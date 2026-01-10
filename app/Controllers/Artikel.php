<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Artikel extends BaseController
{
    protected $kontenModel;
    protected $kategoriModel;
    protected $galeriModel;
    protected $session;

    public function __construct()
    {
        $this->kontenModel = new \App\Models\Konten();
        $this->kategoriModel = new \App\Models\Kategori();
        $this->galeriModel = new \App\Models\Galeri();
        $this->session = \Config\Services::session();
        helper(['form', 'url', 'auth', 'filesystem']);
    }

    /**
     * List konten
     */
    public function index()
    {
        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;

        // Get filters
        $filters = [
            'kategori_id' => $this->request->getGet('kategori'),
            'status'      => $this->request->getGet('status'),
            'search'      => $this->request->getGet('search'),
        ];

        $builder = $this->kontenModel->getFilteredKonten($filters);

        $data = [
            'title' => 'Manajemen Konten',
            'pageTitle' => 'Daftar Konten Publikasi',
            'breadcrumbs' => 'Publikasi / Konten',
            'kontens' => $builder->paginate($perPage),
            'pager' => $this->kontenModel->pager,
            'kategoris' => $this->kategoriModel->getActiveCategories(),
            'filters' => $filters,
        ];

        return view('backend/pages/konten/index', $data);
    }

    /**
     * Create konten form
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Konten',
            'pageTitle' => 'Buat Konten Baru',
            'breadcrumbs' => 'Publikasi / Konten / Tambah',
            'kategoris' => $this->kategoriModel->getActiveCategories(),
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pages/konten/create', $data);
    }

    /**
     * Store konten
     */
    public function store()
    {
        $rules = [
            'kategori_id' => 'required|integer',
            'judul'       => 'required|min_length[3]|max_length[255]',
            'konten'      => 'required',
            'status'      => 'required|in_list[draft,published,archived]',
            'thumbnail'   => 'permit_empty|uploaded[thumbnail]|max_size[thumbnail,2048]|is_image[thumbnail]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $judul = $this->request->getPost('judul');
        $slug = $this->kontenModel->generateSlug($judul);

        // Handle thumbnail upload
        $thumbnailName = null;
        $thumbnail = $this->request->getFile('thumbnail');

        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            $thumbnailName = $thumbnail->getRandomName();
            $thumbnail->move(FCPATH . 'uploads/publikasi/thumbnails/', $thumbnailName);

            // Resize thumbnail
            $this->resizeImage(FCPATH . 'uploads/publikasi/thumbnails/' . $thumbnailName, 800, 600);
        }

        $status = $this->request->getPost('status');
        $publishedAt = null;

        if ($status == 'published') {
            $publishedAt = date('Y-m-d H:i:s');
        }

        $data = [
            'kategori_id'  => $this->request->getPost('kategori_id'),
            'judul'        => $judul,
            'slug'         => $slug,
            'thumbnail'    => $thumbnailName,
            'konten'       => $this->request->getPost('konten'),
            'excerpt'      => $this->request->getPost('excerpt'),
            'tags'         => $this->request->getPost('tags'),
            'author_id'    => get_user_data('user_id'),
            'status'       => $status,
            'is_featured'  => $this->request->getPost('is_featured') ?: '0',
            'published_at' => $publishedAt,
        ];

        $kontenId = $this->kontenModel->insert($data);

        if ($kontenId) {
            // Handle multiple galeri images
            $this->handleGaleriUpload($kontenId);

            return redirect()->to('/artikel')
                ->with('success', 'Konten berhasil ditambahkan');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal menambahkan konten');
    }

    /**
     * Edit konten form
     */
    public function edit($id)
    {
        $konten = $this->kontenModel->find($id);

        if (!$konten) {
            return redirect()->to('/artikel')
                ->with('error', 'Konten tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Konten',
            'pageTitle' => 'Edit Konten',
            'breadcrumbs' => 'Publikasi / Konten / Edit',
            'konten' => $konten,
            'kategoris' => $this->kategoriModel->getActiveCategories(),
            'galeriImages' => $this->galeriModel->getImagesByKonten($id),
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pages/konten/edit', $data);
    }

    /**
     * Update konten
     */
    public function update($id)
    {
        $konten = $this->kontenModel->find($id);

        if (!$konten) {
            return redirect()->to('/artikel')
                ->with('error', 'Konten tidak ditemukan');
        }

        $judul = $this->request->getPost('judul');

        // rules dasar
        $rules = [
            'kategori_id' => 'required|integer',
            'judul'       => 'required|min_length[3]|max_length[255]',
            'konten'      => 'required',
            'status'      => 'required|in_list[draft,published,archived]',
            'thumbnail'   => 'permit_empty|max_size[thumbnail,2048]|is_image[thumbnail]',
        ];

        // validasi slug hanya jika judul berubah
        if ($judul !== $konten->judul) {
            $rules['slug'] = 'is_unique[publikasi_konten.slug,id,' . $id . ']';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // slug
        $slug = ($judul !== $konten->judul)
            ? $this->kontenModel->generateSlug($judul)
            : $konten->slug;

        // thumbnail
        $thumbnailName = $konten->thumbnail;
        $thumbnail = $this->request->getFile('thumbnail');

        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            if ($konten->thumbnail) {
                $oldPath = FCPATH . 'uploads/publikasi/thumbnails/' . $konten->thumbnail;
                if (is_file($oldPath)) {
                    unlink($oldPath);
                }
            }

            $thumbnailName = $thumbnail->getRandomName();
            $thumbnail->move(FCPATH . 'uploads/publikasi/thumbnails/', $thumbnailName);
            $this->resizeImage(
                FCPATH . 'uploads/publikasi/thumbnails/' . $thumbnailName,
                800,
                600
            );
        }

        // status & published_at
        $status = $this->request->getPost('status');
        $publishedAt = $konten->published_at;

        if ($status === 'published' && $konten->status !== 'published') {
            $publishedAt = date('Y-m-d H:i:s');
        }

        $data = [
            'id'           => $id, // Required for is_unique validation to ignore current record
            'kategori_id'  => $this->request->getPost('kategori_id'),
            'judul'        => $judul,
            'slug'         => $slug,
            'thumbnail'    => $thumbnailName,
            'konten'       => $this->request->getPost('konten'),
            'excerpt'      => $this->request->getPost('excerpt'),
            'tags'         => $this->request->getPost('tags'),
            'status'       => $status,
            'is_featured'  => $this->request->getPost('is_featured') ?: '0',
            'published_at' => $publishedAt,
            'author_id'    => $konten->author_id,
        ];

        if ($this->kontenModel->update($id, $data)) {
            $this->handleGaleriUpload($id);

            return redirect()->to('/artikel')
                ->with('success', 'Konten berhasil diupdate');
        }
        return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal mengupdate konten')
            ->with('errors', $this->kontenModel->errors());
    }

    /**
     * Delete konten
     */
    public function delete($id)
    {
        $konten = $this->kontenModel->find($id);

        if (!$konten) {
            return redirect()->to('/artikel')
                ->with('error', 'Konten tidak ditemukan');
        }

        // Delete thumbnail
        if ($konten->thumbnail) {
            $thumbPath = FCPATH . 'uploads/publikasi/thumbnails/' . $konten->thumbnail;
            if (file_exists($thumbPath)) {
                unlink($thumbPath);
            }
        }

        // Delete galeri images
        $this->galeriModel->deleteByKonten($id);

        if ($this->kontenModel->delete($id)) {
            return redirect()->to('/artikel')
                ->with('success', 'Konten berhasil dihapus');
        }

        return redirect()->to('/artikel')
            ->with('error', 'Gagal menghapus konten');
    }

    /**
     * Handle galeri upload
     */
    private function handleGaleriUpload($kontenId)
    {
        $galeriFiles = $this->request->getFileMultiple('galeri_images');

        if (!$galeriFiles) {
            return;
        }

        $urutan = $this->galeriModel->where('konten_id', $kontenId)->countAllResults() + 1;

        foreach ($galeriFiles as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/publikasi/galeri/', $fileName);

                // Resize image
                $this->resizeImage(FCPATH . 'uploads/publikasi/galeri/' . $fileName, 1200, 900);

                $this->galeriModel->insert([
                    'konten_id'  => $kontenId,
                    'image_path' => $fileName,
                    'caption'    => '',
                    'urutan'     => $urutan++,
                ]);
            }
        }
    }

    /**
     * Delete galeri image
     */
    public function deleteGaleriImage($id)
    {
        $image = $this->galeriModel->find($id);

        if (!$image) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gambar tidak ditemukan'
            ]);
        }

        // Delete file
        $filePath = FCPATH . 'uploads/publikasi/galeri/' . $image->image_path;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        if ($this->galeriModel->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Gambar berhasil dihapus'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menghapus gambar'
        ]);
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
     * Upload image from TinyMCE
     */
    public function uploadImage()
    {
        $file = $this->request->getFile('file');

        if (!$file->isValid()) {
            return $this->response->setJSON(['error' => 'Invalid file']);
        }

        $fileName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/publikasi/content/', $fileName);

        $url = base_url('uploads/publikasi/content/' . $fileName);

        return $this->response->setJSON(['location' => $url]);
    }
}
