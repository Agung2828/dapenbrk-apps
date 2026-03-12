@extends('layout.admin.index')

@section('content')
    <div class="page-header">
        <h3>Tambah Materi Sosialisasi</h3>
    </div>

    <form action="{{ route('admin.materi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="judul">Judul Materi</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="file_pdf">Upload File PDF (opsional)</label>
            <input type="file" name="file_pdf" id="file_pdf" class="form-control" accept="application/pdf">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection
