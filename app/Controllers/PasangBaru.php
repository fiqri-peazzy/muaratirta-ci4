<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PendaftaranModel;

class PasangBaru extends BaseController
{
    protected $pendaftaranModel;
    protected $session;

    public function __construct()
    {
        $this->pendaftaranModel = new PendaftaranModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url', 'filesystem']);
    }

    /**
     * Display form pendaftaran
     */
    public function index()
    {
        $data = [
            'title' => 'Pendaftaran Pasang Baru',
            'description' => 'Daftar pemasangan sambungan air bersih PDAM Muara Tirta secara online',
        ];

        return view('frontend/pages/form-pb', $data);
    }

    /**
     * Submit pendaftaran
     */
    public function submit()
    {
        // Validation rules
        $rules = [
            'nama_lengkap'      => 'required|min_length[3]|max_length[200]',
            'nik'               => 'permit_empty|numeric|min_length[16]|max_length[16]',
            'alamat_pemasangan' => 'required|min_length[10]',
            'rt'                => 'permit_empty|max_length[5]',
            'rw'                => 'permit_empty|max_length[5]',
            'kelurahan'         => 'permit_empty|max_length[100]',
            'kecamatan'         => 'permit_empty|max_length[100]',
            'latitude'          => 'permit_empty',
            'longitude'         => 'permit_empty',
            'no_hp'             => 'required|numeric|min_length[10]|max_length[16]',
            'no_wa'             => 'permit_empty|numeric|min_length[10]|max_length[16]',
            'email'             => 'permit_empty|valid_email',
            'foto_ktp'          => 'uploaded[foto_ktp]|max_size[foto_ktp,2048]|is_image[foto_ktp]',
            'foto_rumah'        => 'uploaded[foto_rumah]|max_size[foto_rumah,2048]|is_image[foto_rumah]',
            'setuju_biaya'      => 'required|in_list[1]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $this->validator->getErrors()
            ]);
        }

        // Handle file uploads
        $fotoKTP = $this->request->getFile('foto_ktp');
        $fotoRumah = $this->request->getFile('foto_rumah');

        $ktpName = null;
        $rumahName = null;

        // Upload KTP
        if ($fotoKTP && $fotoKTP->isValid() && !$fotoKTP->hasMoved()) {
            $ktpName = $fotoKTP->getRandomName();
            $fotoKTP->move(FCPATH . 'uploads/pendaftaran/ktp/', $ktpName);

            // Resize image
            $this->resizeImage(FCPATH . 'uploads/pendaftaran/ktp/' . $ktpName, 800, 600);
        }

        // Upload Foto Rumah
        if ($fotoRumah && $fotoRumah->isValid() && !$fotoRumah->hasMoved()) {
            $rumahName = $fotoRumah->getRandomName();
            $fotoRumah->move(FCPATH . 'uploads/pendaftaran/rumah/', $rumahName);

            // Resize image
            $this->resizeImage(FCPATH . 'uploads/pendaftaran/rumah/' . $rumahName, 1200, 900);
        }

        // Generate nomor pendaftaran
        $noPendaftaran = $this->pendaftaranModel->generateNomorPendaftaran();

        // Prepare data
        $data = [
            'no_pendaftaran'    => $noPendaftaran,
            'nama_lengkap'      => $this->request->getPost('nama_lengkap'),
            'nik'               => $this->request->getPost('nik'),
            'alamat_pemasangan' => $this->request->getPost('alamat_pemasangan'),
            'rt'                => $this->request->getPost('rt'),
            'rw'                => $this->request->getPost('rw'),
            'kelurahan'         => $this->request->getPost('kelurahan'),
            'kecamatan'         => $this->request->getPost('kecamatan'),
            'latitude'          => $this->request->getPost('latitude'),
            'longitude'         => $this->request->getPost('longitude'),
            'no_hp'             => $this->request->getPost('no_hp'),
            'no_wa'             => $this->request->getPost('no_wa') ?: $this->request->getPost('no_hp'),
            'email'             => $this->request->getPost('email'),
            'foto_ktp'          => $ktpName,
            'foto_rumah'        => $rumahName,
            'setuju_biaya'      => '1',
            'status'            => 'pending',
        ];

        // Track user info
        $this->pendaftaranModel->trackUserInfo($data);

        // Save to database
        if ($this->pendaftaranModel->insert($data)) {
            // Store nomor pendaftaran in session for success page
            $this->session->set('last_pendaftaran', $noPendaftaran);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Pendaftaran berhasil disimpan',
                'no_pendaftaran' => $noPendaftaran,
                'redirect' => base_url('pasang-baru/sukses')
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menyimpan pendaftaran. Silakan coba lagi.'
        ]);
    }

    /**
     * Success page after submission
     */
    public function sukses()
    {
        $noPendaftaran = $this->session->get('last_pendaftaran');

        if (!$noPendaftaran) {
            return redirect()->to('pasang-baru');
        }

        $pendaftaran = $this->pendaftaranModel->where('no_pendaftaran', $noPendaftaran)->first();

        if (!$pendaftaran) {
            return redirect()->to('pasang-baru');
        }

        $data = [
            'title' => 'Pendaftaran Berhasil',
            'description' => 'Pendaftaran pasang baru Anda telah berhasil',
            'pendaftaran' => $pendaftaran,
        ];

        // Clear session
        $this->session->remove('last_pendaftaran');

        return view('frontend/pages/sukses-pb', $data);
    }

    /**
     * Tracking page
     */
    public function tracking()
    {
        $data = [
            'title' => 'Lacak Status Pendaftaran',
            'description' => 'Cek status pendaftaran pasang baru Anda',
        ];

        return view('frontend/pages/tracking-pb', $data);
    }

    /**
     * Check status via AJAX
     */
    public function checkStatus()
    {
        $noPendaftaran = $this->request->getPost('no_pendaftaran');

        if (!$noPendaftaran) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Nomor pendaftaran wajib diisi'
            ]);
        }

        $pendaftaran = $this->pendaftaranModel->where('no_pendaftaran', $noPendaftaran)->first();

        if (!$pendaftaran) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Nomor pendaftaran tidak ditemukan'
            ]);
        }

        // Status labels
        $statusLabels = [
            'pending'     => 'Menunggu Verifikasi',
            'verifikasi'  => 'Sedang Diverifikasi',
            'approved'    => 'Disetujui',
            'survey'      => 'Proses Survey Lokasi',
            'rejected'    => 'Ditolak',
        ];

        return $this->response->setJSON([
            'success' => true,
            'data' => [
                'no_pendaftaran'    => $pendaftaran->no_pendaftaran,
                'nama_lengkap'      => $pendaftaran->nama_lengkap,
                'alamat_pemasangan' => $pendaftaran->alamat_pemasangan,
                'no_hp'             => $pendaftaran->no_hp,
                'status'            => $pendaftaran->status,
                'status_label'      => $statusLabels[$pendaftaran->status],
                'tanggal_daftar'    => date('d F Y', strtotime($pendaftaran->created_at)),
                'catatan_admin'     => $pendaftaran->catatan_admin,
                'catatan_penolakan' => $pendaftaran->catatan_penolakan,
            ]
        ]);
    }

    /**
     * Upload image for Google Maps location picker (optional)
     */
    public function uploadLocation()
    {
        // Handle temporary image upload if needed
        // This can be used for location picker preview
    }

    /**
     * Resize image helper
     */
    private function resizeImage($filePath, $maxWidth, $maxHeight)
    {
        $image = \Config\Services::image()
            ->withFile($filePath)
            ->resize($maxWidth, $maxHeight, true, 'height')
            ->save($filePath);

        return $image;
    }

    /**
     * Get coordinates from address (Google Geocoding API - optional)
     */
    private function getCoordinatesFromAddress($address)
    {
        // Implementation for geocoding if needed
        // Requires Google Maps API key
        return null;
    }
}
