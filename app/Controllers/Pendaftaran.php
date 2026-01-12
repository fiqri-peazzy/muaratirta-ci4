<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PendaftaranModel;
use App\Libraries\PdfGenerator;

class Pendaftaran extends BaseController
{
    protected $pendaftaranModel;
    protected $session;

    public function __construct()
    {
        $this->pendaftaranModel = new PendaftaranModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url', 'auth']);
    }

    /**
     * Display list pendaftaran
     */
    public function index()
    {
        $perPage = 20;
        $status = $this->request->getGet('status');
        $search = $this->request->getGet('search');

        $builder = $this->pendaftaranModel->orderBy('created_at', 'DESC');

        // Filter by status
        if ($status && $status !== 'all') {
            $builder->where('status', $status);
        }

        // Search
        if ($search) {
            $builder->groupStart()
                ->like('no_pendaftaran', $search)
                ->orLike('nama_lengkap', $search)
                ->orLike('no_hp', $search)
                ->groupEnd();
        }

        $data = [
            'title' => 'Kelola Pendaftaran Baru',
            'pendaftaran' => $builder->paginate($perPage),
            'pager' => $this->pendaftaranModel->pager,
            'status_filter' => $status ?? 'all',
            'search' => $search,
            'stats' => [
                'pending' => $this->pendaftaranModel->where('status', 'pending')->countAllResults(),
                'verifikasi' => $this->pendaftaranModel->where('status', 'verifikasi')->countAllResults(),
                'approved' => $this->pendaftaranModel->where('status', 'approved')->countAllResults(),
                'rejected' => $this->pendaftaranModel->where('status', 'rejected')->countAllResults(),
            ]
        ];

        return view('backend/pages/pendaftaran/index', $data);
    }

    /**
     * Display detail pendaftaran
     */
    public function detail($id)
    {
        $pendaftaran = $this->pendaftaranModel->find($id);

        if (!$pendaftaran) {
            $this->session->setFlashdata('error', 'Data pendaftaran tidak ditemukan');
            return redirect()->to('/pendaftaran');
        }

        $data = [
            'title' => 'Detail Pendaftaran - ' . $pendaftaran->no_pendaftaran,
            'pendaftaran' => $pendaftaran
        ];

        return view('backend/pages/pendaftaran/detail', $data);
    }

    /**
     * Update status pendaftaran
     */
    public function updateStatus($id)
    {
        $pendaftaran = $this->pendaftaranModel->find($id);

        if (!$pendaftaran) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $status = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');

        $updateData = [
            'status' => $status,
            'verified_by' => user_id(),
            'verified_at' => date('Y-m-d H:i:s')
        ];

        if ($status === 'rejected') {
            $updateData['catatan_penolakan'] = $catatan;
        } else {
            $updateData['catatan_admin'] = $catatan;
        }

        if ($this->pendaftaranModel->update($id, $updateData)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status berhasil diupdate'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal update status'
        ]);
    }

    /**
     * Export single pendaftaran to PDF
     */
    public function exportPdf($id)
    {
        $pendaftaran = $this->pendaftaranModel->find($id);

        if (!$pendaftaran) {
            $this->session->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to('/pendaftaran');
        }

        // Convert images to base64 untuk menghindari error remote loading
        $fotoKtpBase64 = null;
        $fotoRumahBase64 = null;

        if ($pendaftaran->foto_ktp) {
            $ktpPath = FCPATH . 'uploads/pendaftaran/ktp/' . $pendaftaran->foto_ktp;
            if (file_exists($ktpPath)) {
                $ktpData = file_get_contents($ktpPath);
                $ktpType = pathinfo($ktpPath, PATHINFO_EXTENSION);
                $fotoKtpBase64 = 'data:image/' . $ktpType . ';base64,' . base64_encode($ktpData);
            }
        }

        if ($pendaftaran->foto_rumah) {
            $rumahPath = FCPATH . 'uploads/pendaftaran/rumah/' . $pendaftaran->foto_rumah;
            if (file_exists($rumahPath)) {
                $rumahData = file_get_contents($rumahPath);
                $rumahType = pathinfo($rumahPath, PATHINFO_EXTENSION);
                $fotoRumahBase64 = 'data:image/' . $rumahType . ';base64,' . base64_encode($rumahData);
            }
        }

        // Convert logo to base64 juga
        $logoBase64 = null;
        $logoPath = FCPATH . 'backend/assets/images/logo/logo.png';
        if (file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/png;base64,' . base64_encode($logoData);
        }

        $data = [
            'pendaftaran' => $pendaftaran,
            'foto_ktp_base64' => $fotoKtpBase64,
            'foto_rumah_base64' => $fotoRumahBase64,
            'logo_base64' => $logoBase64,
            'printed_at' => date('d F Y H:i:s'),
            'printed_by' => session()->get('name') ?? 'Admin'
        ];

        $html = view('backend/pages/pendaftaran/pdf_detail', $data);

        $pdf = new PdfGenerator();
        $filename = 'Pendaftaran_' . $pendaftaran->no_pendaftaran . '.pdf';

        return $pdf->generate($html, $filename, 'A4', 'portrait');
    }
    /**
     * Export bulk pendaftaran to PDF
     */
    public function exportBulkPdf()
    {
        $status = $this->request->getGet('status');
        $search = $this->request->getGet('search');

        $builder = $this->pendaftaranModel->orderBy('created_at', 'DESC');

        if ($status && $status !== 'all') {
            $builder->where('status', $status);
        }

        if ($search) {
            $builder->groupStart()
                ->like('no_pendaftaran', $search)
                ->orLike('nama_lengkap', $search)
                ->orLike('no_hp', $search)
                ->groupEnd();
        }

        $pendaftaran = $builder->findAll();

        if (empty($pendaftaran)) {
            $this->session->setFlashdata('error', 'Tidak ada data untuk diekspor');
            return redirect()->to('/pendaftaran');
        }

        $data = [
            'pendaftaran' => $pendaftaran,
            'status_filter' => $status ?? 'all',
            'printed_at' => date('d F Y H:i:s'),
            'printed_by' => user_name()
        ];

        $html = view('backend/pages/pendaftaran/pdf_list', $data);

        $pdf = new PdfGenerator();
        $filename = 'Laporan_Pendaftaran_' . date('Ymd_His') . '.pdf';

        return $pdf->generate($html, $filename, 'A4', 'portrait');
    }
}
