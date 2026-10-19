@extends('layout.admin.index')

@section('page-title', 'Input Dokumen')

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

        .form-control,
        .form-select {
            border-radius: 10px;
            border-color: #e2e8f0;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
        }

        .sub-form {
            animation: fadeUp .35s ease both;
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

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

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

        <form method="POST" action="{{ route('admin.dokumen.store') }}" enctype="multipart/form-data" class="form-card">
            @csrf

            <div class="form-card-head">
                <i class="bi bi-folder-plus"></i> Input Data Dokumen
            </div>

            <div class="mb-3">
                <label class="form-label" for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="pensiun" {{ old('kategori') == 'pensiun' ? 'selected' : '' }}>Pensiun</option>
                    <option value="peraturan" {{ old('kategori') == 'peraturan' ? 'selected' : '' }}>Peraturan PDF
                    </option>
                    <option value="pedoman" {{ old('kategori') == 'pedoman' ? 'selected' : '' }}>Pedoman</option>
                    <option value="pso" {{ old('kategori') == 'pso' ? 'selected' : '' }}>PSO</option>
                </select>
            </div>

            {{-- ===================== PENSIUN ===================== --}}
            <div id="form-pensiun" class="sub-form d-none">
                <div class="row g-3">
                    <div class="col-12 col-md-7">
                        <label class="form-label">Nama Penerima Pensiun</label>
                        <input name="nama" class="form-control" placeholder="Nama Penerima Pensiun"
                            value="{{ old('nama') }}" disabled>
                    </div>
                    <div class="col-12 col-md-5">
                        <label class="form-label">Jenis</label>
                        <select name="jenis" class="form-select" disabled>
                            <option value="">Pilih Jenis</option>
                            <option value="normal" {{ old('jenis') == 'normal' ? 'selected' : '' }}>Normal</option>
                            <option value="dipercepat" {{ old('jenis') == 'dipercepat' ? 'selected' : '' }}>Dipercepat
                            </option>
                            <option value="janda" {{ old('jenis') == 'janda' ? 'selected' : '' }}>Janda/Duda</option>
                            <option value="anak" {{ old('jenis') == 'anak' ? 'selected' : '' }}>Anak</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- ===================== PERATURAN ===================== --}}
            <div id="form-peraturan" class="sub-form d-none">
                <div class="row g-3">
                    <div class="col-12 col-md-8">
                        <label class="form-label">Judul Peraturan</label>
                        <input name="judul" class="form-control" placeholder="Judul Peraturan"
                            value="{{ old('judul') }}" disabled>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label">Tahun</label>
                        <input name="tahun" class="form-control" placeholder="Tahun" inputmode="numeric"
                            value="{{ old('tahun') }}" disabled>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi" disabled>{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">File PDF</label>
                        <input type="file" name="file_pdf" class="form-control" accept="application/pdf" disabled>
                    </div>
                </div>
            </div>

            {{-- ===================== PEDOMAN ===================== --}}
            <div id="form-pedoman" class="sub-form d-none">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label">Kode Pedoman</label>
                        <input name="kode" class="form-control" placeholder="Kode Pedoman" value="{{ old('kode') }}"
                            disabled>
                    </div>
                    <div class="col-12 col-md-8">
                        <label class="form-label">Nama Pedoman</label>
                        <input name="nama" class="form-control" placeholder="Nama Pedoman" value="{{ old('nama') }}"
                            disabled>
                    </div>
                </div>
            </div>

            {{-- ===================== PSO ===================== --}}
            <div id="form-pso" class="sub-form d-none">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label">Kode PSO</label>
                        <input name="kode" class="form-control" placeholder="Kode PSO" value="{{ old('kode') }}"
                            disabled>
                    </div>
                    <div class="col-12 col-md-8">
                        <label class="form-label">Nama PSO</label>
                        <input name="nama" class="form-control" placeholder="Nama PSO" value="{{ old('nama') }}"
                            disabled>
                    </div>
                </div>
            </div>

            <div class="action-bar">
                <a href="{{ route('admin.dokumen.index') }}" class="btn btn-light border">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function ubahForm() {
            // sembunyikan & disable semua sub-form
            document.querySelectorAll('.sub-form').forEach(form => {
                form.classList.add('d-none');
                form.querySelectorAll('input, select, textarea').forEach(el => el.disabled = true);
            });

            // tampilkan & enable sub-form yang dipilih
            const kategori = document.getElementById('kategori').value;
            if (kategori) {
                const aktif = document.getElementById('form-' + kategori);
                aktif.classList.remove('d-none');
                aktif.querySelectorAll('input, select, textarea').forEach(el => el.disabled = false);
            }
        }

        document.getElementById('kategori').addEventListener('change', ubahForm);
        ubahForm(); // jalankan saat halaman dimuat (untuk nilai old() setelah validasi gagal)
    </script>
@endpush
