<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Layanan Pengaduan')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('template/src/assets/images/logos/Favicon2.png') }}" />

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-section {
            background:
                linear-gradient(rgba(60, 70, 200, 0.75), rgba(60, 70, 200, 0.75)),
                url('assets/img/gedung_pengaduan.jpg') center/cover no-repeat;
            padding: 120px 0 180px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .info-overlay {
            margin-top: -120px;
            /* naik ke hero */
            margin-bottom: 80px;
            /* JARAK KE SECTION BERIKUTNYA */
            position: relative;
            z-index: 5;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-6px);
        }

        .statistik-section {
            padding-top: 20px;
        }

        .timeline {
            list-style: none;
            padding-left: 20px;
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 9px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 25px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: 0;
            top: 3px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            z-index: 2;
        }

        .timeline-content {
            padding-bottom: 5px;
        }

        .timeline-item.completed .timeline-dot {
            box-shadow: 0 0 0 4px rgba(25, 135, 84, .15);
        }

        .timeline-item.rejected .timeline-dot {
            box-shadow: 0 0 0 4px rgba(220, 53, 69, .15);
        }

        @media print {

            /* TAMPILKAN HANYA AREA CETAK */
            .print-area,
            .print-area * {
                visibility: visible;
            }

            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            /* tombol dll tidak ikut */
            .no-print {
                display: none !important;
            }
        }

        /* tombol chat bulat */
        #chat-toggle {
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #0d6efd;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 9999;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .3);
        }

        /* box chat */
        #chat-box {
            position: fixed;
            bottom: 170px;
            right: 30px;
            width: 320px;
            height: 420px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 9999;
        }

        #messages {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: linear-gradient(to bottom, #f0f2f5, #e4e6eb);
        }

        .message {
            max-width: 75%;
            padding: 8px 14px;
            border-radius: 18px;
            margin-bottom: 8px;
            word-wrap: break-word;
            font-size: 14px;
        }

        .message.masyarakat {
            background: #0d6efd;
            color: white;
            margin-left: auto;
            border-bottom-right-radius: 5px;
        }

        .message.admin {
            background: #e4e6eb;
            color: black;
            margin-right: auto;
            border-bottom-left-radius: 5px;
        }

        .chat-input {
            display: flex;
            border-top: 1px solid #ddd;
        }

        #chat-input input {
            flex: 1;
            border: none;
            padding: 10px;
        }

        #chat-input button {
            border: none;
            background: #0d6efd;
            color: white;
            padding: 0 15px;
        }

        #chat-room {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
    </style>

</head>

<body class="bg-light">

    {{-- HEADER --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('masyarakat.index') }}">
                📝 Layanan Pengaduan
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-outline-dark text-white px-3" href="#home">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-outline-dark text-white px-3" href="#daftar-pengaduan">
                            Daftar Pengaduan
                        </a>
                    </li>

                    <li class="nav-item mx-2">
                        <a class="nav-link btn btn-sm btn-outline-dark text-white px-3" href="#kontak">
                            Kontak
                        </a>
                    </li>

                    @auth
                        <li class="nav-item text-white mx-2">
                            Selamat Datang, <strong>{{ Auth::user()->nama ?? 'User' }}</strong>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline-light btn-sm">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-light btn-sm">
                                Login
                            </a>
                        </li>

                        <li class="nav-item ms-2">
                            <a href="{{ route('register') }}" class="btn btn-light btn-sm">
                                <i class="bi bi-person-plus"></i> Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    <div id="chat-toggle">
        💬
    </div>

    <div id="chat-box">

        <div id="chat-form">
            <h6 class="fw-bold mb-3">Live Chat</h6>

            <input class="form-control mb-2" id="nama" placeholder="Nama">
            <input class="form-control mb-2" id="email" placeholder="Email">
            <input class="form-control mb-2" id="hp" placeholder="Nomor HP">

            <button class="btn btn-primary w-100" type="button" onclick="startChat()">
                Mulai Chat
            </button>

        </div>

        <div id="chat-room" style="display:none; height:100%;">
            <div id="messages"></div>
            <div class="chat-input">
                <input id="message" placeholder="Ketik pesan...">
                <button onclick="sendMessage()">Kirim</button>
            </div>
        </div>

    </div>

    {{-- FOOTER --}}

    <footer id="kontak" class="bg-dark text-white mt-5 no-print">
        <div class="container py-5">
            <div class="row">

                {{-- KIRI --}}
                <div class="col-md-6 mb-4 mb-md-0">
                    <h6 class="fw-bold text-white">Layanan Pengaduan Masyarakat</h6>
                    <p class="text-secondary text-white small mb-0">
                        Platform resmi untuk menyampaikan aspirasi dan keluhan masyarakat.
                        Kami berkomitmen untuk memberikan pelayanan terbaik bagi warga.
                    </p>
                </div>

                {{-- KANAN --}}
                <div class="col-md-6">
                    <h6 class="fw-bold text-white">Hubungi Kami</h6>
                    <p class="text-secondary text-white small mb-1">
                        Jl. Merdeka No. 123<br>
                        Jakarta Pusat, DKI Jakarta 10110
                    </p>
                    <p class="text-secondary text-white small mb-1">
                        (021) 1234-5678
                    </p>
                    <p class="text-secondary text-white small mb-0">
                        pengaduan@pemerintah.go.id
                    </p>
                </div>

            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="bg-black text-center py-3">
            <small class="text-secondary text-white">
                © 2026 Layanan Pengaduan Masyarakat. Seluruh hak cipta dilindungi.
            </small>
        </div>
    </footer>

    <script>
        /* ===============================
                                                                                                GLOBAL STATE
                                                                                            ================================ */
        let chatSessionId = null;

        document.addEventListener('DOMContentLoaded', () => {

    if (isLoggedIn) {
        fetch('{{ route("chat.getSession") }}')
            .then(res => res.json())
            .then(data => {

                if (data.success && data.chat_session) {
                    chatSessionId = data.chat_session.id;

                    document.getElementById('chat-form').style.display = 'none';
                    document.getElementById('chat-room').style.display = 'flex';

                    loadMessages();
                }
            });
    }
});

        /* ===============================
           START CHAT
        ================================ */
        function startChat() {
            fetch('{{ route('chat.start') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nama: document.getElementById('nama').value,
                        email: document.getElementById('email').value,
                        no_hp: document.getElementById('hp').value
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        alert('Gagal memulai chat');
                        return;
                    }

                    chatSessionId = data.chat_session.id;

                    // 🔑 LOGIKA YANG BENAR
                    if (!isLoggedIn) {
                        alert('Silakan login untuk mulai chat');
                        window.location.href = '{{ route('login') }}';
                    } else {
                        document.getElementById('chat-form').style.display = 'none';
                        document.getElementById('chat-room').style.display = 'flex';
                    }
                });
        }


        /* ===============================
           SEND MESSAGE
        ================================ */
        function sendMessage() {
            if (!chatSessionId) {
                alert('Chat belum dimulai');
                return;
            }

            fetch('{{ route('chat.send') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        chat_session_id: chatSessionId,
                        message: document.getElementById('message').value
                    })
                })
                .then(res => {
                    if (res.status === 401) {
                        alert('Silakan login terlebih dahulu');
                        window.location.href = '{{ route('login') }}';
                        return;
                    }

                    if (res.status === 403) {
                        alert('Chat tidak valid');
                        return;
                    }

                    return res.json();
                })

                .then(data => {
                    if (!data || !data.success) return;

                    appendMessage('masyarakat', document.getElementById('message').value);
                    document.getElementById('message').value = '';
                });
        }

        function loadMessages() {

            fetch(`/chat/messages/${chatSessionId}`)
                .then(res => res.json())
                .then(data => {

                    if (!data.success) return;

                    document.getElementById('messages').innerHTML = '';

                    data.messages.forEach(msg => {
                        appendMessage(msg.sender_type, msg.message);
                    });

                });
        }

        /* ===============================
           TOGGLE CHAT BOX
        ================================ */
        const toggle = document.getElementById('chat-toggle');
        const chatBox = document.getElementById('chat-box');

        if (toggle && chatBox) {
            toggle.addEventListener('click', () => {
                chatBox.style.display =
                    chatBox.style.display === 'flex' ? 'none' : 'flex';
            });
        }
    </script>
    <script>
        function appendMessage(sender, text) {
            const messages = document.getElementById('messages');
            const div = document.createElement('div');

            div.classList.add('message', sender);
            div.innerText = text;

            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight;
        }
    </script>
    <script>
        const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
