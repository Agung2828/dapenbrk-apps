@extends('layout.admin.index')

@section('page-title', 'Edit Peserta')

@push('styles')
    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px;
            max-width: 860px;
            animation: fadeUp .45s ease both;
        }

        .panel-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .panel-sub {
            font-size: 13px;
            color: #64748b;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        .form-control {
            border-radius: 10px;
            border-color: #e2e8f0;
            padding: .6rem .85rem;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
        }

        .currency-wrapper {
            position: relative;
        }

        .currency-prefix {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-weight: 600;
            font-size: 14px;
            pointer-events: none;
        }

        .currency-input {
            padding-left: 44px !important;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .form-actions .btn {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
        }

        @media (max-width: 576px) {
            .panel {
                padding: 14px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="panel">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h5 class="panel-title">Edit Peserta</h5>
                <div class="panel-sub">{{ $peserta->nama }}</div>
            </div>
            <a href="{{ route('admin.peserta.index') }}" class="btn btn-light border btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.peserta.update', $peserta->id) }}" id="formPeserta" novalidate>
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label" for="kode">Kode</label>
                    <input id="kode" name="kode" value="{{ old('kode', $peserta->kode) }}"
                        class="form-control @error('kode') is-invalid @enderror" required>
                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label" for="nik">NIK</label>
                    <input id="nik" name="nik" value="{{ old('nik', $peserta->nik) }}" maxlength="16"
                        inputmode="numeric" autocomplete="off" class="form-control @error('nik') is-invalid @enderror"
                        required>
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label" for="nama">Nama</label>
                    <input id="nama" name="nama" value="{{ old('nama', $peserta->nama) }}"
                        class="form-control @error('nama') is-invalid @enderror" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', optional($peserta->tanggal_lahir)->format('Y-m-d')) }}"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label" for="tanggal_jadi">Tanggal Jadi Peserta</label>
                    <input type="date" id="tanggal_jadi" name="tanggal_jadi"
                        value="{{ old('tanggal_jadi', optional($peserta->tanggal_jadi)->format('Y-m-d')) }}"
                        class="form-control @error('tanggal_jadi') is-invalid @enderror" required>
                    @error('tanggal_jadi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label" for="tanggal_pensiun">Tanggal Pensiun</label>
                    <input type="date" id="tanggal_pensiun" name="tanggal_pensiun"
                        value="{{ old('tanggal_pensiun', optional($peserta->tanggal_pensiun)->format('Y-m-d')) }}"
                        class="form-control @error('tanggal_pensiun') is-invalid @enderror" required>
                    @error('tanggal_pensiun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label" for="phdp_display">PhDP</label>
                    <div class="currency-wrapper">
                        <span class="currency-prefix">Rp</span>
                        <input type="text" id="phdp_display" inputmode="numeric" autocomplete="off"
                            class="form-control currency-input @error('phdp') is-invalid @enderror" placeholder="0">
                        <input type="hidden" name="phdp" id="phdp"
                            value="{{ old('phdp', (int) $peserta->phdp) }}">
                        @error('phdp')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="text-muted">Format Rupiah otomatis</small>
                </div>
            </div>

            <div class="form-actions mt-4">
                <a href="{{ route('admin.peserta.index') }}" class="btn btn-light border">Batal</a>
                <button type="submit" class="btn btn-primary" id="btnSimpan">
                    <i class="bi bi-check-lg"></i> Update
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ===== NIK: hanya angka =====
            const nik = document.getElementById('nik');
            nik.addEventListener('input', () => {
                nik.value = nik.value.replace(/\D/g, '').slice(0, 16);
            });

            // ===== PhDP: format Rupiah =====
            const disp = document.getElementById('phdp_display');
            const hid = document.getElementById('phdp');
            const rupiah = v => v.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            if (hid.value) disp.value = rupiah(String(hid.value).replace(/\D/g, ''));

            disp.addEventListener('input', () => {
                const val = disp.value.replace(/\D/g, '');
                hid.value = val;
                disp.value = val ? rupiah(val) : '';
            });

            // ===== Cegah klik ganda =====
            const form = document.getElementById('formPeserta');
            const btn = document.getElementById('btnSimpan');
            form.addEventListener('submit', () => {
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
            });
        });
    </script>
@endpush
