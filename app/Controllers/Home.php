<?php

namespace App\Controllers;

use App\Models\KontenModel;

class Home extends BaseController
{
    public function index(): string
    {
        $kontenModel = new KontenModel();

        // Fetch Berita (News)
        $berita = $kontenModel->select('publikasi_konten.*, publikasi_kategori.nama_kategori, users.nm_lengkap as author_name')
            ->join('publikasi_kategori', 'publikasi_kategori.id = publikasi_konten.kategori_id', 'left')
            ->join('users', 'users.id = publikasi_konten.author_id', 'left')
            ->groupStart()
            ->where('publikasi_kategori.slug', 'berita')
            ->orWhere('publikasi_kategori.slug', 'artikel-berita')
            ->orLike('publikasi_kategori.nama_kategori', 'berita', 'both')
            ->groupEnd()
            ->where('publikasi_konten.status', 'published')
            ->orderBy('publikasi_konten.published_at', 'DESC')
            ->orderBy('publikasi_konten.created_at', 'DESC')
            ->limit(8)
            ->findAll();

        // Fetch Info Gangguan (Disturbance)
        $info_gangguan = $kontenModel->select('publikasi_konten.*, publikasi_kategori.nama_kategori, users.nm_lengkap as author_name')
            ->join('publikasi_kategori', 'publikasi_kategori.id = publikasi_konten.kategori_id', 'left')
            ->join('users', 'users.id = publikasi_konten.author_id', 'left')
            ->groupStart()
            ->where('publikasi_kategori.slug', 'info-gangguan')
            ->orLike('publikasi_kategori.nama_kategori', 'gangguan', 'both')
            ->groupEnd()
            ->where('publikasi_konten.status', 'published')
            ->orderBy('publikasi_konten.published_at', 'DESC')
            ->orderBy('publikasi_konten.created_at', 'DESC')
            ->limit(6)
            ->findAll();

        $data = [
            'berita' => $berita,
            'info_gangguan' => $info_gangguan
        ];

        return view('frontend/pages/home', $data);
    }
}
