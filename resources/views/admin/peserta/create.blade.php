@extends('layout.admin.index')

@section('content')
    <style>
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
        }

        .card-header {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        form {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            width: 100%;
            padding: .75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #3b82f6;
            outline: none;
        }

        .date-wrapper {
            position: relative;
        }

        .calendar-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            pointer-events: none;
        }

        .currency-wrapper {
            position: relative;
        }

        .currency-prefix {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }

        .currency-input {
            padding-left: 3rem !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1e3a8a);
            color: white;
            border: none;
            padding: .85rem 2.5rem;
            border-radius: 8px;
        }

        .text-danger {
            font-size: .85rem;
        }
    </style>


    <div class="card">
        <div class="card-header">
            <h3>Tambah Peserta</h3>
            <a href="{{ route('admin.peserta.index') }}" class="btn">
                ← Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.peserta.store') }}">
            @csrf

            {{-- =========================
           KODE
        ========================== --}}
            <div class="form-group">
                <label>Kode</label>
                <input name="kode" value="{{ old('kode') }}" class="form-control" required>
                @error('kode')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            {{-- =========================
           NIK
        ========================== --}}
            <div class="form-group">
                <label>NIK</label>
                <input id="nik" name="nik" value="{{ old('nik') }}" class="form-control" maxlength="16"
                    required>
                @error('nik')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            {{-- =========================
           NAMA
        ========================== --}}
            <div class="form-group">
                <label>Nama</label>
                <input name="nama" value="{{ old('nama') }}" class="form-control" required>
                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            {{-- =========================
           🔥 TANGGAL LAHIR (BARU)
        ========================== --}}
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <div class="date-wrapper">
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control"
                        required>
                    <span class="calendar-icon"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>


            {{-- =========================
           TANGGAL JADI PESERTA
        ========================== --}}
            <div class="form-group">
                <label>Tanggal Jadi Peserta</label>
                <div class="date-wrapper">
                    <input type="date" name="tanggal_jadi" value="{{ old('tanggal_jadi') }}" class="form-control"
                        required>
                    <span class="calendar-icon"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>


            {{-- =========================
           🔥 TANGGAL PENSIUN (BARU)
        ========================== --}}
            <div class="form-group">
                <label>Tanggal Pensiun</label>
                <div class="date-wrapper">
                    <input type="date" name="tanggal_pensiun" value="{{ old('tanggal_pensiun') }}" class="form-control"
                        required>
                    <span class="calendar-icon"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>


            {{-- =========================
           PHDP
        ========================== --}}
            <div class="form-group">
                <label>PhDP</label>
                <div class="currency-wrapper">
                    <span class="currency-prefix">Rp</span>
                    <input type="text" id="phdp_display" class="form-control currency-input">
                    <input type="hidden" name="phdp" id="phdp" value="{{ old('phdp') }}">
                </div>
                @error('phdp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <button class="btn-primary" type="submit">
                💾 Simpan
            </button>
        </form>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ======================
               NIK ONLY NUMBER
            ====================== */
            const nik = document.getElementById('nik');
            nik.addEventListener('input', () => {
                nik.value = nik.value.replace(/\D/g, '').slice(0, 16);
            });


            /* ======================
               FORMAT RUPIAH PHDP
            ====================== */
            const disp = document.getElementById('phdp_display');
            const hid = document.getElementById('phdp');

            const format = v => v.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            if (hid.value) {
                disp.value = format(hid.value);
            }

            disp.addEventListener('input', e => {
                let val = e.target.value.replace(/\D/g, '');
                hid.value = val;
                disp.value = val ? format(val) : '';
            });

        });
    </script>
@endsection
