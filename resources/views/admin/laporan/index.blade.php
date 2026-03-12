@extends('layout.admin.index')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between mb-3">
            <h3>Daftar Laporan Keuangan</h3>

            <a href="{{ route('admin.laporan.create') }}" class="btn btn-primary">
                + Tambah Laporan
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Judul</th>
                            <th>File</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporans as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    <a href="{{ asset('uploads/laporan/' . $item->file) }}" target="_blank">
                                        {{ $item->file }}
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning editBtn" data-item='@json($item)'
                                        data-update-url="{{ route('admin.laporan.update', $item->id) }}"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                        Edit
                                    </button>

                                    <form action="{{ route('admin.laporan.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Belum ada laporan keuangan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- ===================== --}}
    {{-- MODAL CREATE --}}
    {{-- ===================== --}}
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5>Tambah Laporan</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Tahun</label>
                            <input type="text" name="tahun" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>File PDF</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== --}}
    {{-- MODAL EDIT --}}
    {{-- ===================== --}}
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5>Edit Laporan</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Tahun</label>
                            <input type="text" name="tahun" id="edit_tahun" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" id="edit_judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>File Saat Ini</label><br>
                            <a id="edit_file_preview" href="#" target="_blank"></a>
                        </div>
                        <div class="mb-3">
                            <label>Ganti File PDF</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== --}}
    {{-- SCRIPT EDIT MODAL --}}
    {{-- ===================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.editBtn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const item = JSON.parse(this.dataset.item);

                    document.getElementById('edit_tahun').value = item.tahun;
                    document.getElementById('edit_judul').value = item.judul;

                    const preview = document.getElementById('edit_file_preview');
                    if (item.file) {
                        preview.href = '/uploads/laporan/' + item.file;
                        preview.textContent = item.file;
                    } else {
                        preview.textContent = 'Tidak ada file';
                    }

                    document.getElementById('editForm').action = this.dataset.updateUrl;
                });
            });
        });
    </script>
@endsection
