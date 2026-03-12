@extends('layout.admin.index')

@section('content')
    <div class="card card-glass p-3">

        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center bg-glass-header">
            <h3>Data Peserta</h3>

            <div class="d-flex gap-2">
                <a class="btn btn-primary" href="{{ route('admin.peserta.create') }}">
                    + Tambah
                </a>

                <form method="POST" action="{{ route('admin.peserta.destroyAll') }}"
                    onsubmit="return confirm('Hapus semua peserta? Data ini tidak bisa dikembalikan!')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Hapus Semua</button>
                </form>
            </div>
        </div>


        {{-- Import Excel --}}
        <form action="{{ route('admin.peserta.import') }}" method="POST" enctype="multipart/form-data"
            class="d-flex gap-2 my-3">
            @csrf
            <input type="file" name="file" class="form-control" required>
            <button class="btn btn-success">Import Excel</button>
        </form>


        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success my-2">
                {{ session('success') }}
            </div>
        @endif


        {{-- Search --}}
        <form method="GET" class="d-flex gap-2 my-3">
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari kode / NIK / nama"
                class="form-control">

            <button class="btn btn-secondary">Cari</button>

            <a class="btn btn-light" href="{{ route('admin.peserta.index') }}">
                Reset
            </a>
        </form>


        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-striped table-glass">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tgl Lahir</th>
                        <th>Tgl Jadi</th>
                        <th>Tgl Pensiun</th>
                        <th>PhDP</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pesertas as $i => $p)
                        <tr>
                            <td>{{ $pesertas->firstItem() + $i }}</td>

                            <td>{{ $p->kode }}</td>
                            <td>{{ $p->nik }}</td>
                            <td>{{ $p->nama }}</td>

                            <td>{{ $p->tanggal_lahir ? $p->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                            <td>{{ $p->tanggal_jadi ? $p->tanggal_jadi->format('d/m/Y') : '-' }}</td>
                            <td>{{ $p->tanggal_pensiun ? $p->tanggal_pensiun->format('d/m/Y') : '-' }}</td>

                            <td>
                                Rp {{ number_format($p->phdp, 0, ',', '.') }}
                            </td>

                            <td class="d-flex gap-2">
                                <a class="btn btn-warning btn-sm" href="{{ route('admin.peserta.edit', $p->id) }}">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.peserta.destroy', $p->id) }}"
                                    onsubmit="return confirm('Hapus peserta ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Data kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- Pagination --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $pesertas->links('pagination::bootstrap-5') }}
        </div>
    </div>


    {{-- Glass Style --}}
    <style>
        .card-glass {
            background: rgba(255, 255, 255, .05);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, .1);
        }

        .bg-glass-header {
            background: rgba(255, 255, 255, .08);
            border-bottom: 1px solid rgba(255, 255, 255, .1);
        }

        .table-glass th,
        .table-glass td {
            backdrop-filter: blur(8px);
        }

        .table-glass tbody tr:hover {
            background: rgba(255, 255, 255, .05);
        }
    </style>
@endsection
