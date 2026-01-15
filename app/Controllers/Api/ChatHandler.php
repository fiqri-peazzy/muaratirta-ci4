<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class ChatHandler extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        helper(['gemini']);
    }

    /**
     * Handle chat messages from frontend
     */
    public function index()
    {
        $input = $this->request->getJSON();
        $message = isset($input->message) ? trim($input->message) : '';
        $sessionId = isset($input->session_id) ? $input->session_id : session_id();

        if (empty($message)) {
            return $this->fail('Pesan tidak boleh kosong');
        }

        // Search for direct answers in FAQ first (optional local search)
        // For now, we rely on Gemini to use the context we provide it.

        $context = getAIContext();
        $aiResponse = callGeminiAI($message, $context);

        if ($aiResponse['success']) {
            $intent = detectIntent($message);
            saveChatHistory($sessionId, $message, $aiResponse['text'], $intent);

            return $this->respond([
                'success'    => true,
                'message'    => $aiResponse['text'],
                'intent'     => $intent,
                'session_id' => $sessionId
            ]);
        }

        return $this->respond([
            'success' => false,
            'message' => 'Maaf, saat ini sistem sedang mengalami gangguan. Silakan coba lagi nanti atau hubungi customer service kami.',
            'error'   => isset($aiResponse['message']) ? $aiResponse['message'] : 'Gemini AI Error'
        ]);
    }

    /**
     * Submit pengaduan from chat
     */
    public function submitPengaduan()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'id_pel'         => 'required',
            'nm_lengkap'     => 'required',
            'alamat'         => 'required',
            'no_hp'          => 'required',
            'isi_pengaduan'  => 'required',
            'foto'           => 'permit_empty|uploaded[foto]|max_size[foto,5120]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $this->validator->getErrors()
            ]);
        }

        $pengaduanModel = new \App\Models\PengaduanModel();

        $data = [
            'id_pel'        => $this->request->getPost('id_pel'),
            'nm_lengkap'    => $this->request->getPost('nm_lengkap'),
            'alamat'        => $this->request->getPost('alamat'),
            'no_hp'         => $this->request->getPost('no_hp'),
            'isi_pengaduan' => $this->request->getPost('isi_pengaduan'),
            'status'        => '0'
        ];

        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/pengaduan/', $newName);
            $data['foto'] = $newName;
        }

        if ($pengaduanModel->insert($data)) {
            return $this->respond([
                'success' => true,
                'message' => 'Pengaduan Anda telah berhasil terkirim. Tim kami akan segera menindaklanjuti.'
            ]);
        }

        return $this->respond([
            'success' => false,
            'message' => 'Gagal menyimpan pengaduan. Silakan coba lagi.'
        ]);
    }
}
