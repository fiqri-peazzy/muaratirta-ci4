<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\KontenModel;

class Publikasi extends BaseController
{
    protected $kategoriModel;
    protected $session;

    public function __construct()
    {
        $this->kategoriModel = new \App\Models\KategoriModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url', 'auth']);
    }

    /**
     * List kategori
     */
    public function kategori()
    {
        $data = [
            'title' => 'Manajemen Kategori',
            'pageTitle' => 'Kategori Publikasi',
            'breadcrumbs' => 'Publikasi / Kategori',
            'kategoris' => $this->kategoriModel->getCategoriesWithCount()
        ];

        return view('backend/pages/kategori/index', $data);
    }

    /**
     * Create kategori forms
     */
    public function kategoriCreate()
    {
        $data = [
            'title' => 'Tambah Kategori',
            'pageTitle' => 'Tambah Kategori Baru',
            'breadcrumbs' => 'Publikasi / Kategori / Tambah',
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pages/kategori/create', $data);
    }

    /**
     * Store kategori
     */
    public function kategoriStore()
    {
        $rules = [
            'nama_kategori' => 'required|min_length[3]|max_length[100]',
            'icon'          => 'permit_empty|max_length[50]',
            'deskripsi'     => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $namaKategori = $this->request->getPost('nama_kategori');
        $slug = $this->kategoriModel->generateSlug($namaKategori);

        $data = [
            'nama_kategori' => $namaKategori,
            'slug'          => $slug,
            'icon'          => $this->request->getPost('icon') ?: 'bi-folder',
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'is_active'     => $this->request->getPost('is_active') ?: '1',
            'urutan'        => $this->request->getPost('urutan') ?: 0,
        ];

        if ($this->kategoriModel->insert($data)) {
            return redirect()->to('/publikasi/kategori')
                ->with('success', 'Kategori berhasil ditambahkan');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal menambahkan kategori');
    }

    /**
     * Edit kategori form
     */
    public function kategoriEdit($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            return redirect()->to('/publikasi/kategori')
                ->with('error', 'Kategori tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Kategori',
            'pageTitle' => 'Edit Kategori',
            'breadcrumbs' => 'Publikasi / Kategori / Edit',
            'kategori' => $kategori,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pages/kategori/edit', $data);
    }

    /**
     * Update kategori
     */
    public function kategoriUpdate($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            return redirect()->to('/publikasi/kategori')
                ->with('error', 'Kategori tidak ditemukan');
        }

        $rules = [
            'nama_kategori' => 'required|min_length[3]|max_length[100]',
            'icon'          => 'permit_empty|max_length[50]',
            'deskripsi'     => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $namaKategori = $this->request->getPost('nama_kategori');

        // Only regenerate slug if name changed
        if ($namaKategori != $kategori->nama_kategori) {
            $slug = $this->kategoriModel->generateSlug($namaKategori);
        } else {
            $slug = $kategori->slug;
        }

        $data = [
            'nama_kategori' => $namaKategori,
            'slug'          => $slug,
            'icon'          => $this->request->getPost('icon'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'is_active'     => $this->request->getPost('is_active'),
            'urutan'        => $this->request->getPost('urutan'),
        ];

        if ($this->kategoriModel->update($id, $data)) {
            return redirect()->to('/publikasi/kategori')
                ->with('success', 'Kategori berhasil diupdate');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal mengupdate kategori');
    }

    /**
     * Delete kategori
     */
    public function kategoriDelete($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            return redirect()->to('/publikasi/kategori')
                ->with('error', 'Kategori tidak ditemukan');
        }

        // Check if category has content
        $kontenModel = new KontenModel();
        $hasContent = $kontenModel->where('kategori_id', $id)->countAllResults();

        if ($hasContent > 0) {
            return redirect()->to('/publikasi/kategori')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki konten');
        }

        if ($this->kategoriModel->delete($id)) {
            return redirect()->to('/publikasi/kategori')
                ->with('success', 'Kategori berhasil dihapus');
        }

        return redirect()->to('/publikasi/kategori')
            ->with('error', 'Gagal menghapus kategori');
    }

    /**
     * Toggle kategori status
     */
    public function kategoriToggle($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ]);
        }

        $newStatus = $kategori->is_active == '1' ? '0' : '1';

        if ($this->kategoriModel->update($id, ['is_active' => $newStatus])) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status kategori berhasil diubah',
                'status' => $newStatus
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal mengubah status'
        ]);
    }
}
