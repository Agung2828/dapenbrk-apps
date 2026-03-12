<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $berita->judul }} - Berita & Informasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('image/Loadinglogo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Style Umum (kalau ada file css global, boleh ditambahkan) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f6f8;
            margin: 0;
            padding: 0;
        }

        .page-header {
            padding: 4rem 2rem;
            text-align: center;
            color: #111;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }

        .page-header h1 {
            font-size: 2.4rem;
            margin-bottom: 0.75rem;
        }

        .page-header p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .container {
            max-width: 1000px;
            margin: -3rem auto 4rem;
            padding: 0 1.5rem;
        }

        .news-detail {
            background: #fff;
            padding: 2.5rem;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .news-detail-image img {
            width: 100%;
            border-radius: 14px;
            margin-bottom: 2rem;
        }

        .news-detail-content {
            font-size: 1.05rem;
            line-height: 1.9;
            color: #333;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2.5rem;
            text-decoration: none;
            color: #fff;
            background: #dc2626;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #b91c1c;
            transform: translateX(-4px);
        }

        footer {
            text-align: center;
            padding: 2rem;
            font-size: 0.9rem;
            color: #777;
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.8rem;
            }

            .news-detail {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="page-header">
        <h1>{{ $berita->judul }}</h1>
        <p>
            {{ strtoupper($berita->kategori) }} ·
            {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}
        </p>
    </div>

    <!-- CONTENT -->
    <div class="container">
        <div class="news-detail">

            <!-- GAMBAR -->
            @if ($berita->foto)
                <div class="news-detail-image">
                    <img src="{{ asset('uploads/berita/' . rawurlencode($berita->foto)) }}" alt="{{ $berita->judul }}">
                </div>
            @endif

            <!-- ISI BERITA -->
            <div class="news-detail-content">
                {!! nl2br(e($berita->deskripsi)) !!}
            </div>

            <!-- KEMBALI -->
            <a href="{{ url('/dashboard#berita') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Berita
            </a>

        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        &copy; {{ date('Y') }} Dana Pensiun Bank Riau Kepri
    </footer>

</body>

</html>
