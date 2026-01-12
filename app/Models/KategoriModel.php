<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'publikasi_kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'nama_kategori',
        'slug',
        'icon',
        'deskripsi',
        'is_active',
        'urutan'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_kategori' => 'required|min_length[3]|max_length[100]',
        'slug'          => 'required|is_unique[publikasi_kategori.slug,id,{id}]',
        'icon'          => 'permit_empty|max_length[50]',
        'deskripsi'     => 'permit_empty',
    ];

    protected $validationMessages = [
        'nama_kategori' => [
            'required'    => 'Nama kategori wajib diisi',
            'min_length'  => 'Nama kategori minimal 3 karakter',
        ],
        'slug' => [
            'required'  => 'Slug wajib diisi',
            'is_unique' => 'Slug sudah digunakan',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Get active categories
     */
    public function getActiveCategories()
    {
        return $this->where('is_active', '1')
            ->orderBy('urutan', 'ASC')
            ->findAll();
    }

    /**
     * Get category with content count
     */
    public function getCategoriesWithCount()
    {
        return $this->select('publikasi_kategori.*, COUNT(publikasi_konten.id) as total_konten')
            ->join('publikasi_konten', 'publikasi_konten.kategori_id = publikasi_kategori.id', 'left')
            ->groupBy('publikasi_kategori.id')
            ->orderBy('publikasi_kategori.urutan', 'ASC')
            ->findAll();
    }

    /**
     * Auto-generate slug from nama_kategori
     */
    public function generateSlug($namaKategori)
    {
        helper('text');
        $slug = url_title($namaKategori, '-', true);

        // Check if slug exists
        $count = 1;
        $originalSlug = $slug;

        while ($this->where('slug', $slug)->first()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
