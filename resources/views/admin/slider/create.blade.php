@extends('layout.admin.index')

@section('content')
    <h4>Tambah Slider</h4>

    <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Judul Besar</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Foto Background</label>
            <input type="file" name="image" class="form-control" required>
            <small class="text-muted">Disarankan ukuran 1920x1080</small>
        </div>

        <div class="mb-3">
            <label>Urutan</label>
            <input type="number" name="order" class="form-control" value="0">
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
@endsection
