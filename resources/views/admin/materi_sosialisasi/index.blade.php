@extends('layout.admin.index')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h4>Materi Sosialisasi</h4>
        <a href="{{ route('admin.materi.create') }}" class="btn btn-primary">+ Tambah Materi</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>File PDF</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materis as $materi)
                <tr>
                    <td>{{ $materi->judul }}</td>
                    <td>{{ Str::limit($materi->deskripsi, 50) }}</td>
                    <td>
                        @if ($materi->file_pdf)
                            <a href="{{ asset('uploads/materi_sosialisasi/' . $materi->file_pdf) }}"
                                target="_blank">Download</a>
                        @else
                            Tidak ada file
                        @endif
                    </td>
                    <td>{{ $materi->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.materi.edit', $materi->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST"
                            style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus materi ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
