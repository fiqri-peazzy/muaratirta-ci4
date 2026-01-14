<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;

class Pengaduan extends BaseController
{
    protected $pengaduanModel;
    protected $session;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url', 'auth']);
    }

    /**
     * Display list pengaduan
     */
    public function index()
    {
        $perPage = 20;
        $status = $this->request->getGet('status');
        $prioritas = $this->request->getGet('prioritas');
        $kategori = $this->request->getGet('kategori');
        $search = $this->request->getGet('search');

        $builder = $this->pengaduanModel
            ->select('pengaduan.*, users.nm_lengkap as handler_name')
            ->join('users', 'users.id = pengaduan.handled_by', 'left')
            ->orderBy('pengaduan.created_at', 'DESC');

        // Filter by status
        if ($status && $status !== 'all') {
            $builder->where('pengaduan.status', $status);
        }

        // Filter by prioritas
        if ($prioritas && $prioritas !== 'all') {
            $builder->where('pengaduan.prioritas', $prioritas);
        }

        // Filter by kategori
        if ($kategori && $kategori !== 'all') {
            $builder->where('pengaduan.kategori', $kategori);
        }

        // Search
        if ($search) {
            $builder->groupStart()
                ->like('pengaduan.no_pengaduan', $search)
                ->orLike('pengaduan.nm_lengkap', $search)
                ->orLike('pengaduan.no_hp', $search)
                ->orLike('pengaduan.id_pel', $search)
                ->groupEnd();
        }

        $data = [
            'title' => 'Kelola Pengaduan',
            'pengaduan' => $builder->paginate($perPage),
            'pager' => $this->pengaduanModel->pager,
            'status_filter' => $status ?? 'all',
            'prioritas_filter' => $prioritas ?? 'all',
            'kategori_filter' => $kategori ?? 'all',
            'search' => $search,
            'stats' => $this->pengaduanModel->getStatistics(),
            'categories' => $this->getKategoriList()
        ];

        return view('backend/pages/pengaduan/index', $data);
    }

    /**
     * Display detail pengaduan
     */
    public function detail($id)
    {
        $pengaduan = $this->pengaduanModel->getPengaduanWithHandler($id);

        if (!$pengaduan) {
            $this->session->setFlashdata('error', 'Data pengaduan tidak ditemukan');
            return redirect()->to('/pengaduan');
        }

        $data = [
            'title' => 'Detail Pengaduan - ' . $pengaduan->no_pengaduan,
            'pengaduan' => $pengaduan
        ];

        return view('backend/pages/pengaduan/detail', $data);
    }

    /**
     * Update status pengaduan
     */
    public function updateStatus($id)
    {
        $pengaduan = $this->pengaduanModel->find($id);

        if (!$pengaduan) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $status = $this->request->getPost('status');
        $prioritas = $this->request->getPost('prioritas');
        $catatan = $this->request->getPost('catatan');
        $tanggapan = $this->request->getPost('tanggapan');

        $updateData = [
            'status' => $status,
            'prioritas' => $prioritas,
            'catatan_admin' => $catatan,
            'tanggapan' => $tanggapan,
            'handled_by' => user_id(),
            'handled_at' => date('Y-m-d H:i:s')
        ];

        // Set resolved_at jika status selesai
        if ($status === 'selesai') {
            $updateData['resolved_at'] = date('Y-m-d H:i:s');
        }

        if ($this->pengaduanModel->update($id, $updateData)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status pengaduan berhasil diupdate'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal update status'
        ]);
    }

    /**
     * Export PDF
     */
    public function exportPdf($id)
    {
        $pengaduan = $this->pengaduanModel->getPengaduanWithHandler($id);

        if (!$pengaduan) {
            $this->session->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to('/pengaduan');
        }

        // Convert foto to base64
        $fotoBase64 = null;
        if ($pengaduan->foto) {
            $fotoPath = FCPATH . 'uploads/pengaduan/' . $pengaduan->foto;
            if (file_exists($fotoPath)) {
                $fotoData = file_get_contents($fotoPath);
                $fotoType = pathinfo($fotoPath, PATHINFO_EXTENSION);
                $fotoBase64 = 'data:image/' . $fotoType . ';base64,' . base64_encode($fotoData);
            }
        }

        $data = [
            'pengaduan' => $pengaduan,
            'foto_base64' => $fotoBase64,
            'logo_base64' => $this->getLogoBase64(),
            'printed_at' => date('d F Y H:i:s'),
            'printed_by' => session()->get('name') ?? 'Admin'
        ];

        $html = view('backend/pages/pengaduan/pdf_detail', $data);

        $pdf = new \App\Libraries\PdfGenerator();
        $filename = 'Pengaduan_' . $pengaduan->no_pengaduan . '.pdf';

        return $pdf->generate($html, $filename, 'A4', 'portrait');
    }

    /**
     * Get kategori list
     */
    private function getKategoriList()
    {
        return [
            'umum' => 'Umum',
            'teknis' => 'Teknis',
            'administrasi' => 'Administrasi',
            'tagihan' => 'Tagihan',
            'kualitas_air' => 'Kualitas Air',
            'kebocoran' => 'Kebocoran',
            'sambungan_baru' => 'Sambungan Baru',
            'lainnya' => 'Lainnya'
        ];
    }

    /**
     * Get logo base64
     */
    private function getLogoBase64()
    {
        $logoPath = FCPATH . 'backend/assets/images/logo/logo.png';
        if (file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            return 'data:image/png;base64,' . base64_encode($logoData);
        }
        return null;
    }

    /**
     * Display public complaint form
     */
    public function formPublic()
    {
        $data = [
            'title' => 'Lapor Keluhan',
            'description' => 'Laporkan keluhan atau gangguan layanan air PDAM Muara Tirta secara online',
            'categories' => $this->getKategoriList()
        ];

        return view('frontend/pages/form-lk', $data);
    }

    /**
     * Submit public complaint
     */
    public function submitPublic()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_lengkap' => 'required|min_length[3]',
            'no_hp' => 'required|numeric|min_length[10]',
            'alamat' => 'required|min_length[10]',
            'kategori' => 'required',
            'isi_pengaduan' => 'required|min_length[20]',
            'foto' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]'
        ], [
            'nama_lengkap' => [
                'required' => 'Nama lengkap wajib diisi',
                'min_length' => 'Nama minimal 3 karakter'
            ],
            'no_hp' => [
                'required' => 'Nomor HP wajib diisi',
                'numeric' => 'Nomor HP harus angka',
                'min_length' => 'Nomor HP minimal 10 digit'
            ],
            'alamat' => [
                'required' => 'Alamat wajib diisi',
                'min_length' => 'Alamat minimal 10 karakter'
            ],
            'kategori' => [
                'required' => 'Kategori keluhan wajib dipilih'
            ],
            'isi_pengaduan' => [
                'required' => 'Isi pengaduan wajib diisi',
                'min_length' => 'Isi pengaduan minimal 20 karakter'
            ],
            'foto' => [
                'uploaded' => 'Foto bukti wajib diupload',
                'max_size' => 'Ukuran foto maksimal 2MB',
                'is_image' => 'File harus berupa gambar'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        // Generate nomor pengaduan
        $noPengaduan = $this->pengaduanModel->generateNomorPengaduan();

        // Handle file upload
        $foto = $this->request->getFile('foto');
        $fotoName = null;

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Sanitize nomor pengaduan for filename
            $safeNoPengaduan = str_replace(['/', '\\'], '-', $noPengaduan);
            $fotoName = $safeNoPengaduan . '_' . time() . '.' . $foto->getExtension();

            $uploadDir = FCPATH . 'uploads/pengaduan/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            try {
                $foto->move($uploadDir, $fotoName);
            } catch (\Throwable $e) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal upload foto: ' . $e->getMessage(),
                    'foto' => $fotoName,
                ]);
            }
        }

        // Prepare data
        $data = [
            'no_pengaduan' => $noPengaduan,
            'id_pel' => $this->request->getPost('id_pel'),
            'nm_lengkap' => $this->request->getPost('nama_lengkap'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'email' => $this->request->getPost('email'),
            'kategori' => $this->request->getPost('kategori'),
            'isi_pengaduan' => $this->request->getPost('isi_pengaduan'),
            'foto' => $fotoName,
            'status' => 'pending',
            'prioritas' => 'sedang'
        ];

        // Track user info
        $this->pengaduanModel->trackUserInfo($data);

        // Save to database
        if ($this->pengaduanModel->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Pengaduan berhasil dikirim',
                'no_pengaduan' => $noPengaduan,
                'redirect' => base_url('lapor-keluhan/sukses?no=' . $noPengaduan)
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menyimpan pengaduan'
        ]);
    }

    /**
     * Success page
     */
    public function sukses()
    {
        $noPengaduan = $this->request->getGet('no');

        if (!$noPengaduan) {
            return redirect()->to('lapor-keluhan');
        }

        $pengaduan = $this->pengaduanModel->where('no_pengaduan', $noPengaduan)->first();

        $data = [
            'title' => 'Pengaduan Berhasil',
            'pengaduan' => $pengaduan
        ];

        return view('frontend/pages/sukses-lk', $data);
    }

    /**
     * Tracking page
     */
    public function tracking()
    {
        $data = [
            'title' => 'Lacak Status Pengaduan'
        ];

        return view('frontend/pages/tracking-lk', $data);
    }

    /**
     * Check status via AJAX
     */
    public function checkStatus()
    {
        $noPengaduan = $this->request->getPost('no_pengaduan');

        if (!$noPengaduan) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Nomor pengaduan tidak boleh kosong'
            ]);
        }

        $pengaduan = $this->pengaduanModel->getPengaduanWithHandler(null);
        $pengaduan = array_filter($pengaduan, function ($item) use ($noPengaduan) {
            return $item->no_pengaduan === $noPengaduan;
        });

        if (empty($pengaduan)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Pengaduan tidak ditemukan'
            ]);
        }

        $pengaduan = reset($pengaduan);

        return $this->response->setJSON([
            'success' => true,
            'data' => $pengaduan
        ]);
    }
}
