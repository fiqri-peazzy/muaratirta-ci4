<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $table            = 'pendaftaran_pasang_baru';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'no_pendaftaran',
        'nama_lengkap',
        'nik',
        'alamat_pemasangan',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'latitude',
        'longitude',
        'no_hp',
        'no_wa',
        'email',
        'foto_ktp',
        'foto_rumah',
        'setuju_biaya',
        'status',
        'tindak_lanjut',
        'catatan_admin',
        'catatan_penolakan',
        'verified_by',
        'verified_at',
        'surveyed_by',
        'surveyed_at',
        'catatan_survey',
        'ip_address',
        'user_agent',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_lengkap'      => 'required|min_length[3]|max_length[200]',
        'alamat_pemasangan' => 'required|min_length[10]',
        'no_hp'             => 'required|numeric|min_length[10]|max_length[16]',
        'foto_ktp'          => 'permit_empty',
        'foto_rumah'        => 'permit_empty',
        'setuju_biaya'      => 'required|in_list[1]',
    ];

    protected $validationMessages = [
        'nama_lengkap' => [
            'required'   => 'Nama lengkap wajib diisi',
            'min_length' => 'Nama lengkap minimal 3 karakter',
        ],
        'alamat_pemasangan' => [
            'required'   => 'Alamat pemasangan wajib diisi',
            'min_length' => 'Alamat minimal 10 karakter',
        ],
        'no_hp' => [
            'required' => 'Nomor HP wajib diisi',
            'numeric'  => 'Nomor HP harus berupa angka',
        ],
        'setuju_biaya' => [
            'required' => 'Anda harus menyetujui biaya administrasi',
            'in_list'  => 'Anda harus mencentang persetujuan biaya',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Generate nomor pendaftaran unik
     * Format: PB-YYYY-XXXX (PB = Pasang Baru)
     */
    public function generateNomorPendaftaran()
    {
        $year = date('Y');
        $prefix = "PB-{$year}-";

        // Get last number for current year
        $lastRecord = $this->like('no_pendaftaran', $prefix)
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastRecord) {
            $lastNumber = (int) substr($lastRecord->no_pendaftaran, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get pendaftaran with filters for admin
     */
    public function getFilteredPendaftaran($filters = [])
    {
        $builder = $this->select('pendaftaran_pasang_baru.*, users.nm_lengkap as verified_by_name')
            ->join('users', 'users.id = pendaftaran_pasang_baru.verified_by', 'left');

        if (!empty($filters['status'])) {
            $builder->where('pendaftaran_pasang_baru.status', $filters['status']);
        }

        if (!empty($filters['tindak_lanjut'])) {
            $builder->where('pendaftaran_pasang_baru.tindak_lanjut', $filters['tindak_lanjut']);
        }

        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('pendaftaran_pasang_baru.no_pendaftaran', $filters['search'])
                ->orLike('pendaftaran_pasang_baru.nama_lengkap', $filters['search'])
                ->orLike('pendaftaran_pasang_baru.no_hp', $filters['search'])
                ->groupEnd();
        }

        if (!empty($filters['date_from'])) {
            $builder->where('DATE(pendaftaran_pasang_baru.created_at) >=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $builder->where('DATE(pendaftaran_pasang_baru.created_at) <=', $filters['date_to']);
        }

        return $builder->orderBy('pendaftaran_pasang_baru.created_at', 'DESC');
    }

    /**
     * Get statistics for dashboard
     */
    public function getStatistics()
    {
        return [
            'total'       => $this->countAll(),
            'pending'     => $this->where('status', 'pending')->countAllResults(false),
            'verifikasi'  => $this->where('status', 'verifikasi')->countAllResults(false),
            'approved'    => $this->where('status', 'approved')->countAllResults(false),
            'survey'      => $this->where('status', 'survey')->countAllResults(false),
            'rejected'    => $this->where('status', 'rejected')->countAllResults(false),
            'today'       => $this->where('DATE(created_at)', date('Y-m-d'))->countAllResults(false),
            'this_month'  => $this->where('MONTH(created_at)', date('m'))
                ->where('YEAR(created_at)', date('Y'))
                ->countAllResults(false),
        ];
    }

    /**
     * Track user IP and User Agent
     */
    public function trackUserInfo(&$data)
    {
        $request = \Config\Services::request();
        $data['ip_address'] = $request->getIPAddress();
        $data['user_agent'] = $request->getUserAgent()->getAgentString();
        return $data;
    }
}
