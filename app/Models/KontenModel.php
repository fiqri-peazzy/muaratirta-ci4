<?php

namespace App\Models;

use CodeIgniter\Model;

class KontenModel extends Model
{
    protected $table            = 'publikasi_konten';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;

    protected $allowedFields = [
        'kategori_id',
        'judul',
        'slug',
        'thumbnail',
        'konten',
        'excerpt',
        'tags',
        'author_id',
        'status',
        'is_featured',
        'view_count',
        'published_at'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'id'          => 'permit_empty|is_natural_no_zero',
        'kategori_id' => 'required|integer',
        'judul'       => 'required|min_length[3]|max_length[255]',
        'slug'        => 'required|is_unique[publikasi_konten.slug,id,{id}]',
        'konten'      => 'required',
        'author_id'   => 'required|integer',
        'status'      => 'required|in_list[draft,published,archived]',
    ];

    protected $validationMessages = [
        'judul' => [
            'required'   => 'Judul wajib diisi',
            'min_length' => 'Judul minimal 3 karakter',
        ],
        'konten' => [
            'required' => 'Konten wajib diisi',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Get konten with relations
     */
    public function getKontenWithRelations($id = null)
    {
        $builder = $this->select('publikasi_konten.*, publikasi_kategori.nama_kategori, publikasi_kategori.slug as kategori_slug, users.nm_lengkap as author_name')
            ->join('publikasi_kategori', 'publikasi_kategori.id = publikasi_konten.kategori_id')
            ->join('users', 'users.id = publikasi_konten.author_id');

        if ($id !== null) {
            return $builder->where('publikasi_konten.id', $id)->first();
        }

        return $builder->orderBy('publikasi_konten.created_at', 'DESC')->findAll();
    }

    /**
     * Get filtered konten
     */
    public function getFilteredKonten($filters = [])
    {
        $builder = $this->select('publikasi_konten.*, publikasi_kategori.nama_kategori, users.nm_lengkap as author_name')
            ->join('publikasi_kategori', 'publikasi_kategori.id = publikasi_konten.kategori_id')
            ->join('users', 'users.id = publikasi_konten.author_id');

        if (!empty($filters['kategori_id'])) {
            $builder->where('publikasi_konten.kategori_id', $filters['kategori_id']);
        }

        if (!empty($filters['status'])) {
            $builder->where('publikasi_konten.status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('publikasi_konten.judul', $filters['search'])
                ->orLike('publikasi_konten.konten', $filters['search'])
                ->orLike('publikasi_konten.tags', $filters['search'])
                ->groupEnd();
        }

        if (!empty($filters['author_id'])) {
            $builder->where('publikasi_konten.author_id', $filters['author_id']);
        }

        return $builder->orderBy('publikasi_konten.created_at', 'DESC');
    }

    /**
     * Auto-generate slug from judul
     */
    public function generateSlug($judul)
    {
        helper('text');
        $slug = url_title($judul, '-', true);

        // Check if slug exists
        $count = 1;
        $originalSlug = $slug;

        while ($this->where('slug', $slug)->first()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    /**
     * Increment view count
     */
    public function incrementView($id)
    {
        $konten = $this->find($id);
        if ($konten) {
            $this->update($id, ['view_count' => $konten->view_count + 1]);
        }
    }

    /**
     * Get featured content
     */
    public function getFeaturedKonten($limit = 5)
    {
        return $this->select('publikasi_konten.*, publikasi_kategori.nama_kategori')
            ->join('publikasi_kategori', 'publikasi_kategori.id = publikasi_konten.kategori_id')
            ->where('publikasi_konten.is_featured', '1')
            ->where('publikasi_konten.status', 'published')
            ->orderBy('publikasi_konten.published_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get latest content by category
     */
    public function getLatestByKategori($kategoriId, $limit = 10)
    {
        return $this->where('kategori_id', $kategoriId)
            ->where('status', 'published')
            ->orderBy('published_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get popular content (by view count)
     */
    public function getPopularKonten($limit = 5)
    {
        return $this->select('publikasi_konten.*, publikasi_kategori.nama_kategori')
            ->join('publikasi_kategori', 'publikasi_kategori.id = publikasi_konten.kategori_id')
            ->where('publikasi_konten.status', 'published')
            ->orderBy('publikasi_konten.view_count', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}
