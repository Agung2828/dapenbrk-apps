<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buat Laporan WBS - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-custom navbar-dark px-4">
        <a href="{{ route('adminwbs.dashboard') }}" class="navbar-brand"><i class="fas fa-arrow-left"></i> Admin WBS</a>
    </nav>

    <div class="container py-4">
        <h4 class="mb-3">Buat Laporan WBS (oleh Admin)</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('adminwbs.laporan.store') }}" enctype="multipart/form-data"
            class="bg-white p-4 rounded shadow-sm">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Status Anonimitas</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_anonim" value="1" id="anon1"
                        checked>
                    <label class="form-check-label" for="anon1">Anonim</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_anonim" value="0" id="anon0">
                    <label class="form-check-label" for="anon0">Non-Anonim</label>
                </div>
            </div>

            <div id="identitasFields" class="row g-3 mb-3" style="display:none;">
                <div class="col-md-6"><label class="form-label">Nama Lengkap</label><input type="text"
                        name="nama_lengkap" class="form-control"></div>
                <div class="col-md-6">
                    <label class="form-label">Hubungan dengan DAPEN</label>
                    <select name="hubungan_dapen" class="form-select">
                        <option value="">-- Pilih --</option>
                        @foreach ($hubunganDapen as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4"><label class="form-label">No. Identitas</label><input type="text"
                        name="nomor_identitas" class="form-control"></div>
                <div class="col-md-4"><label class="form-label">No. Kontak</label><input type="text" name="no_kontak"
                        class="form-control"></div>
                <div class="col-md-4"><label class="form-label">Email</label><input type="email" name="email_pribadi"
                        class="form-control"></div>
            </div>

            <hr>

            <div class="mb-3">
                <label class="form-label">Kategori Pengaduan</label>
                <select name="kategori_pengaduan" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($kategoriPengaduan as $nama => $desc)
                        <option value="{{ $nama }}">{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Kejadian</label>
                <textarea name="deskripsi_kejadian" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Kerugian (opsional)</label>
                <textarea name="deskripsi_kerugian" class="form-control" rows="2"></textarea>
            </div>

            <hr>
            <label class="form-label fw-bold">Daftar Terlapor</label>
            <div id="terlaporList"></div>
            <button type="button" class="btn btn-outline-secondary btn-sm mb-3" id="btnAddTerlapor"><i
                    class="fas fa-plus"></i> Tambah Terlapor</button>

            <hr>
            <div class="mb-3">
                <label class="form-label">Bukti Pendukung (opsional, boleh lebih dari satu)</label>
                <input type="file" name="bukti[]" multiple class="form-control"
                    accept="{{ collect($buktiExt)->map(fn($e) => '.' . $e)->implode(',') }}">
                <small class="text-muted">Maks {{ $buktiMaxFiles }} file, {{ $buktiMaxSizeMb }}MB/file</small>
            </div>

            <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Simpan Laporan</button>
        </form>
    </div>

    <script>
        const JABATAN = @json($jabatanTerlapor);
        let idx = 0;

        function jabatanOptions() {
            return '<option value="">-- Pilih --</option>' + JABATAN.map(j => `<option value="${j}">${j}</option>`).join(
                '');
        }

        function addTerlapor() {
            const i = idx++;
            const html = `
                <div class="border rounded p-3 mb-2" id="row-${i}">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>Terlapor</strong>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('row-${i}').remove()"><i class="fas fa-trash"></i></button>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-6"><input type="text" name="terlapor[${i}][nama_terlapor]" class="form-control" placeholder="Nama/Inisial Terlapor" required></div>
                        <div class="col-md-6"><select name="terlapor[${i}][jabatan_terlapor]" class="form-select">${jabatanOptions()}</select></div>
                        <div class="col-12"><textarea name="terlapor[${i}][info_tambahan_terlapor]" class="form-control" rows="2" placeholder="Info tambahan (opsional)"></textarea></div>
                    </div>
                </div>`;
            document.getElementById('terlaporList').insertAdjacentHTML('beforeend', html);
        }

        document.getElementById('btnAddTerlapor').onclick = addTerlapor;
        addTerlapor();

        document.querySelectorAll('input[name="is_anonim"]').forEach(r => {
            r.addEventListener('change', () => {
                document.getElementById('identitasFields').style.display = r.value === '0' ? 'flex' :
                    'none';
            });
        });
    </script>
</body>

</html>
