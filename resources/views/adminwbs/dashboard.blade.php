@extends('adminwbs.layout')

@section('page-title', 'Dashboard')

@push('styles')
    <style>
        .stat-link {
            text-decoration: none;
            color: inherit;
            display: block;
            height: 100%;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            overflow: hidden;
            transition: transform .25s, box-shadow .25s, border-color .25s;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 3px;
            background: var(--c);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .35s ease;
        }

        .stat-link:hover .stat-card {
            transform: translateY(-4px);
            box-shadow: 0 12px 26px rgba(15, 23, 42, .1);
            border-color: transparent;
        }

        .stat-link:hover .stat-card::after,
        .stat-link.is-active .stat-card::after {
            transform: scaleX(1);
        }

        .stat-link.is-active .stat-card {
            border-color: var(--c);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            transition: transform .3s;
        }

        .stat-link:hover .stat-icon {
            transform: rotate(-8deg) scale(1.12);
        }

        .stat-value {
            font-size: 24px;
            font-weight: 800;
            line-height: 1;
            color: #0f172a;
        }

        .stat-label {
            font-size: 12.5px;
            color: #64748b;
            margin-top: 5px;
        }

        .panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px;
        }

        .panel-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .table thead th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #64748b;
            font-weight: 600;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        .table td {
            font-size: 14px;
            vertical-align: middle;
        }

        .table tbody tr {
            opacity: 0;
            animation: fadeUp .5s ease forwards;
            transition: background .2s;
        }

        .table code {
            color: #2563eb;
            background: #eff6ff;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 12.5px;
        }

        .btn-icon {
            width: 34px;
            height: 34px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform .2s, background .2s, color .2s;
        }

        .btn-icon:hover {
            transform: translateY(-2px);
        }

        .btn-lihat {
            transition: transform .2s, box-shadow .2s;
        }

        .btn-lihat:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(37, 99, 235, .25);
        }

        .btn-lihat i {
            transition: transform .25s;
        }

        .btn-lihat:hover i {
            transform: translateX(3px);
        }

        /* Modal animasi zoom halus */
        .modal.fade .modal-dialog {
            transform: scale(.92) translateY(20px);
            transition: transform .3s cubic-bezier(.2, .8, .2, 1), opacity .3s;
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        .modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, .25);
        }

        .modal-header,
        .modal-footer {
            border-color: #f1f5f9;
        }

        .filter-info {
            font-size: 13px;
            color: #64748b;
        }

        @media (max-width: 576px) {
            .panel {
                padding: 14px;
            }

            .stat-card {
                padding: 12px;
                gap: 10px;
            }

            .stat-icon {
                width: 38px;
                height: 38px;
                font-size: 17px;
            }

            .stat-value {
                font-size: 20px;
            }
        }
    </style>
@endpush

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show anim-fade-up" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @php
        $cards = [
            [
                'key' => '',
                'label' => 'Total Laporan',
                'val' => $stats['total'],
                'icon' => 'bi-inbox-fill',
                'color' => '#2563eb',
            ],
            [
                'key' => 'diajukan',
                'label' => 'Diajukan (Baru)',
                'val' => $stats['diajukan'],
                'icon' => 'bi-exclamation-triangle-fill',
                'color' => '#ef4444',
            ],
            [
                'key' => 'diterima',
                'label' => 'Diterima',
                'val' => $stats['diterima'],
                'icon' => 'bi-check2-square',
                'color' => '#3b82f6',
            ],
            [
                'key' => 'dalam_antrian',
                'label' => 'Dalam Antrian',
                'val' => $stats['dalam_antrian'],
                'icon' => 'bi-clock-fill',
                'color' => '#f59e0b',
            ],
            [
                'key' => 'diproses',
                'label' => 'Diproses',
                'val' => $stats['diproses'],
                'icon' => 'bi-gear-fill',
                'color' => '#06b6d4',
            ],
            [
                'key' => 'selesai',
                'label' => 'Selesai',
                'val' => $stats['selesai'],
                'icon' => 'bi-check-circle-fill',
                'color' => '#10b981',
            ],
        ];
        $colors = [
            'diajukan' => 'secondary',
            'diterima' => 'primary',
            'dalam_antrian' => 'warning',
            'diproses' => 'info',
            'ditolak' => 'danger',
            'selesai' => 'success',
        ];
        $filterAktif = request('status') || request('q');
    @endphp

    {{-- ===== KARTU STATISTIK (klik untuk memfilter) ===== --}}
    <div class="row g-3 mb-4">
        @foreach ($cards as $i => $c)
            <div class="col-6 col-md-4 col-xl-2 anim-fade-up" style="animation-delay: {{ $i * 80 }}ms;">
                <a href="{{ route('adminwbs.dashboard', $c['key'] ? ['status' => $c['key']] : []) }}#daftarLaporan"
                    class="stat-link {{ request('status') == $c['key'] && $c['key'] !== '' ? 'is-active' : '' }}"
                    style="--c: {{ $c['color'] }};" title="Lihat laporan: {{ $c['label'] }}">
                    <div class="stat-card">
                        <div class="stat-icon" style="background:{{ $c['color'] }}1a;color:{{ $c['color'] }};">
                            <i class="bi {{ $c['icon'] }}"></i>
                        </div>
                        <div>
                            <div class="stat-value" data-count="{{ $c['val'] }}">0</div>
                            <div class="stat-label">{{ $c['label'] }}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- ===== FILTER + TABEL ===== --}}
    <div class="panel anim-fade-up" id="daftarLaporan" style="animation-delay: 520ms;">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h6 class="panel-title">Daftar Laporan WBS</h6>
                @if ($filterAktif)
                    <div class="filter-info mt-1">
                        <i class="bi bi-funnel-fill"></i> Filter aktif &middot; {{ $laporans->total() }} laporan ditemukan
                    </div>
                @endif
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('adminwbs.dashboard') }}#daftarLaporan" class="btn btn-outline-primary btn-sm btn-lihat">
                    <i class="bi bi-list-ul"></i> Lihat Semua Laporan
                </a>
                <a href="{{ route('adminwbs.laporan.create') }}" class="btn btn-primary btn-sm btn-lihat">
                    <i class="bi bi-plus-lg"></i> Buat Laporan
                </a>
            </div>
        </div>

        <form method="GET" action="{{ route('adminwbs.dashboard') }}#daftarLaporan" class="row g-2 mb-3">
            <div class="col-12 col-sm-auto">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">-- Semua Status --</option>
                    @foreach ($statusList as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-8 col-sm-auto flex-grow-1 flex-sm-grow-0" style="min-width:220px;">
                <input type="text" name="q" class="form-control form-control-sm"
                    placeholder="Cari tiket/nama/kategori..." value="{{ request('q') }}">
            </div>
            <div class="col-4 col-sm-auto">
                <button class="btn btn-outline-secondary btn-sm w-100"><i class="bi bi-search"></i> Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Tiket</th>
                        <th>Pelapor</th>
                        <th class="d-none d-md-table-cell">Kategori</th>
                        <th>Status</th>
                        <th class="d-none d-lg-table-cell">Tanggal</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporans as $l)
                        <tr style="animation-delay: {{ 600 + $loop->index * 60 }}ms;">
                            <td><code>{{ $l->ticket_token }}</code></td>
                            <td>{{ $l->is_anonim ? 'Anonim' : ($l->nama_lengkap ?: '-') }}</td>
                            <td class="d-none d-md-table-cell">{{ $l->kategori_pengaduan }}</td>
                            <td>
                                <span class="badge bg-{{ $colors[$l->status] ?? 'secondary' }}">
                                    {{ $statusList[$l->status] ?? $l->status }}
                                </span>
                            </td>
                            <td class="small text-muted d-none d-lg-table-cell">
                                {{ $l->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('adminwbs.laporan.show', $l) }}"
                                        class="btn btn-sm btn-outline-primary btn-icon" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('adminwbs.laporan.pdf', $l) }}"
                                        class="btn btn-sm btn-outline-danger btn-icon" title="Download PDF">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-icon"
                                        title="Ubah Status" data-bs-toggle="modal"
                                        data-bs-target="#statusModal{{ $l->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr style="animation-delay: 600ms;">
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada laporan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $laporans->links() }}</div>
    </div>

    {{-- ===== MODAL UBAH STATUS (di luar tabel agar HTML valid) ===== --}}
    @foreach ($laporans as $l)
        <div class="modal fade" id="statusModal{{ $l->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form method="POST" action="{{ route('adminwbs.laporan.updateStatus', $l) }}" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h6 class="modal-title">Ubah Status &mdash; <code>{{ $l->ticket_token }}</code></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                @foreach ($statusList as $key => $label)
                                    <option value="{{ $key }}" {{ $l->status == $key ? 'selected' : '' }}>
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Catatan untuk Pelapor (opsional)</label>
                            <textarea name="catatan_admin" class="form-control" rows="3">{{ $l->catatan_admin }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        // Animasi hitung naik untuk angka statistik
        (function() {
            const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            document.querySelectorAll('[data-count]').forEach(el => {
                const target = parseInt(el.dataset.count, 10) || 0;
                if (reduce || target === 0) {
                    el.textContent = target;
                    return;
                }
                const duration = 900;
                const start = performance.now();

                function tick(now) {
                    const p = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - p, 3);
                    el.textContent = Math.round(target * eased);
                    if (p < 1) requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);
            });

            // Scroll halus ke daftar laporan bila datang dari filter/kartu statistik
            if (location.hash === '#daftarLaporan') {
                setTimeout(() => {
                    const el = document.getElementById('daftarLaporan');
                    if (el) el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 350);
            }
        })();
    </script>
@endpush
