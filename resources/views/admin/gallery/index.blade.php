@extends('layout.admin.index')

@section('page-title', 'Data Gallery')

@push('styles')
    <style>
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

        .gal-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 14px;
            opacity: 0;
            animation: fadeUp .45s ease forwards;
            transition: box-shadow .25s;
        }

        .gal-card:hover {
            box-shadow: 0 10px 24px rgba(15, 23, 42, .07);
        }

        .gal-head {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 14px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .gal-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
            word-break: break-word;
        }

        .gal-loc {
            font-size: 13px;
            color: #64748b;
            margin-top: 2px;
        }

        .gal-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge-jml {
            font-size: 12px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 50px;
            background: #eff6ff;
            color: #2563eb;
            white-space: nowrap;
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(92px, 1fr));
            gap: 10px;
        }

        .ph-item {
            position: relative;
            aspect-ratio: 1 / 1;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            background: #f1f5f9;
        }

        .ph-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .35s;
        }

        .ph-item:hover img {
            transform: scale(1.07);
        }

        .ph-del {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: none;
            background: rgba(220, 38, 38, .92);
            color: #fff;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .25);
            transition: transform .2s, background .2s;
        }

        .ph-del:hover {
            background: #b91c1c;
            transform: scale(1.12);
        }

        .no-photo {
            font-size: 13px;
            color: #94a3b8;
            font-style: italic;
        }

        .empty-state {
            text-align: center;
            padding: 48px 12px;
            color: #94a3b8;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
        }

        .empty-state i {
            font-size: 44px;
            display: block;
            margin-bottom: 8px;
        }

        /* Modal hapus */
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
            padding: 10px 12px;
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
            color: #64748b;
            font-size: 22px;
        }

        .confirm-item .ci-title {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
            word-break: break-word;
        }

        .confirm-item .ci-sub {
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

        @media (max-width: 576px) {
            .gal-card {
                padding: 12px;
            }

            .btn-tambah {
                width: 100%;
            }

            .photo-grid {
                grid-template-columns: repeat(auto-fill, minmax(78px, 1fr));
                gap: 8px;
            }

            .gal-head {
                flex-direction: column;
            }

            .gal-right {
                width: 100%;
                justify-content: space-between;
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

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <h5 class="panel-title">Data Gallery</h5>
            <div class="panel-sub">{{ count($galleries) }} gallery</div>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-tambah">
            <i class="bi bi-plus-lg"></i> Tambah Gallery
        </a>
    </div>

    @forelse ($galleries as $gallery)
        @php
            $first = $gallery->items->first();
            $fotoUrl = $first ? asset('storage/' . $first->image) : '';
        @endphp

        <div class="gal-card" style="animation-delay: {{ min($loop->index, 10) * 70 }}ms;">
            <div class="gal-head">
                <div>
                    <div class="gal-title">{{ $gallery->judul }}</div>
                    @if ($gallery->lokasi)
                        <div class="gal-loc"><i class="bi bi-geo-alt-fill"></i> {{ $gallery->lokasi }}</div>
                    @endif
                </div>

                <div class="gal-right">
                    <span class="badge-jml"><i class="bi bi-images"></i> {{ $gallery->items->count() }} foto</span>
                    <button type="button" class="btn btn-outline-danger btn-sm btn-hapus" data-type="gallery"
                        data-action="{{ route('admin.gallery.destroy', $gallery->id) }}" data-judul="{{ $gallery->judul }}"
                        data-sub="{{ $gallery->items->count() }} foto di dalamnya" data-foto="{{ $fotoUrl }}">
                        <i class="bi bi-trash"></i> Hapus Gallery
                    </button>
                </div>
            </div>

            @if ($gallery->items->isEmpty())
                <div class="no-photo">Belum ada foto di gallery ini.</div>
            @else
                <div class="photo-grid">
                    @foreach ($gallery->items as $item)
                        <div class="ph-item">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $gallery->judul }}" loading="lazy">
                            <button type="button" class="ph-del btn-hapus" aria-label="Hapus foto" data-type="foto"
                                data-action="{{ route('admin.gallery-item.destroy', $item->id) }}"
                                data-judul="Foto dari {{ $gallery->judul }}" data-sub=""
                                data-foto="{{ asset('storage/' . $item->image) }}">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @empty
        <div class="empty-state">
            <i class="bi bi-images"></i>
            Belum ada data gallery.
        </div>
    @endforelse

    {{-- ===== MODAL KONFIRMASI HAPUS ===== --}}
    <div class="modal fade modal-confirm" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <form method="POST" id="formHapus" class="modal-content">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <div class="confirm-icon"><i class="bi bi-trash3-fill"></i></div>
                    <div class="confirm-title" id="hapusHeading">Hapus?</div>
                    <div class="confirm-text" id="hapusText"></div>

                    <div class="confirm-item">
                        <img id="hapusFoto" src="" alt="" class="d-none">
                        <div class="ph" id="hapusFotoPh"><i class="bi bi-images"></i></div>
                        <div class="min-w-0">
                            <div class="ci-title" id="hapusJudul"></div>
                            <div class="ci-sub" id="hapusSub"></div>
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
            document.body.appendChild(modalEl); // pastikan selalu di atas backdrop

            const modal = new bootstrap.Modal(modalEl);
            const form = document.getElementById('formHapus');
            const btnOk = document.getElementById('btnKonfirmasiHapus');
            const btnOkHtml = btnOk.innerHTML;
            const foto = document.getElementById('hapusFoto');
            const fotoPh = document.getElementById('hapusFotoPh');

            document.querySelectorAll('.btn-hapus').forEach(btn => {
                btn.addEventListener('click', () => {
                    const isGallery = btn.dataset.type === 'gallery';

                    form.action = btn.dataset.action;
                    document.getElementById('hapusHeading').textContent =
                        isGallery ? 'Hapus gallery ini?' : 'Hapus foto ini?';
                    document.getElementById('hapusText').textContent = isGallery ?
                        'Gallery beserta semua fotonya akan dihapus dan tidak dapat dikembalikan.' :
                        'Foto yang sudah dihapus tidak dapat dikembalikan.';
                    document.getElementById('hapusJudul').textContent = btn.dataset.judul;
                    document.getElementById('hapusSub').textContent = btn.dataset.sub || '';

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

            form.addEventListener('submit', () => {
                btnOk.disabled = true;
                btnOk.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1"></span> Menghapus...';
            });

            modalEl.addEventListener('hidden.bs.modal', () => {
                btnOk.disabled = false;
                btnOk.innerHTML = btnOkHtml;
            });
        });
    </script>
@endpush
