<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin WBS</title>
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

        .navbar-custom .navbar-brand,
        .navbar-custom .btn-logout {
            color: #fff !important;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-custom navbar-dark px-4">
        <span class="navbar-brand"><i class="fas fa-shield-halved"></i> Admin WBS - Dapen BRKS</span>
        <form method="POST" action="{{ route('adminwbs.logout') }}">
            @csrf
            <button class="btn btn-sm btn-outline-light">Logout</button>
        </form>
    </nav>

    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Daftar Laporan WBS</h4>
            <a href="{{ route('adminwbs.laporan.create') }}" class="btn btn-danger"><i class="fas fa-plus"></i> Buat
                Laporan</a>
        </div>

        <form method="GET" class="row g-2 mb-3">
            <div class="col-auto">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Status --</option>
                    @foreach ($statusList as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <input type="text" name="q" class="form-control" placeholder="Cari tiket/nama/kategori..."
                    value="{{ request('q') }}">
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-secondary">Cari</button>
            </div>
        </form>

        <div class="table-responsive bg-white rounded shadow-sm">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tiket</th>
                        <th>Pelapor</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporans as $l)
                        <tr>
                            <td><code>{{ $l->ticket_token }}</code></td>
                            <td>{{ $l->is_anonim ? 'Anonim' : ($l->nama_lengkap ?: '-') }}</td>
                            <td>{{ $l->kategori_pengaduan }}</td>
                            <td>
                                @php
                                    $colors = [
                                        'diajukan' => 'secondary',
                                        'diterima' => 'primary',
                                        'dalam_antrian' => 'warning',
                                        'diproses' => 'info',
                                        'ditolak' => 'danger',
                                        'selesai' => 'success',
                                    ];
                                @endphp
                                <span
                                    class="badge bg-{{ $colors[$l->status] ?? 'secondary' }} badge-status">{{ $statusList[$l->status] ?? $l->status }}</span>
                            </td>
                            <td>{{ $l->created_at->format('d/m/Y H:i') }}</td>
                            <td><a href="{{ route('adminwbs.laporan.show', $l) }}"
                                    class="btn btn-sm btn-outline-primary">Detail</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada laporan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $laporans->links() }}</div>
    </div>
</body>

</html>
