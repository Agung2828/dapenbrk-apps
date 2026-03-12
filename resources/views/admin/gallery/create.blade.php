@extends('layout.admin.index')

@section('content')
    <h4>Tambah Gallery</h4>

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Judul Gallery</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control">
        </div>

        <div class="mb-3">
            <label>Foto Gallery</label>
            <input type="file" name="images[]" multiple class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Caption (urut sesuai foto)</label>
            <input type="text" name="captions[]" class="form-control mb-2">
            <input type="text" name="captions[]" class="form-control mb-2">
            <input type="text" name="captions[]" class="form-control mb-2">
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
@endsection
