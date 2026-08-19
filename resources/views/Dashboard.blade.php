<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Beranda - Dana Pensiun Bank Riau Kepri</title>

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="{{ asset('image/logodapenbrk.png') }}">

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

        .logo-section .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-secondary {
            height: 45px;
            width: auto;
            object-fit: contain;
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

        /* ============================
           BACKSOUND TOGGLE BUTTON
        ============================ */
        .backsound-toggle {
            position: fixed;
            bottom: 30px;
            left: 30px;
            z-index: 9999;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.3rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .backsound-toggle:hover {
            transform: scale(1.1);
            background: rgba(0, 0, 0, 0.85);
        }

        /* ============================
           NAV BUTTONS
        ============================ */
        .nav-pengaduan {
            background: rgba(176, 64, 64, 0.85);
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
            box-shadow: 0 2px 8px rgba(176, 64, 64, 0.25);
            border: 2px solid transparent;
        }

        .nav-pengaduan:hover {
            background: #ffffff;
            color: #b04040 !important;
            border-color: #b04040;
            transform: translateY(-2px);
        }

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

        /* ============================
           HERO SLIDER
        ============================ */
        .hero-slider {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            margin-top: 0;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .slide::before {
            display: none;
        }

        .slide.active {
            opacity: 1;
            z-index: 2;
        }

        .slide-content {
            position: relative;
            z-index: 3;
            max-width: 1000px;
            padding: 0 2rem;
            color: white;
            text-align: center;
            animation: slideInUp 1s ease-out;
            margin-bottom: 220px;
        }

        .slide-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.5);
        }

        .slide-content p {
            font-size: 1.25rem;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto 2rem;
            text-shadow: 1px 2px 4px rgba(0, 0, 0, 0.5);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ============================
           QUICK LINKS
        ============================ */
        .quick-links-slider {
            position: absolute;
            bottom: 70px;
            left: 0;
            right: 0;
            z-index: 10;
            display: flex;
            justify-content: center;
            padding: 0 20px;
            animation: slideInUp 1s ease-out 0.3s both;
        }

        .quick-links-grid-slider {
            display: flex;
            justify-content: center;
            gap: 1.2rem;
            width: fit-content;
            max-width: 1100px;
        }

        .quick-link-item-slider {
            width: 210px;
            max-width: 100%;
            background: rgba(50, 55, 65, 0.78);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 1.8rem 1.2rem 1.6rem;
            border-radius: 14px;
            text-align: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.10);
            box-shadow: 0 6px 28px rgba(0, 0, 0, 0.45);
            transition:
                transform 0.35s cubic-bezier(.2, .8, .2, 1),
                background 0.35s ease,
                box-shadow 0.35s ease,
                border-color 0.35s ease;
        }

        .quick-link-item-slider::after {
            content: '';
            position: absolute;
            top: -80%;
            left: -65%;
            width: 50%;
            height: 260%;
            background: linear-gradient(118deg,
                    transparent 0%,
                    rgba(255, 255, 255, 0.07) 50%,
                    transparent 100%);
            transform: skewX(-18deg);
            transition: left 0.6s ease;
            pointer-events: none;
        }

        .quick-link-item-slider:hover {
            transform: translateY(-10px) scale(1.04);
            background: rgba(65, 72, 85, 0.92);
            border-color: rgba(255, 255, 255, 0.22);
            box-shadow: 0 18px 48px rgba(0, 0, 0, 0.55);
        }

        .quick-link-item-slider:hover::after {
            left: 130%;
        }

        .quick-link-item-slider .ql-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            transition: background 0.35s ease, border-color 0.35s ease, transform 0.35s ease;
        }

        .quick-link-item-slider:hover .ql-icon {
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.35);
            transform: scale(1.1) rotate(5deg);
        }

        .quick-link-item-slider .ql-icon i {
            font-size: 1.65rem;
            color: #ffffff;
            display: block;
            position: relative;
            z-index: 1;
        }

        .quick-link-item-slider .ql-label {
            color: #e8edf5;
            font-size: 0.87rem;
            font-weight: 600;
            display: block;
            line-height: 1.45;
            letter-spacing: 0.2px;
            text-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 1;
        }

        .quick-link-item-slider .ql-line {
            display: block;
            width: 24px;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
            margin: 0.55rem auto 0;
            border-radius: 2px;
            transition: width 0.35s ease, background 0.35s ease;
            position: relative;
            z-index: 1;
        }

        .quick-link-item-slider:hover .ql-line {
            width: 44px;
            background: rgba(255, 255, 255, 0.6);
        }

        /* ============================
           SLIDER NAVIGATION
        ============================ */
        .slider-dots {
            position: absolute;
            bottom: 280px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            gap: 12px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot:hover {
            background: rgba(255, 255, 255, 0.8);
            transform: scale(1.2);
        }

        .dot.active {
            background: white;
            width: 40px;
            border-radius: 6px;
        }

        .slider-arrow {
            position: absolute;
            top: 45%;
            transform: translateY(-50%);
            z-index: 10;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .slider-arrow:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-50%) scale(1.1);
        }

        .slider-arrow.prev {
            left: 40px;
        }

        .slider-arrow.next {
            right: 40px;
        }

        .hero-curved-bottom {
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 100px;
            z-index: 5;
            overflow: hidden;
        }

        .hero-curved-bottom svg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            display: block;
        }

        /* ============================
           SCROLL ANIMATIONS
        ============================ */
        .scroll-animate {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .scroll-animate.animated {
            opacity: 1;
            transform: translateY(0);
        }

        .news-card {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .news-card.animated {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .news-card:nth-child(1) {
            transition-delay: 0.1s;
        }

        .news-card:nth-child(2) {
            transition-delay: 0.2s;
        }

        .news-card:nth-child(3) {
            transition-delay: 0.3s;
        }

        .news-card:nth-child(4) {
            transition-delay: 0.4s;
        }

        .news-card:nth-child(5) {
            transition-delay: 0.5s;
        }

        .news-card:nth-child(6) {
            transition-delay: 0.6s;
        }

        .feature-item {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-item.animated {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .feature-item:nth-child(1) {
            transition-delay: 0.1s;
        }

        .feature-item:nth-child(2) {
            transition-delay: 0.2s;
        }

        .feature-item:nth-child(3) {
            transition-delay: 0.3s;
        }

        .feature-item:nth-child(4) {
            transition-delay: 0.4s;
        }

        .feature-item:nth-child(5) {
            transition-delay: 0.5s;
        }

        .feature-item:nth-child(6) {
            transition-delay: 0.6s;
        }

        .news-image1 {
            width: 100%;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f2f2f2;
            overflow: hidden;
            position: relative;
            border-radius: 16px 16px 0 0;
        }

        .news-image1 img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        /* ============================
           RESPONSIVE
        ============================ */
        @media (max-width: 1200px) {

            .nav-download,
            .nav-whatsapp {
                padding: 8px 12px;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 991px) {

            .main-nav .nav-download,
            .main-nav .nav-whatsapp,
            .main-nav .nav-kontak {
                display: none;
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

            .slide-content {
                margin-bottom: 500px;
                padding: 0 1.5rem;
            }

            .slide-content h1 {
                font-size: 2rem;
            }

            .slide-content p {
                font-size: 1rem;
            }

            .quick-links-slider {
                bottom: 20px;
            }

            .quick-links-grid-slider {
                flex-direction: column;
                gap: 0.8rem;
                max-width: 100%;
                padding: 0 1rem;
            }

            .quick-link-item-slider {
                width: 100%;
                padding: 1.2rem 1rem;
            }

            .quick-link-item-slider .ql-icon {
                width: 48px;
                height: 48px;
                margin-bottom: 0.75rem;
            }

            .quick-link-item-slider .ql-icon i {
                font-size: 1.35rem;
            }

            .quick-link-item-slider .ql-label {
                font-size: 0.88rem;
            }

            .slider-dots {
                bottom: 550px;
            }

            .slider-arrow {
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
            }

            .slider-arrow.prev {
                left: 15px;
            }

            .slider-arrow.next {
                right: 15px;
            }
        }

        @media (max-width: 480px) {
            .slide-content h1 {
                font-size: 1.6rem;
            }

            .slide-content p {
                font-size: 0.9rem;
            }

            .slide-content {
                margin-bottom: 530px;
            }

            .slider-dots {
                bottom: 580px;
            }

            .quick-links-slider {
                bottom: 15px;
            }

            .quick-link-item-slider {
                padding: 1rem 0.8rem;
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

    <!-- BACKSOUND -->
    <audio id="backsound"></audio>
    <button id="toggleSound" class="backsound-toggle" aria-label="Toggle Backsound">
        <i class="fas fa-volume-mute"></i>
    </button>

    <!-- LOADING SCREEN -->
    <div id="loader-wrapper">
        <div class="logo-container">
            <img src="{{ asset('image/logodapenbrk.png') }}" alt="Logo Dana Pensiun" class="pulsing-logo">
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
                    <img src="{{ asset('image/logodanapensiun.png') }}" alt="Logo Dana Pensiun" class="logo-secondary">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo">
                </a>
            </div>

            <nav class="main-nav">
                <a href="{{ url('/') }}" class="nav-link active">Beranda</a>
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

            <div class="mobile-nav" id="mobileNav">
                <a href="{{ url('/') }}" class="nav-link active">Beranda</a>
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

            <div class="header-actions">
                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Home Page -->
    <div id="home" class="page-content active">
        <div class="hero-slider">

            @forelse ($sliders as $i => $slider)
                <div class="slide {{ $i == 0 ? 'active' : '' }}"
                    style="background-image: url('{{ asset('storage/' . $slider->image) }}');">
                    <div class="slide-content">
                        <h1>{!! nl2br(e($slider->title)) !!}</h1>
                        <p>{{ $slider->description }}</p>
                    </div>
                </div>
            @empty
                <div class="slide active" style="background:#000;">
                    <div class="slide-content">
                        <h1>Slider belum diisi</h1>
                        <p>Silakan tambah slider dari admin.</p>
                    </div>
                </div>
            @endforelse

            <!-- Quick Links -->
            <div class="quick-links-slider">
                <div class="quick-links-grid-slider">

                    <div class="quick-link-item-slider" onclick="window.location.href='{{ route('Pengaduan') }}'">
                        <div class="ql-icon"><i class="fas fa-headset"></i></div>
                        <span class="ql-label">Bantuan / Kontak Kami</span>
                        <span class="ql-line"></span>
                    </div>

                    <div class="quick-link-item-slider" onclick="window.location.href='{{ route('simulasi') }}'">
                        <div class="ql-icon"><i class="fas fa-calculator"></i></div>
                        <span class="ql-label">Simulasi Manfaat Pensiun</span>
                        <span class="ql-line"></span>
                    </div>

                    <div class="quick-link-item-slider" onclick="window.location.href='{{ url('/peraturan') }}'">
                        <div class="ql-icon"><i class="fas fa-file-invoice"></i></div>
                        <span class="ql-label">Peraturan</span>
                        <span class="ql-line"></span>
                    </div>

                    <div class="quick-link-item-slider"
                        onclick="window.location.href='{{ url('/kepesertaan') }}#pengkinian-data'">
                        <div class="ql-icon"><i class="fas fa-user-edit"></i></div>
                        <span class="ql-label">Pengkinian Data</span>
                        <span class="ql-line"></span>
                    </div>

                </div>
            </div>

            <!-- Navigation Arrows -->
            <button class="slider-arrow prev" onclick="prevSlide()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-arrow next" onclick="nextSlide()">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Dots Navigation -->
            <div class="slider-dots">
                @foreach ($sliders as $i => $slider)
                    <span class="dot {{ $i == 0 ? 'active' : '' }}"
                        onclick="changeSlide({{ $i }})"></span>
                @endforeach
            </div>

            <!-- Curved Bottom -->
            <div class="hero-curved-bottom">
                <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="none">
                    <path d="M0,50 Q360,100 720,50 T1440,50 L1440,100 L0,100 Z" fill="white" />
                </svg>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- News Section -->
            <section class="news-section" id="news-preview">
                <h2 class="section-title scroll-animate">Berita & Informasi Terkini</h2>
                <p class="section-subtitle scroll-animate" style="transition-delay: 0.1s;">
                    Update terbaru seputar Dana Pensiun Bank Riau Kepri
                </p>

                {{-- ── TABS: hanya tampil jika kategori ada datanya ── --}}
                @php
                    $urutanTab = ['penghargaan', 'pengumuman', 'kegiatan'];
                    $labelTab = [
                        'penghargaan' => 'Penghargaan',
                        'pengumuman' => 'Pengumuman',
                        'kegiatan' => 'Kegiatan',
                    ];

                    $defaultTab = null;
                    foreach ($urutanTab as $k) {
                        if (in_array($k, $kategoriTersedia)) {
                            $defaultTab = $k;
                            break;
                        }
                    }
                @endphp

                @if ($defaultTab)
                    <div class="news-tabs">
                        @foreach ($urutanTab as $k)
                            @if (in_array($k, $kategoriTersedia))
                                <button class="news-tab {{ $k === $defaultTab ? 'active' : '' }}"
                                    data-filter="{{ $k }}">
                                    {{ $labelTab[$k] }}
                                </button>
                            @endif
                        @endforeach
                    </div>
                @endif

                <div class="news-grid">
                    @forelse ($semuaBerita as $item)
                        <div class="news-card tab-{{ strtolower($item->kategori) }}" style="cursor:pointer;"
                            onclick="window.location.href='{{ route('berita.detail', $item->id) }}'">
                            <div class="news-image1">
                                @php
                                    $fotoName = $item->foto ? basename(str_replace('\\', '/', $item->foto)) : null;
                                @endphp
                                @if ($fotoName)
                                    <img src="{{ asset('uploads/berita/' . rawurlencode($fotoName)) }}"
                                        alt="Foto Berita">
                                @else
                                    <img src="{{ asset('image/default.jpg') }}" alt="Foto Default">
                                @endif
                                <div class="news-date-badge">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </div>
                            </div>
                            <div class="news-content">
                                <div class="news-category">{{ strtoupper($item->kategori) }}</div>
                                <h3 class="news-title">{{ $item->judul }}</h3>
                                <p class="news-excerpt">
                                    {{ \Illuminate\Support\Str::limit($item->deskripsi, 150) }}
                                </p>
                                <a href="{{ route('berita.detail', $item->id) }}" class="read-more"
                                    onclick="event.stopPropagation();">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p style="padding:1rem; color:#666;">Belum ada berita yang ditambahkan.</p>
                    @endforelse
                </div>
            </section>

            <!-- Why Choose Section -->
            <section class="why-choose">
                <div class="container">
                    <h2 class="section-title scroll-animate" style="text-align: center;">
                        Mengapa Memilih Dana Pensiun Bank Riau Kepri
                    </h2>
                    <p class="section-subtitle scroll-animate" style="text-align: center; transition-delay: 0.1s;">
                        Melayani lebih dari 25 tahun, Dana Pensiun Bank Riau Kepri senantiasa memberikan kemudahan dan
                        kecepatan dalam merespon berbagai kebutuhan peserta dengan didukung oleh layanan yang prima
                    </p>

                    <div class="features-grid">
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                            <h3 class="feature-title">Terpercaya & Aman</h3>
                            <p class="feature-desc">Diawasi OJK dengan sistem keamanan berlapis untuk melindungi dana
                                Anda</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-network-wired"></i></div>
                            <h3 class="feature-title">Pengelolaan Profesional</h3>
                            <p class="feature-desc">Tim ahli yang kompeten dan berpengalaman dalam mengelola dana
                                pensiun</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-users"></i></div>
                            <h3 class="feature-title">Layanan Prima</h3>
                            <p class="feature-desc">Pelayanan terbaik untuk memenuhi kebutuhan peserta dengan responsif
                            </p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                            <h3 class="feature-title">Investasi Optimal</h3>
                            <p class="feature-desc">Pengelolaan investasi yang optimal untuk hasil maksimal dan
                                berkelanjutan</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-balance-scale"></i></div>
                            <h3 class="feature-title">Tata Kelola Baik</h3>
                            <p class="feature-desc">Menerapkan prinsip tata kelola yang baik dan transparan</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-lightbulb"></i></div>
                            <h3 class="feature-title">Terus Berinovasi</h3>
                            <p class="feature-desc">Mengembangkan produk sesuai perkembangan untuk memenuhi kebutuhan
                                peserta</p>
                        </div>
                    </div>
                </div>
            </section>
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
        // Default tab dari server (PHP)
        const defaultFilter = '{{ $defaultTab }}';

        // Loading Screen
        window.addEventListener("load", function() {
            setTimeout(() => document.getElementById("loader-wrapper").classList.add("loader-hide"), 300);
        });

        // Mobile Menu
        document.querySelector(".mobile-menu-btn").addEventListener("click", () => {
            document.getElementById("mobileNav").classList.toggle("active");
        });

        // Header Scroll
        window.addEventListener('scroll', function() {
            document.getElementById('mainHeader').classList.toggle('scrolled', window.scrollY > 50);
        });

        // Slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        function showSlide(n) {
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            if (dots[currentSlide]) dots[currentSlide].classList.add('active');
        }

        function changeSlide(n) {
            showSlide(n);
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }
        setInterval(() => showSlide(currentSlide + 1), 5000);

        // Scroll Animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('animated');
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.news-card').forEach(card => {
                if (defaultFilter && !card.classList.contains('tab-' + defaultFilter)) {
                    card.classList.add('hidden');
                }
            });

            document.querySelectorAll('.scroll-animate, .news-card, .feature-item')
                .forEach(el => observer.observe(el));
        });

        // News Filter
        document.querySelectorAll(".news-tabs").forEach(section => {
            section.querySelectorAll(".news-tab").forEach(tab => {
                tab.addEventListener("click", () => {
                    section.querySelectorAll(".news-tab").forEach(t => t.classList.remove(
                        "active"));
                    tab.classList.add("active");
                    const filter = tab.dataset.filter;
                    document.querySelectorAll(".news-card").forEach(card => {
                        if (card.classList.contains("tab-" + filter)) {
                            card.classList.remove("hidden");
                        } else {
                            card.classList.add("hidden");
                        }
                    });
                });
            });
        });
    </script>

    <!-- BACKSOUND PLAYLIST -->
    <script>
        window.backsoundPlaylist = [
            "{{ asset('image/jingle1.mp3') }}",
            "{{ asset('image/jingle2.mp3') }}",
            "{{ asset('image/jingle3.mp3') }}"
        ];
    </script>
    <script src="{{ asset('js/backsound.js') }}"></script>

</body>

</html>
