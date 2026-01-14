<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Tagihan extends BaseController
{
    public function index()
    {
        return view('frontend/pages/form-tagihan');
    }

    /**
     * Fetch billing data from external API
     */
    public function get_detail()
    {
        if ($this->request->isAJAX()) {
            $id_pel = $this->request->getPost('id_pel');

            if (empty($id_pel)) {
                return $this->response->setJSON(['status' => false, 'error' => ['id_pel' => 'Nomor Sambung wajib diisi']]);
            }

            if (!is_numeric($id_pel) || strlen($id_pel) != 7) {
                return $this->response->setJSON(['status' => false, 'error' => ['id_pel' => 'Nomor Sambung harus 7 digit angka']]);
            }

            // Using token from requirements
            $token = '5d659eef91487eb4d4c4181d51977mkm';
            $url = "http://gorontalo.homeip.net/webapi/pelanggan/getTagihanDetail?token={$token}&nosamw={$id_pel}";

            try {
                $client = \Config\Services::curlrequest();
                $response = $client->get($url, [
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                    'timeout' => 10,
                    'http_errors' => false // Don't throw exception on 4xx/5xx
                ]);

                $body = $response->getBody();
                $data = json_decode($body, true);

                if ($data) {
                    return $this->response->setJSON($data);
                } else {
                    return $this->response->setJSON(['status' => false, 'message' => 'Gagal menguraikan data dari server']);
                }
            } catch (\Exception $e) {
                return $this->response->setJSON(['status' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
        }

        return $this->response->setStatusCode(404);
    }

    /**
     * Proxy for Foto Rumah to avoid mixed content in browser
     */
    public function foto_proxy($id)
    {
        $url = "http://103.133.223.242/sister-gto/api/uploads/rumah/{$id}.jpg";

        try {
            $client = \Config\Services::curlrequest();
            $response = $client->get($url, [
                'timeout' => 5,
                'http_errors' => false
            ]);

            if ($response->getStatusCode() == 200) {
                return $this->response
                    ->setHeader('Content-Type', 'image/jpeg')
                    ->setBody($response->getBody());
            }
        } catch (\Exception $e) {
            // Handle silently
        }

        return $this->response->setStatusCode(404);
    }
}
