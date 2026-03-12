@extends('layout.admin.index')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h4>Slider Home</h4>
        <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">+ Tambah Slider</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Judul</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $slider->image) }}" width="120">
                    </td>
                    <td>{{ $slider->title }}</td>
                    <td>{{ $slider->order }}</td>
                    <td>
                        <span class="badge {{ $slider->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $slider->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
