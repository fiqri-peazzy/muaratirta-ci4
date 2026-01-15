<?php

namespace App\Controllers;

use App\Models\ChatFaqModel;
use App\Models\ChatInfoModel;
use CodeIgniter\Controller;

class ChatAssistant extends BaseController
{
    protected $faqModel;
    protected $infoModel;

    public function __construct()
    {
        $this->faqModel = new ChatFaqModel();
        $this->infoModel = new ChatInfoModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen AI Assistant',
            'faqs'  => $this->faqModel->findAll(),
            'infos' => $this->infoModel->findAll(),
        ];

        return view('backend/pages/chat/index', $data);
    }

    // FAQ Methods
    public function faqStore()
    {
        $data = [
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'jawaban'    => $this->request->getPost('jawaban'),
            'kategori'   => $this->request->getPost('kategori'),
            'is_active'  => '1'
        ];

        $this->faqModel->insert($data);
        return redirect()->back()->with('success', 'FAQ berhasil ditambahkan');
    }

    public function faqUpdate($id)
    {
        $data = [
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'jawaban'    => $this->request->getPost('jawaban'),
            'kategori'   => $this->request->getPost('kategori'),
        ];

        $this->faqModel->update($id, $data);
        return redirect()->back()->with('success', 'FAQ berhasil diperbarui');
    }

    public function faqDelete($id)
    {
        $this->faqModel->delete($id);
        return redirect()->back()->with('success', 'FAQ berhasil dihapus');
    }

    public function faqToggle($id)
    {
        $faq = $this->faqModel->find($id);
        $newStatus = $faq->is_active == '1' ? '0' : '1';
        $this->faqModel->update($id, ['is_active' => $newStatus]);
        return redirect()->back()->with('success', 'Status FAQ berhasil diubah');
    }

    // Info Methods
    public function infoStore()
    {
        $data = [
            'judul'     => $this->request->getPost('judul'),
            'konten'    => $this->request->getPost('konten'),
            'kategori'  => $this->request->getPost('kategori'),
            'is_active' => '1'
        ];

        $this->infoModel->insert($data);
        return redirect()->back()->with('success', 'Info berhasil ditambahkan');
    }

    public function infoUpdate($id)
    {
        $data = [
            'judul'    => $this->request->getPost('judul'),
            'konten'   => $this->request->getPost('konten'),
            'kategori' => $this->request->getPost('kategori'),
        ];

        $this->infoModel->update($id, $data);
        return redirect()->back()->with('success', 'Info berhasil diperbarui');
    }

    public function infoDelete($id)
    {
        $this->infoModel->delete($id);
        return redirect()->back()->with('success', 'Info berhasil dihapus');
    }

    public function infoToggle($id)
    {
        $info = $this->infoModel->find($id);
        $newStatus = $info->is_active == '1' ? '0' : '1';
        $this->infoModel->update($id, ['is_active' => $newStatus]);
        return redirect()->back()->with('success', 'Status Info berhasil diubah');
    }

    public function history()
    {
        $db = \Config\Database::connect();
        $data = [
            'title'   => 'Riwayat Chat',
            'history' => $db->table('chat_history')->orderBy('id', 'DESC')->get()->getResult(),
        ];

        return view('backend/pages/chat/history', $data);
    }
}
