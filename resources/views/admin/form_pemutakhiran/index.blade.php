@extends('layout.admin.index')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between mb-3">
            <h4>Form Pemutakhiran Data (PDF)</h4>
            <a href="{{ route('admin.form-pemutakhiran.create') }}" class="btn btn-primary">
                + Tambah Form PDF
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul Form</th>
                            <th>File PDF</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    <a href="{{ asset('uploads/form_pemutakhiran/' . $item->file_pdf) }}" target="_blank"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-file-pdf"></i> Lihat
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.form-pemutakhiran.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus form ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
