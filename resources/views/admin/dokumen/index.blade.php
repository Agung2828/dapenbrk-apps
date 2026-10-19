@extends('layout.admin.index')

@section('page-title', 'Data Dokumen')

@push('styles')
    <style>
        .panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px;
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

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .search-box {
            position: relative;
            flex: 1 1 240px;
            min-width: 0;
        }

        .search-box i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .search-box input {
            padding-left: 38px;
            border-radius: 10px;
            border-color: #e2e8f0;
        }

        .search-box input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
        }

        /* ===== Tabel ===== */
        .table thead th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #64748b;
            font-weight: 600;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        .table td {
            font-size: 14px;
            vertical-align: middle;
        }

        .table tbody tr {
            opacity: 0;
            animation: fadeUp .45s ease forwards;
        }

        .judul-cell {
            max-width: 420px;
            word-break: break-word;
        }

        /* ===== Badge kategori ===== */
        .badge-kat {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 11px;
            border-radius: 50px;
            white-space: nowrap;
        }

        .kat-pensiun {
            background: #eff6ff;
            color: #2563eb;
        }

        .kat-peraturan {
            background: #fef3c7;
            color: #b45309;
        }

        .kat-pedoman {
            background: #dcfce7;
            color: #15803d;
        }

        .kat-pso {
            background: #f3e8ff;
            color: #7e22ce;
        }

        /* ===== Kartu mobile ===== */
        .doc-card {
            padding: 12px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            background: #fff;
            margin-bottom: 12px;
            opacity: 0;
            animation: fadeUp .45s ease forwards;
        }

        .doc-card:last-child {
            margin-bottom: 0;
        }

        .doc-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.35;
            margin: 8px 0 4px;
            word-break: break-word;
        }

        .doc-meta {
            font-size: 12.5px;
            color: #64748b;
        }

        .doc-actions {
            margin-top: 10px;
            display: flex;
            justify-content: flex-end;
        }

        .empty-state {
            text-align: center;
            padding: 48px 12px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 44px;
            display: block;
            margin-bottom: 8px;
        }

        /* ===== Modal hapus ===== */
        .modal.fade .modal-dialog {
            transform: scale(.9) translateY(16px);
            transition: transform .3s cubic-bezier(.2, .8, .2, 1), opacity .3s;
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        .modal-confirm .modal-content {
            border: none;
            border-radius: 18px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, .28);
            overflow: hidden;
        }

        .modal-confirm .modal-body {
            padding: 28px 24px 8px;
            text-align: center;
        }

        .confirm-icon {
            width: 68px;
            height: 68px;
            margin: 0 auto 14px;
            border-radius: 50%;
            background: #fef2f2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            animation: popIn .45s cubic-bezier(.2, .9, .3, 1.4);
        }

        @keyframes popIn {
            from {
                transform: scale(.4);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .confirm-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .confirm-text {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 16px;
        }

        .confirm-item {
            text-align: left;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
        }

        .confirm-item .ci-title {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
            margin-top: 6px;
            word-break: break-word;
        }

        .modal-confirm .modal-footer {
            border: none;
            padding: 16px 24px 24px;
            gap: 10px;
            justify-content: center;
        }

        .modal-confirm .modal-footer .btn {
            flex: 1;
            border-radius: 10px;
            padding: 10px 14px;
            font-weight: 600;
        }

        @media (max-width: 576px) {
            .panel {
                padding: 14px;
            }

            .btn-tambah {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')

    @php
        // Gabungkan semua kategori jadi satu daftar agar tabel & kartu memakai data yang sama
        $rows = collect();
        foreach ($pensiuns as $i) {
            $rows->push([
                'id' => $i->id,
                'kat' => 'Pensiun',
                'key' => 'pensiun',
                'judul' => $i->nama ?? '-',
                'ket' => ucfirst($i->jenis ?? '-'),
            ]);
        }
        foreach ($peraturans as $i) {
            $rows->push([
                'id' => $i->id,
                'kat' => 'Peraturan',
                'key' => 'peraturan',
                'judul' => $i->judul ?? '-',
                'ket' => $i->tahun ?? '-',
            ]);
        }
        foreach ($pedomans as $i) {
            $rows->push([
                'id' => $i->id,
                'kat' => 'Pedoman',
                'key' => 'pedoman',
                'judul' => $i->nama ?? '-',
                'ket' => $i->kode ?? '-',
            ]);
        }
        foreach ($psos as $i) {
            $rows->push([
                'id' => $i->id,
                'kat' => 'PSO',
                'key' => 'pso',
                'judul' => $i->nama ?? '-',
                'ket' => $i->kode ?? '-',
            ]);
        }
    @endphp

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="panel">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <h5 class="panel-title">Data Dokumen</h5>
                <div class="panel-sub">{{ $rows->count() }} dokumen</div>
            </div>
            <div class="toolbar flex-grow-1 flex-md-grow-0">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari nama / judul / kode...">
                </div>
                <a href="{{ route('admin.dokumen.create') }}" class="btn btn-primary btn-tambah">
                    <i class="bi bi-plus-lg"></i> Tambah Data
                </a>
            </div>
        </div>

        @if ($rows->isEmpty())
            <div class="empty-state">
                <i class="bi bi-folder2-open"></i>
                Data masih kosong.
            </div>
        @else
            {{-- ===== TABEL: tablet & desktop ===== --}}
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:60px">No</th>
                            <th style="width:140px">Kategori</th>
                            <th>Judul / Nama</th>
                            <th style="width:180px">Keterangan</th>
                            <th class="text-end" style="width:110px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $r)
                            <tr class="js-item"
                                data-search="{{ strtolower($r['kat'] . ' ' . $r['judul'] . ' ' . $r['ket']) }}"
                                style="animation-delay: {{ min($loop->index, 15) * 40 }}ms;">
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge-kat kat-{{ $r['key'] }}">{{ $r['kat'] }}</span></td>
                                <td class="judul-cell">{{ $r['judul'] }}</td>
                                <td>{{ $r['ket'] }}</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-hapus"
                                        data-action="{{ route('admin.dokumen.destroy', $r['id']) }}"
                                        data-kategori="{{ $r['kat'] }}" data-key="{{ $r['key'] }}"
                                        data-judul="{{ $r['judul'] }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- ===== KARTU: mobile ===== --}}
            <div class="d-md-none">
                @foreach ($rows as $r)
                    <div class="doc-card js-item"
                        data-search="{{ strtolower($r['kat'] . ' ' . $r['judul'] . ' ' . $r['ket']) }}"
                        style="animation-delay: {{ min($loop->index, 15) * 50 }}ms;">
                        <span class="badge-kat kat-{{ $r['key'] }}">{{ $r['kat'] }}</span>
                        <div class="doc-title">{{ $r['judul'] }}</div>
                        <div class="doc-meta"><i class="bi bi-info-circle"></i> {{ $r['ket'] }}</div>
                        <div class="doc-actions">
                            <button type="button" class="btn btn-outline-danger btn-sm btn-hapus"
                                data-action="{{ route('admin.dokumen.destroy', $r['id']) }}"
                                data-kategori="{{ $r['kat'] }}" data-key="{{ $r['key'] }}"
                                data-judul="{{ $r['judul'] }}">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="empty-state d-none" id="noResult">
                <i class="bi bi-search"></i>
                Tidak ada dokumen yang cocok.
            </div>
        @endif
    </div>

    {{-- ===== MODAL KONFIRMASI HAPUS ===== --}}
    <div class="modal fade modal-confirm" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <form method="POST" id="formHapus" class="modal-content">
                @csrf
                @method('DELETE')
                <input type="hidden" name="kategori" id="hapusKey">

                <div class="modal-body">
                    <div class="confirm-icon"><i class="bi bi-trash3-fill"></i></div>
                    <div class="confirm-title">Hapus dokumen ini?</div>
                    <div class="confirm-text">Data yang sudah dihapus tidak dapat dikembalikan.</div>

                    <div class="confirm-item">
                        <span class="badge-kat" id="hapusBadge"></span>
                        <div class="ci-title" id="hapusJudul"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" id="btnKonfirmasiHapus">
                        <i class="bi bi-trash"></i> Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ===== Pencarian (tabel + kartu) =====
            const search = document.getElementById('searchInput');
            const noResult = document.getElementById('noResult');

            search.addEventListener('input', function() {
                const kw = this.value.trim().toLowerCase();
                let visible = 0;

                document.querySelectorAll('.js-item').forEach(el => {
                    const match = el.dataset.search.includes(kw);
                    el.style.display = match ? '' : 'none';
                    // hitung hanya elemen yang sedang tampil di layar (tabel ATAU kartu)
                    if (match && el.offsetParent !== null) visible++;
                });

                if (noResult) noResult.classList.toggle('d-none', visible > 0);
            });

            // ===== Modal hapus =====
            const modalEl = document.getElementById('modalHapus');
            document.body.appendChild(modalEl); // pastikan selalu di atas backdrop

            const modal = new bootstrap.Modal(modalEl);
            const form = document.getElementById('formHapus');
            const btnOk = document.getElementById('btnKonfirmasiHapus');
            const btnOkHtml = btnOk.innerHTML;
            const badge = document.getElementById('hapusBadge');

            document.querySelectorAll('.btn-hapus').forEach(btn => {
                btn.addEventListener('click', () => {
                    form.action = btn.dataset.action;
                    document.getElementById('hapusKey').value = btn.dataset.key;
                    document.getElementById('hapusJudul').textContent = btn.dataset.judul;
                    badge.textContent = btn.dataset.kategori;
                    badge.className = 'badge-kat kat-' + btn.dataset.key;
                    modal.show();
                });
            });

            form.addEventListener('submit', () => {
                btnOk.disabled = true;
                btnOk.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1"></span> Menghapus...';
            });

            modalEl.addEventListener('hidden.bs.modal', () => {
                btnOk.disabled = false;
                btnOk.innerHTML = btnOkHtml;
            });
        });
    </script>
@endpush
