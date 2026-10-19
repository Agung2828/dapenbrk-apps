@extends('layout.admin.index')

@section('page-title', 'Tambah Gallery')

@push('styles')
    <style>
        .form-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px;
            animation: fadeUp .45s ease both;
        }

        .form-card-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #e2e8f0;
            font-weight: 700;
            color: #0f172a;
            font-size: 16px;
        }

        .form-card-head i {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
        }

        .form-control {
            border-radius: 10px;
            border-color: #e2e8f0;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
        }

        .hint {
            font-size: 12.5px;
            color: #64748b;
            margin-top: 6px;
        }

        .caption-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .caption-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
            animation: fadeUp .35s ease both;
        }

        .caption-row .no {
            width: 24px;
            height: 24px;
            border-radius: 7px;
            background: #2563eb;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .caption-row img {
            width: 54px;
            height: 54px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #e2e8f0;
        }

        .caption-row .cap-body {
            flex: 1;
            min-width: 0;
        }

        .caption-row .fname {
            font-size: 11.5px;
            color: #64748b;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .action-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
            align-items: center;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
        }

        @media (max-width: 576px) {
            .form-card {
                padding: 16px;
            }

            .caption-row {
                align-items: flex-start;
            }

            .action-bar {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .action-bar .btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid p-0" style="max-width: 760px;">

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="form-card"
            id="formGallery">
            @csrf

            <div class="form-card-head">
                <i class="bi bi-images"></i> Tambah Gallery
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-md-7">
                    <label class="form-label" for="judul">Judul Gallery</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}"
                        required>
                </div>
                <div class="col-12 col-md-5">
                    <label class="form-label" for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ old('lokasi') }}"
                        placeholder="Opsional">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="images">Foto Gallery</label>
                <input type="file" name="images[]" id="images" multiple class="form-control" accept="image/*"
                    required>
                <div class="hint">Pilih satu atau beberapa foto sekaligus.</div>
            </div>

            <div class="mb-1" id="captionWrap" style="display:none;">
                <label class="form-label">Caption (opsional, urut sesuai foto)</label>
                <div class="caption-list" id="captionList"></div>
            </div>

            <div class="action-bar">
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-light border">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary" id="btnSimpan">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const input = document.getElementById('images');
        const wrap = document.getElementById('captionWrap');
        const list = document.getElementById('captionList');
        let urls = [];

        function escapeHtml(s) {
            return s.replace(/[&<>"']/g, c => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            } [c]));
        }

        input.addEventListener('change', () => {
            // bersihkan preview lama
            urls.forEach(u => URL.revokeObjectURL(u));
            urls = [];
            list.innerHTML = '';

            const files = Array.from(input.files);
            wrap.style.display = files.length ? '' : 'none';

            files.forEach((f, i) => {
                const url = URL.createObjectURL(f);
                urls.push(url);

                const row = document.createElement('div');
                row.className = 'caption-row';
                row.style.animationDelay = Math.min(i, 10) * 50 + 'ms';
                row.innerHTML = `
                    <span class="no">${i + 1}</span>
                    <img src="${url}" alt="">
                    <div class="cap-body">
                        <div class="fname">${escapeHtml(f.name)}</div>
                        <input type="text" name="captions[]" class="form-control form-control-sm"
                            placeholder="Caption foto ${i + 1}">
                    </div>`;
                list.appendChild(row);
            });
        });

        // Cegah klik ganda saat menyimpan
        document.getElementById('formGallery').addEventListener('submit', () => {
            const btn = document.getElementById('btnSimpan');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
        });
    </script>
@endpush
