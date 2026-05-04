@extends('layout.admin.index')

@section('content')
    <div class="container mt-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0">Jumlah Peserta</h3>
                <small class="text-muted">
                    Data terbaru: {{ $data->nama_bulan }} {{ $data->tahun }}
                </small>
            </div>
            <div class="d-flex gap-2">
                {{-- <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fas fa-plus me-1"></i> Tambah Data Bulan Baru
                </button> --}}
                <a href="{{ route('admin.jumlah-peserta.edit', $data->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> Edit Data Terbaru
                </a>
            </div>
        </div>

        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- BADGE PERIODE AKTIF --}}
        <div class="alert alert-info d-flex align-items-center mb-4">
            <i class="fas fa-calendar-alt me-2 fs-5"></i>
            <div>
                <strong>Periode Aktif:</strong>
                {{ $data->nama_bulan }} {{ $data->tahun }}
                <span class="badge bg-info ms-2">Data Terbaru</span>
            </div>
        </div>

        {{-- CARDS --}}
        @php
            $fields = [
                'peserta_aktif' => ['label' => 'Peserta Aktif', 'icon' => 'fas fa-users', 'color' => 'primary'],
                'pensiun_ditunda' => ['label' => 'Pensiun Ditunda', 'icon' => 'fas fa-clock', 'color' => 'warning'],
                'pensiun_normal' => ['label' => 'Pensiun Normal', 'icon' => 'fas fa-user-check', 'color' => 'success'],
                'pensiun_dipercepat' => [
                    'label' => 'Pensiun Dipercepat',
                    'icon' => 'fas fa-forward',
                    'color' => 'info',
                ],
                'pensiun_janda_duda' => [
                    'label' => 'Pensiun Janda/Duda',
                    'icon' => 'fas fa-heart',
                    'color' => 'danger',
                ],
                'pensiun_anak' => ['label' => 'Pensiun Anak', 'icon' => 'fas fa-child', 'color' => 'secondary'],
            ];

            $total = 0;
            foreach ($fields as $field => $meta) {
                $total += $data->$field;
            }
        @endphp

        <div class="row g-3 mb-4">
            @foreach ($fields as $field => $meta)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 border-0" style="border-left: 4px solid !important;"
                        :class="'border-{{ $meta['color'] }}'">
                        <div class="card-body d-flex align-items-center gap-3"
                            style="border-left: 4px solid var(--bs-{{ $meta['color'] }});">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-{{ $meta['color'] }}"
                                style="width:52px;height:52px;background:rgba(0,0,0,0.05);font-size:1.4rem;flex-shrink:0;">
                                <i class="{{ $meta['icon'] }}"></i>
                            </div>
                            <div>
                                <div class="text-muted small mb-1">{{ $meta['label'] }}</div>
                                <div class="fw-bold fs-3 text-{{ $meta['color'] }}">
                                    {{ number_format($data->$field) }}
                                </div>
                                <div class="text-muted" style="font-size:0.78rem;">Orang</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- TOTAL --}}
        <div class="card shadow mb-5 border-0" style="border-left: 5px solid #ffc107 !important;">
            <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2"
                style="border-left: 5px solid #ffc107;">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-warning bg-opacity-10 d-flex align-items-center justify-content-center"
                        style="width:56px;height:56px;font-size:1.6rem;">
                        <i class="fas fa-users text-warning"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Seluruh Peserta</div>
                        <div class="fw-bold fs-2 text-warning">
                            {{ number_format($total) }} Orang
                        </div>
                    </div>
                </div>
                <div class="text-muted small text-end">
                    <i class="fas fa-calendar me-1"></i>
                    Per {{ $data->nama_bulan }} {{ $data->tahun }}
                </div>
            </div>
        </div>

        {{-- TABEL HISTORI --}}
        <div class="card shadow border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                {{-- <h5 class="mb-0">
                    <i class="fas fa-history me-2 text-secondary"></i>Riwayat Data Per Bulan
                </h5> --}}
                {{-- <span class="badge bg-secondary">{{ $histori->count() }} Periode</span> --}}
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Periode</th>
                                <th class="text-center">Aktif</th>
                                <th class="text-center">Ditunda</th>
                                <th class="text-center">Normal</th>
                                <th class="text-center">Dipercepat</th>
                                <th class="text-center">Janda/Duda</th>
                                <th class="text-center">Anak</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histori as $h)
                                @php
                                    $totalRow =
                                        $h->peserta_aktif +
                                        $h->pensiun_ditunda +
                                        $h->pensiun_normal +
                                        $h->pensiun_dipercepat +
                                        $h->pensiun_janda_duda +
                                        $h->pensiun_anak;
                                @endphp
                                <tr @if ($h->id === $data->id) class="table-warning" @endif>
                                    <td>
                                        <strong>{{ $h->nama_bulan }} {{ $h->tahun }}</strong>
                                        @if ($h->id === $data->id)
                                            <span class="badge bg-warning text-dark ms-1"
                                                style="font-size:0.65rem;">Terbaru</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ number_format($h->peserta_aktif) }}</td>
                                    <td class="text-center">{{ number_format($h->pensiun_ditunda) }}</td>
                                    <td class="text-center">{{ number_format($h->pensiun_normal) }}</td>
                                    <td class="text-center">{{ number_format($h->pensiun_dipercepat) }}</td>
                                    <td class="text-center">{{ number_format($h->pensiun_janda_duda) }}</td>
                                    <td class="text-center">{{ number_format($h->pensiun_anak) }}</td>
                                    <td class="text-center fw-bold text-primary">
                                        {{ number_format($totalRow) }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.jumlah-peserta.edit', $h->id) }}"
                                            class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.jumlah-peserta.destroy', $h->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Hapus data {{ $h->nama_bulan }} {{ $h->tahun }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- MODAL TAMBAH DATA BULAN BARU --}}
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus me-2"></i>Tambah Data Peserta Bulan Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.jumlah-peserta.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        {{-- PILIH BULAN & TAHUN --}}
                        <div class="row g-3 mb-4 p-3 bg-light rounded">
                            <div class="col-12">
                                <small class="text-muted fw-semibold text-uppercase">
                                    <i class="fas fa-calendar me-1"></i> Periode
                                </small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Bulan <span class="text-danger">*</span></label>
                                <select name="bulan" class="form-select" required>
                                    @foreach ([
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ] as $num => $nama)
                                        <option value="{{ $num }}"
                                            @if ($num == date('n')) selected @endif>
                                            {{ $nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tahun <span class="text-danger">*</span></label>
                                <input type="number" name="tahun" class="form-control" min="2000" max="2100"
                                    value="{{ date('Y') }}" required>
                            </div>
                        </div>

                        <hr>
                        <small class="text-muted fw-semibold text-uppercase d-block mb-3">
                            <i class="fas fa-users me-1"></i> Data Jumlah Peserta
                        </small>

                        <div class="row g-3">
                            @foreach ($fields as $field => $meta)
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="{{ $meta['icon'] }} text-{{ $meta['color'] }} me-1"></i>
                                        {{ $meta['label'] }}
                                    </label>
                                    <div class="input-group">
                                        <input type="number" name="{{ $field }}" class="form-control"
                                            min="0" value="0" required>
                                        <span class="input-group-text text-muted">Orang</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
