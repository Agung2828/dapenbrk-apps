@extends('layout.admin.index')

@section('content')
    <div class="container-fluid mt-4">
        <h4>Tambah Form Pemutakhiran (PDF)</h4>

        <form method="POST" action="{{ route('admin.form-pemutakhiran.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Judul Form</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Upload File PDF</label>
                <input type="file" name="file_pdf" class="form-control" accept=".pdf" required>
            </div>

            <a href="{{ route('admin.form-pemutakhiran.index') }}" class="btn btn-light">
                Kembali
            </a>
            <button class="btn btn-primary">
                Simpan
            </button>
        </form>
    </div>
@endsection
