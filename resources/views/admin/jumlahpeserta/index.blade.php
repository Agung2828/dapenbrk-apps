@extends('layout.admin.index')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Jumlah Peserta</h3>

            {{-- TOMBOL EDIT (PASTI MUNCUL) --}}
            <a href="{{ route('admin.jumlah-peserta.edit', $data->id) }}" class="btn btn-warning">
                ✏️ Edit Jumlah Peserta
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @php
            $fields = [
                'peserta_aktif' => 'Peserta Aktif',
                'pensiun_ditunda' => 'Pensiun Ditunda',
                'pensiun_normal' => 'Pensiun Normal',
                'pensiun_dipercepat' => 'Pensiun Dipercepat',
                'pensiun_janda_duda' => 'Pensiun Janda/Duda',
                'pensiun_anak' => 'Pensiun Anak',
            ];

            $total = 0;
            foreach ($fields as $field => $label) {
                $total += $data->$field;
            }
        @endphp

        <div class="row">
            @foreach ($fields as $field => $label)
                <div class="col-md-4 mb-3">
                    <div class="card shadow text-center">
                        <div class="card-body">
                            <h5 class="text-muted">{{ $label }}</h5>
                            <h2 class="fw-bold text-primary">
                                {{ $data->$field }}
                            </h2>
                            <span class="text-muted">Orang</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card mt-3 shadow">
            <div class="card-body text-center">
                <h3 class="fw-bold">
                    Total Peserta:
                    <span class="text-warning">{{ $total }}</span> Orang
                </h3>
            </div>
        </div>

    </div>
@endsection
