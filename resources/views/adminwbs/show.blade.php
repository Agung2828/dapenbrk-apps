@extends('adminwbs.layout')

@section('page-title', 'Detail Laporan')

@section('content')
    <div class="wd">
        <style>
            .wd {
                --navy: #0f172a;
                --blue: #2563eb;
                --blue-soft: #eff6ff;
                --amber: #f59e0b;
                --red: #dc3545;
                --red2: #b91c1c;
                --green: #10b981;
                --bg: #f8fafc;
                --line: #e2e8f0;
                --muted: #64748b;
                --ink: #334155;
                font-family: inherit;
                color: var(--ink)
            }

            .wd * {
                box-sizing: border-box
            }

            /* ===== Animasi ===== */
            @keyframes wdUp {
                from {
                    opacity: 0;
                    transform: translateY(22px)
                }

                to {
                    opacity: 1;
                    transform: translateY(0)
                }
            }

            @keyframes wdPop {
                from {
                    opacity: 0;
                    transform: scale(.85)
                }

                to {
                    opacity: 1;
                    transform: scale(1)
                }
            }

            @keyframes wdSlideLeft {
                from {
                    opacity: 0;
                    transform: translateX(-16px)
                }

                to {
                    opacity: 1;
                    transform: translateX(0)
                }
            }

            @keyframes wdPulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(37, 99, 235, .35)
                }

                70% {
                    box-shadow: 0 0 0 12px rgba(37, 99, 235, 0)
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(37, 99, 235, 0)
                }
            }

            @keyframes wdZoom {
                from {
                    opacity: 0;
                    transform: scale(.88)
                }

                to {
                    opacity: 1;
                    transform: scale(1)
                }
            }

            .wd-anim {
                opacity: 0;
                animation: wdUp .6s cubic-bezier(.2, .7, .2, 1) forwards
            }

            /* ===== Alert ===== */
            .wd-alert {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 14px 18px;
                border-radius: 14px;
                background: #ecfdf5;
                border: 1px solid #a7f3d0;
                color: #065f46;
                font-weight: 600;
                font-size: 14px;
                margin-bottom: 18px
            }

            /* ===== Topbar ===== */
            .wd-topbar {
                position: relative;
                overflow: hidden;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
                gap: 14px;
                background: #fff;
                border: 1px solid var(--line);
                border-radius: 16px;
                padding: 20px 24px;
                margin-bottom: 20px;
                box-shadow: 0 8px 24px rgba(15, 23, 42, .05)
            }

            .wd-topbar::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, #3b82f6, #2563eb, #06b6d4)
            }

            .wd-eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                font-size: 11.5px;
                font-weight: 800;
                letter-spacing: .06em;
                text-transform: uppercase;
                color: var(--blue);
                background: var(--blue-soft);
                border: 1px solid #bfdbfe;
                padding: 4px 12px;
                border-radius: 50px;
                margin-bottom: 8px
            }

            .wd-title {
                font-size: 20px;
                font-weight: 800;
                color: var(--navy);
                margin: 0;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 6px
            }

            .wd-title code {
                background: var(--blue-soft);
                color: var(--blue);
                padding: 3px 10px;
                border-radius: 8px;
                font-size: 15px
            }

            .wd-meta {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 6px;
                font-size: 13px;
                color: var(--muted);
                margin-top: 6px
            }

            .wd-actions {
                display: flex;
                gap: 10px;
                flex-wrap: wrap
            }

            .wd-btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 18px;
                border-radius: 50px;
                font-size: 13.5px;
                font-weight: 700;
                text-decoration: none;
                cursor: pointer;
                border: none;
                transition: .25s
            }

            .wd-btn.ghost {
                background: #f1f5f9;
                color: var(--navy)
            }

            .wd-btn.ghost:hover {
                background: #e2e8f0
            }

            .wd-btn.ghost:hover i {
                transform: translateX(-3px)
            }

            .wd-btn i {
                transition: transform .25s
            }

            .wd-btn.outline {
                background: #fff;
                color: var(--red2);
                border: 1.5px solid #fecaca
            }

            .wd-btn.outline:hover {
                background: #fef2f2;
                transform: translateY(-2px)
            }

            .wd-btn.primary {
                background: linear-gradient(135deg, #3b82f6, #2563eb);
                color: #fff;
                width: 100%;
                justify-content: center;
                padding: 12px 18px;
                box-shadow: 0 8px 18px rgba(37, 99, 235, .3)
            }

            .wd-btn.primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 24px rgba(37, 99, 235, .38)
            }

            /* ===== Grid ===== */
            .wd-grid {
                display: grid;
                grid-template-columns: 1.7fr 1fr;
                gap: 20px;
                align-items: start
            }

            .wd-main,
            .wd-side {
                min-width: 0
            }

            @media(max-width:991px) {
                .wd-grid {
                    grid-template-columns: 1fr
                }
            }

            /* ===== Card ===== */
            .wd-card {
                background: #fff;
                border: 1px solid var(--line);
                border-radius: 16px;
                box-shadow: 0 6px 18px rgba(15, 23, 42, .04);
                margin-bottom: 18px;
                overflow: hidden;
                transition: box-shadow .3s, transform .3s
            }

            .wd-card:hover {
                box-shadow: 0 12px 28px rgba(15, 23, 42, .08)
            }

            .wd-card-head {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 16px 20px;
                font-weight: 800;
                font-size: 15px;
                color: var(--navy);
                background: linear-gradient(180deg, #f8fafc, #fff);
                border-bottom: 1px solid var(--line)
            }

            .wd-card-head i {
                color: var(--blue)
            }

            .wd-count {
                margin-left: auto;
                font-size: 11.5px;
                font-weight: 800;
                background: var(--blue-soft);
                color: var(--blue);
                padding: 3px 12px;
                border-radius: 50px
            }

            .wd-card-body {
                padding: 20px
            }

            .wd-empty {
                color: var(--muted);
                font-style: italic;
                font-size: 13.5px;
                margin: 0
            }

            /* ===== Data Pelapor ===== */
            .wd-anon-note {
                display: flex;
                align-items: center;
                gap: 10px;
                background: var(--blue-soft);
                border: 1px solid #bfdbfe;
                color: var(--navy);
                padding: 14px 16px;
                border-radius: 12px;
                font-size: 14px
            }

            .wd-anon-note i {
                font-size: 18px;
                color: var(--blue)
            }

            .wd-info-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 14px 20px
            }

            .wd-info-grid .span2 {
                grid-column: 1/-1
            }

            .wd-info-grid span {
                display: block;
                font-size: 11.5px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .04em;
                color: var(--muted);
                margin-bottom: 3px
            }

            .wd-info-grid strong {
                font-size: 14.5px;
                color: #1f2937;
                word-break: break-word
            }

            @media(max-width:560px) {
                .wd-info-grid {
                    grid-template-columns: 1fr
                }
            }

            /* ===== Rincian Kejadian ===== */
            .wd-chip {
                display: inline-flex;
                align-items: center;
                gap: 7px;
                padding: 6px 16px;
                border-radius: 50px;
                font-size: 13px;
                font-weight: 800;
                margin-bottom: 16px
            }

            .wd-chip.kat {
                background: #fffbeb;
                color: #92400e;
                border: 1.5px solid #fbbf24
            }

            .wd-block {
                margin-top: 14px
            }

            .wd-block-label {
                display: flex;
                align-items: center;
                gap: 7px;
                font-size: 12px;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: .04em;
                color: var(--muted);
                margin-bottom: 6px
            }

            .wd-block-label i {
                color: var(--blue)
            }

            .wd-block p {
                background: #f8fafc;
                border: 1px solid var(--line);
                border-left: 4px solid var(--blue);
                border-radius: 10px;
                padding: 12px 16px;
                font-size: 14px;
                line-height: 1.7;
                white-space: pre-line;
                margin: 0;
                color: #1f2937;
                word-break: break-word
            }

            /* ===== Daftar Terlapor ===== */
            .wd-terlapor {
                display: flex;
                gap: 14px;
                padding: 14px 0;
                border-bottom: 1px dashed var(--line);
                opacity: 0;
                animation: wdSlideLeft .5s ease forwards
            }

            .wd-terlapor:last-child {
                border-bottom: none;
                padding-bottom: 0
            }

            .wd-terlapor:first-child {
                padding-top: 0
            }

            .wd-terlapor>div:last-child {
                min-width: 0
            }

            .wd-terlapor-badge {
                flex-shrink: 0;
                width: 34px;
                height: 34px;
                border-radius: 10px;
                background: linear-gradient(135deg, #3b82f6, #2563eb);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                font-size: 14px
            }

            .wd-terlapor strong {
                font-size: 14.5px;
                color: #1f2937
            }

            .wd-terlapor-jab {
                display: inline-block;
                margin-left: 8px;
                font-size: 12px;
                font-weight: 700;
                color: var(--red2);
                background: #fff5f5;
                border: 1px solid #fecaca;
                padding: 2px 10px;
                border-radius: 50px
            }

            .wd-terlapor-info {
                margin: 6px 0 0;
                font-size: 13px;
                color: var(--muted)
            }

            /* ===== Bukti: galeri foto ===== */
            .wd-gallery {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
                gap: 12px;
                margin-bottom: 16px
            }

            .wd-photo {
                position: relative;
                display: block;
                border-radius: 14px;
                overflow: hidden;
                aspect-ratio: 1/1;
                background: var(--bg);
                border: 1.5px solid var(--line);
                cursor: zoom-in;
                transition: .25s;
                opacity: 0;
                animation: wdPop .5s ease forwards
            }

            .wd-photo:hover {
                border-color: var(--blue);
                box-shadow: 0 10px 22px rgba(37, 99, 235, .18);
                transform: translateY(-3px)
            }

            .wd-photo img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .4s
            }

            .wd-photo:hover img {
                transform: scale(1.08)
            }

            .wd-photo-overlay {
                position: absolute;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(15, 23, 42, 0);
                color: #fff;
                opacity: 0;
                transition: .25s;
                font-size: 20px
            }

            .wd-photo:hover .wd-photo-overlay {
                opacity: 1;
                background: rgba(15, 23, 42, .4)
            }

            .wd-photo-name {
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                padding: 6px 8px 5px;
                font-size: 10.5px;
                font-weight: 600;
                color: #fff;
                background: linear-gradient(0deg, rgba(15, 23, 42, .85), transparent);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis
            }

            /* ===== Bukti: file lain ===== */
            .wd-filelist {
                display: flex;
                flex-direction: column;
                gap: 10px
            }

            .wd-fileitem {
                opacity: 0;
                animation: wdSlideLeft .5s ease forwards
            }

            .wd-file {
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 12px 14px;
                border: 1px solid var(--line);
                border-radius: 14px;
                background: #fafcff;
                transition: .25s
            }

            .wd-file:hover {
                border-color: #bfdbfe;
                box-shadow: 0 6px 16px rgba(37, 99, 235, .08)
            }

            .wd-file-ic {
                flex-shrink: 0;
                width: 42px;
                height: 42px;
                border-radius: 12px;
                background: linear-gradient(135deg, #3b82f6, #2563eb);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 17px
            }

            .wd-file-info {
                flex: 1;
                min-width: 0
            }

            .wd-file-info strong {
                display: block;
                font-size: 13.5px;
                color: #1f2937;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis
            }

            .wd-file-info span {
                font-size: 11.5px;
                color: var(--muted)
            }

            .wd-file-view {
                flex-shrink: 0;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 7px 14px;
                border-radius: 50px;
                background: var(--blue-soft);
                color: var(--blue);
                border: 1px solid #bfdbfe;
                font-size: 12.5px;
                font-weight: 700;
                text-decoration: none;
                transition: .2s
            }

            .wd-file-view:hover {
                background: var(--blue);
                color: #fff
            }

            .wd-media {
                width: 100%;
                border-radius: 14px;
                margin: 8px 0 2px;
                background: #000
            }

            audio.wd-media {
                background: #fafcff;
                height: 42px
            }

            /* ===== Sidebar: status ===== */
            .wd-status-card .wd-card-body {
                text-align: center
            }

            .wd-status-label {
                display: block;
                font-size: 12px;
                font-weight: 700;
                color: var(--muted);
                text-transform: uppercase;
                letter-spacing: .05em;
                margin-bottom: 10px
            }

            .wd-status-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 9px 22px;
                border-radius: 50px;
                font-size: 14px;
                font-weight: 800;
                color: #fff;
                animation: wdPulse 2.4s infinite
            }

            .wd-status-badge.status-diajukan {
                background: #6b7280
            }

            .wd-status-badge.status-diterima {
                background: var(--blue)
            }

            .wd-status-badge.status-dalam_antrian {
                background: var(--amber)
            }

            .wd-status-badge.status-diproses {
                background: #06b6d4
            }

            .wd-status-badge.status-ditolak {
                background: var(--red)
            }

            .wd-status-badge.status-selesai {
                background: var(--green)
            }

            .wd-status-time {
                margin-top: 10px;
                font-size: 12.5px;
                color: var(--muted)
            }

            /* ===== Form ubah status ===== */
            .wd-form-group {
                margin-bottom: 16px
            }

            .wd-form-group label {
                display: block;
                font-size: 13px;
                font-weight: 700;
                color: #374151;
                margin-bottom: 6px
            }

            .wd-select,
            .wd-textarea {
                width: 100%;
                padding: 11px 14px;
                border: 1.5px solid var(--line);
                border-radius: 10px;
                font-size: 14px;
                font-family: inherit;
                background: #fff;
                color: var(--ink);
                transition: .2s
            }

            .wd-select:focus,
            .wd-textarea:focus {
                outline: none;
                border-color: var(--blue);
                box-shadow: 0 0 0 4px rgba(37, 99, 235, .12)
            }

            .wd-textarea {
                resize: vertical
            }

            /* ===== Lightbox ===== */
            .wd-lightbox {
                position: fixed;
                inset: 0;
                z-index: 99999;
                background: rgba(15, 23, 42, .92);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 30px;
                opacity: 0;
                pointer-events: none;
                transition: opacity .25s
            }

            .wd-lightbox.show {
                opacity: 1;
                pointer-events: auto
            }

            .wd-lightbox.show img {
                animation: wdZoom .35s cubic-bezier(.2, .8, .2, 1)
            }

            .wd-lightbox img {
                max-width: 100%;
                max-height: 100%;
                border-radius: 12px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, .5)
            }

            .wd-lightbox-close {
                position: absolute;
                top: 20px;
                right: 24px;
                width: 42px;
                height: 42px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .12);
                color: #fff;
                border: none;
                font-size: 18px;
                cursor: pointer;
                transition: .2s
            }

            .wd-lightbox-close:hover {
                background: rgba(255, 255, 255, .25);
                transform: rotate(90deg)
            }

            /* ===== Responsif kecil ===== */
            @media(max-width:576px) {
                .wd-topbar {
                    padding: 16px
                }

                .wd-title {
                    font-size: 17px
                }

                .wd-actions {
                    width: 100%
                }

                .wd-actions .wd-btn {
                    flex: 1;
                    justify-content: center
                }

                /* tombol back sudah ada di header pada mobile */
                .wd-actions .wd-btn.ghost {
                    display: none
                }

                .wd-card-body {
                    padding: 16px
                }

                .wd-file {
                    flex-wrap: wrap
                }

                .wd-lightbox {
                    padding: 14px
                }
            }

            @media (prefers-reduced-motion: reduce) {

                .wd *,
                .wd-lightbox,
                .wd-lightbox * {
                    animation-duration: .01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: .01ms !important
                }
            }
        </style>

        @if (session('success'))
            <div class="wd-alert wd-anim"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <div class="wd-topbar wd-anim">
            <div>
                <span class="wd-eyebrow"><i class="fas fa-shield-halved"></i> Whistleblowing System</span>
                <h1 class="wd-title">Detail Laporan <code>{{ $laporan->ticket_token }}</code></h1>
                <div class="wd-meta">
                    <i class="far fa-clock"></i>
                    Dilaporkan {{ $laporan->created_at->translatedFormat('d F Y, H:i') }}
                    ({{ $laporan->created_at->diffForHumans() }})
                </div>
            </div>
            <div class="wd-actions">
                <a href="{{ route('adminwbs.dashboard') }}" class="wd-btn ghost"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
                <a href="{{ route('adminwbs.laporan.pdf', $laporan) }}" class="wd-btn outline"><i
                        class="fas fa-file-pdf"></i> Download PDF</a>
            </div>
        </div>

        <div class="wd-grid">
            {{-- ===== KOLOM UTAMA ===== --}}
            <div class="wd-main">

                {{-- Data Pelapor --}}
                <div class="wd-card wd-anim" style="animation-delay:100ms">
                    <div class="wd-card-head"><i class="fas fa-user-shield"></i> Data Pelapor</div>
                    <div class="wd-card-body">
                        @if ($laporan->is_anonim)
                            <div class="wd-anon-note">
                                <i class="fas fa-user-secret"></i>
                                <div>Pelapor memilih melapor secara <strong>Anonim (Rahasia)</strong>. Identitas
                                    tidak dicantumkan dalam laporan ini.</div>
                            </div>
                        @else
                            <div class="wd-info-grid">
                                <div><span>Nama</span><strong>{{ $laporan->nama_lengkap ?: '-' }}</strong></div>
                                <div><span>Hubungan dengan DAPEN</span>
                                    <strong>{{ $laporan->hubungan_dapen ?: '-' }}</strong>
                                </div>
                                <div><span>No. Identitas</span>
                                    <strong>{{ $laporan->nomor_identitas ?: '-' }}</strong>
                                </div>
                                <div><span>No. Kontak</span><strong>{{ $laporan->no_kontak ?: '-' }}</strong></div>
                                <div class="span2"><span>Email</span>
                                    <strong>{{ $laporan->email_pribadi ?: '-' }}</strong>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Rincian Kejadian --}}
                <div class="wd-card wd-anim" style="animation-delay:200ms">
                    <div class="wd-card-head"><i class="fas fa-triangle-exclamation"></i> Rincian Kejadian</div>
                    <div class="wd-card-body">
                        <span class="wd-chip kat"><i class="fas fa-tag"></i>
                            {{ $laporan->kategori_pengaduan }}</span>
                        <div class="wd-block">
                            <span class="wd-block-label"><i class="fas fa-file-lines"></i> Deskripsi Kejadian</span>
                            <p>{{ $laporan->deskripsi_kejadian }}</p>
                        </div>
                        <div class="wd-block">
                            <span class="wd-block-label"><i class="fas fa-coins"></i> Deskripsi Kerugian</span>
                            <p>{{ $laporan->deskripsi_kerugian ?: '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Daftar Terlapor --}}
                <div class="wd-card wd-anim" style="animation-delay:300ms">
                    <div class="wd-card-head"><i class="fas fa-users"></i> Daftar Terlapor
                        <span class="wd-count">{{ $laporan->terlapors->count() }} orang</span>
                    </div>
                    <div class="wd-card-body">
                        @forelse ($laporan->terlapors as $i => $t)
                            <div class="wd-terlapor" style="animation-delay: {{ 450 + $i * 90 }}ms">
                                <div class="wd-terlapor-badge">{{ $i + 1 }}</div>
                                <div>
                                    <strong>{{ $t->nama_terlapor }}</strong>
                                    @if ($t->jabatan_terlapor)
                                        <span class="wd-terlapor-jab">{{ $t->jabatan_terlapor }}</span>
                                    @endif
                                    @if ($t->info_tambahan_terlapor)
                                        <p class="wd-terlapor-info">{{ $t->info_tambahan_terlapor }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="wd-empty">Tidak ada data terlapor.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Bukti Pendukung --}}
                @php
                    $semuaBukti = $laporan->buktiPendukung ?? ($laporan->bukti ?? collect());
                    $fotoBukti = $semuaBukti->filter(function ($b) {
                        $ext = strtolower($b->ekstensi ?? pathinfo($b->nama_file_asli, PATHINFO_EXTENSION));
                        return ($b->jenis_bukti ?? null) === 'gambar' ||
                            in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    });
                    $fileLain = $semuaBukti->diff($fotoBukti);
                @endphp
                <div class="wd-card wd-anim" style="animation-delay:400ms">
                    <div class="wd-card-head"><i class="fas fa-paperclip"></i> Bukti Pendukung
                        <span class="wd-count">{{ $semuaBukti->count() }} file</span>
                    </div>
                    <div class="wd-card-body">
                        @if ($semuaBukti->isEmpty())
                            <p class="wd-empty">Tidak ada bukti dilampirkan.</p>
                        @else
                            @if ($fotoBukti->count())
                                <div class="wd-gallery">
                                    @foreach ($fotoBukti as $g)
                                        <a href="{{ Storage::url($g->path_file) }}" class="wd-photo js-lightbox"
                                            style="animation-delay: {{ 550 + $loop->index * 80 }}ms"
                                            data-full="{{ Storage::url($g->path_file) }}"
                                            title="{{ $g->nama_file_asli }}">
                                            <img src="{{ Storage::url($g->path_file) }}" alt="{{ $g->nama_file_asli }}"
                                                loading="lazy">
                                            <span class="wd-photo-overlay"><i
                                                    class="fas fa-magnifying-glass-plus"></i></span>
                                            <span class="wd-photo-name">{{ $g->nama_file_asli }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            @if ($fileLain->count())
                                <div class="wd-filelist">
                                    @foreach ($fileLain as $f)
                                        @php
                                            $ext = strtolower(
                                                $f->ekstensi ?? pathinfo($f->nama_file_asli, PATHINFO_EXTENSION),
                                            );
                                            $isAudio = in_array($ext, ['mp3', 'wav', 'ogg', 'm4a', 'aac']);
                                            $isVideo = in_array($ext, ['mp4', 'mov', 'avi', 'mkv', 'webm', '3gp']);
                                            $icon = match (true) {
                                                $isAudio => 'fa-file-audio',
                                                $isVideo => 'fa-file-video',
                                                $ext === 'pdf' => 'fa-file-pdf',
                                                in_array($ext, ['doc', 'docx']) => 'fa-file-word',
                                                default => 'fa-file',
                                            };
                                            $url = Storage::url($f->path_file);
                                        @endphp
                                        <div class="wd-fileitem" style="animation-delay: {{ 550 + $loop->index * 80 }}ms">
                                            <div class="wd-file">
                                                <div class="wd-file-ic"><i class="fas {{ $icon }}"></i></div>
                                                <div class="wd-file-info">
                                                    <strong
                                                        title="{{ $f->nama_file_asli }}">{{ $f->nama_file_asli }}</strong>
                                                    <span>{{ $f->ukuran_bytes ? number_format($f->ukuran_bytes / 1024, 0) . ' KB' : '' }}</span>
                                                </div>
                                                @unless ($isAudio || $isVideo)
                                                    <a href="{{ $url }}" target="_blank" class="wd-file-view"><i
                                                            class="fas fa-eye"></i> Lihat</a>
                                                @endunless
                                            </div>
                                            @if ($isAudio)
                                                <audio controls preload="metadata" class="wd-media"
                                                    src="{{ $url }}"></audio>
                                            @elseif ($isVideo)
                                                <video controls preload="metadata" class="wd-media"
                                                    src="{{ $url }}"></video>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            {{-- ===== SIDEBAR ===== --}}
            <div class="wd-side">
                <div class="wd-card wd-status-card wd-anim" style="animation-delay:150ms">
                    <div class="wd-card-body">
                        <span class="wd-status-label">Status Saat Ini</span>
                        <span class="wd-status-badge status-{{ $laporan->status }}">
                            <i class="fas fa-circle-info"></i>
                            {{ \App\Support\WbsOptions::statusList()[$laporan->status] ?? $laporan->status }}
                        </span>
                        <div class="wd-status-time">Diperbarui {{ $laporan->updated_at->diffForHumans() }}</div>
                    </div>
                </div>

                <div class="wd-card wd-anim" style="animation-delay:250ms">
                    <div class="wd-card-head"><i class="fas fa-gear"></i> Ubah Status Laporan</div>
                    <div class="wd-card-body">
                        <form method="POST" action="{{ route('adminwbs.laporan.updateStatus', $laporan) }}">
                            @csrf
                            @method('PUT')
                            <div class="wd-form-group">
                                <label>Status</label>
                                <select name="status" class="wd-select" required>
                                    @foreach (\App\Support\WbsOptions::statusList() as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ $laporan->status == $key ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="wd-form-group">
                                <label>Catatan untuk Pelapor (opsional)</label>
                                <textarea name="catatan_admin" class="wd-textarea" rows="3">{{ $laporan->catatan_admin }}</textarea>
                            </div>
                            <button class="wd-btn primary"><i class="fas fa-save"></i> Simpan Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Lightbox foto bukti --}}
    <div id="wdLightbox" class="wd-lightbox">
        <button type="button" class="wd-lightbox-close" aria-label="Tutup"><i class="fas fa-xmark"></i></button>
        <img id="wdLightboxImg" src="" alt="">
    </div>

    <script>
        (function() {
            const box = document.getElementById('wdLightbox');
            const img = document.getElementById('wdLightboxImg');

            function open(src, alt) {
                img.src = src;
                img.alt = alt || '';
                box.classList.add('show');
            }

            function close() {
                box.classList.remove('show');
                setTimeout(() => {
                    if (!box.classList.contains('show')) img.src = '';
                }, 250);
            }

            document.querySelectorAll('.js-lightbox').forEach(a => {
                a.addEventListener('click', e => {
                    e.preventDefault();
                    open(a.dataset.full, a.getAttribute('title'));
                });
            });

            box.addEventListener('click', e => {
                if (e.target === box) close();
            });
            box.querySelector('.wd-lightbox-close').addEventListener('click', close);
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') close();
            });
        })();
    </script>
@endsection
