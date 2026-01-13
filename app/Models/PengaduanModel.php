<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'no_pengaduan',
        'id_pel',
        'nm_lengkap',
        'alamat',
        'no_hp',
        'email',
        'kategori',
        'isi_pengaduan',
        'foto',
        'status',
        'prioritas',
        'handled_by',
        'handled_at',
        'catatan_admin',
        'tanggapan',
        'resolved_at',
        'ip_address',
        'user_agent'
    ];

    /**
     * Generate nomor pengaduan unik
     */
    public function generateNomorPengaduan()
    {
        $prefix = 'PGD';
        $date = date('Ymd');

        // Get last number today
        $lastPengaduan = $this->like('no_pengaduan', $prefix . '/' . $date, 'after')
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastPengaduan) {
            $lastNumber = intval(substr($lastPengaduan->no_pengaduan, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . '/' . $date . '/' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get pengaduan dengan info handler
     */
    public function getPengaduanWithHandler($id = null)
    {
        $builder = $this->select('pengaduan.*, users.nm_lengkap as handler_name')
            ->join('users', 'users.id = pengaduan.handled_by', 'left');

        if ($id) {
            return $builder->where('pengaduan.id', $id)->first();
        }

        return $builder->orderBy('pengaduan.created_at', 'DESC')->findAll();
    }

    /**
     * Get statistics
     */
    public function getStatistics()
    {
        return [
            'total' => $this->countAll(),
            'pending' => $this->where('status', 'pending')->countAllResults(),
            'proses' => $this->where('status', 'proses')->countAllResults(),
            'selesai' => $this->where('status', 'selesai')->countAllResults(),
            'ditolak' => $this->where('status', 'ditolak')->countAllResults(),
        ];
    }

    /**
     * Track user info
     */
    public function trackUserInfo(&$data)
    {
        $request = \Config\Services::request();
        $data['ip_address'] = $request->getIPAddress();
        $data['user_agent'] = $request->getUserAgent()->getAgentString();
    }
}
