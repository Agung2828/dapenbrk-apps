@extends('layout.admin.index')

@section('content')
    <div class="container mt-4">

        <h3>Edit Jumlah Peserta</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.jumlah-peserta.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            @php
                $fields = [
                    'peserta_aktif' => 'Peserta Aktif',
                    'pensiun_ditunda' => 'Pensiun Ditunda',
                    'pensiun_normal' => 'Pensiun Normal',
                    'pensiun_dipercepat' => 'Pensiun Dipercepat',
                    'pensiun_janda_duda' => 'Pensiun Janda/Duda',
                    'pensiun_anak' => 'Pensiun Anak',
                ];
            @endphp

            <div class="row">
                @foreach ($fields as $field => $label)
                    <div class="col-md-6 mb-3">
                        <label>{{ $label }}</label>
                        <input type="number" name="{{ $field }}" class="form-control" min="0"
                            value="{{ old($field, $data->$field) }}" required>
                    </div>
                @endforeach
            </div>

            <a href="{{ route('admin.jumlah-peserta.index') }}" class="btn btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn btn-warning">
                Update
            </button>
        </form>

    </div>
@endsection
