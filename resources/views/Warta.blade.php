<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warta - Dana Pensiun Bank Riau Kepri</title>
    <link rel="icon" type="image/png" href="{{ asset('image/Loadinglogo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
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
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 0.2s ease-out, visibility 0.2s ease-out;
            overflow: hidden;
        }

        #loader-wrapper.loader-hide {
            opacity: 0;
            visibility: hidden;
        }

        .loading-ring,
        .loading-text,
        .progress-container,
        .loading-percentage,
        .particle {
            display: none !important;
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

        .nav-whatsapp {
            background: rgba(37, 211, 102, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 0.2px solid rgba(37, 211, 102, 0.3);
            color: #ffffff !important;
            padding: 10px 10px;
            border-radius: 10px;
            margin-left: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(37, 211, 102, 0.1);
            white-space: nowrap;
        }

        .nav-whatsapp:hover {
            background: rgba(37, 211, 102, 0.25);
            border-color: rgba(37, 211, 102, 0.5);
            color: #128C7E !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.2);
        }

        .nav-whatsapp i {
            font-size: 1.1rem;
            color: #25D366;
            transition: color 0.3s ease;
        }

        .nav-whatsapp:hover i {
            color: #128C7E;
        }

        /* ============================
           CATEGORY SECTION
        ============================ */
        .category-section {
            margin-bottom: 5rem;
        }

        .category-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2.5rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid #f0f0f0;
        }

        .category-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .category-header h2 {
            font-size: 2rem;
            color: #1a1a1a;
            font-weight: 700;
        }

        /* ============================
           IMAGE SLIDER (Apresiasi OJK)
        ============================ */
        .image-slider {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto 2rem;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .slider-wrapper {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 50%;
        }

        .slide-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
        }

        .slide-item.active {
            opacity: 1;
        }

        .slide-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #f5f5f5;
        }

        .slide-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            color: #333;
            transition: all 0.3s;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slide-arrow:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .slide-prev {
            left: 2rem;
        }

        .slide-next {
            right: 2rem;
        }

        .slide-dots {
            position: absolute;
            bottom: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.75rem;
            z-index: 10;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        .dot:hover {
            background: rgba(255, 255, 255, 0.8);
            transform: scale(1.2);
        }

        .dot.active {
            background: white;
            width: 35px;
            border-radius: 6px;
        }

        .slider-description {
            background: linear-gradient(135deg, #fef9c3 0%, #fef3c7 100%);
            padding: 1.5rem 2rem;
            border-radius: 12px;
            margin-top: 1.5rem;
            border-left: 4px solid #f59e0b;
        }

        .slider-description p {
            margin: 0;
            color: #78350f;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .slider-description i {
            color: #f59e0b;
            margin-right: 0.5rem;
        }

        /* ============================
           PDF CARDS GRID (Majalah ADPI)
        ============================ */
        .warta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .pdf-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .pdf-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(220, 38, 38, 0.2);
            border-color: #dc2626;
        }

        .pdf-preview {
            position: relative;
            height: 350px;
            background: #f8f9fa;
            overflow: hidden;
        }

        .pdf-preview iframe {
            width: 100%;
            height: 100%;
            border: none;
            pointer-events: none;
        }

        .pdf-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .pdf-card:hover .pdf-overlay {
            opacity: 1;
        }

        .pdf-overlay-content {
            text-align: center;
            color: white;
            transform: translateY(20px);
            transition: transform 0.3s;
        }

        .pdf-card:hover .pdf-overlay-content {
            transform: translateY(0);
        }

        .pdf-overlay-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .pdf-overlay-text {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .pdf-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
            z-index: 5;
        }

        .pdf-content {
            padding: 1.5rem;
        }

        .pdf-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .pdf-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .pdf-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }

        .pdf-date {
            color: #999;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pdf-action {
            color: #dc2626;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: gap 0.3s;
        }

        .pdf-card:hover .pdf-action {
            gap: 0.75rem;
        }

        /* ============================
           PDF MODAL
        ============================ */
        .pdf-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 10000;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .pdf-modal.active {
            display: flex;
        }

        .pdf-modal-content {
            width: 100%;
            max-width: 1200px;
            height: 90vh;
            background: white;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .pdf-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
        }

        .pdf-modal-title {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .pdf-modal-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .pdf-modal-btn {
            background: white;
            color: #dc2626;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .pdf-modal-btn:hover {
            background: #fef2f2;
            transform: translateY(-2px);
        }

        .pdf-modal-close {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            font-size: 1.2rem;
        }

        .pdf-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .pdf-modal-viewer {
            flex: 1;
            overflow: hidden;
        }

        .pdf-modal-viewer iframe {
            width: 100%;
            height: 100%;
            border: none;
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
           RESPONSIVE
        ============================ */
        @media (max-width: 768px) {
            .category-header h2 {
                font-size: 1.5rem;
            }

            .category-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }

            .warta-grid {
                grid-template-columns: 1fr;
            }

            .slide-arrow {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .slide-prev {
                left: 1rem;
            }

            .slide-next {
                right: 1rem;
            }

            .pdf-modal-content {
                height: 85vh;
            }

            .pdf-modal {
                padding: 1rem;
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
            <div class="logo-section">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo">
                </a>
            </div>

            <nav class="main-nav">
                <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
                <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
                <a href="{{ url('/kepesertaan') }}" class="nav-link">Kepesertaan</a>
                <a href="{{ url('/warta') }}" class="nav-link active">Warta</a>

                <!-- MENU KHUSUS -->
                <a href="{{ route('formulir') }}" class="nav-link nav-download">
                    <i class="fas fa-download"></i> Unduh Formulir
                </a>
                <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak">
                    <i class="fas fa-phone-alt"></i> Bantuan/Kontak
                </a>
        </div>>

        <div class="mobile-nav" id="mobileNav">
            <a href="{{ url('/') }}" class="nav-link">Beranda</a>
            <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
            <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
            <a href="{{ url('/kepesertaan') }}" class="nav-link">Kepesertaan</a>
            <a href="{{ url('/warta') }}" class="nav-link active">Warta</a>

            <!-- MENU KHUSUS -->
            <a href="{{ route('formulir') }}" class="nav-link nav-download">
                <i class="fas fa-download"></i> Unduh Formulir
            </a>
            <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak">
                <i class="fas fa-phone-alt"></i> Bantuan/Kontak
            </a>
        </div>>

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
                    <h1>Warta Dana Pensiun<br>Bank Riau Kepri</h1>
                    <p>Informasi terkini seputar apresiasi, majalah, dan berita Dana Pensiun Bank Riau Kepri</p>
                </div>
            </div>

            <div class="slide" style="background-image: url('{{ asset('image/MTQ.jpg') }}');">
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

        <!-- Main Content -->
        <section class="quick-links">
            <div class="container">
                <!-- Apresiasi OJK 2023 -->
                <section class="category-section">
                    <div class="category-header">
                        <div class="category-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h2>Apresiasi OJK 2023</h2>
                    </div>

                    <div class="image-slider">
                        <div class="slider-wrapper">
                            <div class="slide-item active">
                                <img src="{{ asset('image/apresiasi-jan-2023.jpg') }}" alt="Apresiasi Januari 2023">
                            </div>
                            <div class="slide-item">
                                <img src="{{ asset('image/apresiasi-agu-2023.jpg') }}" alt="Apresiasi Agustus 2023">
                            </div>
                            <div class="slide-item">
                                <img src="{{ asset('image/apresiasi-des-2023.jpg') }}" alt="Apresiasi Desember 2023">
                            </div>
                            <div class="slide-item">
                                <img src="{{ asset('image/apresiasi-okt-2023.jpg') }}" alt="Apresiasi Oktober 2023">
                            </div>
                            <div class="slide-item">
                                <img src="{{ asset('image/apresiasi-nov-2023.jpg') }}" alt="Apresiasi November 2023">
                            </div>
                        </div>

                        <button class="slide-arrow slide-prev" onclick="moveSlide(-1)">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="slide-arrow slide-next" onclick="moveSlide(1)">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <div class="slide-dots">
                            <span class="dot active" onclick="currentSlide(0)"></span>
                            <span class="dot" onclick="currentSlide(1)"></span>
                            <span class="dot" onclick="currentSlide(2)"></span>
                            <span class="dot" onclick="currentSlide(3)"></span>
                            <span class="dot" onclick="currentSlide(4)"></span>
                        </div>
                    </div>

                    <div class="slider-description">
                        <p><i class="fas fa-info-circle"></i> Dana Pensiun dengan Penyampaian Laporan Keuangan
                            Bulanan Tercepat dan Lengkap</p>
                    </div>
                </section>

                <!-- Majalah Info ADPI -->
                <section class="category-section">
                    <div class="category-header">
                        <div class="category-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h2>Majalah Info ADPI</h2>
                    </div>

                    <div class="warta-grid">
                        @foreach ($wartas as $warta)
                            <div class="pdf-card"
                                onclick="openPDF('{{ asset('storage/' . $warta->file_pdf) }}', '{{ $warta->judul }}')">

                                <div class="pdf-preview">
                                    <iframe
                                        src="{{ asset('storage/' . $warta->file_pdf) }}#page=1&view=FitH&toolbar=0&navpanes=0"
                                        scrolling="no">
                                    </iframe>

                                    <div class="pdf-overlay">
                                        <div class="pdf-overlay-content">
                                            <div class="pdf-overlay-icon">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <div class="pdf-overlay-text">
                                                Klik untuk Lihat & Download
                                            </div>
                                        </div>
                                    </div>

                                    <span class="pdf-badge">
                                        {{ $warta->kategori }} {{ $warta->tanggal }}
                                    </span>
                                </div>

                                <div class="pdf-content">
                                    <h3 class="pdf-title">{{ $warta->judul }}</h3>
                                    <p class="pdf-description">{{ $warta->deskripsi }}</p>

                                    <div class="pdf-meta">
                                        <span class="pdf-date">
                                            <i class="far fa-calendar"></i>
                                            {{ $warta->tanggal }}
                                        </span>
                                        <span class="pdf-action">
                                            Lihat PDF <i class="fas fa-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </section>
    </div>

    <!-- PDF Modal -->
    <div class="pdf-modal" id="pdfModal">
        <div class="pdf-modal-content">
            <div class="pdf-modal-header">
                <div class="pdf-modal-title" id="pdfTitle">Dokumen PDF</div>
                <div class="pdf-modal-actions">
                    <button class="pdf-modal-btn" onclick="downloadPDF()">
                        <i class="fas fa-download"></i>
                        Download
                    </button>
                    <button class="pdf-modal-close" onclick="closePDF()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="pdf-modal-viewer">
                <iframe id="pdfViewer" src=""></iframe>
            </div>
        </div>
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

        // Hero Slider
        let currentHeroSlide = 0;
        const heroSlides = document.querySelectorAll('.hero-slider .slide');
        const heroDots = document.querySelectorAll('.hero-slider .dot');

        function showSlide(n) {
            heroSlides.forEach(slide => slide.classList.remove('active'));
            heroDots.forEach(dot => dot.classList.remove('active'));

            currentHeroSlide = n;
            if (currentHeroSlide >= heroSlides.length) currentHeroSlide = 0;
            if (currentHeroSlide < 0) currentHeroSlide = heroSlides.length - 1;

            heroSlides[currentHeroSlide].classList.add('active');
            heroDots[currentHeroSlide].classList.add('active');
        }

        function changeSlide(n) {
            showSlide(n);
        }

        setInterval(() => {
            currentHeroSlide++;
            showSlide(currentHeroSlide);
        }, 5000);

        // Image Slider (Apresiasi)
        let currentIndex = 0;
        const slides = document.querySelectorAll('.slide-item');
        const dots = document.querySelectorAll('.image-slider .dot');
        let autoSlideInterval;

        function showImageSlide(index) {
            if (index >= slides.length) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = slides.length - 1;
            } else {
                currentIndex = index;
            }

            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === currentIndex);
            });

            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === currentIndex);
            });
        }

        function moveSlide(direction) {
            showImageSlide(currentIndex + direction);
            resetAutoSlide();
        }

        function currentSlide(index) {
            showImageSlide(index);
            resetAutoSlide();
        }

        function autoSlide() {
            currentIndex++;
            showImageSlide(currentIndex);
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(autoSlide, 4000);
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        startAutoSlide();

        const sliderElement = document.querySelector('.image-slider');
        if (sliderElement) {
            sliderElement.addEventListener('mouseenter', () => {
                clearInterval(autoSlideInterval);
            });

            sliderElement.addEventListener('mouseleave', () => {
                startAutoSlide();
            });
        }

        // PDF Modal Functions
        let currentPDFUrl = '';

        function openPDF(url, title) {
            currentPDFUrl = url;
            document.getElementById('pdfTitle').textContent = title;
            document.getElementById('pdfViewer').src = url;
            document.getElementById('pdfModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePDF() {
            document.getElementById('pdfModal').classList.remove('active');
            document.getElementById('pdfViewer').src = '';
            document.body.style.overflow = 'auto';
        }

        function downloadPDF() {
            const link = document.createElement('a');
            link.href = currentPDFUrl;
            link.download = document.getElementById('pdfTitle').textContent + '.pdf';
            link.click();
        }

        // Close modal on outside click
        document.getElementById('pdfModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePDF();
            }
        });
    </script>
</body>

</html>
