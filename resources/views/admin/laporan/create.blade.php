@extends('layout.admin.index')

@section('page-title', 'Tambah Laporan Keuangan')

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

        .file-info {
            display: none;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            padding: 8px 12px;
            border-radius: 10px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 13px;
            word-break: break-all;
            animation: fadeUp .3s ease both;
        }

        .file-info.show {
            display: flex;
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

        <form action="{{ route('admin.laporan.store') }}" method="POST" enctype="multipart/form-data" class="form-card"
            id="formTambah">
            @csrf

            <div class="form-card-head">
                <i class="bi bi-file-earmark-bar-graph"></i> Tambah Laporan Keuangan
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-md-4">
                    <label class="form-label" for="tahun">Tahun</label>
                    <input type="text" name="tahun" id="tahun" class="form-control" inputmode="numeric"
                        value="{{ old('tahun') }}" placeholder="Contoh: 2024" required>
                </div>
                <div class="col-12 col-md-8">
                    <label class="form-label" for="judul">Judul Laporan</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}"
                        placeholder="Laporan Keuangan Tahun 2024" required>
                </div>
            </div>

            <div class="mb-1">
                <label class="form-label" for="file">File PDF</label>
                <input type="file" name="file" id="file" class="form-control" accept=".pdf,application/pdf"
                    required>
                <div class="hint">File harus berformat PDF.</div>
                <div class="file-info" id="fileInfo">
                    <i class="bi bi-file-earmark-check-fill"></i>
                    <span id="fileName"></span>
                </div>
            </div>

            <div class="action-bar">
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-light border">
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
        const fileInput = document.getElementById('file');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');

        fileInput.addEventListener('change', () => {
            const f = fileInput.files[0];
            if (f) {
                fileName.textContent = f.name + ' (' + Math.round(f.size / 1024) + ' KB)';
                fileInfo.classList.add('show');
            } else {
                fileInfo.classList.remove('show');
            }
        });

        document.getElementById('formTambah').addEventListener('submit', () => {
            const btn = document.getElementById('btnSimpan');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
        });
    </script>
@endpush
