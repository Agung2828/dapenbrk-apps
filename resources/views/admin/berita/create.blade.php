@extends('layout.admin.index')

@section('page-title', 'Tambah Berita')

@push('styles')
    <style>
        .form-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 16px;
            position: relative;
            animation: fadeUp .45s ease both;
        }

        .form-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .form-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #0f172a;
            font-size: 15px;
        }

        .form-card-no {
            width: 30px;
            height: 30px;
            border-radius: 9px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
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

        .action-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
            align-items: center;
        }

        @media (max-width: 576px) {
            .form-card {
                padding: 14px;
            }

            .action-bar {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .action-bar .btn {
                width: 100%;
            }

            .action-bar .btn-group-end {
                display: flex;
                flex-direction: column-reverse;
                gap: 10px;
                width: 100%;
            }
        }

        .action-bar .btn-group-end {
            display: flex;
            gap: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid p-0" style="max-width: 900px;">

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

        <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data">
            @csrf

            <div id="formContainer">

                {{-- ===== FORM BERITA ===== --}}
                <div class="form-card form-berita">
                    <div class="form-card-head">
                        <div class="form-card-title">
                            <span class="form-card-no">1</span> Berita
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove d-none"
                            onclick="hapusForm(this)">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label">Kategori</label>
                            <select name="kategori[]" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Pengumuman">Pengumuman</option>
                                <option value="Kegiatan">Kegiatan</option>
                                <option value="Penghargaan">Penghargaan</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal[]" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Foto (Opsional)</label>
                            <input type="file" name="foto[]" class="form-control" accept="image/*">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul[]" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi[]" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                </div>
                {{-- ===== END FORM ===== --}}

            </div>

            <button type="button" class="btn btn-outline-secondary mb-4 w-100 w-sm-auto" onclick="tambahForm()">
                <i class="bi bi-plus-lg"></i> Tambah Berita Lagi
            </button>

            <div class="action-bar">
                <a href="{{ route('admin.berita.index') }}" class="btn btn-light border">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <div class="btn-group-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Semua
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const container = document.getElementById('formContainer');

        function refreshForms() {
            const forms = container.querySelectorAll('.form-berita');
            forms.forEach((f, i) => {
                f.querySelector('.form-card-no').textContent = i + 1;
                // tombol hapus hanya muncul jika form lebih dari satu
                f.querySelector('.btn-remove').classList.toggle('d-none', forms.length === 1);
            });
        }

        function tambahForm() {
            const clone = container.querySelector('.form-berita').cloneNode(true);

            clone.querySelectorAll('input, textarea, select').forEach(el => el.value = '');
            container.appendChild(clone);
            refreshForms();
            clone.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function hapusForm(btn) {
            btn.closest('.form-berita').remove();
            refreshForms();
        }
    </script>
@endpush
