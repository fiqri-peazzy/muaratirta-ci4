<!-- Chat Widget Styling -->
<style>
    :root {
        --chat-primary: #3b82f6;
        --chat-secondary: #f3f4f6;
    }

    .chat-widget-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 30px;
        background: var(--chat-primary);
        color: white;
        border: none;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        z-index: 1000;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: all 0.3s ease;
    }

    .chat-widget-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
    }

    .chat-window {
        position: fixed;
        bottom: 100px;
        right: 30px;
        width: 380px;
        height: 600px;
        max-height: calc(100vh - 120px);
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        display: none;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    .chat-header {
        background: var(--chat-primary);
        color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-avatar {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .chat-body {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        background: #f8fafc;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .message {
        display: flex;
        gap: 10px;
        max-width: 85%;
    }

    .bot-message {
        align-self: flex-start;
    }

    .user-message {
        align-self: flex-end;
        flex-direction: row-reverse;
    }

    .message-avatar {
        width: 32px;
        height: 32px;
        background: #e2e8f0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .message-content {
        padding: 12px 16px;
        border-radius: 15px;
        font-size: 14px;
        line-height: 1.5;
    }

    .bot-message .message-content {
        background: white;
        color: #1e293b;
        border-bottom-left-radius: 2px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .bot-message .message-content p {
        margin-bottom: 8px;
    }

    .bot-message .message-content p:last-child {
        margin-bottom: 0;
    }

    .user-message .message-content {
        background: var(--chat-primary);
        color: white;
        border-bottom-right-radius: 2px;
    }

    .quick-actions {
        padding: 10px 15px;
        background: white;
        display: flex;
        gap: 10px;
        overflow-x: auto;
        border-top: 1px solid #f1f5f9;
    }

    .quick-action-btn {
        white-space: nowrap;
        padding: 8px 16px;
        background: var(--chat-secondary);
        border: none;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s;
    }

    .quick-action-btn:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .chat-input {
        padding: 15px;
        background: white;
        border-top: 1px solid #f1f5f9;
        display: flex;
        gap: 10px;
    }

    .chat-input textarea {
        flex: 1;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 15px;
        resize: none;
        font-size: 14px;
        max-height: 100px;
    }

    .chat-input textarea:focus {
        outline: none;
        border-color: var(--chat-primary);
    }

    .send-btn {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: var(--chat-primary);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .send-btn:hover {
        background: #2563eb;
    }

    /* Typing Animation */
    .typing {
        display: flex;
        gap: 4px;
        padding: 5px 0;
    }

    .typing span {
        width: 6px;
        height: 6px;
        background: #94a3b8;
        border-radius: 50%;
        animation: bounce 1.4s infinite ease-in-out;
    }

    .typing span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes bounce {

        0%,
        80%,
        100% {
            transform: scale(0);
        }

        40% {
            transform: scale(1);
        }
    }

    @media (max-width: 480px) {
        .chat-window {
            width: calc(100% - 40px);
            right: 20px;
            bottom: 90px;
        }
    }
</style>

<!-- Chat Widget Button -->
<button class="chat-widget-btn" id="chatWidgetBtn">
    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863-0.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
    </svg>
</button>

<!-- Chat Window -->
<div class="chat-window" id="chatWindow">
    <div class="chat-header">
        <div class="flex items-center space-x-3">
            <div class="chat-avatar">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-5-9h10v2H7z" />
                </svg>
            </div>
            <div>
                <h4 class="text-sm font-bold m-0 p-0 text-white">Tirta Assistant</h4>
                <p class="text-[10px] text-white/70 m-0 p-0">Online | Virtual Assistant PDAM</p>
            </div>
        </div>
        <button id="closeChatBtn" class="text-white hover:text-white/80 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="chat-body" id="chatBody">
        <div class="message bot-message">
            <div class="message-avatar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="message-content">
                <p>Halo! 👋 Saya <strong>Tirta</strong>, asisten virtual PDAM Muaratirta Gorontalo.</p>
                <p>Saya bisa membantu anda cek tagihan, info tarif, atau panduan pendaftaran/pengaduan. 😊</p>
                <p>Ada yang bisa saya bantu hari ini?</p>
            </div>
        </div>
    </div>

    <div class="quick-actions" id="quickActions">
        <button class="quick-action-btn" onclick="askTirta('Bagaimana cara cek tagihan?')">Cek Tagihan</button>
        <button class="quick-action-btn" onclick="askTirta('Bagaimana cara daftar baru?')">Daftar Baru</button>
        <button class="quick-action-btn" onclick="askTirta('Saya ingin komplain/pengaduan')">Pengaduan</button>
    </div>

    <div class="chat-input">
        <textarea id="chatInput" rows="1" placeholder="Tanyakan sesuatu..."></textarea>
        <button id="sendChatBtn" class="send-btn">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>
        </button>
    </div>
</div>

<!-- Modal Cek Tagihan -->
<div class="modal fade" id="modalCekTagihan" tabindex="-1" aria-hidden="true" style="z-index: 2000;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title font-bold">Cek Tagihan Air</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-sm text-gray-600 mb-4">Masukkan nomor pelanggan Anda untuk melihat rincian tagihan terakhir.</p>
                <div class="mb-3">
                    <label class="form-label text-xs font-bold uppercase tracking-wider text-gray-500">Nomor Pelanggan</label>
                    <input type="text" id="noPelangganTagihan" class="form-control form-control-lg border-gray-200" style="border-radius: 12px;" placeholder="Contoh: 123456">
                </div>
                <div id="hasilTagihan" class="mt-4">
                    <!-- Result will be here -->
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light px-4" style="border-radius: 12px;" data-bs-dismiss="modal">Tutup</button>
                <button type="button" onclick="doCekTagihan()" class="btn btn-primary px-4" style="border-radius: 12px;">Cek Sekarang</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pengaduan -->
<div class="modal fade" id="modalChatPengaduan" tabindex="-1" aria-hidden="true" style="z-index: 2000;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <form id="formChatPengaduan" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-bold">Form Pengaduan Cepat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-xs font-bold uppercase">No. Pelanggan</label>
                            <input type="text" name="id_pel" class="form-control" style="border-radius: 10px;" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-xs font-bold uppercase">Nama Lengkap</label>
                            <input type="text" name="nm_lengkap" class="form-control" style="border-radius: 10px;" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-xs font-bold uppercase">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="2" style="border-radius: 10px;" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-xs font-bold uppercase">No. HP / WhatsApp</label>
                            <input type="text" name="no_hp" class="form-control" style="border-radius: 10px;" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-xs font-bold uppercase">Foto Bukti (Opsional)</label>
                            <input type="file" name="foto" class="form-control" style="border-radius: 10px;" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-xs font-bold uppercase">Isi Pengaduan</label>
                            <textarea name="isi_pengaduan" class="form-control" rows="3" style="border-radius: 10px;" required placeholder="Jelaskan kendala yang Anda alami..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light px-4" style="border-radius: 12px;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4" style="border-radius: 12px;">Kirim Pengaduan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .tagihan-results {
        max-height: 400px;
        overflow-y: auto;
    }

    .tagihan-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px;
        margin-bottom: 10px;
    }

    .tagihan-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .tagihan-item label {
        display: block;
        font-size: 10px;
        color: #64748b;
        text-transform: uppercase;
        font-weight: bold;
    }

    .tagihan-item strong {
        display: block;
        font-size: 13px;
        color: #1e293b;
    }
</style>

<script>
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'decimal',
            minimumFractionDigits: 0
        }).format(angka);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('chatWidgetBtn');
        const win = document.getElementById('chatWindow');
        const closeBtn = document.getElementById('closeChatBtn');
        const chatInput = document.getElementById('chatInput');
        const sendBtn = document.getElementById('sendChatBtn');
        const chatBody = document.getElementById('chatBody');

        // Toggle Window
        btn.onclick = () => win.style.display = win.style.display === 'flex' ? 'none' : 'flex';
        closeBtn.onclick = () => win.style.display = 'none';

        // Auto-resize textarea
        chatInput.oninput = function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        };

        // Send on Enter
        chatInput.onkeydown = (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        };

        sendBtn.onclick = sendMessage;

        function appendMessage(role, content) {
            const div = document.createElement('div');
            div.className = `message ${role}-message`;

            // Detect and replace special buttons
            let processedContent = content;
            if (content.includes('Cek Tagihan')) {
                processedContent += `<br><button class="btn btn-sm btn-outline-primary mt-2" onclick="openCekTagihan()">Klik di sini Cek Tagihan</button>`;
            }
            if (content.includes('Pengaduan') || content.includes('komplain')) {
                processedContent += `<br><button class="btn btn-sm btn-outline-primary mt-2" onclick="openPengaduan()">Buka Form Pengaduan</button>`;
            }

            let avatar = '';
            if (role === 'bot') {
                avatar = `
                <div class="message-avatar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
            `;
            } else {
                avatar = `
                <div class="message-avatar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
            `;
            }

            div.innerHTML = `
            ${avatar}
            <div class="message-content">
                ${processedContent.split('\n').map(p => `<p class="mb-1">${p}</p>`).join('')}
            </div>
        `;
            chatBody.appendChild(div);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function showTyping() {
            const div = document.createElement('div');
            div.id = 'typingBubble';
            div.className = 'message bot-message';
            div.innerHTML = `
            <div class="message-avatar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="message-content">
                <div class="typing"><span></span><span></span><span></span></div>
            </div>
        `;
            chatBody.appendChild(div);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function removeTyping() {
            const el = document.getElementById('typingBubble');
            if (el) el.remove();
        }

        async function sendMessage() {
            const msg = chatInput.value.trim();
            if (!msg) return;

            chatInput.value = '';
            chatInput.style.height = 'auto';
            appendMessage('user', msg);

            showTyping();

            try {
                const response = await fetch('<?= base_url('api/chat/send') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        message: msg
                    })
                });

                const data = await response.json();
                removeTyping();

                if (data.success) {
                    appendMessage('bot', data.message);
                } else {
                    appendMessage('bot', 'Maaf sedang ada kendala teknis. Mohon hubungi CS kami: 0822-9275-4405');
                }
            } catch (error) {
                removeTyping();
                appendMessage('bot', 'Koneksi bermasalah. Silakan periksa jaringan Anda.');
            }
        }

        // Modal Helpers
        window.openCekTagihan = () => new bootstrap.Modal(document.getElementById('modalCekTagihan')).show();
        window.openPengaduan = () => new bootstrap.Modal(document.getElementById('modalChatPengaduan')).show();

        // Do Cek Tagihan
        window.doCekTagihan = async () => {
            const noPelanggan = document.getElementById('noPelangganTagihan').value.trim();
            const hasilDiv = document.getElementById('hasilTagihan');

            if (!noPelanggan) {
                hasilDiv.innerHTML = '<div class="alert alert-warning text-sm">Masukkan nomor pelanggan</div>';
                return;
            }

            hasilDiv.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div><p class="mt-2 text-sm">Mengecek tagihan...</p></div>';

            try {
                const formData = new FormData();
                formData.append('id_pel', noPelanggan);

                const response = await fetch('<?= route_to('tagihan.detail') ?>', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.status !== "true" || !data.pelanggan || data.pelanggan.length === 0) {
                    hasilDiv.innerHTML = '<div class="alert alert-danger text-sm">Data tidak ditemukan. Periksa kembali nomor pelanggan Anda.</div>';
                    return;
                }

                // Display tagihan info
                let html = '<div class="tagihan-results">';

                // Basic Info header from first record
                const info = data.pelanggan[0];
                html += `<div class="card mb-3 border-primary shadow-sm" style="border-radius: 15px; border-left: 4px solid #3b82f6;">
                            <div class="card-body py-2 px-3">
                                <div class="d-flex justify-content-between align-items-center mb-1 border-bottom pb-1">
                                    <h6 class="mb-0 text-primary font-bold text-xs"><i class="bi bi-person-badge me-2"></i>DATA PELANGGAN</h6>
                                </div>
                                <div class="text-xs">
                                    <div class="flex justify-between py-1 border-bottom border-dashed"><span>Nama:</span><strong class="text-blue-900">${info.NAMA}</strong></div>
                                    <div class="flex justify-between py-1 border-bottom border-dashed"><span>No. Samb:</span><strong>${info.NOSAMW}</strong></div>
                                    <div class="flex justify-between py-1"><span>Alamat:</span><strong class="text-right ml-4">${info.ALAMAT}</strong></div>
                                </div>
                            </div>
                        </div>`;

                html += '<h6 class="text-xs font-bold mb-2 text-gray-500"><i class="bi bi-file-text me-1"></i> DAFTAR TAGIHAN KELUAR</h6>';

                data.pelanggan.forEach(item => {
                    html += '<div class="tagihan-card shadow-sm">';
                    html += '<div class="tagihan-info">';
                    html += `<div class="tagihan-item"><label>Periode</label><strong>${item.PERIODE || '-'}</strong></div>`;
                    html += `<div class="tagihan-item text-right"><label>Pemakaian</label><strong>${item.PAKAI || '-'} m³</strong></div>`;
                    html += `<div class="tagihan-item"><label>Stand Meter</label><strong>${item.METER_LALU} - ${item.METER_KINI}</strong></div>`;
                    html += `<div class="tagihan-item text-right"><label>Tagihan</label><strong class="text-blue-600">Rp ${formatRupiah(item.TAGIHAN || 0)}</strong></div>`;
                    html += '</div></div>';
                });

                html += '</div>';

                hasilDiv.innerHTML = html;

                // Send info to chat
                const totalUnpaid = data.pelanggan.length;
                const totalBill = data.pelanggan.reduce((sum, item) => sum + parseInt(item.TAGIHAN || 0), 0);

                appendMessage('bot', `Halo, untuk pelanggan ${info.NAMA} (${noPelanggan}), ditemukan ${totalUnpaid} catatan tagihan dengan total Rp ${formatRupiah(totalBill)}.`);

            } catch (error) {
                hasilDiv.innerHTML = '<div class="alert alert-danger text-sm">Terjadi kesalahan saat mengambil data. Silakan coba lagi.</div>';
                console.error('Error:', error);
            }
        };

        // Submit Pengaduan
        document.getElementById('formChatPengaduan').onsubmit = async function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            const btn = this.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = 'Mengirim...';

            try {
                const res = await fetch('<?= route_to('api.chat.submit_pengaduan') ?>', {
                    method: 'POST',
                    body: fd
                });
                const data = await res.json();

                if (data.success) {
                    alert(data.message);
                    bootstrap.Modal.getInstance(document.getElementById('modalChatPengaduan')).hide();
                    this.reset();
                    appendMessage('bot', 'Terima kasih, pengaduan Anda sudah saya teruskan ke tim teknis kami. Ada lagi yang bisa saya bantu?');
                } else {
                    alert(data.message || 'Gagal mengirim pengaduan');
                }
            } catch (e) {
                alert('Terjadi kesalahan koneksi');
            } finally {
                btn.disabled = false;
                btn.innerHTML = 'Kirim Pengaduan';
            }
        };

        // Export to global scope
        window.askTirta = (msg) => {
            chatInput.value = msg;
            sendMessage();
        };
    });
</script>