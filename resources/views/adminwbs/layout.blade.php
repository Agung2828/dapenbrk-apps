<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin WBS') - Dapen BRKS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            background: #f8fafc;
            color: #334155;
        }

        /* ===== ANIMASI GLOBAL ===== */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bellRing {

            0%,
            100% {
                transform: rotate(0);
            }

            15% {
                transform: rotate(14deg);
            }

            30% {
                transform: rotate(-12deg);
            }

            45% {
                transform: rotate(8deg);
            }

            60% {
                transform: rotate(-6deg);
            }

            75% {
                transform: rotate(0);
            }
        }

        @keyframes pulseDot {
            0% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, .55);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(239, 68, 68, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        .anim-fade-up {
            opacity: 0;
            animation: fadeUp .55s cubic-bezier(.2, .7, .2, 1) forwards;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #1e293b, #0f172a);
            color: #fff;
            box-shadow: 4px 0 24px rgba(0, 0, 0, .15);
            overflow-y: auto;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            transition: transform .3s ease;
        }

        .sidebar-header {
            padding: 22px;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
        }

        .sidebar-header h4 {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }

        .sidebar-menu {
            padding: 16px 0;
            flex: 1;
        }

        .menu-label {
            padding: 10px 22px;
            font-size: 11px;
            text-transform: uppercase;
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
            padding: 12px 22px;
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
            position: relative;
            color: #334155;
            transition: .2s;
        }

        .icon-btn:hover {
            background: #e2e8f0;
        }

        .icon-btn:hover .bi-bell {
            animation: bellRing .8s ease;
        }

        .notif-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ef4444;
            color: #fff;
            font-size: 10.5px;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            animation: pulseDot 2s infinite;
        }

        .notif-dropdown {
            width: 320px;
            max-width: calc(100vw - 24px);
            padding: 0;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 14px 34px rgba(0, 0, 0, .12);
            overflow: hidden;
            animation: slideDown .25s ease;
        }

        .notif-dropdown .dh {
            padding: 14px 18px;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #fff;
            font-weight: 600;
            font-size: 14px;
        }

        .notif-dropdown .di {
            display: block;
            padding: 12px 18px;
            border-bottom: 1px solid #f1f5f9;
            text-decoration: none;
            color: #334155;
            transition: .2s;
        }

        .notif-dropdown .di:hover {
            background: #f8fafc;
            padding-left: 22px;
        }

        .notif-dropdown .di strong {
            display: block;
            font-size: 13.5px;
        }

        .notif-dropdown .di span {
            font-size: 12px;
            color: #64748b;
        }

        .notif-dropdown .df {
            display: block;
            padding: 11px 18px;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            color: #2563eb;
            text-decoration: none;
            background: #f8fafc;
            transition: .2s;
        }

        .notif-dropdown .df:hover {
            background: #eff6ff;
        }

        .notif-empty {
            padding: 24px 18px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
        }

        /* ===== PROFIL ===== */
        .profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            border: none;
            padding: 4px 6px 4px 4px;
            border-radius: 50px;
            transition: .2s;
            color: inherit;
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
            transition: transform .25s;
        }

        .profile-btn:hover .admin-avatar {
            transform: scale(1.08);
        }

        .admin-info {
            text-align: left;
        }

        .admin-name {
            font-size: 14px;
            font-weight: 600;
            line-height: 1.2;
        }

        .admin-role {
            font-size: 11px;
            color: #94a3b8;
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

        .profile-menu .pm-head .admin-avatar {
            width: 44px;
            height: 44px;
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
            animation: fadeIn .5s ease both;
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
                <img src="{{ asset('image/logodapen.png') }}" alt="Dapen BRKS" style="height:40px;">
                <span>Dapen BRKS</span>
            </h4>
        </div>

        <div class="sidebar-menu">
            <div class="menu-label">Admin WBS</div>

            <a href="{{ route('adminwbs.dashboard') }}"
                class="{{ request()->routeIs('adminwbs.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>

            <a href="{{ route('adminwbs.laporan.create') }}"
                class="{{ request()->routeIs('adminwbs.laporan.create') ? 'active' : '' }}">
                <i class="bi bi-plus-square-fill"></i> Buat Laporan
            </a>

            <div class="menu-label">Lainnya</div>

            <form method="POST" action="{{ route('adminwbs.logout') }}">
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
                {{-- Tombol kembali: hanya mobile & bukan di halaman dashboard --}}
                @unless (request()->routeIs('adminwbs.dashboard'))
                    <a href="{{ route('adminwbs.dashboard') }}" class="btn-header" id="btnBack" aria-label="Kembali">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                @endunless

                <button type="button" class="btn-header" id="btnToggleSidebar" aria-label="Menu">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="header-title">@yield('page-title', 'Dashboard')</h1>
            </div>

            <div class="header-right">
                {{-- Notifikasi --}}
                <div class="dropdown">
                    <button class="icon-btn" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifikasi">
                        <i class="bi bi-bell"></i>
                        @if (($notifCount ?? 0) > 0)
                            <span class="notif-badge">{{ $notifCount > 9 ? '9+' : $notifCount }}</span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end notif-dropdown">
                        <div class="dh"><i class="bi bi-bell"></i> Laporan Baru Masuk</div>
                        @forelse ($notifLatest ?? [] as $n)
                            <a href="{{ route('adminwbs.laporan.show', $n) }}" class="di">
                                <strong>{{ $n->ticket_token }}</strong>
                                <span>{{ $n->kategori_pengaduan }} &middot;
                                    {{ $n->created_at->diffForHumans() }}</span>
                            </a>
                        @empty
                            <div class="notif-empty">Tidak ada laporan baru.</div>
                        @endforelse
                        <a href="{{ route('adminwbs.dashboard') }}#daftarLaporan" class="df">
                            Lihat semua laporan <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- Profil --}}
                <div class="dropdown">
                    <button class="profile-btn" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Profil">
                        <div class="admin-avatar"><i class="bi bi-person-fill"></i></div>
                        <div class="admin-info">
                            <div class="admin-name">{{ auth('adminwbs')->user()->name ?? 'Admin' }}</div>
                            <div class="admin-role">Tim Anti Fraud</div>
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end profile-menu">
                        <div class="pm-head">
                            <div class="admin-avatar"><i class="bi bi-person-fill"></i></div>
                            <div>
                                <div class="admin-name">{{ auth('adminwbs')->user()->name ?? 'Admin' }}</div>
                                <div class="admin-role">Tim Anti Fraud</div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('adminwbs.logout') }}">
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
        (function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const btn = document.getElementById('btnToggleSidebar');
            const back = document.getElementById('btnBack');

            function toggle(show) {
                sidebar.classList.toggle('show', show);
                overlay.classList.toggle('show', show);
            }

            btn.addEventListener('click', () => toggle(!sidebar.classList.contains('show')));
            overlay.addEventListener('click', () => toggle(false));
            sidebar.querySelectorAll('a').forEach(a => a.addEventListener('click', () => toggle(false)));
            window.addEventListener('resize', () => {
                if (window.innerWidth > 992) toggle(false);
            });

            // Tombol kembali: pakai riwayat browser bila halaman sebelumnya masih di situs ini,
            // kalau tidak, pakai href bawaan (Dashboard).
            if (back) {
                back.addEventListener('click', function(e) {
                    try {
                        if (document.referrer && new URL(document.referrer).origin === location.origin) {
                            e.preventDefault();
                            history.back();
                        }
                    } catch (err) {}
                });
            }
        })();
    </script>
    @stack('scripts')
</body>

</html>
