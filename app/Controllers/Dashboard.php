<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PendaftaranModel;
use App\Models\PengaduanModel;
use App\Models\KontenModel;
use App\Models\KategoriModel;
use App\Models\ActivityLogModel;

class Dashboard extends BaseController
{
    protected $pendaftaranModel;
    protected $pengaduanModel;
    protected $kontenModel;
    protected $kategoriModel;
    protected $activityLogModel;

    public function __construct()
    {
        helper(['auth', 'url']);
        $this->pendaftaranModel = new PendaftaranModel();
        $this->pengaduanModel = new PengaduanModel();
        $this->kontenModel = new KontenModel();
        $this->kategoriModel = new KategoriModel();
        $this->activityLogModel = new ActivityLogModel();
    }

    /**
     * Display dashboard page
     */
    public function index()
    {
        // Get statistics
        $stats = $this->getStatistics();

        // Get recent activities
        $recentActivities = $this->activityLogModel->getRecentActivities(10);

        // Get today's stats
        $todayStats = $this->activityLogModel->getTodayStats();

        $data = [
            'title' => 'Dashboard',
            'pageTitle' => 'Dashboard Overview',
            'breadcrumbs' => 'Halaman Utama',
            'stats' => $stats,
            'recentActivities' => $recentActivities,
            'todayStats' => $todayStats
        ];

        return view('backend/pages/dashboard', $data);
    }

    /**
     * Get all statistics
     */
    private function getStatistics()
    {
        // Total Pelanggan (from pendaftaran with status approved)
        $totalPelanggan = $this->pendaftaranModel
            ->where('status', 'approved')
            ->countAllResults();

        // Pengaduan Aktif (pending + proses)
        $pengaduanAktif = $this->pengaduanModel
            ->groupStart()
            ->where('status', 'pending')
            ->orWhere('status', 'proses')
            ->groupEnd()
            ->countAllResults();

        // Get kategori IDs
        $kategoriArtikel = $this->kategoriModel->where('slug', 'berita')->first();
        $kategoriPengumuman = $this->kategoriModel->where('slug', 'pengumuman')->first();

        // Total Artikel (published)
        $totalArtikel = $this->kontenModel
            ->where('status', 'published')
            ->countAllResults();

        // Total Pengumuman (published) - if kategori exists
        $totalPengumuman = 0;
        if ($kategoriPengumuman) {
            $totalPengumuman = $this->kontenModel
                ->where('kategori_id', $kategoriPengumuman->id)
                ->where('status', 'published')
                ->countAllResults();
        }

        return [
            'total_pelanggan' => $totalPelanggan,
            'pengaduan_aktif' => $pengaduanAktif,
            'total_artikel' => $totalArtikel,
            'total_pengumuman' => $totalPengumuman
        ];
    }
}
