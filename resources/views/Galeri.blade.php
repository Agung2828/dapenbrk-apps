<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - Dana Pensiun Bank Riau Kepri</title>
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

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Gallery Wrapper */
        .gallery-wrapper {
            padding: 5rem 0;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 50px 50px 0 0;
            margin-top: -40px;
            position: relative;
            z-index: 2;
        }

        /* ============ GALLERY INTRO SECTION ============ */
        .gallery-intro-section {
            text-align: center;
            max-width: 900px;
            margin: 0 auto 4rem;
            padding: 0 2rem;
        }

        .gallery-intro-title {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 800;
            background: linear-gradient(135deg, #1e3a5f 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gallery-intro-description {
            font-size: 1.15rem;
            color: #64748b;
            line-height: 1.8;
            margin-bottom: 2rem;
            animation: fadeIn 1.2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .gallery-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
            animation: fadeInUp 1.4s ease;
        }

        .gallery-stat-item {
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .gallery-stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(251, 191, 36, 0.2);
        }

        .gallery-stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .gallery-stat-label {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 600;
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

        /* Gallery Section */
        .gallery-section {
            background: #ffffff;
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 3rem;
            margin-bottom: 4rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(251, 191, 36, 0.15);
        }

        .gallery-title {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 700;
            margin-bottom: 2.5rem;
            background: linear-gradient(135deg, #fbbf24 0%, #ef4444 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            padding-bottom: 1rem;
        }

        .gallery-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #fbbf24, #ef4444);
            border-radius: 2px;
        }

        /* ============ CURVED 3D CAROUSEL ============ */
        .gallery-carousel-wrapper {
            position: relative;
            overflow: visible;
            padding: 3rem 0;
            margin: 0 auto;
        }

        .gallery-carousel-container {
            position: relative;
            height: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1500px;
            overflow: visible;
        }

        .gallery-carousel-track {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
        }

        .gallery-carousel-item {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 400px;
            height: 320px;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.25);
            transform-origin: center center;
        }

        .gallery-carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-carousel-item:hover img {
            transform: scale(1.05);
        }

        .gallery-carousel-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.2) 0%, rgba(239, 68, 68, 0.2) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .gallery-carousel-item:hover::before {
            opacity: 1;
        }

        .gallery-carousel-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, transparent 100%);
            transform: translateY(100%);
            transition: transform 0.4s ease;
            z-index: 2;
        }

        .gallery-carousel-item:hover .gallery-carousel-overlay {
            transform: translateY(0);
        }

        .gallery-carousel-overlay-text {
            color: white;
            font-size: 1rem;
            font-weight: 600;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        /* Carousel Controls */
        .carousel-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .carousel-btn {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            border: none;
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);
        }

        .carousel-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(249, 115, 22, 0.6);
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
        }

        .carousel-btn:active {
            transform: scale(0.95);
        }

        .carousel-dots {
            display: flex;
            gap: 0.75rem;
        }

        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #cbd5e1;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-dot.active {
            background: linear-gradient(135deg, #fbbf24 0%, #ef4444 100%);
            width: 40px;
            border-radius: 10px;
        }

        .carousel-dot:hover {
            background: #94a3b8;
        }

        /* Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox-content {
            max-width: 90vw;
            max-height: 90vh;
            position: relative;
            animation: zoomInLightbox 0.3s ease;
        }

        @keyframes zoomInLightbox {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .lightbox-content img {
            max-width: 100%;
            max-height: 90vh;
            border-radius: 15px;
            box-shadow: 0 25px 100px rgba(0, 0, 0, 0.8);
        }

        .lightbox-close {
            position: absolute;
            top: -50px;
            right: 0;
            background: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.5rem;
            color: #1e293b;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lightbox-close:hover {
            background: #fbbf24;
            color: white;
            transform: rotate(90deg);
        }

        /* Scroll Animate */
        .scroll-animate {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .scroll-animate.animated {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 991px) {

            .main-nav .nav-download,
            .main-nav .nav-kontak {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .gallery-intro-title {
                font-size: 2rem;
            }

            .gallery-intro-description {
                font-size: 1rem;
            }

            .gallery-stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .gallery-stat-number {
                font-size: 2rem;
            }

            .gallery-section {
                padding: 2rem 1.5rem;
                margin-bottom: 2.5rem;
            }

            .gallery-carousel-item {
                width: 300px;
                height: 240px;
            }

            .gallery-carousel-container {
                height: 350px;
            }

            .carousel-btn {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }

            .container {
                padding: 0 1rem;
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

    <!-- ===================== HEADER ===================== -->
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
                <a href="{{ route('Galeri') }}" class="nav-link active">Galeri</a>
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
                <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
                <a href="{{ route('Galeri') }}" class="nav-link active">Galeri</a>
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
    <!-- ===================== END HEADER ===================== -->


    <!-- ===================== HERO SLIDER ===================== -->
    <div class="hero-slider">
        <div class="slide active" style="background-image: url('{{ asset('image/MTQ.jpg') }}');">
            <div class="slide-content">
                <h1>Jaminan Masa Depan<br>Yang Cerah</h1>
                <p>Dana Pensiun Bank Riau Kepri memberikan perlindungan finansial untuk hari tua Anda dengan
                    pengelolaan profesional dan transparan.</p>
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
    <!-- ===================== END HERO SLIDER ===================== -->


    <!-- ===================== GALLERY CONTENT ===================== -->
    <div class="gallery-wrapper">
        <div class="container">

            <!-- Intro Section -->
            <div class="gallery-intro-section">
                <h2 class="gallery-intro-title">
                    Galeri<br>Dana Pensiun Bank Riau Kepri
                </h2>
                <p class="gallery-intro-description">
                    Kumpulan dokumentasi kegiatan, acara, dan momen penting Dana Pensiun Bank Riau Kepri
                    dalam melayani peserta dan membangun masa depan yang lebih baik bersama.
                </p>
                <div class="gallery-stats-grid">
                    <div class="gallery-stat-item">
                        <div class="gallery-stat-number">{{ $galleries->count() }}+</div>
                        <div class="gallery-stat-label">Album Galeri</div>
                    </div>
                    <div class="gallery-stat-item">
                        <div class="gallery-stat-number">
                            {{ $galleries->sum(function ($g) {return $g->items->count();}) }}+
                        </div>
                        <div class="gallery-stat-label">Total Foto</div>
                    </div>
                    <div class="gallery-stat-item">
                        <div class="gallery-stat-number">{{ date('Y') }}</div>
                        <div class="gallery-stat-label">Tahun Ini</div>
                    </div>
                </div>
            </div>

            <!-- Gallery Sections Loop -->
            @foreach ($galleries as $galleryIndex => $gallery)
                <div class="gallery-section scroll-animate" style="animation-delay: {{ $galleryIndex * 0.1 }}s">
                    <h2 class="gallery-title">{{ $gallery->judul }}</h2>

                    <div class="gallery-carousel-wrapper">
                        <div class="gallery-carousel-container">
                            <div class="gallery-carousel-track" id="carousel-track-{{ $gallery->id }}">
                                @foreach ($gallery->items as $itemIndex => $item)
                                    <div class="gallery-carousel-item" data-index="{{ $itemIndex }}"
                                        onclick="openLightbox('{{ asset('storage/' . $item->image) }}', '{{ $item->caption ?? 'Gallery Image' }}')">
                                        <img src="{{ asset('storage/' . $item->image) }}"
                                            alt="{{ $item->caption ?? 'Gallery Image' }}">
                                        <div class="gallery-carousel-overlay">
                                            <p class="gallery-carousel-overlay-text">
                                                {{ $item->caption ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @if ($gallery->items->count() > 1)
                            <div class="carousel-controls">
                                <button class="carousel-btn" onclick="moveCarousel({{ $gallery->id }}, -1)">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <div class="carousel-dots" id="carousel-dots-{{ $gallery->id }}">
                                    @foreach ($gallery->items as $dotIndex => $item)
                                        <button class="carousel-dot {{ $dotIndex === 0 ? 'active' : '' }}"
                                            onclick="goToCarouselSlide({{ $gallery->id }}, {{ $dotIndex }})">
                                        </button>
                                    @endforeach
                                </div>
                                <button class="carousel-btn" onclick="moveCarousel({{ $gallery->id }}, 1)">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- ===================== END GALLERY CONTENT ===================== -->


    <!-- ===================== LIGHTBOX ===================== -->
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <div class="lightbox-content" onclick="event.stopPropagation()">
            <button class="lightbox-close" onclick="closeLightbox()">
                <i class="fas fa-times"></i>
            </button>
            <img id="lightbox-img" src="" alt="Preview">
        </div>
    </div>
    <!-- ===================== END LIGHTBOX ===================== -->


    <!-- ===================== FOOTER ===================== -->
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
    <!-- ===================== END FOOTER ===================== -->


    <!-- ===================== SCRIPTS ===================== -->
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
        if (mobileBtn) {
            mobileBtn.addEventListener("click", () => {
                mobileNav.classList.toggle("active");
            });
        }

        // Header Scroll Effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 50) header.classList.add('scrolled');
            else header.classList.remove('scrolled');
        });

        // Scroll Animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('animated');
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        });

        document.querySelectorAll('.scroll-animate').forEach(el => observer.observe(el));

        // Hero Slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        function showSlide(n) {
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
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

        // ============ 3D Curved Carousel ============
        const carousels = {};

        document.querySelectorAll('[id^="carousel-track-"]').forEach(track => {
            const galleryId = track.id.replace('carousel-track-', '');
            const items = track.querySelectorAll('.gallery-carousel-item');

            carousels[galleryId] = {
                currentIndex: 0,
                totalItems: items.length,
                autoSlideInterval: null
            };

            positionCarouselItems(galleryId);
            startCarouselAutoSlide(galleryId);

            track.addEventListener('mouseenter', () => stopCarouselAutoSlide(galleryId));
            track.addEventListener('mouseleave', () => startCarouselAutoSlide(galleryId));
        });

        function positionCarouselItems(galleryId) {
            const carousel = carousels[galleryId];
            const track = document.getElementById(`carousel-track-${galleryId}`);
            const items = track.querySelectorAll('.gallery-carousel-item');
            const totalItems = carousel.totalItems;

            items.forEach((item, index) => {
                const position = (index - carousel.currentIndex + totalItems) % totalItems;
                let transform, opacity, zIndex, pointerEvents;

                if (position === 0) {
                    transform = 'translate(-50%, -50%) scale(1) translateZ(0px)';
                    opacity = 1;
                    zIndex = 10;
                    pointerEvents = 'auto';
                } else if (position === 1) {
                    transform =
                        'translate(-50%, -50%) translateX(350px) translateZ(-200px) rotateY(-15deg) scale(0.75)';
                    opacity = 0.6;
                    zIndex = 5;
                    pointerEvents = 'auto';
                } else if (position === totalItems - 1) {
                    transform =
                        'translate(-50%, -50%) translateX(-350px) translateZ(-200px) rotateY(15deg) scale(0.75)';
                    opacity = 0.6;
                    zIndex = 5;
                    pointerEvents = 'auto';
                } else {
                    transform = 'translate(-50%, -50%) scale(0.5) translateZ(-400px)';
                    opacity = 0;
                    zIndex = 0;
                    pointerEvents = 'none';
                }

                item.style.transform = transform;
                item.style.opacity = opacity;
                item.style.zIndex = zIndex;
                item.style.pointerEvents = pointerEvents;
            });
        }

        function moveCarousel(galleryId, direction) {
            const carousel = carousels[galleryId];
            carousel.currentIndex = (carousel.currentIndex + direction + carousel.totalItems) % carousel.totalItems;
            positionCarouselItems(galleryId);
            updateCarouselDots(galleryId);
            resetCarouselAutoSlide(galleryId);
        }

        function goToCarouselSlide(galleryId, index) {
            carousels[galleryId].currentIndex = index;
            positionCarouselItems(galleryId);
            updateCarouselDots(galleryId);
            resetCarouselAutoSlide(galleryId);
        }

        function updateCarouselDots(galleryId) {
            const dots = document.querySelectorAll(`#carousel-dots-${galleryId} .carousel-dot`);
            dots.forEach((dot, i) => dot.classList.toggle('active', i === carousels[galleryId].currentIndex));
        }

        function startCarouselAutoSlide(galleryId) {
            if (carousels[galleryId].totalItems <= 1) return;
            stopCarouselAutoSlide(galleryId);
            carousels[galleryId].autoSlideInterval = setInterval(() => moveCarousel(galleryId, 1), 4000);
        }

        function stopCarouselAutoSlide(galleryId) {
            if (carousels[galleryId].autoSlideInterval) {
                clearInterval(carousels[galleryId].autoSlideInterval);
                carousels[galleryId].autoSlideInterval = null;
            }
        }

        function resetCarouselAutoSlide(galleryId) {
            stopCarouselAutoSlide(galleryId);
            startCarouselAutoSlide(galleryId);
        }

        // Lightbox
        function openLightbox(imageSrc, caption) {
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            img.src = imageSrc;
            img.alt = caption;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLightbox();
        });

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                Object.keys(carousels).forEach(id => stopCarouselAutoSlide(id));
            } else {
                Object.keys(carousels).forEach(id => startCarouselAutoSlide(id));
            }
        });
    </script>
    <!-- ===================== END SCRIPTS ===================== -->

</body>

</html>
