@extends('layout.admin.index')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h4>Data Warta</h4>
        <a href="{{ route('admin.warta.create') }}" class="btn btn-primary">
            + Tambah Warta
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>File</th>
                <th width="140">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wartas as $warta)
                <tr>
                    <td>{{ $warta->judul }}</td>
                    <td>{{ $warta->kategori }}</td>
                    <td>{{ $warta->tanggal }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $warta->file_pdf) }}" target="_blank">
                            Lihat PDF
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.warta.destroy', $warta->id) }}" method="POST"
                            onsubmit="return confirm('Yakin mau hapus warta ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
