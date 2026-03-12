@extends('layout.admin.index')

@section('content')
    <h4>Input Data Dokumen</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.dokumen.store') }}" enctype="multipart/form-data">
        @csrf

        <select name="kategori" onchange="ubahForm()" id="kategori" class="form-control mb-3" required>
            <option value="">Pilih Kategori</option>
            <option value="pensiun">Pensiun</option>
            <option value="peraturan">Peraturan PDF</option>
            <option value="pedoman">Pedoman</option>
            <option value="pso">PSO</option>
        </select>

        {{-- ===================== PENSIUN ===================== --}}
        <div id="form-pensiun" class="d-none">
            <input name="nama" class="form-control mb-2" placeholder="Nama Penerima Pensiun" disabled>

            <select name="jenis" class="form-control" disabled>
                <option value="">Pilih Jenis</option>
                <option value="normal">Normal</option>
                <option value="dipercepat">Dipercepat</option>
                <option value="janda">Janda/Duda</option>
                <option value="anak">Anak</option>
            </select>
        </div>

        {{-- ===================== PERATURAN ===================== --}}
        <div id="form-peraturan" class="d-none">
            <input name="judul" class="form-control mb-2" placeholder="Judul Peraturan" disabled>

            <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi" disabled></textarea>

            <input name="tahun" class="form-control mb-2" placeholder="Tahun" disabled>

            <input type="file" name="file_pdf" class="form-control" disabled>
        </div>

        {{-- ===================== PEDOMAN ===================== --}}
        <div id="form-pedoman" class="d-none">
            <input name="kode" class="form-control mb-2" placeholder="Kode Pedoman" disabled>
            <input name="nama" class="form-control mb-2" placeholder="Nama Pedoman" disabled>
        </div>

        {{-- ===================== PSO ===================== --}}
        <div id="form-pso" class="d-none">
            <input name="kode" class="form-control mb-2" placeholder="Kode PSO" disabled>
            <input name="nama" class="form-control mb-2" placeholder="Nama PSO" disabled>
        </div>

        <button class="btn btn-primary mt-3">Simpan</button>
    </form>

    <script>
        function ubahForm() {
            // sembunyikan & disable semua form
            document.querySelectorAll('[id^=form-]').forEach(form => {
                form.classList.add('d-none');
                form.querySelectorAll('input, select, textarea').forEach(el => {
                    el.disabled = true;
                });
            });

            // tampilkan & enable form yang dipilih
            const kategori = document.getElementById('kategori').value;
            if (kategori) {
                const aktif = document.getElementById('form-' + kategori);
                aktif.classList.remove('d-none');
                aktif.querySelectorAll('input, select, textarea').forEach(el => {
                    el.disabled = false;
                });
            }
        }
    </script>
@endsection
