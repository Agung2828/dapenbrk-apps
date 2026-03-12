<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Pengaduan - Dana Pensiun Bank Riau Kepri</title>
    <link rel="icon" type="image/png" href="{{ asset('image/Loadinglogo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* ============================
           RESET & BASE STYLES
        ============================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            color: #333;
            line-height: 1.6;
        }

        /* ============================
           LOADING SCREEN
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
            justify-content: center;
            align-items: center;
            transition: opacity 0.2s ease-out, visibility 0.2s ease-out;
        }

        #loader-wrapper.loader-hide {
            opacity: 0;
            visibility: hidden;
        }

        .pulsing-logo {
            width: 100px;
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
           CONTAINER & LAYOUT
        ============================ */
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ============================
           SECTION TITLE
        ============================ */
        .section-title {
            text-align: center;
            margin: 60px 0 40px;
            color: #2d3748;
            font-size: 2rem;
            font-weight: 700;
        }

        /* ============================
           PAGE HEADER
        ============================ */
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h3 {
            font-size: 2rem;
            color: #2d3748;
            margin-bottom: 15px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .page-header h3 i {
            color: #d46727;
        }

        .page-header p {
            color: #666;
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        /* ============================
   NAV KONTAK (SOFT BLUE)
   ============================ */
        .nav-kontak {
            background: rgba(186, 152, 2, 0.85);
            /* biru navy kalem */
            color: #fff !important;

            /* ukuran sama */
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
           LEGAL BOX
        ============================ */
        .legal-box {
            background: linear-gradient(135deg, #e8f5e9 0%, #f1f8f4 100%);
            border-left: 5px solid #43a047;
            padding: 25px 30px;
            border-radius: 12px;
            margin-bottom: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .legal-box h4 {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #2e7d32;
            font-size: 1.1rem;
        }

        .legal-box h4 i {
            font-size: 1.3rem;
        }

        .legal-box p {
            color: #2e7d32;
            line-height: 1.7;
        }

        /* ============================
           INFO CARD
        ============================ */
        .info-card {
            background: white;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid #e8e8e8;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #e4c61d 0%, #d46727 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            border-color: #d46727;
        }

        .info-card:hover::before {
            transform: scaleX(1);
        }

        .info-card h4 {
            color: #2d3748;
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .info-card>p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        /* Card Header */
        .card-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #e4c61d 0%, #ceb630 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: white;
            font-size: 2rem;
            box-shadow: 0 6px 20px rgba(228, 198, 29, 0.3);
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
        }

        /* Card Body Layout */
        .card-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .card-body-left {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card-body-left>p {
            color: #666;
            line-height: 1.8;
            font-size: 1.05rem;
        }

        .card-body-right {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #e4c61d;
        }

        .card-body-right h4 {
            margin-bottom: 15px;
            color: #2d3748;
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* Contact Item */
        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 18px 24px;
            background: linear-gradient(135deg, #fff9e6 0%, #fff5d6 100%);
            border-radius: 12px;
            border-left: 4px solid #d46727;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .contact-item i {
            color: #d46727;
            font-size: 1.5rem;
            width: 30px;
            text-align: center;
        }

        .contact-item strong {
            color: #333;
            font-weight: 700;
            margin-right: 5px;
        }

        .contact-item span {
            color: #555;
            font-size: 1.05rem;
        }

        .highlight {
            color: #d46727;
            font-weight: 700;
        }

        /* Detail List */
        .detail-list,
        .clean-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .detail-list li,
        .clean-list li {
            margin-bottom: 12px;
            padding-left: 30px;
            position: relative;
            color: #555;
            line-height: 1.7;
        }

        .detail-list li::before,
        .clean-list li::before {
            content: '\f058';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 2px;
            color: #43a047;
            font-size: 1.1rem;
        }

        /* ============================
           FEEDBACK SECTION
        ============================ */
        .feedback-section {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            border-radius: 20px;
            padding: 50px 40px;
            margin-top: 50px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .feedback-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .feedback-content h3 {
            font-size: 2rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .feedback-content>p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            opacity: 0.95;
            line-height: 1.8;
        }

        .feedback-details {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 12px;
            margin: 30px 0;
            text-align: left;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feedback-details strong {
            display: block;
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .download-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 35px;
            background: #e4c61d;
            color: #333;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        .download-btn:hover {
            background: #d4b51c;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
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

        @media (max-width: 768px) {
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

        /* ============================
           RESPONSIVE DESIGN
        ============================ */
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.6rem;
            }

            .page-header h3 {
                font-size: 1.5rem;
                flex-direction: column;
            }

            .card-body {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-title {
                font-size: 1.5rem;
            }

            .info-card {
                padding: 25px;
            }

            .feedback-section {
                padding: 35px 25px;
            }

            .feedback-content h3 {
                font-size: 1.6rem;
                flex-direction: column;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .nav-download,
            .nav-whatsapp {
                margin-left: 0;
                margin-top: 10px;
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .info-card {
                padding: 20px;
            }

            .card-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .contact-item {
                padding: 15px 18px;
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .download-btn {
                padding: 12px 25px;
                font-size: 1rem;
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
                <a href="{{ url('/kepesertaan') }}" class="nav-link active">Kepesertaan</a>
                <a href="{{ url('/warta') }}" class="nav-link">Warta</a>

                <!-- MENU KHUSUS -->
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
                <a href="{{ url('/kepesertaan') }}" class="nav-link active">Kepesertaan</a>
                <a href="{{ url('/warta') }}" class="nav-link">Warta</a>

                <!-- MENU KHUSUS -->
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

    <!-- Hero Slider -->
    <div id="home" class="page-content active">
        <div class="hero-slider">
            <div class="slide active" style="background-image: url('{{ asset('image/LAM Kepri.jpeg') }}');">
                <div class="slide-content">
                    <h1>Mekanisme Layanan<br>Pengaduan</h1>
                    <p>Setiap Peserta berhak mendapatkan layanan terbaik. Kami menerima pengaduan terkait
                        kerugian dan/atau potensi kerugian finansial yang diduga disebabkan oleh kesalahan
                        atau kelalaian pihak Dana Pensiun Bank Riau Kepri.</p>
                </div>
            </div>
        </div>

        <section class="quick-links">
            <div class="container">
                <!-- Page Header -->
                <div class="page-header">
                    <h3>
                        <i class="fas fa-headset"></i>
                        Layanan Pengaduan Peserta
                    </h3>
                    <p>
                        Anda dapat melakukan pengaduan apabila terjadi kerugian finansial yang diduga karena
                        kesalahan atau kelalaian Dana Pensiun Bank Riau Kepri.
                    </p>
                </div>

                <!-- Legal Box -->
                <div class="legal-box">
                    <h4><i class="fas fa-book-open"></i> Dasar Hukum & Referensi</h4>
                    <p>
                        Layanan ini mengacu pada: POJK No. 1/POJK.07/2013 (Perlindungan Konsumen),
                        POJK No. 18/POJK.07/2018 (Layanan Pengaduan), dan SEOJK No. 2/SEOJK.07/2014.
                    </p>
                </div>

                <!-- Referensi Card -->
                <div class="info-card">
                    <h4><i class="fas fa-file-alt"></i> 1. Referensi</h4>
                    <p>
                        Peraturan Otoritas Jasa Keuangan Nomor: 1/POJK.07/2013 tentang Perlindungan Konsumen Sektor
                        Jasa Keuangan, Peraturan Otoritas Jasa Keuangan Nomor: 18/POJK.07/2018 tentang Layanan
                        Pengaduan Konsumen Sektor Jasa Keuangan, dan Surat Edaran Otoritas Jasa Keuangan Nomor:
                        2/SEOJK.07/2014 tentang Pelayanan dan Penyelesaian Pengaduan Konsumen.
                    </p>
                </div>

                <!-- Ketentuan Umum Card -->
                <div class="info-card">
                    <h4><i class="fas fa-clipboard-list"></i> 2. Ketentuan Umum</h4>
                    <ul class="clean-list">
                        <li>Peserta dapat melakukan pengaduan atas kerugian dan/atau potensi kerugian finansial.</li>
                        <li>Pengaduan dapat disampaikan secara lisan atau tertulis ke Kantor Dana Pensiun Bank Riau
                            Kepri.</li>
                    </ul>
                </div>

                <!-- Section Title -->
                <div class="section-title">Layanan Pengaduan</div>

                <!-- Layanan Lisan Card -->
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <div class="card-title">Layanan Lisan</div>
                    </div>

                    <div class="card-body">
                        <!-- Left Column -->
                        <div class="card-body-left">
                            <p>Dapat disampaikan melalui telepon pada hari dan jam kerja.</p>

                            <div class="contact-item">
                                <i class="fas fa-headset"></i>
                                <span><strong>Telepon:</strong> <span class="highlight">0761-5781181</span></span>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="card-body-right">
                            <h4>Siapkan Data Diri:</h4>
                            <ul class="detail-list">
                                <li>Nama Lengkap</li>
                                <li>Alamat & No. Telepon</li>
                                <li>Deskripsi singkat pengaduan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Saran & Pendapat Section -->
                <div class="feedback-section">
                    <div class="feedback-content">
                        <h3>
                            <i class="fas fa-comment-dots"></i>
                            Saran & Pendapat
                        </h3>
                        <p>
                            Yth. Para Pensiunan, pendapat Anda sangat berarti bagi kami. Silakan sampaikan saran
                            Anda kepada kami.
                        </p>

                        <div class="feedback-details">
                            <strong>Departemen Kepesertaan</strong>
                            Dana Pensiun Bank Riau Kepri<br>
                            Jl. Arifin Ahmad No. 54-56, Pekanbaru<br>
                            Telp: (0761) 5781181 | Fax: (0761) 32720<br>
                            Email: dapenbankriau@gmail.com
                        </div>

                        <a href="pdf/F-K04-00 Saran dan Pendapat.pdf" class="download-btn">
                            <i class="fas fa-download"></i> Download Formulir Saran
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>Tentang Kami</h3>
                    <p style="color: #d1d5db; font-size: 0.95rem; line-height: 1.9;">
                        Dana Pensiun Bank Riau Kepri memberikan jaminan kesejahteraan di masa pensiun dengan pengelolaan
                        yang profesional dan transparan.
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


    <!-- JavaScript -->
    <script>
        // Loading Screen
        window.addEventListener("load", function() {
            const loader = document.getElementById("loader-wrapper");
            setTimeout(() => {
                loader.classList.add("loader-hide");
            }, 300);
        });

        // Mobile Menu Toggle
        const mobileBtn = document.querySelector(".mobile-menu-btn");
        const mobileNav = document.getElementById("mobileNav");

        if (mobileBtn && mobileNav) {
            mobileBtn.addEventListener("click", () => {
                mobileNav.classList.toggle("active");
            });
        }

        // Header Scroll Effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            if (header) {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
        });
    </script>
</body>

</html>
