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
        $logoPath = FCPATH . 'backend/assets/compiled/svg/logo.svg';
        if (file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            return 'data:image/svg+xml;base64,' . base64_encode($logoData);
        }
        return null;
    }
}
