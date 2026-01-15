<?php

namespace App\Models;

use CodeIgniter\Model;

class TingkatJabatanModel extends Model
{
    protected $table = 'tingkat_jabatan';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType = 'object';
    protected $allowedFields = ['nama_tingkat', 'level', 'keterangan', 'is_active'];

    /**
     * Get all active tingkat jabatan ordered by level
     */
    public function getActive()
    {
        return $this->where('is_active', '1')
            ->orderBy('level', 'ASC')
            ->findAll();
    }

    /**
     * Check if level already exists (for validation)
     */
    public function isLevelExists($level, $excludeId = null)
    {
        $builder = $this->where('level', $level);

        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }

        return $builder->countAllResults() > 0;
    }

    /**
     * Get next available level
     */
    public function getNextLevel()
    {
        $result = $this->selectMax('level')->first();
        return $result ? (int)$result->level + 1 : 1;
    }
}
