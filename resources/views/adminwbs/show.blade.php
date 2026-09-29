<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Laporan - {{ $laporan->ticket_token }}</title>
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

        .card-section {
            border-radius: 14px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-custom navbar-dark px-4">
        <a href="{{ route('adminwbs.dashboard') }}" class="navbar-brand"><i class="fas fa-arrow-left"></i> Admin WBS</a>
    </nav>

    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Detail Laporan <code>{{ $laporan->ticket_token }}</code></h4>
            <a href="{{ route('adminwbs.laporan.pdf', $laporan) }}" class="btn btn-outline-danger"><i
                    class="fas fa-file-pdf"></i> Download PDF</a>
        </div>

        <div class="card card-section mb-3 shadow-sm">
            <div class="card-header bg-white fw-bold">Data Pelapor</div>
            <div class="card-body">
                @if ($laporan->is_anonim)
                    <p class="text-muted mb-0"><i class="fas fa-user-secret"></i> Pelapor memilih Anonim</p>
                @else
                    <p><strong>Nama:</strong> {{ $laporan->nama_lengkap }}</p>
                    <p><strong>Hubungan dengan DAPEN:</strong> {{ $laporan->hubungan_dapen }}</p>
                    <p><strong>No. Identitas:</strong> {{ $laporan->nomor_identitas ?: '-' }}</p>
                    <p><strong>No. Kontak:</strong> {{ $laporan->no_kontak ?: '-' }}</p>
                    <p class="mb-0"><strong>Email:</strong> {{ $laporan->email_pribadi ?: '-' }}</p>
                @endif
            </div>
        </div>

        <div class="card card-section mb-3 shadow-sm">
            <div class="card-header bg-white fw-bold">Rincian Kejadian</div>
            <div class="card-body">
                <p><strong>Kategori:</strong> {{ $laporan->kategori_pengaduan }}</p>
                <p><strong>Deskripsi Kejadian:</strong><br>{{ $laporan->deskripsi_kejadian }}</p>
                <p class="mb-0"><strong>Deskripsi Kerugian:</strong><br>{{ $laporan->deskripsi_kerugian ?: '-' }}</p>
            </div>
        </div>

        <div class="card card-section mb-3 shadow-sm">
            <div class="card-header bg-white fw-bold">Daftar Terlapor</div>
            <div class="card-body">
                @forelse ($laporan->terlapors as $i => $t)
                    <div class="mb-2 pb-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <strong>{{ $i + 1 }}. {{ $t->nama_terlapor }}</strong>
                        @if ($t->jabatan_terlapor)
                            <span class="text-muted"> — {{ $t->jabatan_terlapor }}</span>
                        @endif
                        @if ($t->info_tambahan_terlapor)
                            <div class="small text-muted">{{ $t->info_tambahan_terlapor }}</div>
                        @endif
                    </div>
                @empty
                    <p class="text-muted mb-0">Tidak ada data terlapor.</p>
                @endforelse
            </div>
        </div>

        <div class="card card-section mb-3 shadow-sm">
            <div class="card-header bg-white fw-bold">Bukti Pendukung</div>
            <div class="card-body">
                @forelse ($laporan->bukti as $b)
                    <a href="{{ Storage::url($b->path_file) }}" target="_blank"
                        class="badge bg-light text-dark border me-2 mb-2 p-2">
                        <i class="fas fa-paperclip"></i> {{ $b->nama_file_asli }}
                    </a>
                @empty
                    <p class="text-muted mb-0">Tidak ada bukti dilampirkan.</p>
                @endforelse
            </div>
        </div>

        <div class="card card-section shadow-sm">
            <div class="card-header bg-white fw-bold">Ubah Status Laporan</div>
            <div class="card-body">
                <form method="POST" action="{{ route('adminwbs.laporan.updateStatus', $laporan) }}">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                @foreach (\App\Support\WbsOptions::statusList() as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ $laporan->status == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Catatan untuk Pelapor (opsional)</label>
                            <textarea name="catatan_admin" class="form-control" rows="2">{{ $laporan->catatan_admin }}</textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3"><i class="fas fa-save"></i> Simpan Status</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
