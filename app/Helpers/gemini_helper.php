<?php

/**
 * Gemini AI Helper
 * Helper functions untuk integrasi Gemini AI
 */

if (!defined('GEMINI_API_KEY')) {
    define('GEMINI_API_KEY', 'AIzaSyBxWKeB6wQzwbNP6ZJuT507hiMTilRjl_A');
}

if (!defined('GEMINI_API_URL')) {
    define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent');
}

/**
 * Call Gemini AI API
 */
function callGeminiAI($prompt, $context = '')
{
    $url = GEMINI_API_URL . '?key=' . GEMINI_API_KEY;

    // Gabungkan context dengan prompt
    $fullPrompt = $context . "\n\nPertanyaan User: " . $prompt;

    // Sanitasi encoding
    $fullPrompt = mb_convert_encoding($fullPrompt, 'UTF-8', 'UTF-8');
    $fullPrompt = str_replace(["\r\n", "\r"], "\n", $fullPrompt);

    $data = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $fullPrompt]
                ]
            ]
        ],
        'generationConfig' => [
            'temperature' => 0.7,
            'maxOutputTokens' => 1000,
            'topP' => 0.8,
            'topK' => 10
        ]
    ];

    $payload = json_encode($data, JSON_UNESCAPED_UNICODE);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json; charset=utf-8'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if (!$response) {
        return [
            'success' => false,
            'message' => 'No response from Gemini API',
            'error' => $error
        ];
    }

    if ($httpCode != 200) {
        $error_detail = json_decode($response, true);
        $msg = isset($error_detail['error']['message']) ? $error_detail['error']['message'] : 'HTTP ' . $httpCode;
        return [
            'success' => false,
            'message' => 'Gemini AI Error: ' . $msg,
            'raw' => $response
        ];
    }

    $result = json_decode($response, true);

    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        return [
            'success' => true,
            'text' => $result['candidates'][0]['content']['parts'][0]['text']
        ];
    }

    return [
        'success' => false,
        'message' => 'Invalid response structure from Gemini AI',
        'raw_response' => $result
    ];
}

/**
 * Get AI context from database
 */
function getAIContext()
{
    $db = \Config\Database::connect();

    $context = "=== IDENTITAS ===\n";
    $context .= "Kamu adalah Asisten Virtual PDAM Muaratirta Gorontalo bernama 'Tirta'.\n";
    $context .= "Tugasmu membantu pelanggan dengan ramah, informatif, dan profesional.\n\n";

    // Ambil FAQ dari database
    $faqs = $db->table('chat_faq')->where('is_active', '1')->get()->getResultArray();
    if (count($faqs) > 0) {
        $context .= "=== FREQUENTLY ASKED QUESTIONS (FAQ) ===\n";
        foreach ($faqs as $faq) {
            $context .= "Q: " . $faq['pertanyaan'] . "\n";
            $context .= "A: " . $faq['jawaban'] . "\n\n";
        }
    }

    // Ambil Info Tarif & Layanan
    $infos = $db->table('chat_info')->where('is_active', '1')->get()->getResultArray();
    if (count($infos) > 0) {
        $context .= "=== INFORMASI TARIF & LAYANAN ===\n";
        foreach ($infos as $info) {
            $context .= $info['judul'] . ":\n" . $info['konten'] . "\n\n";
        }
    }

    $context .= "=== PANDUAN MENJAWAB ===\n";
    $context .= "1. Jawab dengan bahasa Indonesia yang ramah dan sopan\n";
    $context .= "2. Gunakan emoji yang sesuai untuk membuat percakapan lebih friendly (tapi jangan berlebihan)\n";
    $context .= "3. Berikan jawaban yang singkat, padat, dan jelas (maksimal 3-4 paragraf)\n";
    $context .= "4. Jika user tanya tentang CEK TAGIHAN: katakan 'Untuk cek tagihan, silakan klik tombol Cek Tagihan dan masukkan nomor pelanggan Anda'\n";
    $context .= "5. Jika user ingin KOMPLAIN/PENGADUAN: katakan 'Untuk mengajukan pengaduan, silakan klik tombol Kirim Pengaduan dan isi form yang tersedia'\n";
    $context .= "6. Jika tidak tahu jawabannya: katakan dengan jujur dan sarankan untuk menghubungi customer service\n";
    $context .= "7. Format jawaban dengan rapi menggunakan line breaks untuk kemudahan membaca\n";
    $context .= "8. Selalu tutup dengan pertanyaan 'Ada yang bisa saya bantu lagi?' jika perlu\n\n";

    return $context;
}

/**
 * Save chat history
 */
function saveChatHistory($sessionId, $userMessage, $botResponse, $intent = 'general')
{
    $db = \Config\Database::connect();
    $data = [
        'session_id' => $sessionId,
        'user_message' => $userMessage,
        'bot_response' => $botResponse,
        'intent' => $intent
    ];

    $db->table('chat_history')->insert($data);
}

/**
 * Detect intent from user message
 */
function detectIntent($message)
{
    $message = strtolower($message);

    $intents = [
        'cek_tagihan' => ['tagihan', 'cek tagihan', 'bayar', 'pembayaran', 'bill', 'berapa tagihan'],
        'pengaduan' => ['pengaduan', 'komplain', 'keluhan', 'lapor', 'aduan', 'tidak mengalir', 'bocor', 'rusak'],
        'pendaftaran' => ['daftar', 'pendaftaran', 'pelanggan baru', 'pasang baru', 'sambungan baru'],
        'tarif' => ['tarif', 'harga', 'biaya', 'berapa', 'ongkos'],
        'info_layanan' => ['jam', 'operasional', 'buka', 'tutup', 'kontak', 'alamat', 'customer service'],
        'balik_nama' => ['balik nama', 'ganti nama', 'pindah nama'],
    ];

    foreach ($intents as $intent => $keywords) {
        foreach ($keywords as $keyword) {
            if (strpos($message, $keyword) !== false) {
                return $intent;
            }
        }
    }

    return 'general';
}
