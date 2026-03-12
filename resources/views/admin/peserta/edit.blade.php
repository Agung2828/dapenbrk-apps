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
            padding: 1.2rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        form {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.3rem;
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

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1e3a8a);
            color: white;
            border: none;
            padding: .8rem 2.5rem;
            border-radius: 8px;
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
    </style>


    <div class="card">

        <div class="card-header">
            <h3>Edit Peserta</h3>
            <a class="btn btn-light" href="{{ route('admin.peserta.index') }}">← Kembali</a>
        </div>


        {{-- Error --}}
        @if ($errors->any())
            <div class="alert alert-danger m-3">
                <ul style="margin:0;padding-left:18px;">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="POST" action="{{ route('admin.peserta.update', $peserta->id) }}">
            @csrf
            @method('PUT')


            {{-- KODE --}}
            <div class="form-group">
                <label>Kode</label>
                <input name="kode" value="{{ old('kode', $peserta->kode) }}" class="form-control" required>
            </div>


            {{-- NIK --}}
            <div class="form-group">
                <label>NIK</label>
                <input name="nik" id="nik" maxlength="16" value="{{ old('nik', $peserta->nik) }}"
                    class="form-control" required>
            </div>


            {{-- NAMA --}}
            <div class="form-group">
                <label>Nama</label>
                <input name="nama" value="{{ old('nama', $peserta->nama) }}" class="form-control" required>
            </div>


            {{-- TANGGAL LAHIR --}}
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir"
                    value="{{ old('tanggal_lahir', optional($peserta->tanggal_lahir)->format('Y-m-d')) }}"
                    class="form-control" required>
            </div>


            {{-- TANGGAL JADI --}}
            <div class="form-group">
                <label>Tanggal Jadi Peserta</label>
                <input type="date" name="tanggal_jadi"
                    value="{{ old('tanggal_jadi', optional($peserta->tanggal_jadi)->format('Y-m-d')) }}"
                    class="form-control" required>
            </div>


            {{-- TANGGAL PENSIUN --}}
            <div class="form-group">
                <label>Tanggal Pensiun</label>
                <input type="date" name="tanggal_pensiun"
                    value="{{ old('tanggal_pensiun', optional($peserta->tanggal_pensiun)->format('Y-m-d')) }}"
                    class="form-control" required>
            </div>


            {{-- PHDP --}}
            <div class="form-group">
                <label>PhDP</label>

                <div class="currency-wrapper">
                    <span class="currency-prefix">Rp</span>

                    <input type="text" id="phdp_display" class="form-control currency-input">

                    <input type="hidden" name="phdp" id="phdp" value="{{ old('phdp', $peserta->phdp) }}">
                </div>

                <small class="text-muted">Format otomatis Rupiah</small>
            </div>


            <button class="btn-primary">Update</button>

        </form>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ===== NIK only number ===== */
            const nik = document.getElementById('nik');
            nik.addEventListener('input', () => {
                nik.value = nik.value.replace(/\D/g, '').slice(0, 16);
            });


            /* ===== PHDP format ===== */
            const disp = document.getElementById('phdp_display');
            const hid = document.getElementById('phdp');

            const rupiah = v => v.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            if (hid.value) {
                disp.value = rupiah(hid.value);
            }

            disp.addEventListener('input', e => {
                let val = e.target.value.replace(/\D/g, '');
                hid.value = val;
                disp.value = val ? rupiah(val) : '';
            });

        });
    </script>

@endsection
