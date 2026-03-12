@extends('layout.admin.index')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Dokumen</h4>

        <div class="d-flex gap-2">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari nama / judul / kode..."
                style="width: 260px;">
            <a href="{{ route('admin.dokumen.create') }}" class="btn btn-primary">
                + Tambah Data
            </a>
        </div>
    </div>

    <table class="table table-bordered align-middle" id="dokumenTable">
        <thead class="table-light">
            <tr>
                <th width="60">No</th>
                <th width="140">Kategori</th>
                <th>Judul / Nama</th>
                <th width="180">Keterangan</th>
                <th width="100">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp

            {{-- ================= PENSIUN ================= --}}
            @foreach ($pensiuns as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Pensiun</td>
                    <td>{{ $item->nama ?? '-' }}</td>
                    <td>{{ ucfirst($item->jenis) }}</td>
                    <td>
                        <form action="{{ route('admin.dokumen.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            {{-- ================= PERATURAN ================= --}}
            @foreach ($peraturans as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Peraturan</td>
                    <td>{{ $item->judul ?? '-' }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>
                        <form action="{{ route('admin.dokumen.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            {{-- ================= PEDOMAN ================= --}}
            @foreach ($pedomans as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Pedoman</td>
                    <td>{{ $item->nama ?? '-' }}</td>
                    <td>{{ $item->kode }}</td>
                    <td>
                        <form action="{{ route('admin.dokumen.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            {{-- ================= PSO ================= --}}
            @foreach ($psos as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>PSO</td>
                    <td>{{ $item->nama ?? '-' }}</td>
                    <td>{{ $item->kode }}</td>
                    <td>
                        <form action="{{ route('admin.dokumen.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            {{-- DATA KOSONG --}}
            @if ($no === 1)
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Data masih kosong
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- SEARCH SCRIPT --}}
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const keyword = this.value.toLowerCase();
            const rows = document.querySelectorAll('#dokumenTable tbody tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(keyword) ? '' : 'none';
            });
        });
    </script>
@endsection
