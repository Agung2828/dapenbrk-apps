<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Formulir - Dana Pensiun Bank Riau Kepri</title>
    <link rel="icon" type="image/png" href="{{ asset('image/Loadinglogo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* ============================
           LOADING SCREEN STYLES
        ============================ */
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 99999;
            background: rgba(0, 0, 0, 0.75);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 0.2s ease-out, visibility 0.2s ease-out;
            overflow: hidden;
        }

        .loading-ring,
        .loading-text,
        .progress-container,
        .loading-percentage,
        .particle {
            display: none !important;
        }

        .logo-container {
            position: relative;
            margin: 0;
        }

        .pulsing-logo {
            width: 100px;
            object-fit: contain;
            filter: none;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        #loader-wrapper.loader-hide {
            opacity: 0;
            visibility: hidden;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }

        /* ============================
           NAVIGATION BUTTONS
        ============================ */
        .nav-download {
            background: rgba(234, 90, 12, 0.75);
            color: #ffffff !important;
            padding: 10px 18px;
            border-radius: 8px;
            margin-left: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(234, 90, 12, 0.35);
            white-space: nowrap;
            border: 2px solid transparent;
        }

        .nav-download:hover {
            background: #ffffff;
            color: #ea5a0c !important;
            border-color: #ea5a0c;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(234, 90, 12, 0.4);
        }

        /* ============================
           NAV KONTAK
        ============================ */
        .nav-kontak {
            background: rgba(186, 152, 2, 0.85);
            color: #fff !important;
            padding: 10px 18px;
            border-radius: 8px;
            margin-left: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(44, 82, 130, 0.25);
            border: 2px solid transparent;
        }

        .nav-kontak:hover {
            background: #ffffff;
            color: #988904 !important;
            border-color: #82682c;
            transform: translateY(-2px);
        }

        /* ============================
           FLOATING WHATSAPP BUTTON
        ============================ */
        .floating-whatsapp {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
        }

        .floating-whatsapp-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            border-radius: 50%;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            text-decoration: none;
            animation: floating-pulse 2s ease-in-out infinite;
        }

        .floating-whatsapp-link:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
        }

        .floating-whatsapp-link i {
            font-size: 2.2rem;
            color: white;
        }

        @keyframes floating-pulse {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        /* Stats Section */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .stat-box {
            background: white;
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border: 1px solid #e8e8e8;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            border-color: #43a047;
        }

        .stat-box i {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #b19912 0%, #c5c225e8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .stat-box h3 {
            font-size: 2rem;
            color: #2d3748;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .stat-box p {
            color: #718096;
            font-size: 0.95rem;
        }

        /* Main Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        /* Card Styling */
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid #e8e8e8;
            display: flex;
            flex-direction: column;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #b9a91a 0%, #d46727 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
            border-color: #e0d31f;
        }

        .form-card:hover::before {
            transform: scaleX(1);
        }

        /* Special Card for Complaints */
        .complaint-card {
            background: white;
            border: 3px solid #dc3545 !important;
            color: #2d3748;
        }

        .complaint-card::before {
            background: linear-gradient(90deg, #dc3545 0%, #c82333 100%);
        }

        .complaint-card .card-header h2 {
            color: #2d3748 !important;
        }

        .complaint-card .card-description {
            color: #718096 !important;
        }

        .complaint-card .card-icon {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
        }

        .complaint-card .card-icon i {
            color: white;
        }

        .complaint-card .form-item {
            background: #f8f9fa;
            border: 2px solid transparent;
        }

        .complaint-card .form-item::before {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .complaint-card .form-item:hover {
            background: #fff5f5;
            border-color: #dc3545;
        }

        .complaint-card .form-name {
            color: #2d3748 !important;
        }

        .complaint-card .form-item i {
            color: #dc3545;
        }

        .complaint-card .file-badge {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        /* Card Header */
        .card-header {
            margin-bottom: 28px;
            position: relative;
        }

        .card-icon {
            width: 65px;
            height: 65px;
            background: linear-gradient(135deg, #e4c61d 0%, #ceb630 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 6px 20px rgba(27, 94, 32, 0.3);
        }

        .card-icon i {
            font-size: 1.8rem;
            color: white;
        }

        .card-header h2 {
            font-size: 1.6rem;
            color: #2d3748;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .card-description {
            color: #718096;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Form Items */
        .form-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .form-item {
            display: flex;
            align-items: center;
            padding: 18px 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 2px solid transparent;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .form-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, #dfbc20 0%, #beb423 100%);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .form-item:hover {
            background: #e8f5e9;
            border-color: #b5ce28;
            transform: translateX(8px);
        }

        .form-item:hover::before {
            transform: scaleY(1);
        }

        .form-item:active {
            transform: translateX(4px) scale(0.98);
        }

        .form-item i {
            font-size: 1.4rem;
            color: #d1ce26;
            margin-right: 18px;
            transition: transform 0.3s ease;
            min-width: 24px;
        }

        .form-item:hover i {
            transform: scale(1.15);
        }

        .form-name {
            flex: 1;
            font-size: 1rem;
            color: #2d3748;
            font-weight: 600;
        }

        .file-badge {
            background: linear-gradient(135deg, #e65b24 0%, #a05143 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(27, 94, 32, 0.25);
        }

        /* Download Animation */
        .form-item.downloading i {
            animation: downloadPulse 0.6s ease;
        }

        @keyframes downloadPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 30px;
            left: 30px;
            background: white;
            padding: 18px 25px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 15px;
            transform: translateY(150%);
            transition: transform 0.4s ease;
            z-index: 2000;
        }

        .toast.show {
            transform: translateY(0);
        }

        .toast i {
            font-size: 1.5rem;
            color: #43a047;
        }

        .toast-content h4 {
            font-size: 1rem;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .toast-content p {
            font-size: 0.85rem;
            color: #718096;
        }

        /* Responsive */
        @media (max-width: 991px) {

            .main-nav .nav-download,
            .main-nav .nav-kontak {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .form-card {
                padding: 25px;
            }

            .stats-container {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
            }

            .floating-whatsapp {
                bottom: 20px;
                right: 20px;
            }

            .floating-whatsapp-link {
                width: 55px;
                height: 55px;
            }

            .floating-whatsapp-link i {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 480px) {
            .stats-container {
                grid-template-columns: 1fr;
            }

            .stat-box {
                padding: 20px;
            }

            .floating-whatsapp {
                bottom: 15px;
                right: 15px;
            }

            .floating-whatsapp-link {
                width: 50px;
                height: 50px;
            }

            .floating-whatsapp-link i {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>

    <!-- LOADING SCREEN -->
    <div id="loader-wrapper">
        <div class="logo-container">
            <img src="{{ asset('image/Loadinglogo.png') }}" alt="Logo Dana Pensiun" class="pulsing-logo">
        </div>
    </div>

    <!-- FLOATING WHATSAPP BUTTON -->
    <div class="floating-whatsapp">
        <a href="https://wa.me/628137964058" target="_blank" class="floating-whatsapp-link" aria-label="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <!-- Main Header -->
    <header class="main-header" id="mainHeader">
        <div class="container">
            <!-- Logo -->
            <div class="logo-section">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo">
                </a>
            </div>

            <!-- Main Nav -->
            <nav class="main-nav">
                <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
                <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
                <a href="{{ url('/kepesertaan') }}" class="nav-link">Kepesertaan</a>
                <a href="{{ url('/warta') }}" class="nav-link">Warta</a>
                <a href="{{ route('formulir') }}" class="nav-link nav-download">
                    <i class="fas fa-download"></i> Unduh Formulir
                </a>
                <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak">
                    <i class="fas fa-phone-alt"></i> Bantuan/Kontak
                </a>
            </nav>

            <!-- Mobile Nav -->
            <div class="mobile-nav" id="mobileNav">
                <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
                <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
                <a href="{{ url('/kepesertaan') }}" class="nav-link">Kepesertaan</a>
                <a href="{{ url('/warta') }}" class="nav-link">Warta</a>
                <a href="{{ route('formulir') }}" class="nav-link nav-download">
                    <i class="fas fa-download"></i> Unduh Formulir
                </a>
                <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak">
                    <i class="fas fa-phone-alt"></i> Bantuan/Kontak
                </a>
            </div>

            <!-- Header Actions -->
            <div class="header-actions">
                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Page Content -->
    <div id="home" class="page-content active">

        <!-- Hero Slider -->
        <div class="hero-slider">
            <div class="slide active" style="background-image: url('{{ asset('image/MTQ.jpg') }}');">
                <div class="slide-content">
                    <h1>Formulir Layanan<br>Dana Pensiun</h1>
                    <p>
                        Unduh dan lengkapi formulir layanan Dana Pensiun Bank Riau Kepri
                        sebagai bagian dari proses kepesertaan dan administrasi
                        yang tertib, mudah, dan transparan.
                    </p>
                </div>
            </div>

            <div class="slide" style="background-image: url('{{ asset('image/LAM Kepri.jpeg') }}');">
                <div class="slide-content">
                    <h1>Investasi Terpercaya<br>Untuk Masa Pensiun</h1>
                    <p>Pengelolaan dana pensiun yang amanah dan profesional dengan hasil investasi optimal untuk
                        kesejahteraan peserta.</p>
                </div>
            </div>

            <div class="slide"
                style="background-image: url('https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=1600');">
                <div class="slide-content">
                    <h1>Layanan Prima<br>Untuk Peserta</h1>
                    <p>Tim ahli kami siap melayani kebutuhan kepesertaan Anda dengan profesional dan responsif.</p>
                </div>
            </div>

            <div class="slider-dots">
                <span class="dot active" onclick="changeSlide(0)"></span>
                <span class="dot" onclick="changeSlide(1)"></span>
                <span class="dot" onclick="changeSlide(2)"></span>
            </div>
        </div>

        <!-- Form Content Section -->
        <section class="quick-links">
            <div class="container">

                <div class="stats-container">
                    {{-- Stats box jika diperlukan --}}
                </div>

                <!-- Content Grid -->
                <div class="content-grid">

                    <!-- Manfaat Pensiun Card -->
                    <div class="form-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                            <h2>Manfaat Pensiun (MP)</h2>
                            <p class="card-description">Formulir permohonan pembayaran manfaat pensiun sesuai jenis
                                klaim</p>
                        </div>
                        <div class="form-list">
                            <a href="pdf/F-K10-01 Permohonan MP Normal.pdf" class="form-item" data-name="mp normal"
                                download>
                                <i class="fas fa-file-download"></i>
                                <span class="form-name">Form MP Normal</span>
                                <span class="file-badge">PDF</span>
                            </a>
                            <a href="pdf/F-K11-01 Permohonan MP Cacat.pdf" class="form-item" data-name="mp cacat"
                                download>
                                <i class="fas fa-file-download"></i>
                                <span class="form-name">Form MP Cacat</span>
                                <span class="file-badge">PDF</span>
                            </a>
                            <a href="pdf/F-K12-01 Permohonan MP Ditunda.pdf" class="form-item" data-name="mp ditunda"
                                download>
                                <i class="fas fa-file-download"></i>
                                <span class="form-name">Form MP Ditunda</span>
                                <span class="file-badge">PDF</span>
                            </a>
                            <a href="pdf/F-K13-01 Permohonan MP Ditunda Dialihkan.pdf" class="form-item"
                                data-name="mp ditunda dialihkan" download>
                                <i class="fas fa-file-download"></i>
                                <span class="form-name">Form MP Ditunda Dialihkan</span>
                                <span class="file-badge">PDF</span>
                            </a>
                            <a href="pdf/F-K14-01 Permohonan MP Ditunda Jatuh Tempo.pdf" class="form-item"
                                data-name="mp ditunda jatuh tempo" download>
                                <i class="fas fa-file-download"></i>
                                <span class="form-name">Form MP Ditunda Jatuh Tempo</span>
                                <span class="file-badge">PDF</span>
                            </a>
                        </div>
                    </div>

                    <!-- MP Khusus Card -->
                    <div class="form-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h2>MP Khusus</h2>
                            <p class="card-description">Formulir untuk kondisi pensiun khusus dan ahli waris</p>
                        </div>
                        <div class="form-list">
                            <a href="pdf/F-K15-01 Permohonan MP Dipercepat.pdf" class="form-item"
                                data-name="mp dipercepat" download>
                                <i class="fas fa-file-download"></i>
                                <span class="form-name">Form MP Dipercepat</span>
                                <span class="file-badge">PDF</span>
                            </a>
                            <a href="pdf/F-K16-01 Permohonan MP Janda-Duda.pdf" class="form-item"
                                data-name="mp janda duda" download>
                                <i class="fas fa-file-download"></i>
                                <span class="form-name">Form MP Janda/Duda</span>
                                <span class="file-badge">PDF</span>
                            </a>
                            <a href="pdf/F-K17-01 Permohonan MP Anak.pdf" class="form-item" data-name="mp anak"
                                download>
                                <i class="fas fa-file-download"></i>
                                <span class="form-name">Form MP Anak</span>
                                <span class="file-badge">PDF</span>
                            </a>
                            <a href="pdf/F-K18-01 Permohonan MP Sekaligus & -3 Tahun.pdf" class="form-item"
                                data-name="mp sekaligus" download>
                                <i class="fas fa-file-download"></i>
                                <span class="form-name">Form MP Sekaligus & Kurang 3 Tahun</span>
                                <span class="file-badge">PDF</span>
                            </a>
                        </div>
                    </div>

                    <!-- Form Pemutakhiran Data -->
                    <div class="form-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h2>Formulir Pemutakhiran Data</h2>
                            <p class="card-description">
                                Formulir untuk pengajuan dan pembaruan data kepesertaan pensiunan maupun ahli waris
                            </p>
                        </div>
                        <div class="form-list">
                            @forelse ($formPemutakhiran ?? collect() as $item)
                                <a href="{{ asset('uploads/form_pemutakhiran/' . $item->file_pdf) }}"
                                    class="form-item" data-name="{{ \Illuminate\Support\Str::slug($item->judul) }}"
                                    download>
                                    <i class="fas fa-file-pdf"></i>
                                    <span class="form-name">{{ $item->judul }}</span>
                                    <span class="file-badge">PDF</span>
                                </a>
                            @empty
                                <p class="text-muted">Belum ada form pemutakhiran yang tersedia.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Layanan Pengaduan Card -->
                    <div class="form-card complaint-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <h2>Layanan Pengaduan</h2>
                            <p class="card-description">Sampaikan pengaduan atau keluhan Anda melalui formulir resmi
                            </p>
                        </div>
                        <div class="form-list">
                            <a href="pdf/F-K04-00 Saran dan Pendapat.pdf" class="form-item"
                                data-name="pengaduan peserta" download>
                                <i class="fas fa-comment-dots"></i>
                                <span class="form-name">Form Layanan Pengaduan Peserta</span>
                                <span class="file-badge">PDF</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>
    {{-- END #home / .page-content --}}

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fas fa-check-circle"></i>
        <div class="toast-content">
            <h4>Download Berhasil!</h4>
            <p>Formulir sedang diunduh...</p>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>Tentang Kami</h3>
                    <p style="color: #d1d5db; font-size: 0.95rem; line-height: 1.9;">
                        Dana Pensiun Bank Riau Kepri memberikan jaminan kesejahteraan di masa pensiun dengan
                        pengelolaan yang profesional dan transparan.
                    </p>
                    <div class="social-links">
                        <a href="https://wa.me/628137964058" target="_blank" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3>Tautan Cepat</h3>
                    <ul>
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li><a href="{{ url('/profile') }}">Profil</a></li>
                        <li><a href="{{ url('/kepesertaan') }}">Kepesertaan</a></li>
                        <li><a href="{{ url('/warta') }}">Warta</a></li>
                        <li><a href="{{ route('simulasi') }}">Simulasi Manfaat</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Layanan</h3>
                    <ul>
                        <li><a href="{{ route('simulasi') }}">Simulasi Manfaat</a></li>
                        <li><a href="{{ route('Pengaduan') }}">Pengaduan</a></li>
                        <li><a href="{{ route('formulir') }}">Download Formulir</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3 style="margin-bottom: 1rem;">Kontak & Legalitas</h3>
                    <ul style="margin-bottom: 2rem;">
                        <li style="display: flex; gap: 0.75rem; color: #d1d5db; margin-bottom: 0.5rem;">
                            <i class="fas fa-map-marker-alt" style="margin-top: 0.25rem; color: #fbbf24;"></i>
                            <span>Jl. Arifin Ahmad No. 54-56 Kel Sidomulyo Timur Kec Marpoyan Damai Pekanbaru -
                                28125</span>
                        </li>
                        <li style="display: flex; gap: 0.75rem; color: #d1d5db; margin-bottom: 0.5rem;">
                            <i class="fas fa-phone" style="color: #fbbf24;"></i>
                            <span>(0761) 5781181</span>
                        </li>
                        <li style="display: flex; gap: 0.75rem; color: #d1d5db; margin-bottom: 1rem;">
                            <i class="fas fa-envelope" style="color: #fbbf24;"></i>
                            <span>dapenbankriau@gmail.com</span>
                        </li>
                    </ul>

                    <div class="compliance-group">
                        <div class="compliance-item">
                            <p>Terdaftar dan Diawasi Oleh:</p>
                            <a href="https://www.ojk.go.id" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('image/logo-ojk.jpg') }}" alt="OJK Logo"
                                    class="logo-img bg-white">
                            </a>
                        </div>
                        <div class="compliance-item">
                            <p>Terdaftar Sebagai Anggota:</p>
                            <a href="https://www.adpi.or.id" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('image/adpi.jpg') }}" alt="ADPI Logo" class="logo-img bg-white">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy;Dana Pensiun Bank Riau Kepri</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Loading Screen
        window.addEventListener("load", function() {
            const loader = document.getElementById("loader-wrapper");
            setTimeout(function() {
                loader.classList.add("loader-hide");
            }, 300);
        });

        // Mobile Menu
        const mobileBtn = document.querySelector(".mobile-menu-btn");
        const mobileNav = document.getElementById("mobileNav");
        mobileBtn.addEventListener("click", () => {
            mobileNav.classList.toggle("active");
        });

        // Header Scroll
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 50) header.classList.add('scrolled');
            else header.classList.remove('scrolled');
        });

        // Slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        function showSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            currentSlide = n;
            if (currentSlide >= slides.length) currentSlide = 0;
            if (currentSlide < 0) currentSlide = slides.length - 1;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        function changeSlide(n) {
            showSlide(n);
        }

        setInterval(() => {
            currentSlide++;
            showSlide(currentSlide);
        }, 5000);

        // Download Toast
        const toast = document.getElementById('toast');
        const formItems = document.querySelectorAll('.form-item');

        formItems.forEach(item => {
            item.addEventListener('click', function() {
                this.classList.add('downloading');
                toast.classList.add('show');
                const fileName = this.querySelector('.form-name').textContent;
                toast.querySelector('p').textContent = `${fileName} sedang diunduh...`;
                setTimeout(() => {
                    this.classList.remove('downloading');
                    toast.classList.remove('show');
                }, 3000);
            });
        });
    </script>

</body>

</html>
