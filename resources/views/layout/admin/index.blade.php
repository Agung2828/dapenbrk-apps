<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>@yield('title', 'Admin Dashboard') - Dapen BRKS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --header-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            overflow-x: hidden;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            background: #f8fafc;
            color: #334155;
        }

        body.no-scroll {
            overflow: hidden;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: var(--sidebar-width);
            max-width: 85vw;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: linear-gradient(180deg, #1e293b, #0f172a);
            color: #fff;
            box-shadow: 4px 0 24px rgba(0, 0, 0, .15);
            z-index: 1050;
            transition: transform .3s ease;
        }

        .sidebar-header {
            flex-shrink: 0;
            padding: 20px 22px;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
        }

        .sidebar-header h4 {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 19px;
            font-weight: 700;
            margin: 0;
        }

        .sidebar-header img {
            height: 38px;
            width: auto;
            flex-shrink: 0;
        }

        /* Daftar menu: bagian yang bisa di-scroll */
        .sidebar-menu {
            flex: 1 1 auto;
            min-height: 0;
            overflow-y: auto;
            overscroll-behavior: contain;
            -webkit-overflow-scrolling: touch;
            padding: 12px 0;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .15);
            border-radius: 10px;
        }

        /* Footer: Keluar selalu terlihat */
        .sidebar-footer {
            flex-shrink: 0;
            border-top: 1px solid rgba(255, 255, 255, .1);
            padding: 6px 0 calc(8px + env(safe-area-inset-bottom));
            background: rgba(15, 23, 42, .6);
        }

        .menu-label {
            padding: 10px 22px 6px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #94a3b8;
            font-weight: 600;
        }

        .sidebar a,
        .logout-btn {
            color: #cbd5e1;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 22px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            border-left: 3px solid transparent;
            background: transparent;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: .25s;
        }

        .sidebar a i,
        .logout-btn i {
            font-size: 16px;
            width: 18px;
            text-align: center;
            transition: transform .25s;
        }

        .sidebar a:hover,
        .sidebar a.active,
        .logout-btn:hover {
            background: rgba(59, 130, 246, .15);
            color: #fff;
            border-left-color: #3b82f6;
            padding-left: 26px;
        }

        .sidebar a:hover i,
        .logout-btn:hover i {
            transform: scale(1.15);
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, .15);
            border-left-color: #ef4444;
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .55);
            backdrop-filter: blur(2px);
            z-index: 1040;
            opacity: 0;
            pointer-events: none;
            transition: opacity .3s;
        }

        .sidebar-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }

        /* ===== MAIN ===== */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* ===== HEADER ===== */
        .header-navbar {
            height: var(--header-height);
            background: rgba(255, 255, 255, .92);
            border-bottom: 1px solid #e2e8f0;
            padding: 0 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 900;
            backdrop-filter: blur(8px);
            animation: slideDown .5s ease both;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .header-title {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-header {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f1f5f9;
            border: none;
            font-size: 20px;
            color: #334155;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            text-decoration: none;
            transition: .2s;
        }

        .btn-header:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .btn-header:active {
            transform: scale(.92);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-shrink: 0;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f1f5f9;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #334155;
            transition: .2s;
        }

        .icon-btn:hover {
            background: #e2e8f0;
        }

        /* ===== PROFIL ===== */
        .profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            border: none;
            padding: 4px 8px 4px 4px;
            border-radius: 50px;
            color: inherit;
            transition: .2s;
        }

        .profile-btn:hover {
            background: #f1f5f9;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(37, 99, 235, .3);
        }

        .admin-name {
            font-size: 14px;
            font-weight: 600;
            line-height: 1.2;
            text-align: left;
        }

        .admin-role {
            font-size: 11px;
            color: #94a3b8;
            text-align: left;
        }

        .profile-menu {
            min-width: 220px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 14px 34px rgba(0, 0, 0, .12);
            padding: 8px;
            animation: slideDown .25s ease;
        }

        .profile-menu .pm-head {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px 12px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 6px;
        }

        .profile-menu button {
            width: 100%;
            border: none;
            background: transparent;
            padding: 10px 12px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #dc2626;
            transition: .2s;
        }

        .profile-menu button:hover {
            background: #fef2f2;
        }

        /* ===== CONTENT ===== */
        .content-area {
            padding: 28px;
            flex: 1;
            min-width: 0;
            animation: fadeUp .5s ease both;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .btn-header {
                display: flex;
            }
        }

        @media (max-width: 576px) {
            .header-navbar {
                padding: 0 12px;
            }

            .header-title {
                font-size: 17px;
            }

            .header-right {
                gap: 8px;
            }

            .admin-info {
                display: none;
            }

            .profile-btn {
                padding: 0;
            }

            .content-area {
                padding: 16px 14px;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4>
                <img src="{{ asset('image/logodapen.png') }}" alt="Dapen BRKS">
                <span>Dapen BRKS</span>
            </h4>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Main Menu</div>

            <a href="{{ route('dashboard') }}">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>

            <div class="menu-label">Konten Management</div>

            <a href="{{ route('admin.berita.index') }}">
                <i class="bi bi-newspaper"></i> Berita & Informasi
            </a>

            {{-- <a href="{{ route('admin.laporan.index') }}">
                <i class="bi bi-file-earmark-bar-graph"></i> Laporan Keuangan
            </a> --}}

            <a href="{{ route('admin.jumlah-peserta.index') }}">
                <i class="bi bi-people-fill"></i> Jumlah Peserta
            </a>
            <a href="{{ route('admin.peserta.index') }}">
                <i class="bi bi-person-vcard-fill"></i> Data Peserta (Simulasi)
            </a>
            <a href="{{ route('admin.warta.index') }}">
                <i class="bi bi-journal-richtext"></i> Warta / Majalah
            </a>
            <a href="{{ route('admin.dokumen.index') }}">
                <i class="bi bi-folder2-open"></i> Dokumen
            </a>
            <a href="{{ route('admin.form-pemutakhiran.index') }}">
                <i class="bi bi-file-earmark-pdf-fill"></i> Form Pemutakhiran Data
            </a>
            <a href="{{ route('admin.gallery.index') }}">
                <i class="bi bi-images"></i> Galeri
            </a>
            <a href="{{ route('admin.slider.index') }}">
                <i class="bi bi-sliders"></i> Slider
            </a>
            <a href="{{ route('admin.materi.index') }}">
                <i class="bi bi-journal-text"></i> Materi Sosialisasi
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main-wrapper">

        <header class="header-navbar">
            <div class="header-left">
                <button type="button" class="btn-header" id="btnToggleSidebar" aria-label="Menu">
                    <i class="bi bi-list"></i>
                </button>

                <h1 class="header-title">@yield('page-title', 'Admin Panel')</h1>
            </div>

            <div class="header-right">
                <button class="icon-btn" aria-label="Notifikasi"><i class="bi bi-bell"></i></button>

                <div class="dropdown">
                    <button class="profile-btn" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Profil">
                        <div class="admin-avatar"><i class="bi bi-person-fill"></i></div>
                        <div class="admin-info">
                            <div class="admin-name">{{ auth()->user()->name }}</div>
                            <div class="admin-role">Super Admin</div>
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end profile-menu">
                        <div class="pm-head">
                            <div class="admin-avatar"><i class="bi bi-person-fill"></i></div>
                            <div>
                                <div class="admin-name">{{ auth()->user()->name }}</div>
                                <div class="admin-role">Super Admin</div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="content-area">
            @yield('content')
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const btn = document.getElementById('btnToggleSidebar');
            const back = document.getElementById('btnBack');

            function toggle(show) {
                sidebar.classList.toggle('show', show);
                overlay.classList.toggle('show', show);
                document.body.classList.toggle('no-scroll', show);
            }

            btn.addEventListener('click', () => toggle(!sidebar.classList.contains('show')));
            overlay.addEventListener('click', () => toggle(false));
            sidebar.querySelectorAll('a').forEach(a => a.addEventListener('click', () => toggle(false)));
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') toggle(false);
            });
            window.addEventListener('resize', () => {
                if (window.innerWidth > 992) toggle(false);
            });

            // Tombol kembali: pakai riwayat browser jika halaman sebelumnya masih di situs ini
            if (back) {
                back.addEventListener('click', e => {
                    try {
                        if (document.referrer && new URL(document.referrer).origin === location.origin) {
                            e.preventDefault();
                            history.back();
                        }
                    } catch (err) {}
                });
            }

            // Menu aktif
            const path = location.pathname.replace(/\/$/, '') || '/';
            sidebar.querySelectorAll('.sidebar-menu a').forEach(link => {
                const p = new URL(link.href).pathname.replace(/\/$/, '') || '/';
                if (p === path || (p !== '/' && path.startsWith(p + '/'))) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
