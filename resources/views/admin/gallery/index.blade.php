@extends('layout.admin.index')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h4>Data Gallery</h4>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
            + Tambah Gallery
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="5%">No</th>
                        <th width="25%">Judul Gallery</th>
                        <th>Foto</th>
                        <th width="10%">Jumlah</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($galleries as $gallery)
                        <tr>
                            {{-- No --}}
                            <td class="text-center">{{ $loop->iteration }}</td>

                            {{-- Judul --}}
                            <td>
                                <strong>{{ $gallery->judul }}</strong>
                                @if ($gallery->lokasi)
                                    <br>
                                    <small class="text-muted">{{ $gallery->lokasi }}</small>
                                @endif
                            </td>

                            {{-- Foto --}}
                            <td>
                                @foreach ($gallery->items as $item)
                                    <div class="d-inline-block position-relative me-1 mb-1">
                                        <img src="{{ asset('storage/' . $item->image) }}" class="rounded"
                                            style="width:60px;height:60px;object-fit:cover;">

                                        {{-- Delete Foto --}}
                                        <form action="{{ route('admin.gallery-item.destroy', $item->id) }}" method="POST"
                                            class="position-absolute top-0 end-0"
                                            onsubmit="return confirm('Hapus foto ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm p-0"
                                                style="width:20px;height:20px;line-height:1;">
                                                ×
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </td>

                            {{-- Jumlah --}}
                            <td class="text-center">
                                <span class="badge bg-info">
                                    {{ $gallery->items->count() }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus gallery dan semua fotonya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        🗑️ Hapus Gallery
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada data gallery
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
