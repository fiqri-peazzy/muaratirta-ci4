<?php

namespace App\Models;

use CodeIgniter\Model;

class BagianModel extends Model
{
    protected $table = 'bagian';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType = 'object';
    protected $allowedFields = ['kd_bagian', 'nama_bagian', 'parent_id', 'urutan', 'deskripsi', 'is_active'];

    /**
     * Generate unique kode bagian
     */
    public function generateKodeBagian()
    {
        $prefix = 'BGN';
        $randomNumber = rand(1000, 9999);
        $kodeBagian = $prefix . '-' . $randomNumber;

        // Check if exists, regenerate if needed
        while ($this->where('kd_bagian', $kodeBagian)->first()) {
            $randomNumber = rand(1000, 9999);
            $kodeBagian = $prefix . '-' . $randomNumber;
        }

        return $kodeBagian;
    }

    /**
     * Get all active bagian ordered by urutan
     */
    public function getActive()
    {
        return $this->where('is_active', '1')
            ->orderBy('urutan', 'ASC')
            ->findAll();
    }

    /**
     * Get bagian with parent info
     */
    public function getBagianWithParent($id = null)
    {
        $builder = $this->select('bagian.*, parent.nama_bagian as parent_nama')
            ->join('bagian as parent', 'parent.id = bagian.parent_id', 'left');

        if ($id) {
            return $builder->where('bagian.id', $id)->first();
        }

        return $builder->orderBy('bagian.urutan', 'ASC')->findAll();
    }

    /**
     * Get next urutan number
     */
    public function getNextUrutan()
    {
        $result = $this->selectMax('urutan')->first();
        return $result ? (int)$result->urutan + 1 : 1;
    }
}
