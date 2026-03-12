<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - Dana Pensiun Bank Riau Kepri</title>
    <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($berita->deskripsi), 150) }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #1a202c;
        }

        .main-header {
            background: #fff;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .main-header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.2rem 2rem;
        }

        .logo img {
            height: 50px;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .article-container {
            max-width: 900px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }

        .article-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeInUp 0.6s ease;
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

        .article-header {
            padding: 3rem 3rem 1.5rem;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .category-badge {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: #fff;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
        }

        .article-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            font-size: 0.95rem;
        }

        .article-date i {
            color: #dc2626;
        }

        .article-title {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.3;
            color: #111827;
            margin-bottom: 1.5rem;
        }

        .featured-image-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .featured-image {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }

        .featured-image-wrapper:hover .featured-image {
            transform: scale(1.05);
        }

        .article-content {
            padding: 3rem;
            font-size: 1.1rem;
            line-height: 1.9;
            color: #374151;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .back-button {
            margin: 2rem 3rem 3rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
        }

        .back-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.4);
        }

        .back-link i {
            transition: transform 0.3s ease;
        }

        .back-link:hover i {
            transform: translateX(-5px);
        }

        .main-footer {
            margin-top: 5rem;
            padding: 2.5rem 2rem;
            background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
            color: #e5e7eb;
            text-align: center;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.1);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-content p {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        @media (max-width: 768px) {

            .article-header,
            .article-content,
            .back-button {
                padding: 2rem 1.5rem;
            }

            .article-title {
                font-size: 1.8rem;
            }

            .article-content {
                font-size: 1rem;
            }

            .article-meta {
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .article-title {
                font-size: 1.5rem;
            }

            .category-badge {
                font-size: 0.75rem;
                padding: 0.4rem 1rem;
            }
        }
    </style>
</head>

<body>

    <header class="main-header">
        <div class="container">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('image/logo.png') }}" alt="Logo Dana Pensiun Bank Riau Kepri">
            </a>
        </div>
    </header>

    <main class="article-container">
        <article class="article-card">
            <div class="article-header">
                <div class="article-meta">
                    <span class="category-badge">
                        {{ strtoupper($berita->kategori) }}
                    </span>
                    <span class="article-date">
                        <i class="far fa-calendar-alt"></i>
                        {{ \Carbon\Carbon::parse($berita->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
                    </span>
                </div>

                <h1 class="article-title">
                    {{ $berita->judul }}
                </h1>
            </div>

            @if ($berita->foto)
                <div class="featured-image-wrapper">
                    <img src="{{ asset('uploads/berita/' . rawurlencode(basename($berita->foto))) }}"
                        alt="{{ $berita->judul }}" class="featured-image">
                </div>
            @endif

            <div class="article-content">
                {!! nl2br(e($berita->deskripsi)) !!}
            </div>

            <div class="back-button">
                <a href="{{ route('dashboard') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </article>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} Dana Pensiun Bank Riau Kepri. Semua Hak Dilindungi.</p>
        </div>
    </footer>

</body>

</html>
