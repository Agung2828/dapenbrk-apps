@extends('layout.admin.index')

@section('content')
    <div class="container mt-4" style="max-width: 780px;">

        {{-- HEADER --}}
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.jumlah-peserta.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <div>
                <h3 class="mb-0">Edit Jumlah Peserta</h3>
                <small class="text-muted">
                    Periode: {{ $data->nama_bulan }} {{ $data->tahun }}
                </small>
            </div>
        </div>

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Terdapat kesalahan:</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow border-0">
            <div class="card-header bg-warning bg-opacity-10 border-bottom py-3">
                <h6 class="mb-0 text-warning">
                    <i class="fas fa-edit me-2"></i>Form Edit Data Peserta
                </h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.jumlah-peserta.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- BULAN & TAHUN --}}
                    <div class="row g-3 mb-4 p-3 rounded" style="background:#fffbeb; border:1px solid #fde68a;">
                        <div class="col-12">
                            <small class="text-muted fw-semibold text-uppercase">
                                <i class="fas fa-calendar me-1"></i> Periode Data
                            </small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Bulan <span class="text-danger">*</span>
                            </label>
                            <select name="bulan" class="form-select @error('bulan') is-invalid @enderror" required>
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
                                        {{ old('bulan', $data->bulan) == $num ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Tahun <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                                min="2000" max="2100" value="{{ old('tahun', $data->tahun) }}" required>
                            @error('tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>
                    <small class="text-muted fw-semibold text-uppercase d-block mb-3">
                        <i class="fas fa-users me-1"></i> Data Jumlah Peserta
                    </small>

                    {{-- FIELD PESERTA --}}
                    @php
                        $fields = [
                            'peserta_aktif' => [
                                'label' => 'Peserta Aktif',
                                'icon' => 'fas fa-users',
                                'color' => 'primary',
                            ],
                            'pensiun_ditunda' => [
                                'label' => 'Pensiun Ditunda',
                                'icon' => 'fas fa-clock',
                                'color' => 'warning',
                            ],
                            'pensiun_normal' => [
                                'label' => 'Pensiun Normal',
                                'icon' => 'fas fa-user-check',
                                'color' => 'success',
                            ],
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
                            'pensiun_anak' => [
                                'label' => 'Pensiun Anak',
                                'icon' => 'fas fa-child',
                                'color' => 'secondary',
                            ],
                        ];
                    @endphp

                    <div class="row g-3 mb-4">
                        @foreach ($fields as $field => $meta)
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="{{ $meta['icon'] }} text-{{ $meta['color'] }} me-1"></i>
                                    {{ $meta['label'] }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" name="{{ $field }}"
                                        class="form-control @error($field) is-invalid @enderror" min="0"
                                        value="{{ old($field, $data->$field) }}" required>
                                    <span class="input-group-text text-muted">Orang</span>
                                    @error($field)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- PREVIEW TOTAL (live) --}}
                    <div class="p-3 rounded mb-4" style="background:#f0fdf4; border:1px solid #bbf7d0;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-success">
                                <i class="fas fa-calculator me-1"></i> Estimasi Total Peserta
                            </span>
                            <span class="fs-4 fw-bold text-success" id="totalPreview">
                                {{ number_format($data->peserta_aktif + $data->pensiun_ditunda + $data->pensiun_normal + $data->pensiun_dipercepat + $data->pensiun_janda_duda + $data->pensiun_anak) }}
                                Orang
                            </span>
                        </div>
                    </div>

                    {{-- TOMBOL --}}
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.jumlah-peserta.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    {{-- LIVE TOTAL SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fields = [
                'peserta_aktif', 'pensiun_ditunda', 'pensiun_normal',
                'pensiun_dipercepat', 'pensiun_janda_duda', 'pensiun_anak'
            ];

            function updateTotal() {
                let total = 0;
                fields.forEach(function(f) {
                    const el = document.querySelector('input[name="' + f + '"]');
                    total += parseInt(el ? el.value : 0) || 0;
                });
                document.getElementById('totalPreview').textContent =
                    total.toLocaleString('id-ID') + ' Orang';
            }

            fields.forEach(function(f) {
                const el = document.querySelector('input[name="' + f + '"]');
                if (el) el.addEventListener('input', updateTotal);
            });
        });
    </script>

@endsection
