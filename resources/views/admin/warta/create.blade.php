@extends('layout.admin.index')

@section('content')
    <h4>Tambah Warta</h4>

    <form action="{{ route('admin.warta.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="MAJALAH">MAJALAH</option>
                <option value="PDF">PDF</option>
                <option value="SPECIAL">SPECIAL</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal / Periode</label>
            <input type="text" name="tanggal" class="form-control" placeholder="Sept-Okt 2024">
        </div>

        <div class="mb-3">
            <label>File PDF</label>
            <input type="file" name="file_pdf" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
@endsection
