<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Manfaat Pensiun - Dana Pensiun Bank Riau Kepri</title>

    <link rel="icon" type="image/png" href="{{ asset('image/Loadinglogo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* LOADING */
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
        }

        .pulsing-logo {
            width: 80px;
            object-fit: contain;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1)
            }

            50% {
                transform: scale(1.1)
            }
        }

        #loader-wrapper.loader-hide {
            opacity: 0;
            visibility: hidden;
        }

        /* BACKGROUND */
        .page-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: url('{{ asset('image/MTQ.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .page-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(2px);
        }

        /* NAV BUTTONS */
        .nav-download {
            background: rgba(234, 90, 12, 0.75);
            color: #fff !important;
            padding: 8px 14px;
            border-radius: 8px;
            margin-left: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(234, 90, 12, 0.35);
            white-space: nowrap;
            border: 2px solid transparent;
        }

        .nav-download:hover {
            background: #fff;
            color: #ea5a0c !important;
            border-color: #ea5a0c;
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
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .nav-kontak:hover {
            background: #fff;
            color: #988904 !important;
            border-color: #82682c;
            transform: translateY(-2px);
        }

        /* PAGE TITLE */
        .page-title-section {
            text-align: center;
            padding: 2.5rem 0 0.5rem;
            position: relative;
            z-index: 10;
            margin-top: 60px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        .page-subtitle {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.75);
            margin-top: 0.25rem;
            font-weight: 500;
        }

        /* CALCULATOR WRAPPER */
        .calculator-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem 1rem;
            position: relative;
            z-index: 10;
            height: calc(100vh - 180px);
            display: flex;
            align-items: flex-start;
        }

        .calculator-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            align-items: start;
            width: 100%;
        }

        /* CARDS */
        .calc-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }

        .calc-card::-webkit-scrollbar {
            width: 6px;
        }

        .calc-card::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        .calc-card::-webkit-scrollbar-thumb {
            background: rgba(251, 191, 36, 0.5);
            border-radius: 10px;
        }

        .calc-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
            border-color: rgba(251, 191, 36, 0.3);
        }

        .calc-title {
            font-size: 1.2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.5rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .calc-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(251, 191, 36, 0.5), transparent);
            margin: 0.5rem 0 0.8rem;
        }

        /* FORM INPUTS */
        .calc-card .form-input {
            background: rgba(0, 0, 0, 0.18) !important;
            border: 1.8px solid rgba(255, 255, 255, 0.22) !important;
            color: #fff !important;
        }

        .calc-card .form-input::placeholder {
            color: rgba(255, 255, 255, 0.45) !important;
        }

        .calc-card .form-input:focus {
            background: rgba(0, 0, 0, 0.28) !important;
            border-color: rgba(251, 191, 36, 0.70) !important;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.15) !important;
            transform: none !important;
        }

        .calc-card .form-input:read-only {
            background: rgba(0, 0, 0, 0.18) !important;
            color: rgba(255, 255, 255, 0.85) !important;
            cursor: not-allowed;
        }

        /* DATE INPUT WRAPPER */
        .date-input-wrapper {
            position: relative;
        }

        .date-input-wrapper input[type="text"] {
            padding-right: 2.5rem;
        }

        .date-input-wrapper .calendar-icon {
            position: absolute;
            right: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: #fbbf24;
            pointer-events: none;
            font-size: 1rem;
            z-index: 1;
        }

        .date-input-wrapper input[type="date"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .date-input-wrapper input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            cursor: pointer;
        }

        /* FORM BASE */
        .form-input {
            width: 100%;
            padding: 0.5rem 0.8rem;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            font-size: 0.8rem;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.03);
            color: #fff !important;
            backdrop-filter: blur(10px);
            font-weight: 500;
        }

        .form-input:focus {
            outline: none;
            border-color: #fbbf24;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.2);
            background: rgba(255, 255, 255, 0.08);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
            font-weight: 400;
        }

        /* Column header labels */
        .col-header {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.72rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.25rem;
        }

        /* ============================
           LAYOUT ROWS (persis seperti gambar)
        ============================ */

        /* Row 1: NIK (lebar) | Tanggal Lahir */
        .row-nik-lahir {
            display: grid;
            grid-template-columns: 3fr 2fr;
            gap: 0.6rem;
            margin-bottom: 0.5rem;
            align-items: end;
        }

        /* Row bawah: Tanggal Jadi | PhDP | Tanggal Pensiun */
        .row-three {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 0.6rem;
            margin-bottom: 0.3rem;
        }

        /* ============================
           AREA NAMA
        ============================ */
        .nama-area {
            background: rgba(200, 200, 200, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            min-height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0.5rem 0 0.55rem;
            padding: 0.6rem 1rem;
            position: relative;
            transition: all 0.3s;
        }

        .nama-placeholder {
            color: rgba(255, 255, 255, 0.3);
            font-size: 0.78rem;
            font-style: italic;
        }

        .nama-text {
            color: #fff;
            font-size: 1.05rem;
            font-weight: 900;
            text-align: center;
            display: none;
            letter-spacing: 0.5px;
        }

        .nama-verified-badge {
            position: absolute;
            top: 5px;
            right: 7px;
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.4);
            color: #22c55e;
            font-size: 0.58rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 20px;
            display: none;
        }

        .nama-area.verified {
            border-color: rgba(34, 197, 94, 0.4);
            background: rgba(34, 197, 94, 0.08);
        }

        /* Auto-filled highlight */
        .input-auto-filled {
            border-color: rgba(34, 197, 94, 0.55) !important;
            box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.12) !important;
        }

        /* Hint */
        .form-hint {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
            font-size: 0.65rem;
            margin-top: 0.2rem;
        }

        .hint-auto {
            color: #f87171;
        }

        .hint-auto i {
            color: #f87171;
        }

        /* ============================
           BUTTONS (full width, stacked)
        ============================ */
        .btn-full {
            width: 100%;
            padding: 0.65rem;
            border: none;
            border-radius: 8px;
            font-weight: 800;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .btn-full::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transition: width 0.6s, height 0.6s, top 0.6s, left 0.6s;
            transform: translate(-50%, -50%);
        }

        .btn-full:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-full span,
        .btn-full i {
            position: relative;
            z-index: 1;
        }

        .btn-verify {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: #1e3a5f;
        }

        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(251, 191, 36, 0.5);
        }

        .btn-reset {
            background: linear-gradient(135deg, #ef5350, #e53935);
            color: #fff;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 83, 80, 0.5);
        }

        .btn-hitung {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: #1e3a5f;
        }

        .btn-hitung:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(251, 191, 36, 0.5);
        }

        /* ERROR */
        .search-error {
            background: rgba(255, 235, 238, 0.15);
            border-left: 4px solid #dc3545;
            padding: 0.65rem 0.8rem;
            border-radius: 8px;
            margin: 0.4rem 0;
            color: #ffcdd2;
            font-size: 0.78rem;
        }

        .search-error p {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            margin: 0;
        }

        /* RESULT BOXES */
        .result-box {
            background: rgba(30, 58, 95, 0.4);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(251, 191, 36, 0.3);
            border-radius: 10px;
            padding: 0.8rem;
            margin-bottom: 0.8rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            display: none;
        }

        .result-label {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 700;
            margin-bottom: 0.6rem;
            font-size: 0.8rem;
        }

        .result-label i {
            color: #fbbf24;
        }

        .result-value {
            color: #fbbf24;
            font-weight: 900;
            font-size: 1.5rem;
            margin-bottom: 0.6rem;
            text-shadow: 0 0 20px rgba(251, 191, 36, 0.5);
        }

        .result-details {
            padding-top: 0.6rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .result-details-title {
            color: rgba(255, 255, 255, 0.95);
            font-weight: 700;
            margin-bottom: 0.4rem;
            font-size: 0.8rem;
        }

        .result-details-content {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.75rem;
            line-height: 1.5;
        }

        /* NOTES */
        .notes-box {
            background: rgba(255, 243, 205, 0.15);
            border-left: 4px solid #fbbf24;
            border-radius: 8px;
            padding: 0.8rem;
            margin-top: 0.8rem;
        }

        .notes-box h4 {
            color: #fbbf24;
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.85rem;
        }

        .notes-box ul {
            margin: 0;
            padding-left: 1rem;
        }

        .notes-box li {
            color: rgba(255, 255, 255, 0.85);
            margin: 0.4rem 0;
            line-height: 1.4;
            font-size: 0.7rem;
        }

        /* FLOATING WA */
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
            background: linear-gradient(135deg, #25D366, #128C7E);
            border-radius: 50%;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            transition: all 0.3s;
            text-decoration: none;
            animation: floating-pulse 2s ease-in-out infinite;
        }

        .floating-whatsapp-link:hover {
            transform: scale(1.1);
        }

        .floating-whatsapp-link i {
            font-size: 2.2rem;
            color: white;
        }

        @keyframes floating-pulse {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-8px)
            }
        }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .calculator-grid {
                grid-template-columns: 1fr;
            }

            .calculator-wrapper {
                height: auto;
            }

            .page-title-section {
                margin-top: 70px;
            }
        }

        @media (max-width: 768px) {
            .calc-card {
                padding: 1rem;
                max-height: none;
            }

            .row-nik-lahir {
                grid-template-columns: 1fr;
            }

            .row-three {
                grid-template-columns: 1fr;
            }

            .page-title-section {
                margin-top: 65px;
                padding: 1.5rem 0 0.5rem;
            }

            .page-title {
                font-size: 1.1rem;
            }

            .floating-whatsapp {
                bottom: 20px;
                right: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="page-background"></div>

    <div id="loader-wrapper">
        <img src="{{ asset('image/Loadinglogo.png') }}" alt="Logo" class="pulsing-logo">
    </div>

    <div class="floating-whatsapp">
        <a href="https://wa.me/628137964058" target="_blank" class="floating-whatsapp-link">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <script>
        window.addEventListener("load", function() {
            setTimeout(() => document.getElementById("loader-wrapper").classList.add("loader-hide"), 300);
        });
    </script>

    <!-- Header -->
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
                <a href="{{ url('/warta') }}" class="nav-link">Warta</a>
                <a href="{{ route('formulir') }}" class="nav-link nav-download"><i class="fas fa-download"></i> Unduh
                    Formulir</a>
                <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak"><i class="fas fa-phone-alt"></i>
                    Bantuan/Kontak</a>
            </nav>
            <div class="mobile-nav" id="mobileNav">
                <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
                <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
                <a href="{{ url('/kepesertaan') }}" class="nav-link">Kepesertaan</a>
                <a href="{{ url('/warta') }}" class="nav-link">Warta</a>
                <a href="{{ route('formulir') }}" class="nav-link nav-download"><i class="fas fa-download"></i> Unduh
                    Formulir</a>
                <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak"><i class="fas fa-phone-alt"></i>
                    Bantuan/Kontak</a>
            </div>
            <div class="header-actions">
                <button class="mobile-menu-btn"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </header>

    <script>
        document.querySelector(".mobile-menu-btn").addEventListener("click", () => {
            document.getElementById("mobileNav").classList.toggle("active");
        });
        window.addEventListener('scroll', function() {
            document.getElementById('mainHeader').classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>

    <!-- Page Title -->
    <div class="page-title-section">
        <h1 class="page-title">FORM SIMULASI MANFAAT PENSIUN</h1>
        <p class="page-subtitle">Perhitungan Simulasi ini merupakan perhitungan sementara bukan nominal pasti yang akan
            diterima.</p>
    </div>

    <!-- Calculator -->
    <div class="calculator-wrapper">
        <div class="calculator-grid">

            <!-- KIRI: SIMULASI -->
            <div class="calc-card">
                <h2 class="calc-title">SIMULASI</h2>
                <div class="calc-divider"></div>

                <!-- Instruksi merah -->
                <div style="text-align:center; margin-bottom:0.55rem;">
                    <span style="color:#f87171; font-size:0.72rem; font-weight:600; line-height:1.5;">
                        Isi NIK dan Tanggal Lahir untuk Mengetahui
                        <span style="text-decoration:underline; cursor:default;">Tanggal Jadi Peserta</span> dan
                        <span style="text-decoration:underline; cursor:default;">Penghasilan Dasar</span>
                    </span>
                </div>

                <form onsubmit="return false;">

                    <!-- ROW 1: NIK + Tanggal Lahir -->
                    <div class="row-nik-lahir">
                        <div>
                            <div class="col-header">Kode / NIK Peserta</div>
                            <input type="text" id="searchInput" class="form-input" placeholder="Masukkan NIK">
                        </div>
                        <div>
                            <div class="col-header">Tanggal Lahir</div>
                            <div class="date-input-wrapper">
                                <input type="text" id="birthDateDisplay" class="form-input" placeholder="dd/mm/yyyy"
                                    readonly>
                                <i class="fas fa-calendar-alt calendar-icon"></i>
                                <input type="date" id="birthDate">
                            </div>
                        </div>
                    </div>

                    <!-- TOMBOL VERIFIKASI -->
                    <button type="button" onclick="verifyPeserta()" class="btn-full btn-verify">
                        <i class="fas fa-shield-alt"></i>
                        <span>Verifikasi Data</span>
                    </button>

                    <!-- AREA NAMA -->
                    <div class="nama-area" id="namaArea">
                        <span class="nama-placeholder" id="namaPlaceholder">Nama peserta muncul di sini setelah
                            verifikasi</span>
                        <span class="nama-text" id="namaTeks"></span>
                        <span class="nama-verified-badge" id="namaVerifiedBadge">✓ Terverifikasi</span>
                    </div>

                    <!-- Error -->
                    <div id="searchError" style="display:none;">
                        <div class="search-error">
                            <p><i class="fas fa-exclamation-triangle"></i>
                                <strong id="errorMsg">Data tidak ditemukan.</strong>
                            </p>
                        </div>
                    </div>

                    <!-- ROW 3: Tanggal Jadi | PhDP | Tanggal Pensiun -->
                    <div class="row-three">
                        <div>
                            <div class="col-header">Tanggal Jadi Peserta</div>
                            <div class="date-input-wrapper">
                                <input type="text" id="joinDateDisplay" class="form-input"
                                    placeholder="dd/mm/yyyy" readonly>
                                <i class="fas fa-calendar-alt calendar-icon"></i>
                                <input type="date" id="joinDate">
                            </div>
                        </div>
                        <div>
                            <div class="col-header">Penghasilan Dasar Pensiun (PhDP)</div>
                            <input type="text" id="phdpDisplay" class="form-input" placeholder="Rp.">
                        </div>
                        <div>
                            <div class="col-header">Tanggal Pensiun</div>
                            <div class="date-input-wrapper">
                                <input type="text" id="retirementDateDisplay" class="form-input"
                                    placeholder="dd/mm/yyyy" readonly>
                                <i class="fas fa-calendar-alt calendar-icon"></i>
                                <input type="date" id="retirementDate">
                            </div>
                        </div>
                    </div>

                    <!-- Hint -->
                    <div class="form-hint hint-auto" style="margin-bottom:0.7rem;">
                        <i class="fas fa-magic"></i>
                        Terisi otomatis setelah verifikasi data
                    </div>

                    <!-- RESET + HITUNG (full width, stacked) -->
                    <button type="button" onclick="resetForm()" class="btn-full btn-reset">
                        <i class="fas fa-redo"></i>
                        <span>Reset</span>
                    </button>
                    <button type="button" onclick="calculatePension()" class="btn-full btn-hitung"
                        style="margin-bottom:0;">
                        <i class="fas fa-calculator"></i>
                        <span>Hitung Estimasi</span>
                    </button>

                </form>
            </div>

            <!-- KANAN: HASIL PERHITUNGAN -->
            <div class="calc-card">
                <h2 class="calc-title">HASIL PERHITUNGAN</h2>
                <div class="calc-divider"></div>

                <div class="result-box" id="usiaBerhentiBox">
                    <div class="result-label"><i class="fas fa-user-clock"></i> Usia Pensiun</div>
                    <div class="result-value" id="usiaBerhentiDisplay">0 Tahun 0 Bulan</div>
                </div>

                <div class="result-box" id="masaKerjaBox">
                    <div class="result-label"><i class="fas fa-calendar-check"></i> Masa Kerja</div>
                    <div class="result-value" id="masaKerjaDisplay">0 Tahun 0 Bulan</div>
                    <div class="result-details">
                        <div class="result-details-content">
                            • Tahun: <strong id="tahunDetail">0</strong>
                            &nbsp;• Bulan: <strong id="bulanDetail">0</strong>
                            &nbsp;• Desimal: <strong id="desimalDetail">0.00</strong> tahun
                        </div>
                    </div>
                </div>

                <div class="result-box" id="resultBox">
                    <div class="result-label"><i class="fas fa-money-bill-wave"></i> Asumsi Manfaat Pensiun Per Bulan
                    </div>
                    <div class="result-value" id="resultValue">Rp 0</div>
                    <div class="result-details">
                        <div class="result-details-title">Rumus Perhitungan:</div>
                        <div class="result-details-content">
                            <strong>2,5% × Masa Kerja × PhDP</strong><br>
                            <div id="formulaDetail" style="margin-top:0.5rem;"></div>
                        </div>
                    </div>
                </div>

                <div class="notes-box">
                    <h4><i class="fas fa-exclamation-circle"></i> Catatan Penting</h4>
                    <ul>
                        <li>Jika perhitungan hanya memunculkan usia, berarti kriteria usia tidak memenuhi ketentuan usia
                            pensiun normal atau dipercepat.</li>
                        <li>Tanggal Peserta adalah tanggal dimana Peserta diangkat menjadi Pegawai.</li>
                        <li>Untuk pensiun janda/duda/anak besarnya manfaat pensiun menjadi 80% dari Nilai Manfaat
                            Pensiun.</li>
                        <li>Jika manfaat pensiun &lt; Rp. 1.000.000, maka manfaat pensiun digenapkan menjadi Rp.
                            1.000.000.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>Tentang Kami</h3>
                    <p style="color:#d1d5db; font-size:0.95rem; line-height:1.9;">Dana Pensiun Bank Riau Kepri
                        memberikan jaminan kesejahteraan di masa pensiun dengan pengelolaan yang profesional dan
                        transparan.</p>
                    <div class="social-links">
                        <a href="https://wa.me/628137964058" target="_blank"><i class="fab fa-whatsapp"></i></a>
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
                    <h3 style="margin-bottom:1rem;">Kontak & Legalitas</h3>
                    <ul style="margin-bottom:2rem;">
                        <li style="display:flex; gap:0.75rem; color:#d1d5db; margin-bottom:0.5rem;">
                            <i class="fas fa-map-marker-alt" style="margin-top:0.25rem; color:#fbbf24;"></i>
                            <span>Jl. Arifin Ahmad No. 54-56 Kel Sidomulyo Timur Kec Marpoyan Damai Pekanbaru -
                                28125</span>
                        </li>
                        <li style="display:flex; gap:0.75rem; color:#d1d5db; margin-bottom:0.5rem;">
                            <i class="fas fa-phone" style="color:#fbbf24;"></i>
                            <span>(0761) 5781181</span>
                        </li>
                        <li style="display:flex; gap:0.75rem; color:#d1d5db; margin-bottom:1rem;">
                            <i class="fas fa-envelope" style="color:#fbbf24;"></i>
                            <span>dapenbankriau@gmail.com</span>
                        </li>
                    </ul>
                    <div class="compliance-group">
                        <div class="compliance-item">
                            <p>Terdaftar dan Diawasi Oleh:</p>
                            <a href="https://www.ojk.go.id" target="_blank">
                                <img src="{{ asset('image/logo-ojk.jpg') }}" alt="OJK Logo"
                                    class="logo-img bg-white">
                            </a>
                        </div>
                        <div class="compliance-item">
                            <p>Terdaftar Sebagai Anggota:</p>
                            <a href="https://www.adpi.or.id" target="_blank">
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
        document.addEventListener("DOMContentLoaded", function() {

            /* -----------------------------------------------
               HELPERS
            ----------------------------------------------- */
            function formatRupiah(angka) {
                if (!angka) return '';
                return 'Rp ' + Number(angka).toLocaleString('id-ID');
            }

            function parseRupiah(str) {
                return parseInt((str || '').replace(/[^0-9]/g, '')) || 0;
            }

            function formatDisplayDate(dateStr) {
                if (!dateStr) return '';
                const [y, m, d] = dateStr.split('-');
                return `${d}/${m}/${y}`;
            }

            /* -----------------------------------------------
               DATE PICKERS
            ----------------------------------------------- */
            function bindDate(displayId, inputId) {
                document.getElementById(inputId).addEventListener('change', function() {
                    document.getElementById(displayId).value = this.value ? formatDisplayDate(this.value) :
                        '';
                });
            }
            bindDate('birthDateDisplay', 'birthDate');
            bindDate('joinDateDisplay', 'joinDate');
            bindDate('retirementDateDisplay', 'retirementDate');

            /* -----------------------------------------------
               AUTO-FORMAT PhDP SAAT MENGETIK MANUAL
               Contoh: user ketik 1600000 → tampil "Rp 1.600.000"
            ----------------------------------------------- */
            const phdpEl = document.getElementById('phdpDisplay');

            phdpEl.addEventListener('input', function() {
                // Simpan posisi kursor
                const cursorPos = this.selectionStart;
                const prevLen = this.value.length;

                // Ambil hanya angka
                const digits = this.value.replace(/[^0-9]/g, '');

                if (digits === '') {
                    this.value = '';
                    return;
                }

                // Format dengan titik ribuan, prefix "Rp "
                const formatted = 'Rp ' + parseInt(digits).toLocaleString('id-ID');
                this.value = formatted;

                // Sesuaikan posisi kursor agar tidak lompat ke ujung
                const newLen = this.value.length;
                const newPos = cursorPos + (newLen - prevLen);
                this.setSelectionRange(newPos, newPos);
            });

            // Saat fokus: jika isinya "Rp 0" atau kosong, kosongkan agar mudah diketik
            phdpEl.addEventListener('focus', function() {
                if (parseRupiah(this.value) === 0) {
                    this.value = '';
                }
            });

            // Saat blur: jika kosong, biarkan kosong (placeholder akan tampil)
            phdpEl.addEventListener('blur', function() {
                const val = parseRupiah(this.value);
                if (val > 0) {
                    this.value = formatRupiah(val);
                } else {
                    this.value = '';
                }
            });

            /* -----------------------------------------------
               NAMA AREA helpers
            ----------------------------------------------- */
            function setNama(verified, nama) {
                const area = document.getElementById('namaArea');
                const placeholder = document.getElementById('namaPlaceholder');
                const teks = document.getElementById('namaTeks');
                const badge = document.getElementById('namaVerifiedBadge');
                if (verified) {
                    area.classList.add('verified');
                    placeholder.style.display = 'none';
                    teks.innerText = nama;
                    teks.style.display = 'block';
                    badge.style.display = 'inline-block';
                } else {
                    area.classList.remove('verified');
                    placeholder.style.display = 'block';
                    teks.style.display = 'none';
                    badge.style.display = 'none';
                }
            }

            function showError(msg) {
                document.getElementById('errorMsg').innerText = msg;
                document.getElementById('searchError').style.display = 'block';
            }

            function fillDate(inputId, displayId, dateStr) {
                if (!dateStr) return;
                document.getElementById(inputId).value = dateStr;
                document.getElementById(displayId).value = formatDisplayDate(dateStr);
                document.getElementById(displayId).classList.add('input-auto-filled');
            }

            /* -----------------------------------------------
               VERIFIKASI — hanya NIK + tanggal lahir
               Response: { found, nama, phdp, tanggal_jadi, tanggal_pensiun }
            ----------------------------------------------- */
            window.verifyPeserta = async function() {
                const key = document.getElementById('searchInput').value.trim();
                const tanggalLahir = document.getElementById('birthDate').value;

                document.getElementById('searchError').style.display = 'none';
                setNama(false, '');

                if (!key || !tanggalLahir) {
                    showError('Mohon isi Kode/NIK dan Tanggal Lahir sebelum verifikasi.');
                    return;
                }

                try {
                    const params = new URLSearchParams({
                        key,
                        tanggal_lahir: tanggalLahir
                    });
                    const res = await fetch(`/peserta/verify?${params}`);
                    const data = await res.json();

                    if (!data.found) {
                        showError(data.message || 'Data tidak ditemukan atau tanggal lahir tidak sesuai.');
                        return;
                    }

                    // Tampilkan nama
                    setNama(true, data.nama ?? '-');

                    // Isi tiga kolom bawah secara otomatis
                    fillDate('joinDate', 'joinDateDisplay', data.tanggal_jadi);
                    fillDate('retirementDate', 'retirementDateDisplay', data.tanggal_pensiun);

                    phdpEl.value = formatRupiah(data.phdp ?? 0);
                    phdpEl.classList.add('input-auto-filled');

                } catch (err) {
                    console.error(err);
                    showError('Terjadi kesalahan koneksi. Coba lagi.');
                }
            };

            /* -----------------------------------------------
               HITUNG ESTIMASI
            ----------------------------------------------- */
            window.calculatePension = function() {
                const birthDate = document.getElementById('birthDate').value;
                const joinDate = document.getElementById('joinDate').value;
                const retireDate = document.getElementById('retirementDate').value;
                const phdp = parseRupiah(phdpEl.value);

                if (!birthDate) {
                    alert('Mohon isi Tanggal Lahir!');
                    return;
                }
                if (!joinDate) {
                    alert('Mohon isi Tanggal Jadi Peserta!');
                    return;
                }
                if (!retireDate) {
                    alert('Mohon isi Tanggal Pensiun!');
                    return;
                }
                if (phdp <= 0) {
                    alert('Mohon isi Penghasilan Dasar Pensiun (PhDP)!');
                    return;
                }

                const birth = new Date(birthDate);
                const join = new Date(joinDate);
                const retire = new Date(retireDate);

                if (retire < join) {
                    alert('Tanggal Pensiun tidak boleh lebih awal dari Tanggal Jadi Peserta!');
                    return;
                }

                // Usia saat pensiun
                let ageYears = retire.getFullYear() - birth.getFullYear();
                let ageMonths = retire.getMonth() - birth.getMonth();
                if (ageMonths < 0) {
                    ageYears--;
                    ageMonths += 12;
                }
                document.getElementById('usiaBerhentiDisplay').innerText =
                    `${ageYears} Tahun ${ageMonths} Bulan`;
                document.getElementById('usiaBerhentiBox').style.display = 'block';

                // Masa kerja
                let years = retire.getFullYear() - join.getFullYear();
                let months = retire.getMonth() - join.getMonth();
                if (months < 0) {
                    years--;
                    months += 12;
                }
                const decimal = (years + months / 12).toFixed(2);
                document.getElementById('masaKerjaDisplay').innerText = `${years} Tahun ${months} Bulan`;
                document.getElementById('tahunDetail').innerText = years;
                document.getElementById('bulanDetail').innerText = months;
                document.getElementById('desimalDetail').innerText = decimal;
                document.getElementById('masaKerjaBox').style.display = 'block';

                // Manfaat pensiun
                let manfaat = 0.025 * parseFloat(decimal) * phdp;
                if (manfaat < 1000000) manfaat = 1000000;
                document.getElementById('resultValue').innerText = formatRupiah(Math.round(manfaat));
                document.getElementById('formulaDetail').innerText =
                `2,5% × ${decimal} × ${formatRupiah(phdp)}`;
                document.getElementById('resultBox').style.display = 'block';
            };

            /* -----------------------------------------------
               RESET
            ----------------------------------------------- */
            window.resetForm = function() {
                ['searchInput', 'birthDateDisplay', 'joinDateDisplay', 'retirementDateDisplay', 'phdpDisplay']
                .forEach(id => {
                    document.getElementById(id).value = '';
                });
                ['birthDate', 'joinDate', 'retirementDate']
                .forEach(id => {
                    document.getElementById(id).value = '';
                });
                ['joinDateDisplay', 'retirementDateDisplay', 'phdpDisplay']
                .forEach(id => document.getElementById(id).classList.remove('input-auto-filled'));
                ['usiaBerhentiBox', 'masaKerjaBox', 'resultBox']
                .forEach(id => {
                    document.getElementById(id).style.display = 'none';
                });
                document.getElementById('searchError').style.display = 'none';
                setNama(false, '');
            };

        });
    </script>

</body>

</html>
