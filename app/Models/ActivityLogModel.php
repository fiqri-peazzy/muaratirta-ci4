<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'user_id',
        'user_name',
        'activity_type',
        'module',
        'description',
        'status',
        'ip_address',
        'user_agent',
        'created_at'
    ];

    /**
     * Log activity
     */
    public function logActivity($activityType, $module, $description, $status = 'success')
    {
        $request = \Config\Services::request();

        $data = [
            'user_id' => session()->get('id'),
            'user_name' => session()->get('name'),
            'activity_type' => $activityType,
            'module' => $module,
            'description' => $description,
            'status' => $status,
            'ip_address' => $request->getIPAddress(),
            'user_agent' => $request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->insert($data);
    }

    /**
     * Get recent activities
     */
    public function getRecentActivities($limit = 10)
    {
        return $this->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get today's activities
     */
    public function getTodayActivities()
    {
        return $this->where('DATE(created_at)', date('Y-m-d'))
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Get activities by module
     */
    public function getActivitiesByModule($module, $limit = 10)
    {
        return $this->where('module', $module)
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get today's statistics
     */
    public function getTodayStats()
    {
        $today = date('Y-m-d');

        return [
            'pengaduan_masuk' => $this->where('DATE(created_at)', $today)
                ->where('module', 'pengaduan')
                ->where('activity_type', 'create')
                ->countAllResults(),
            'pengaduan_selesai' => $this->where('DATE(created_at)', $today)
                ->where('module', 'pengaduan')
                ->where('activity_type', 'update')
                ->like('description', 'selesai')
                ->countAllResults(),
            'artikel_dibuat' => $this->where('DATE(created_at)', $today)
                ->where('module', 'artikel')
                ->where('activity_type', 'create')
                ->countAllResults(),
        ];
    }

    /**
     * Clean old logs (keep last 90 days)
     */
    public function cleanOldLogs($days = 90)
    {
        $date = date('Y-m-d', strtotime("-{$days} days"));
        return $this->where('created_at <', $date)->delete();
    }
}
