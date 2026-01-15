<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffOrganisasiModel extends Model
{
    protected $table = 'staff_organisasi';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType = 'object';
    protected $allowedFields = [
        'nip',
        'nm_lengkap',
        'gelar_depan',
        'gelar_belakang',
        'bagian_id',
        'tingkat_jabatan_id',
        'jabatan_spesifik',
        'profile_pict',
        'email',
        'no_hp',
        'status_kepegawaian',
        'urutan_tampil',
        'is_active'
    ];

    /**
     * Get staff with bagian and tingkat info
     */
    public function getStaffWithDetails($id = null)
    {
        $builder = $this->select('staff_organisasi.*, bagian.nama_bagian, bagian.kd_bagian, tingkat_jabatan.nama_tingkat, tingkat_jabatan.level')
            ->join('bagian', 'bagian.id = staff_organisasi.bagian_id')
            ->join('tingkat_jabatan', 'tingkat_jabatan.id = staff_organisasi.tingkat_jabatan_id');

        if ($id) {
            return $builder->where('staff_organisasi.id', $id)->first();
        }

        return $builder->orderBy('tingkat_jabatan.level', 'ASC')
            ->orderBy('bagian.urutan', 'ASC')
            ->orderBy('staff_organisasi.urutan_tampil', 'ASC')
            ->findAll();
    }

    /**
     * Get staff grouped by tingkat jabatan (for frontend display)
     */
    public function getStaffGrouped()
    {
        $staff = $this->getStaffWithDetails();
        $grouped = [];

        foreach ($staff as $s) {
            $grouped[$s->level][] = $s;
        }

        ksort($grouped); // Sort by level
        return $grouped;
    }

    /**
     * Get next urutan in same bagian & tingkat
     */
    public function getNextUrutan($bagianId, $tingkatId)
    {
        $result = $this->selectMax('urutan_tampil')
            ->where('bagian_id', $bagianId)
            ->where('tingkat_jabatan_id', $tingkatId)
            ->first();

        return $result ? (int)$result->urutan_tampil + 1 : 1;
    }

    /**
     * Format nama lengkap dengan gelar
     */
    public function getFormattedName($staff)
    {
        $name = '';

        if ($staff->gelar_depan) {
            $name .= $staff->gelar_depan . ' ';
        }

        $name .= $staff->nm_lengkap;

        if ($staff->gelar_belakang) {
            $name .= ', ' . $staff->gelar_belakang;
        }

        return $name;
    }
}
