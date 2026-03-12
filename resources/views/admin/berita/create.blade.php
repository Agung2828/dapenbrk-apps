@extends('layout.admin.index')

@section('content')
    <div class="container-fluid mt-4">

        <h4>Tambah Berita & Informasi</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data">

            @csrf

            <div id="formContainer">

                {{-- ================= FORM BERITA ================= --}}
                <div class="form-berita border p-3 mb-3 rounded position-relative">

                    <button type="button" class="btn btn-sm btn-danger position-absolute"
                        style="top:10px;right:10px;display:none" onclick="hapusForm(this)">
                        ✕
                    </button>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori[]" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
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
                        <label>Foto (Opsional)</label>
                        <input type="file" name="foto[]" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul[]" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi[]" class="form-control" rows="4" required></textarea>
                    </div>

                </div>
                {{-- ================= END FORM ================= --}}

            </div>

            <button type="button" class="btn btn-secondary mb-3" onclick="tambahForm()">
                + Tambah Berita Lagi
            </button>

            <div>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-light">
                    Kembali
                </a>

                <button class="btn btn-primary">
                    Simpan Semua
                </button>
            </div>

        </form>
    </div>

    <script>
        function tambahForm() {
            const container = document.getElementById('formContainer');
            const form = container.querySelector('.form-berita');
            const clone = form.cloneNode(true);

            clone.querySelectorAll('input, textarea, select').forEach(el => el.value = '');
            clone.querySelector('button').style.display = 'block';

            container.appendChild(clone);
        }

        function hapusForm(btn) {
            btn.closest('.form-berita').remove();
        }
    </script>
@endsection
