<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TingkatJabatanModel;
use App\Models\BagianModel;
use App\Models\StaffOrganisasiModel;

class Organisasi extends BaseController
{
    protected $tingkatJabatanModel;
    protected $bagianModel;
    protected $staffModel;
    protected $session;

    public function __construct()
    {
        $this->tingkatJabatanModel = new TingkatJabatanModel();
        $this->bagianModel = new BagianModel();
        $this->staffModel = new StaffOrganisasiModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url', 'auth', 'filesystem']);
    }

    // ========== TINGKAT JABATAN ==========

    /**
     * Display & manage tingkat jabatan
     */
    public function tingkatJabatan()
    {
        $data = [
            'title' => 'Tingkat Jabatan',
            'tingkat' => $this->tingkatJabatanModel->orderBy('level', 'ASC')->findAll(),
            'nextLevel' => $this->tingkatJabatanModel->getNextLevel()
        ];

        return view('backend/pages/organisasi/tingkat_jabatan', $data);
    }

    /**
     * Store tingkat jabatan
     */
    public function tingkatJabatanStore()
    {
        $rules = [
            'nama_tingkat' => 'required|min_length[3]|max_length[100]',
            'level' => 'required|numeric|is_unique[tingkat_jabatan.level]',
            'keterangan' => 'permit_empty|max_length[500]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'nama_tingkat' => $this->request->getPost('nama_tingkat'),
            'level' => $this->request->getPost('level'),
            'keterangan' => $this->request->getPost('keterangan'),
            'is_active' => '1'
        ];

        if ($this->tingkatJabatanModel->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Tingkat jabatan berhasil ditambahkan'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menambahkan tingkat jabatan'
        ]);
    }

    /**
     * Update tingkat jabatan
     */
    public function tingkatJabatanUpdate($id)
    {
        $tingkat = $this->tingkatJabatanModel->find($id);

        if (!$tingkat) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $rules = [
            'nama_tingkat' => 'required|min_length[3]|max_length[100]',
            'level' => "required|numeric|is_unique[tingkat_jabatan.level,id,{$id}]",
            'keterangan' => 'permit_empty|max_length[500]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'nama_tingkat' => $this->request->getPost('nama_tingkat'),
            'level' => $this->request->getPost('level'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        if ($this->tingkatJabatanModel->update($id, $data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Tingkat jabatan berhasil diupdate'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal mengupdate tingkat jabatan'
        ]);
    }

    /**
     * Delete tingkat jabatan
     */
    public function tingkatJabatanDelete($id)
    {
        $tingkat = $this->tingkatJabatanModel->find($id);

        if (!$tingkat) {
            $this->session->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to('/organisasi/tingkat-jabatan');
        }

        // Check if used in staff
        $staffCount = $this->staffModel->where('tingkat_jabatan_id', $id)->countAllResults();

        if ($staffCount > 0) {
            $this->session->setFlashdata('error', "Tidak dapat menghapus. Ada {$staffCount} staff yang menggunakan tingkat jabatan ini");
            return redirect()->to('/organisasi/tingkat-jabatan');
        }

        if ($this->tingkatJabatanModel->delete($id)) {
            $this->session->setFlashdata('success', 'Tingkat jabatan berhasil dihapus');
        } else {
            $this->session->setFlashdata('error', 'Gagal menghapus tingkat jabatan');
        }

        return redirect()->to('/organisasi/tingkat-jabatan');
    }

    // ========== BAGIAN ==========

    /**
     * Display list bagian
     */
    public function bagian()
    {
        $data = [
            'title' => 'Bagian/Divisi',
            'bagian' => $this->bagianModel->getBagianWithParent(),
        ];

        return view('backend/pages/organisasi/bagian/index', $data);
    }

    /**
     * Show create bagian form
     */
    public function bagianCreate()
    {
        $data = [
            'title' => 'Tambah Bagian',
            'allBagian' => $this->bagianModel->getActive(),
            'nextUrutan' => $this->bagianModel->getNextUrutan(),
            'kodeBagian' => $this->bagianModel->generateKodeBagian()
        ];

        return view('backend/pages/organisasi/bagian/create', $data);
    }

    /**
     * Store bagian
     */
    public function bagianStore()
    {
        $rules = [
            'kd_bagian' => 'required|is_unique[bagian.kd_bagian]|max_length[50]',
            'nama_bagian' => 'required|min_length[3]|max_length[200]',
            'urutan' => 'required|numeric',
            'parent_id' => 'permit_empty|numeric',
            'deskripsi' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'kd_bagian' => $this->request->getPost('kd_bagian'),
            'nama_bagian' => $this->request->getPost('nama_bagian'),
            'parent_id' => $this->request->getPost('parent_id') ?: null,
            'urutan' => $this->request->getPost('urutan'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'is_active' => '1'
        ];

        if ($this->bagianModel->insert($data)) {
            $this->session->setFlashdata('success', 'Bagian berhasil ditambahkan');
            return redirect()->to('/organisasi/bagian');
        }

        $this->session->setFlashdata('error', 'Gagal menambahkan bagian');
        return redirect()->back()->withInput();
    }

    /**
     * Show edit bagian form
     */
    public function bagianEdit($id)
    {
        $bagian = $this->bagianModel->find($id);

        if (!$bagian) {
            $this->session->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to('/organisasi/bagian');
        }

        $data = [
            'title' => 'Edit Bagian',
            'bagian' => $bagian,
            'allBagian' => $this->bagianModel->where('id !=', $id)->findAll(),
        ];

        return view('backend/pages/organisasi/bagian/edit', $data);
    }

    /**
     * Update bagian
     */
    public function bagianUpdate($id)
    {
        $bagian = $this->bagianModel->find($id);

        if (!$bagian) {
            $this->session->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to('/organisasi/bagian');
        }

        $rules = [
            'kd_bagian' => "required|is_unique[bagian.kd_bagian,id,{$id}]|max_length[50]",
            'nama_bagian' => 'required|min_length[3]|max_length[200]',
            'urutan' => 'required|numeric',
            'parent_id' => 'permit_empty|numeric',
            'deskripsi' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'kd_bagian' => $this->request->getPost('kd_bagian'),
            'nama_bagian' => $this->request->getPost('nama_bagian'),
            'parent_id' => $this->request->getPost('parent_id') ?: null,
            'urutan' => $this->request->getPost('urutan'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];

        if ($this->bagianModel->update($id, $data)) {
            $this->session->setFlashdata('success', 'Bagian berhasil diupdate');
            return redirect()->to('/organisasi/bagian');
        }

        $this->session->setFlashdata('error', 'Gagal mengupdate bagian');
        return redirect()->back()->withInput();
    }

    /**
     * Delete bagian
     */
    public function bagianDelete($id)
    {
        $bagian = $this->bagianModel->find($id);

        if (!$bagian) {
            $this->session->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to('/organisasi/bagian');
        }

        // Check if has child bagian
        $childCount = $this->bagianModel->where('parent_id', $id)->countAllResults();
        if ($childCount > 0) {
            $this->session->setFlashdata('error', "Tidak dapat menghapus. Ada {$childCount} sub bagian di bawahnya");
            return redirect()->to('/organisasi/bagian');
        }

        // Check if used in staff
        $staffCount = $this->staffModel->where('bagian_id', $id)->countAllResults();
        if ($staffCount > 0) {
            $this->session->setFlashdata('error', "Tidak dapat menghapus. Ada {$staffCount} staff di bagian ini");
            return redirect()->to('/organisasi/bagian');
        }

        if ($this->bagianModel->delete($id)) {
            $this->session->setFlashdata('success', 'Bagian berhasil dihapus');
        } else {
            $this->session->setFlashdata('error', 'Gagal menghapus bagian');
        }

        return redirect()->to('/organisasi/bagian');
    }

    // ========== STAFF ORGANISASI ==========

    /**
     * Display list staff
     */
    public function staff()
    {
        $bagianFilter = $this->request->getGet('bagian');
        $tingkatFilter = $this->request->getGet('tingkat');
        $search = $this->request->getGet('search');

        $builder = $this->staffModel
            ->select('staff_organisasi.*, bagian.nama_bagian, bagian.kd_bagian, tingkat_jabatan.nama_tingkat, tingkat_jabatan.level')
            ->join('bagian', 'bagian.id = staff_organisasi.bagian_id')
            ->join('tingkat_jabatan', 'tingkat_jabatan.id = staff_organisasi.tingkat_jabatan_id');

        if ($bagianFilter && $bagianFilter !== 'all') {
            $builder->where('staff_organisasi.bagian_id', $bagianFilter);
        }

        if ($tingkatFilter && $tingkatFilter !== 'all') {
            $builder->where('staff_organisasi.tingkat_jabatan_id', $tingkatFilter);
        }

        if ($search) {
            $builder->groupStart()
                ->like('staff_organisasi.nm_lengkap', $search)
                ->orLike('staff_organisasi.nip', $search)
                ->orLike('staff_organisasi.jabatan_spesifik', $search)
                ->groupEnd();
        }

        $staff = $builder->orderBy('tingkat_jabatan.level', 'ASC')
            ->orderBy('bagian.urutan', 'ASC')
            ->orderBy('staff_organisasi.urutan_tampil', 'ASC')
            ->paginate(20);

        $data = [
            'title' => 'Staff Organisasi',
            'staff' => $staff,
            'pager' => $this->staffModel->pager,
            'allBagian' => $this->bagianModel->getActive(),
            'allTingkat' => $this->tingkatJabatanModel->getActive(),
            'bagian_filter' => $bagianFilter ?? 'all',
            'tingkat_filter' => $tingkatFilter ?? 'all',
            'search' => $search,
            'stats' => [
                'total' => $this->staffModel->countAll(),
                'active' => $this->staffModel->where('is_active', '1')->countAllResults(),
            ]
        ];

        return view('backend/pages/organisasi/staff/index', $data);
    }

    /**
     * Show create staff form
     */
    public function staffCreate()
    {
        $data = [
            'title' => 'Tambah Staff',
            'allBagian' => $this->bagianModel->getActive(),
            'allTingkat' => $this->tingkatJabatanModel->getActive(),
        ];

        return view('backend/pages/organisasi/staff/create', $data);
    }

    /**
     * Store staff
     */
    public function staffStore()
    {
        $rules = [
            'nm_lengkap' => 'required|min_length[3]|max_length[200]',
            'bagian_id' => 'required|numeric',
            'tingkat_jabatan_id' => 'required|numeric',
            'jabatan_spesifik' => 'required|min_length[3]|max_length[200]',
            'nip' => 'permit_empty|max_length[50]',
            'gelar_depan' => 'permit_empty|max_length[50]',
            'gelar_belakang' => 'permit_empty|max_length[100]',
            'email' => 'permit_empty|valid_email',
            'no_hp' => 'permit_empty|max_length[25]',
            'status_kepegawaian' => 'required|in_list[PNS,PPPK,Kontrak,Honorer]',
            'urutan_tampil' => 'required|numeric',
            'profile_pict' => 'permit_empty|max_size[profile_pict,2048]|is_image[profile_pict]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $profilePict = null;
        $file = $this->request->getFile('profile_pict');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $profilePict = $file->getRandomName();
            $file->move(FCPATH . 'uploads/organisasi/', $profilePict);
            $this->resizeImage(FCPATH . 'uploads/organisasi/' . $profilePict, 400, 400);
        }

        $data = [
            'nip' => $this->request->getPost('nip'),
            'nm_lengkap' => $this->request->getPost('nm_lengkap'),
            'gelar_depan' => $this->request->getPost('gelar_depan'),
            'gelar_belakang' => $this->request->getPost('gelar_belakang'),
            'bagian_id' => $this->request->getPost('bagian_id'),
            'tingkat_jabatan_id' => $this->request->getPost('tingkat_jabatan_id'),
            'jabatan_spesifik' => $this->request->getPost('jabatan_spesifik'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status_kepegawaian' => $this->request->getPost('status_kepegawaian'),
            'urutan_tampil' => $this->request->getPost('urutan_tampil'),
            'profile_pict' => $profilePict,
            'is_active' => '1'
        ];

        if ($this->staffModel->insert($data)) {
            $this->session->setFlashdata('success', 'Staff berhasil ditambahkan');
            return redirect()->to('/organisasi/staff');
        }

        $this->session->setFlashdata('error', 'Gagal menambahkan staff');
        return redirect()->back()->withInput();
    }

    /**
     * Show edit staff form
     */
    public function staffEdit($id)
    {
        $staff = $this->staffModel->find($id);

        if (!$staff) {
            $this->session->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to('/organisasi/staff');
        }

        $data = [
            'title' => 'Edit Staff',
            'staff' => $staff,
            'allBagian' => $this->bagianModel->getActive(),
            'allTingkat' => $this->tingkatJabatanModel->getActive(),
        ];

        return view('backend/pages/organisasi/staff/edit', $data);
    }

    /**
     * Update staff
     */
    public function staffUpdate($id)
    {
        $staff = $this->staffModel->find($id);

        if (!$staff) {
            $this->session->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to('/organisasi/staff');
        }

        $rules = [
            'nm_lengkap' => 'required|min_length[3]|max_length[200]',
            'bagian_id' => 'required|numeric',
            'tingkat_jabatan_id' => 'required|numeric',
            'jabatan_spesifik' => 'required|min_length[3]|max_length[200]',
            'nip' => 'permit_empty|max_length[50]',
            'gelar_depan' => 'permit_empty|max_length[50]',
            'gelar_belakang' => 'permit_empty|max_length[100]',
            'email' => 'permit_empty|valid_email',
            'no_hp' => 'permit_empty|max_length[25]',
            'status_kepegawaian' => 'required|in_list[PNS,PPPK,Kontrak,Honorer]',
            'urutan_tampil' => 'required|numeric',
            'profile_pict' => 'permit_empty|max_size[profile_pict,2048]|is_image[profile_pict]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $profilePict = $staff->profile_pict;
        $file = $this->request->getFile('profile_pict');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old file
            if ($staff->profile_pict && file_exists(FCPATH . 'uploads/organisasi/' . $staff->profile_pict)) {
                unlink(FCPATH . 'uploads/organisasi/' . $staff->profile_pict);
            }

            $profilePict = $file->getRandomName();
            $file->move(FCPATH . 'uploads/organisasi/', $profilePict);
            $this->resizeImage(FCPATH . 'uploads/organisasi/' . $profilePict, 400, 400);
        }

        $data = [
            'nip' => $this->request->getPost('nip'),
            'nm_lengkap' => $this->request->getPost('nm_lengkap'),
            'gelar_depan' => $this->request->getPost('gelar_depan'),
            'gelar_belakang' => $this->request->getPost('gelar_belakang'),
            'bagian_id' => $this->request->getPost('bagian_id'),
            'tingkat_jabatan_id' => $this->request->getPost('tingkat_jabatan_id'),
            'jabatan_spesifik' => $this->request->getPost('jabatan_spesifik'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status_kepegawaian' => $this->request->getPost('status_kepegawaian'),
            'urutan_tampil' => $this->request->getPost('urutan_tampil'),
            'profile_pict' => $profilePict,
        ];

        if ($this->staffModel->update($id, $data)) {
            $this->session->setFlashdata('success', 'Staff berhasil diupdate');
            return redirect()->to('/organisasi/staff');
        }

        $this->session->setFlashdata('error', 'Gagal mengupdate staff');
        return redirect()->back()->withInput();
    }

    /**
     * Delete staff
     */
    public function staffDelete($id)
    {
        $staff = $this->staffModel->find($id);

        if (!$staff) {
            $this->session->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to('/organisasi/staff');
        }

        // Delete profile picture
        if ($staff->profile_pict && file_exists(FCPATH . 'uploads/organisasi/' . $staff->profile_pict)) {
            unlink(FCPATH . 'uploads/organisasi/' . $staff->profile_pict);
        }

        if ($this->staffModel->delete($id)) {
            $this->session->setFlashdata('success', 'Staff berhasil dihapus');
        } else {
            $this->session->setFlashdata('error', 'Gagal menghapus staff');
        }

        return redirect()->to('/organisasi/staff');
    }

    /**
     * Toggle staff status
     */
    public function staffToggleStatus($id)
    {
        $staff = $this->staffModel->find($id);

        if (!$staff) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $newStatus = $staff->is_active == '1' ? '0' : '1';

        if ($this->staffModel->update($id, ['is_active' => $newStatus])) {
            $statusText = $newStatus == '1' ? 'diaktifkan' : 'dinonaktifkan';
            return $this->response->setJSON([
                'success' => true,
                'message' => "Staff berhasil {$statusText}",
                'new_status' => $newStatus
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal mengubah status'
        ]);
    }

    public function publicIndex()
    {
        $allTingkat = $this->tingkatJabatanModel->where('is_active', '1')->orderBy('level', 'ASC')->findAll();
        $allBagian = $this->bagianModel->where('is_active', '1')->orderBy('urutan', 'ASC')->findAll();

        $staffRaw = $this->staffModel->getStaffWithDetails();

        $topLevelStaff = [];
        $departmentalStaff = []; // [bagian_id => [level => [staff]]]

        foreach ($staffRaw as $s) {
            if ($s->is_active != '1') continue;

            if ($s->level <= 3) {
                $topLevelStaff[$s->level][] = $s;
            } else {
                $departmentalStaff[$s->bagian_id][$s->level][] = $s;
            }
        }

        $data = [
            'title' => 'Struktur Organisasi',
            'topLevelStaff' => $topLevelStaff,
            'departmentalStaff' => $departmentalStaff,
            'allBagian' => $allBagian,
            'allTingkat' => $allTingkat,
        ];

        return view('frontend/pages/organisasi/public-index', $data);
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
}
