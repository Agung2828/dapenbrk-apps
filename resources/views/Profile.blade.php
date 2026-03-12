<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Dana Pensiun Bank Riau Kepri</title>
    <link rel="icon" type="image/png" href="{{ asset('image/Loadinglogo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* ============================
           LOADING SCREEN STYLES (VERSI TRANSPARAN)
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

        /* ================= HERO VIDEO - FIXED ================= */
        .hero-video {
            position: relative;
            width: 100%;
            height: 80vh;
            overflow: hidden;
            border-radius: 50px 50px;
            margin-top: -50px;
        }

        .hero-video video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            z-index: 1;
        }

        .video-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(220, 38, 38, 0) 0%,
                    rgba(185, 28, 28, 0) 50%,
                    rgba(0, 0, 0, 0.7) 100%);
            z-index: 2;
        }

        .video-content {
            position: relative;
            z-index: 3;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            padding: 0 2rem;
        }

        .video-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1s ease;
        }

        .video-content p {
            max-width: 700px;
            font-size: 1.2rem;
            line-height: 1.8;
            opacity: 0.95;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1s ease 0.3s backwards;
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

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Main Content */
        .main-content {
            padding: 4rem 0;
        }

        /* Section */
        .section {
            margin-bottom: 5rem;
        }

        .section-title {
            font-size: 2.5rem;
            color: #1a1a1a;
            margin-bottom: 1rem;
            font-weight: 800;
            text-align: center;
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #dc2626 0%, #fbbf24 100%);
            border-radius: 2px;
        }

        .section-subtitle {
            text-align: center;
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 3rem;
        }

        /* Sejarah Section */
        .sejarah-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
        }

        .sejarah-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #dc2626 0%, #fbbf24 100%);
        }

        .timeline {
            position: relative;
            padding: 2rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #dc2626 0%, #fbbf24 100%);
            border-radius: 4px;
        }

        .timeline-item {
            margin-bottom: 3rem;
            position: relative;
            display: flex;
            align-items: center;
        }

        .timeline-item:nth-child(odd) {
            flex-direction: row;
        }

        .timeline-item:nth-child(even) {
            flex-direction: row-reverse;
        }

        .timeline-content {
            width: 45%;
            background: #f9fafb;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
        }

        .timeline-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .timeline-date {
            font-size: 1.5rem;
            font-weight: 800;
            color: #dc2626;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .timeline-date i {
            font-size: 1.2rem;
        }

        .timeline-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.75rem;
        }

        .timeline-text {
            color: #4b5563;
            line-height: 1.8;
            font-size: 0.95rem;
        }

        .timeline-marker {
            width: 20px;
            height: 20px;
            background: #dc2626;
            border: 4px solid #fff;
            border-radius: 50%;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.2);
            z-index: 2;
        }

        /* Visi Misi Cards */
        .visi-misi-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            margin-top: 3rem;
        }

        .visi-card,
        .misi-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .visi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
        }

        .misi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #16a34a 0%, #15803d 100%);
        }

        .visi-card:hover,
        .misi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .visi-card .card-icon {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }

        .misi-card .card-icon {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        }

        .card-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .card-content {
            font-size: 1.1rem;
            color: #4b5563;
            line-height: 1.9;
        }

        .misi-list {
            list-style: none;
            padding: 0;
        }

        .misi-list li {
            padding: 1rem 0;
            padding-left: 2.5rem;
            position: relative;
            color: #4b5563;
            font-size: 1.05rem;
            line-height: 1.8;
            border-bottom: 1px solid #f0f0f0;
        }

        .misi-list li:last-child {
            border-bottom: none;
        }

        .misi-list li::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            color: #16a34a;
            font-size: 1.2rem;
            top: 1rem;
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

        /* Profile Cards */
        .profile-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
            margin-top: 3rem;
        }

        /* Layout untuk 4 cards berdampingan (untuk tab Kepala Departemen) */
        #kepala-dept .profile-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* NEW: Layout untuk 1 card di tengah (Ketua) */
        .profile-grid-single {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        .profile-grid-single .profile-card {
            max-width: 400px;
            width: 100%;
        }

        /* NEW: Layout untuk 3 cards (Anggota) */
        .profile-grid-two {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 2rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Layout untuk 2 cards berdampingan (untuk tab Pengurus) */
        #pengurus .profile-grid-two {
            grid-template-columns: repeat(2, 1fr);
            max-width: 900px;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #dc2626 0%, #fbbf24 100%);
        }

        .profile-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #dc2626;
            border: 5px solid #fff;
            box-shadow: 0 5px 20px rgba(220, 38, 38, 0.2);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .profile-position {
            font-size: 1rem;
            color: #dc2626;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .profile-period {
            font-size: 0.9rem;
            color: #666;
            padding: 0.5rem 1rem;
            background: #f9fafb;
            border-radius: 20px;
            display: inline-block;
        }

        .profile-info {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f0f0f0;
        }

        .profile-info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            font-size: 0.95rem;
        }

        .profile-info-label {
            color: #666;
            font-weight: 500;
        }

        .profile-info-value {
            color: #1a1a1a;
            font-weight: 600;
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

        /* Struktur Organisasi */
        .struktur-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-top: 3rem;
        }

        .struktur-image {
            width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }

        /* Tab Navigation */
        .tab-navigation {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
            border-bottom: 3px solid #f0f0f0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .tab-btn {
            padding: 1rem 2rem;
            background: none;
            border: none;
            color: #666;
            font-weight: 600;
            cursor: pointer;
            position: relative;
            transition: all 0.3s;
            border-radius: 8px 8px 0 0;
            font-size: 1rem;
        }

        .tab-btn:hover {
            color: #dc2626;
            background: #fef2f2;
        }

        .tab-btn.active {
            color: #dc2626;
            background: #fef2f2;
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #dc2626 0%, #fbbf24 100%);
            border-radius: 3px 3px 0 0;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Quick Links Section */
        .quick-links {
            padding: 5rem 0;
            background: #f8fafc;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-video {
                height: 70vh;
            }

            .video-content h1 {
                font-size: 2rem;
            }

            .video-content p {
                font-size: 0.95rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .profile-grid {
                grid-template-columns: 1fr;
            }

            #kepala-dept .profile-grid {
                grid-template-columns: 1fr;
            }

            .profile-grid-two {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .visi-misi-container {
                gap: 2rem;
            }

            .card-header {
                flex-direction: column;
                text-align: center;
            }

            .tab-navigation {
                flex-direction: column;
            }

            .tab-btn {
                width: 100%;
            }

            .timeline::before {
                left: 20px;
            }

            .timeline-item {
                flex-direction: column !important;
                align-items: flex-start;
                padding-left: 50px;
            }

            .timeline-content {
                width: 100%;
            }

            .timeline-marker {
                left: 20px;
            }
        }

        /* Responsive untuk tablet */
        @media (min-width: 769px) and (max-width: 1024px) {
            #kepala-dept .profile-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .nav-download {
            background: #f36c12;
            color: #fff !important;
            padding: 8px 14px;
            border-radius: 6px;
            margin-left: 10px;
            font-weight: 600;
        }

        .nav-download:hover {
            background: #d68910;
            color: #f70707 !important;
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

    <script>
        window.addEventListener("load", function() {
            const loader = document.getElementById("loader-wrapper");
            setTimeout(function() {
                loader.classList.add("loader-hide");
            }, 300);
        });
    </script>

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
                <a href="{{ url('/profile') }}" class="nav-link active">Profil</a>
                <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
                <a href="{{ url('/kepesertaan') }}" class="nav-link">Kepesertaan</a>
                <a href="{{ url('/warta') }}" class="nav-link">Warta</a>
                <!-- MENU KHUSUS -->
                <a href="{{ route('formulir') }}" class="nav-link nav-download">
                    <i class="fas fa-download"></i> Unduh Formulir
                </a>
                <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak">
                    <i class="fas fa-phone-alt"></i> Bantuan/Kontak
                </a>
        </div>
        <!-- Mobile Nav -->
        <div class="mobile-nav" id="mobileNav">
            <a href="{{ url('/') }}" class="nav-link">Beranda</a>
            <a href="{{ url('/profile') }}" class="nav-link active">Profil</a>
            <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
            <a href="{{ url('/kepesertaan') }}" class="nav-link">Kepesertaan</a>
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

    <script>
        const mobileBtn = document.querySelector(".mobile-menu-btn");
        const mobileNav = document.getElementById("mobileNav");
        mobileBtn.addEventListener("click", () => {
            mobileNav.classList.toggle("active");
            mobileBtn.classList.toggle("active");
        });

        // Scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>

    <!-- Home Page -->
    <div id="home" class="page-content active">
        <!-- Hero Slider -->
        <div class="hero-slider">
            <div class="slide active" style="background-image: url('{{ asset('image/LAM Kepri.jpeg') }}');">
                <div class="slide-content">
                    <h1>Jaminan Masa Depan<br>Yang Cerah</h1>
                    <p>Dana Pensiun Bank Riau Kepri memberikan perlindungan finansial untuk hari tua Anda dengan
                        pengelolaan profesional dan transparan.</p>
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

                <!-- Sejarah Section -->
                <section class="section">
                    <h2 class="section-title">Sejarah Dana Pensiun</h2>
                    <p class="section-subtitle">Perjalanan Dana Pensiun Bank Riau Kepri dari masa ke masa</p>

                    <div class="sejarah-container">
                        <div class="timeline">
                            <!-- 1985 -->
                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <div class="timeline-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        17 Januari 1985
                                    </div>
                                    <h3 class="timeline-title">Pendirian Yayasan Dana Pensiun</h3>
                                    <p class="timeline-text">
                                        Dana Pensiun didirikan oleh Bank untuk pertama kali pada hari Kamis dalam bentuk
                                        "YAYASAN DANA PENSIUN DAN JAMINAN HARI TUA BANK PEMBANGUNAN DAERAH RIAU" di
                                        hadapan notaris SINGGIH SUSILO S.H. dengan Akta No. 100.
                                    </p>
                                </div>
                                <div class="timeline-marker"></div>
                            </div>

                            <!-- 1991 -->
                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <div class="timeline-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        22 Januari 1991
                                    </div>
                                    <h3 class="timeline-title">Perubahan Nama Pertama</h3>
                                    <p class="timeline-text">
                                        Pada hari Selasa atas permintaan Dewan Pengurus dihadapan notaris SINGGIH SUSILO
                                        S.H NOMOR 88 berubah nama menjadi "YAYASAN DAN PENSIUN BANK PEMBANGUNAN DAERAH
                                        RIAU".
                                    </p>
                                </div>
                                <div class="timeline-marker"></div>
                            </div>

                            <!-- 1992 -->
                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <div class="timeline-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        20 April 1992
                                    </div>
                                    <h3 class="timeline-title">UU Dana Pensiun No. 11 Tahun 1992</h3>
                                    <p class="timeline-text">
                                        Terbitnya Undang-undang Republik Indonesia Nomor 11 Tahun 1992 tentang Dana
                                        Pensiun pada BAB VIII pasal 61 ayat 7 yang mengatur bahwa Dana Pensiun karyawan
                                        yang telah ada dalam bentuk apapun hanya dapat menamakan dirinya sebagai Dana
                                        Pensiun bila penyelenggaraannya didasarkan pada Undang-undang tersebut.
                                    </p>
                                </div>
                                <div class="timeline-marker"></div>
                            </div>

                            <!-- 1993 -->
                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <div class="timeline-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        1993
                                    </div>
                                    <h3 class="timeline-title">Perubahan Status Badan Hukum</h3>
                                    <p class="timeline-text">
                                        Diterbitkan Keputusan Direksi Bank Pembangunan Daerah Riau Nomor: 17/KEPDIR/1993
                                        tentang Peraturan Dana Pensiun Bank Pembangunan Daerah Riau. Dana Pensiun
                                        berubah statusnya menjadi badan hukum dan diberi nama: <strong>Dana Pensiun Bank
                                            Pembangunan Daerah Riau (Dapenria)</strong>.
                                    </p>
                                </div>
                                <div class="timeline-marker"></div>
                            </div>

                            <!-- 2024 -->
                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <div class="timeline-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        2024
                                    </div>
                                    <h3 class="timeline-title">Peraturan Dana Pensiun Terbaru</h3>
                                    <p class="timeline-text">
                                        Seiring berjalannya waktu, Dana Pensiun Bank Riau Kepri telah mengalami beberapa
                                        kali perubahan Peraturan Dana Pensiun. Peraturan terakhir ditetapkan melalui
                                        Surat Keputusan Direksi BPD Riau Kepri Syariah Nomor
                                        <strong>070/DIR/2024</strong> tanggal 02 Mei 2024 dan disahkan oleh Dewan
                                        Komisioner Otoritas Jasa Keuangan Nomor <strong>KEP-641/PD.02/2024</strong>
                                        tanggal 07 November 2024.
                                    </p>
                                </div>
                                <div class="timeline-marker"></div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Visi & Misi Section -->
                <section class="section">
                    <h2 class="section-title">Visi & Misi</h2>
                    <p class="section-subtitle">Komitmen kami dalam memberikan pelayanan terbaik</p>

                    <div class="visi-misi-container">
                        <!-- Visi Card -->
                        <div class="visi-card">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <h3 class="card-title">Visi</h3>
                            </div>
                            <div class="card-content">
                                Menjadi Dana Pensiun Yang Sehat dan mampu Menjunjung Kepentingan
                                Stakeholder/Pemangku
                                Kepentingan Guna Jaminan Terpeliharanya kesinambungan Penghasilan Hari Tua Bagi
                                Peserta
                            </div>
                        </div>

                        <!-- Misi Card -->
                        <div class="misi-card">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-bullseye"></i>
                                </div>
                                <h3 class="card-title">Misi</h3>
                            </div>
                            <div class="card-content">
                                <ul class="misi-list">
                                    <li>Melaksanakan Peraturan Dana Pensiun, Sehingga Peserta Menerima Haknya Dengan
                                        Tepat Jumlah dan Tepat Waktu</li>
                                    <li>Mengelola Kekayaan Dana Pensiun Secara Efektif, Efisien Dan Hasil Maksimal,
                                        Sehingga Memberikan Motivasi, Rasa Aman Dan Ketenangan Dalam Bekerja Bagi
                                        Peserta Sehingga Meningkatkan Produktivitas Perusahaan, Karena Hari Tuanya
                                        Terjamin</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Profil Organisasi Section -->
                <section class="section">
                    <h2 class="section-title">Profil Organisasi</h2>
                    <p class="section-subtitle">Struktur kepemimpinan Dana Pensiun Bank Riau Kepri</p>

                    <!-- Tab Navigation -->
                    <div class="tab-navigation">
                        <button class="tab-btn active" onclick="openTab('dewan-pengawas')">Dewan Pengawas</button>
                        <button class="tab-btn" onclick="openTab('pengurus')">Pengurus</button>
                        <button class="tab-btn" onclick="openTab('kepala-dept')">Kepala Departemen</button>
                    </div>

                    <!-- Dewan Pengawas Tab -->
                    <div id="dewan-pengawas" class="tab-content active">
                        <!-- Ketua Dewan Pengawas -->
                        <div class="profile-grid-single">
                            <div class="profile-card">
                                <div class="profile-avatar">
                                    <img src="{{ asset('image/saidsyamsuri.png') }}" alt="Said Syamsuri">
                                </div>
                                <h3 class="profile-name">Said Syamsuri</h3>
                                <p class="profile-position">Ketua Dewan Pengawas</p>
                                <p class="profile-period">Periode: 2023-2027</p>
                                <div class="profile-info">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">Status</span>
                                        <span class="profile-info-value">Wakil Pendiri</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Anggota Dewan Pengawas -->
                        {{-- <h3 style="text-align: center; color: #1a1a1a; font-size: 1.5rem; margin: 3rem 0 2rem 0;">
                            Anggota Dewan Pengawas</h3> --}}
                        <div class="profile-grid-two">
                            <div class="profile-card">
                                <div class="profile-avatar">
                                    <img src="{{ asset('image/M.affan.png') }}" alt="M. Affan">
                                </div>
                                <h3 class="profile-name">M. Affan</h3>
                                <p class="profile-position">Anggota Dewan Pengawas</p>
                                <p class="profile-period">Periode: 2021-2025</p>
                                <div class="profile-info">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">Status</span>
                                        <span class="profile-info-value">Wakil Peserta</span>
                                    </div>
                                </div>
                            </div>

                            <div class="profile-card">
                                <div class="profile-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <h3 class="profile-name">Nama Anggota 2</h3>
                                <p class="profile-position">Anggota Dewan Pengawas</p>
                                <p class="profile-period">Periode: -</p>
                                <div class="profile-info">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">Status</span>
                                        <span class="profile-info-value">-</span>
                                    </div>
                                </div>
                            </div>

                            <div class="profile-card">
                                <div class="profile-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <h3 class="profile-name">Nama Anggota 3</h3>
                                <p class="profile-position">Anggota Dewan Pengawas</p>
                                <p class="profile-period">Periode: -</p>
                                <div class="profile-info">
                                    <div class="profile-info-item">
                                        <span class="profile-info-label">Status</span>
                                        <span class="profile-info-value">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pengurus Tab -->
                    <div id="pengurus" class="tab-content">
                        <!-- Direktur Utama (PLT) -->
                        <div class="profile-grid-single">
                            <div class="profile-card">
                                <div class="profile-avatar">
                                    <img src="{{ asset('image/Edirison.png') }}" alt="Edirison">
                                </div>
                                <h3 class="profile-name">Edirison</h3>
                                <p class="profile-position">Direktur Utama</p>
                                <div style="margin: 0.5rem 0; font-size: 0.9rem; color: #666; font-style: italic;">
                                    Merangkap Direktur Kepesertaan & Umum
                                </div>
                            </div>
                        </div>

                        <!-- Direktur -->
                        {{-- <h3 style="text-align: center; color: #1a1a1a; font-size: 1.5rem; margin: 3rem 0 2rem 0;">
                            Direktur</h3> --}}
                        <div class="profile-grid-two">
                            <div class="profile-card">
                                <div class="profile-avatar">
                                    <img src="{{ asset('image/Edirison.png') }}" alt="Edirison">
                                </div>
                                <h3 class="profile-name">Edirison</h3>
                                <p class="profile-position">Direktur Kepesertaan & Umum</p>
                                <p class="profile-period">Periode: 2025-2026</p>
                            </div>

                            <div class="profile-card">
                                <div class="profile-avatar">
                                    <img src="{{ asset('image/Yuharman.png') }}" alt="Yuharman">
                                </div>
                                <h3 class="profile-name">Yuharman</h3>
                                <p class="profile-position">Direktur Investasi</p>
                                <p class="profile-period">Periode: 2021-2025</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kepala Departemen Tab -->
                    <div id="kepala-dept" class="tab-content">
                        <div class="profile-grid">
                            <div class="profile-card">
                                <div class="profile-avatar">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <h3 class="profile-name">Firmansyah</h3>
                                <p class="profile-position">Kepala Departemen Akuntansi & SI</p>
                            </div>

                            <div class="profile-card">
                                <div class="profile-avatar">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                                <h3 class="profile-name">Aresfanber</h3>
                                <p class="profile-position">Kepala Departemen Umum & Kepesertaan</p>
                            </div>

                            <div class="profile-card">
                                <div class="profile-avatar">
                                    <i class="fas fa-coins"></i>
                                </div>
                                <h3 class="profile-name">Nanang Eko Fadli</h3>
                                <p class="profile-position">Kepala Departemen Investasi</p>
                            </div>

                            <div class="profile-card">
                                <div class="profile-avatar">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h3 class="profile-name">Dede Ermania</h3>
                                <p class="profile-position">Kepala Satuan Pengawas Internal (SPI)</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Struktur Organisasi Section -->
                <section class="section">
                    <h2 class="section-title">Struktur Organisasi</h2>
                    <p class="section-subtitle">Bagan organisasi Dana Pensiun Bank Riau Kepri</p>

                    <div class="struktur-container">
                        <img src="{{ asset('image/Struktur organisasi.png') }}" alt="Struktur Organisasi"
                            class="struktur-image">
                    </div>
                </section>

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

    <script>
        // Slider functionality
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

        // Auto slide
        setInterval(() => {
            currentSlide++;
            showSlide(currentSlide);
        }, 5000);

        // Tab Functionality
        function openTab(tabName) {
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => {
                content.classList.remove('active');
            });

            const tabBtns = document.querySelectorAll('.tab-btn');
            tabBtns.forEach(btn => {
                btn.classList.remove('active');
            });

            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }
    </script>
</body>

</html>
