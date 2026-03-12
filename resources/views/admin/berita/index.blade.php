@extends('layout.admin.index')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Daftar Berita & Informasi</h3>

            <!-- BOOTSTRAP 4 -->
            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                + Tambah Berita
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th width="140">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($berita as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($item->foto)
                                        <img src="{{ asset('uploads/berita/' . $item->foto) }}" width="80">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                <td>
                                    {{-- <button class="btn btn-warning btn-sm editBtn" data-item='@json($item)'
                                        data-update-url="{{ route('admin.berita.update', $item->id) }}" data-toggle="modal"
                                        data-target="#editModal">
                                        Edit
                                    </button> --}}

                                    <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>

    {{-- ================= MODAL CREATE ================= --}}
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Berita</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                    + Tambah Berita
                </a>
                @csrf

                <div class="modal-body">

                    <div id="formContainer">
                        <div class="formBerita border p-3 mb-3 position-relative">

                            <button type="button" class="close removeFormBtn"
                                style="position:absolute;top:10px;right:10px;display:none;">
                                &times;
                            </button>

                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori[]" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Pengumuman">Pengumuman</option>
                                    <option value="Kegiatan">Kegiatan</option>
                                    <option value="Penghargaan">Penghargaan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal[]" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="foto[]" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" name="judul[]" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi[]" class="form-control" rows="3" required></textarea>
                            </div>

                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary btn-sm" id="addFormBtn">
                        + Tambah Form
                    </button>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
                </form>

            </div>
        </div>
    </div>

    {{-- ================= MODAL EDIT ================= --}}
    {{-- <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Berita</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" id="edit_kategori" class="form-control"></select>
                        </div>

                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" id="edit_tanggal" class="form-control">
                        </div>

                        <img id="edit_foto_preview" width="120" class="mb-2 d-none">

                        <div class="form-group">
                            <label>Ganti Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" id="edit_judul" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="edit_deskripsi" class="form-control"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button class="btn btn-warning">Update</button>
                    </div>

                </form>

            </div>
        </div>
    </div> --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#addFormBtn').click(function() {
                let clone = $('.formBerita').first().clone();
                clone.find('input, textarea, select').val('');
                clone.find('.removeFormBtn').show();
                $('#formContainer').append(clone);
            });

            $('#formContainer').on('click', '.removeFormBtn', function() {
                $(this).closest('.formBerita').remove();
            });

            $('.editBtn').click(function() {
                let item = $(this).data('item');

                $('#edit_kategori').html(`
            <option value="Pengumuman">Pengumuman</option>
            <option value="Kegiatan">Kegiatan</option>
            <option value="Penghargaan">Penghargaan</option>
        `).val(item.kategori);

                $('#edit_tanggal').val(item.tanggal);
                $('#edit_judul').val(item.judul);
                $('#edit_deskripsi').val(item.deskripsi);

                if (item.foto) {
                    $('#edit_foto_preview').attr('src', '/uploads/berita/' + item.foto).removeClass(
                        'd-none');
                } else {
                    $('#edit_foto_preview').addClass('d-none');
                }

                $('#editForm').attr('action', $(this).data('update-url'));
            });

        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
@endpush
