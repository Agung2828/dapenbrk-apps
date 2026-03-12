@extends('layout.admin.index')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Tambah Laporan Keuangan</h3>

            <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">
                ← Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">

                <form action="{{ route('admin.laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="text" name="tahun" class="form-control" placeholder="Contoh: 2024" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Judul Laporan</label>
                        <input type="text" name="judul" class="form-control" placeholder="Laporan Keuangan Tahun 2024"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File PDF</label>
                        <input type="file" name="file" class="form-control" accept="application/pdf" required>
                        <small class="text-muted">
                            File harus berformat PDF
                        </small>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary">
                            Simpan
                        </button>

                        <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
