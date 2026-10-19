@extends('layout.admin.index')

@section('page-title', 'Berita & Informasi')

@push('styles')
    <style>
        .panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px;
            animation: fadeUp .45s ease both;
        }

        .panel-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .panel-sub {
            font-size: 13px;
            color: #64748b;
        }

        /* ===== Tabel (tablet & desktop) ===== */
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
            animation: fadeUp .45s ease forwards;
        }

        .thumb {
            width: 84px;
            height: 58px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #f1f5f9;
        }

        .thumb-empty {
            width: 84px;
            height: 58px;
            border-radius: 8px;
            border: 1px dashed #cbd5e1;
            background: #f8fafc;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .judul-cell {
            max-width: 380px;
        }

        /* ===== Kartu (mobile) ===== */
        .news-card {
            display: flex;
            gap: 12px;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            background: #fff;
            margin-bottom: 12px;
            opacity: 0;
            animation: fadeUp .45s ease forwards;
        }

        .news-card:last-child {
            margin-bottom: 0;
        }

        .news-card .thumb,
        .news-card .thumb-empty {
            width: 82px;
            height: 82px;
            flex-shrink: 0;
        }

        .news-body {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .news-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.35;
            margin: 6px 0 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-break: break-word;
        }

        .news-meta {
            font-size: 12px;
            color: #64748b;
        }

        .news-actions {
            margin-top: auto;
            padding-top: 8px;
            display: flex;
            justify-content: flex-end;
        }

        .badge-kat {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 50px;
            background: #eff6ff;
            color: #2563eb;
        }

        .empty-state {
            text-align: center;
            padding: 48px 12px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 44px;
            display: block;
            margin-bottom: 8px;
        }

        /* ===== Modal konfirmasi hapus ===== */
        .modal.fade .modal-dialog {
            transform: scale(.9) translateY(16px);
            transition: transform .3s cubic-bezier(.2, .8, .2, 1), opacity .3s;
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        .modal-confirm .modal-content {
            border: none;
            border-radius: 18px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, .28);
            overflow: hidden;
        }

        .modal-confirm .modal-body {
            padding: 28px 24px 8px;
            text-align: center;
        }

        .confirm-icon {
            width: 68px;
            height: 68px;
            margin: 0 auto 14px;
            border-radius: 50%;
            background: #fef2f2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            animation: popIn .45s cubic-bezier(.2, .9, .3, 1.4);
        }

        @keyframes popIn {
            from {
                transform: scale(.4);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .confirm-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .confirm-text {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 16px;
        }

        .confirm-item {
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
        }

        .confirm-item img,
        .confirm-item .ph {
            width: 54px;
            height: 54px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
            background: #e2e8f0;
        }

        .confirm-item .ph {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 20px;
        }

        .confirm-item .ci-title {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-break: break-word;
        }

        .confirm-item .ci-kat {
            font-size: 12px;
            color: #64748b;
            margin-top: 2px;
        }

        .modal-confirm .modal-footer {
            border: none;
            padding: 16px 24px 24px;
            gap: 10px;
            justify-content: center;
        }

        .modal-confirm .modal-footer .btn {
            flex: 1;
            border-radius: 10px;
            padding: 10px 14px;
            font-weight: 600;
        }

        /* ===== CONTENT ===== */
        .content-area {
            padding: 28px;
            flex: 1;
            min-width: 0;
            animation: fadeUp .5s ease backwards;
        }

        @media (max-width: 576px) {
            .panel {
                padding: 14px;
            }

            .btn-tambah {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="panel">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <h5 class="panel-title">Daftar Berita &amp; Informasi</h5>
                <div class="panel-sub">{{ count($berita) }} berita</div>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-tambah">
                <i class="bi bi-plus-lg"></i> Tambah Berita
            </a>
        </div>

        @if (count($berita) === 0)
            <div class="empty-state">
                <i class="bi bi-newspaper"></i>
                Belum ada berita.
            </div>
        @else
            {{-- ===== TABEL: tablet & desktop ===== --}}
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($berita as $item)
                            <tr style="animation-delay: {{ $loop->index * 50 }}ms;">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($item->foto)
                                        <img src="{{ asset('uploads/berita/' . $item->foto) }}" class="thumb"
                                            alt="{{ $item->judul }}" loading="lazy">
                                    @else
                                        <div class="thumb-empty"><i class="bi bi-image"></i></div>
                                    @endif
                                </td>
                                <td><span class="badge-kat">{{ $item->kategori }}</span></td>
                                <td class="judul-cell">{{ $item->judul }}</td>
                                <td class="text-nowrap">{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-hapus"
                                        data-action="{{ route('admin.berita.destroy', $item->id) }}"
                                        data-judul="{{ $item->judul }}" data-kategori="{{ $item->kategori }}"
                                        data-foto="{{ $item->foto ? asset('uploads/berita/' . $item->foto) : '' }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- ===== KARTU: mobile ===== --}}
            <div class="d-md-none">
                @foreach ($berita as $item)
                    <div class="news-card" style="animation-delay: {{ $loop->index * 60 }}ms;">
                        @if ($item->foto)
                            <img src="{{ asset('uploads/berita/' . $item->foto) }}" class="thumb"
                                alt="{{ $item->judul }}" loading="lazy">
                        @else
                            <div class="thumb-empty"><i class="bi bi-image"></i></div>
                        @endif

                        <div class="news-body">
                            <div><span class="badge-kat">{{ $item->kategori }}</span></div>
                            <div class="news-title">{{ $item->judul }}</div>
                            <div class="news-meta">
                                <i class="bi bi-calendar3"></i> {{ date('d-m-Y', strtotime($item->tanggal)) }}
                            </div>
                            <div class="news-actions">
                                <button type="button" class="btn btn-outline-danger btn-sm btn-hapus"
                                    data-action="{{ route('admin.berita.destroy', $item->id) }}"
                                    data-judul="{{ $item->judul }}" data-kategori="{{ $item->kategori }}"
                                    data-foto="{{ $item->foto ? asset('uploads/berita/' . $item->foto) : '' }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ===== MODAL KONFIRMASI HAPUS (satu modal untuk semua berita) ===== --}}
    <div class="modal fade modal-confirm" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <form method="POST" id="formHapus" class="modal-content">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <div class="confirm-icon"><i class="bi bi-trash3-fill"></i></div>
                    <div class="confirm-title">Hapus berita ini?</div>
                    <div class="confirm-text">Data yang sudah dihapus tidak dapat dikembalikan.</div>

                    <div class="confirm-item">
                        <img id="hapusFoto" src="" alt="" class="d-none">
                        <div class="ph" id="hapusFotoPh"><i class="bi bi-image"></i></div>
                        <div class="min-w-0">
                            <div class="ci-title" id="hapusJudul"></div>
                            <div class="ci-kat" id="hapusKategori"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" id="btnKonfirmasiHapus">
                        <i class="bi bi-trash"></i> Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modalEl = document.getElementById('modalHapus');

            // Pindahkan modal ke <body> agar selalu di atas backdrop
            document.body.appendChild(modalEl);

            const modal = new bootstrap.Modal(modalEl);
            const form = document.getElementById('formHapus');
            const btnOk = document.getElementById('btnKonfirmasiHapus');
            const foto = document.getElementById('hapusFoto');
            const fotoPh = document.getElementById('hapusFotoPh');
            const btnOkHtml = btnOk.innerHTML;

            document.querySelectorAll('.btn-hapus').forEach(btn => {
                btn.addEventListener('click', () => {
                    form.action = btn.dataset.action;
                    document.getElementById('hapusJudul').textContent = btn.dataset.judul;
                    document.getElementById('hapusKategori').textContent = btn.dataset.kategori;

                    if (btn.dataset.foto) {
                        foto.src = btn.dataset.foto;
                        foto.classList.remove('d-none');
                        fotoPh.classList.add('d-none');
                    } else {
                        foto.classList.add('d-none');
                        fotoPh.classList.remove('d-none');
                    }

                    modal.show();
                });
            });

            // Cegah klik ganda saat proses hapus berjalan
            form.addEventListener('submit', () => {
                btnOk.disabled = true;
                btnOk.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1"></span> Menghapus...';
            });

            // Kembalikan tombol ke keadaan awal setiap modal ditutup
            modalEl.addEventListener('hidden.bs.modal', () => {
                btnOk.disabled = false;
                btnOk.innerHTML = btnOkHtml;
            });
        });
    </script>
@endpush
