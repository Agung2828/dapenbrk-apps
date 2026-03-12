<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Dapen BRKS</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: #f8fafc;
            color: #334155;
        }

        /* SIDEBAR */
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
            z-index: 1000;
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
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-menu {
            padding: 16px 0;
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
            border-left: 3px solid transparent;
            background: transparent;
            width: 100%;
            transition: .25s;
        }

        .sidebar a:hover,
        .sidebar a.active,
        .logout-btn:hover {
            background: rgba(59, 130, 246, .15);
            color: #fff;
            border-left-color: #3b82f6;
            padding-left: 26px;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, .15);
            border-left-color: #ef4444;
        }

        /* MAIN */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        .header-navbar {
            height: var(--header-height);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 900;
            backdrop-filter: blur(6px);
        }

        .header-title {
            font-size: 20px;
            font-weight: 700;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 18px;
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
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-name {
            font-size: 14px;
            font-weight: 600;
        }

        /* CONTENT */
        .content-area {
            padding: 28px;
            flex: 1;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4 class="d-flex align-items-center gap-2">
                <img src="{{ asset('image/Loadinglogo.png') }}" alt="Dapen BRKS" style="height:40px;">
                <span>Dapen BRKS</span>
            </h4>
        </div>

        <div class="sidebar-menu">
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
                <i class="bi bi-newspaper"></i> Warta / Majalah
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

            <div class="menu-label">Lainnya</div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main-wrapper">

        <header class="header-navbar">
            <h1 class="header-title">Admin Panel</h1>

            <div class="header-right">
                <button class="icon-btn"><i class="bi bi-bell"></i></button>

                <div class="admin-profile">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="admin-name">{{ auth()->user()->name }}</div>
                </div>
            </div>
        </header>

        <main class="content-area">
            @yield('content')
        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const path = window.location.pathname;
            document.querySelectorAll('.sidebar a').forEach(link => {
                if (path.startsWith(new URL(link.href).pathname)) {
                    link.classList.add('active');
                }
            });
        });
    </script>

</body>

</html>
