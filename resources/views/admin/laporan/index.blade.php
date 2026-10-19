@extends('layout.admin.index')

@section('page-title', 'Laporan Keuangan')

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
            flex: 1 1 220px;
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

        .search-box input:focus,
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
        }

        .form-control {
            border-radius: 10px;
            border-color: #e2e8f0;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
        }

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
            max-width: 380px;
            word-break: break-word;
        }

        .badge-tahun {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            padding: 3px 11px;
            border-radius: 50px;
            background: #eff6ff;
            color: #2563eb;
        }

        .pdf-ic {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #fef2f2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        /* Kartu mobile */
        .doc-card {
            display: flex;
            gap: 12px;
            padding: 12px;
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

        .doc-body {
            flex: 1;
            min-width: 0;
        }

        .doc-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.35;
            margin: 6px 0 10px;
            word-break: break-word;
        }

        .doc-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
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

        /* Modal */
        .modal.fade .modal-dialog {
            transform: scale(.9) translateY(16px);
            transition: transform .3s cubic-bezier(.2, .8, .2, 1), opacity .3s;
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        .modal-content {
            border: none;
            border-radius: 18px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, .28);
            overflow: hidden;
        }

        .modal-edit .modal-header {
            border-bottom: 1px solid #f1f5f9;
        }

        .modal-edit .modal-footer {
            border-top: 1px solid #f1f5f9;
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
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
        }

        .confirm-item .ci-title {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
            word-break: break-word;
        }

        .confirm-item .ci-sub {
            font-size: 12px;
            color: #64748b;
            margin-top: 2px;
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

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="panel">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <h5 class="panel-title">Daftar Laporan Keuangan</h5>
                <div class="panel-sub">{{ count($laporans) }} laporan</div>
            </div>
            <div class="toolbar flex-grow-1 flex-md-grow-0">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari tahun / judul...">
                </div>
                <a href="{{ route('admin.laporan.create') }}" class="btn btn-primary btn-tambah">
                    <i class="bi bi-plus-lg"></i> Tambah Laporan
                </a>
            </div>
        </div>

        @if (count($laporans) === 0)
            <div class="empty-state">
                <i class="bi bi-file-earmark-bar-graph"></i>
                Belum ada laporan keuangan.
            </div>
        @else
            {{-- ===== TABEL: tablet & desktop ===== --}}
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:60px">No</th>
                            <th style="width:100px">Tahun</th>
                            <th>Judul</th>
                            <th style="width:120px">File</th>
                            <th class="text-end" style="width:190px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $item)
                            <tr class="js-item" data-search="{{ strtolower($item->tahun . ' ' . $item->judul) }}"
                                style="animation-delay: {{ min($loop->index, 15) * 50 }}ms;">
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge-tahun">{{ $item->tahun }}</span></td>
                                <td class="judul-cell">{{ $item->judul }}</td>
                                <td>
                                    @if ($item->file)
                                        <a href="{{ asset('uploads/laporan/' . $item->file) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-file-earmark-pdf"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-outline-warning btn-sm btn-edit"
                                        data-action="{{ route('admin.laporan.update', $item->id) }}"
                                        data-tahun="{{ $item->tahun }}" data-judul="{{ $item->judul }}"
                                        data-file="{{ $item->file }}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-hapus"
                                        data-action="{{ route('admin.laporan.destroy', $item->id) }}"
                                        data-judul="{{ $item->judul }}" data-tahun="{{ $item->tahun }}">
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
                @foreach ($laporans as $item)
                    <div class="doc-card js-item" data-search="{{ strtolower($item->tahun . ' ' . $item->judul) }}"
                        style="animation-delay: {{ min($loop->index, 15) * 60 }}ms;">
                        <div class="pdf-ic"><i class="bi bi-file-earmark-bar-graph-fill"></i></div>
                        <div class="doc-body">
                            <span class="badge-tahun">{{ $item->tahun }}</span>
                            <div class="doc-title">{{ $item->judul }}</div>
                            <div class="doc-actions">
                                @if ($item->file)
                                    <a href="{{ asset('uploads/laporan/' . $item->file) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                @endif
                                <button type="button" class="btn btn-outline-warning btn-sm btn-edit"
                                    data-action="{{ route('admin.laporan.update', $item->id) }}"
                                    data-tahun="{{ $item->tahun }}" data-judul="{{ $item->judul }}"
                                    data-file="{{ $item->file }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm btn-hapus"
                                    data-action="{{ route('admin.laporan.destroy', $item->id) }}"
                                    data-judul="{{ $item->judul }}" data-tahun="{{ $item->tahun }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="empty-state d-none" id="noResult">
                <i class="bi bi-search"></i>
                Tidak ada laporan yang cocok.
            </div>
        @endif
    </div>

    {{-- ===== MODAL EDIT ===== --}}
    <div class="modal fade modal-edit" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="formEdit" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h6 class="modal-title fw-bold"><i class="bi bi-pencil-square"></i> Edit Laporan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="text" name="tahun" id="editTahun" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" id="editJudul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">File Saat Ini</label>
                        <a id="editFilePreview" href="#" target="_blank" class="small text-break"></a>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Ganti File PDF (opsional)</label>
                        <input type="file" name="file" class="form-control" accept="application/pdf">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnUpdate">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== MODAL KONFIRMASI HAPUS ===== --}}
    <div class="modal fade modal-confirm" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <form method="POST" id="formHapus" class="modal-content">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <div class="confirm-icon"><i class="bi bi-trash3-fill"></i></div>
                    <div class="confirm-title">Hapus laporan ini?</div>
                    <div class="confirm-text">Data yang sudah dihapus tidak dapat dikembalikan.</div>

                    <div class="confirm-item">
                        <div class="pdf-ic"><i class="bi bi-file-earmark-bar-graph-fill"></i></div>
                        <div>
                            <div class="ci-title" id="hapusJudul"></div>
                            <div class="ci-sub" id="hapusTahun"></div>
                        </div>
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
            const fileBase = @json(asset('uploads/laporan')) + '/';

            // ===== Pencarian (tabel + kartu) =====
            const search = document.getElementById('searchInput');
            const noResult = document.getElementById('noResult');

            search.addEventListener('input', function() {
                const kw = this.value.trim().toLowerCase();
                let visible = 0;

                document.querySelectorAll('.js-item').forEach(el => {
                    const match = el.dataset.search.includes(kw);
                    el.style.display = match ? '' : 'none';
                    if (match && el.offsetParent !== null) visible++;
                });

                if (noResult) noResult.classList.toggle('d-none', visible > 0);
            });

            // ===== Modal (dipindah ke body agar selalu di atas backdrop) =====
            const editEl = document.getElementById('modalEdit');
            const hapusEl = document.getElementById('modalHapus');
            document.body.appendChild(editEl);
            document.body.appendChild(hapusEl);

            const editModal = new bootstrap.Modal(editEl);
            const hapusModal = new bootstrap.Modal(hapusEl);

            // --- Edit ---
            const formEdit = document.getElementById('formEdit');
            const btnUpdate = document.getElementById('btnUpdate');
            const btnUpdateHtml = btnUpdate.innerHTML;
            const preview = document.getElementById('editFilePreview');

            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', () => {
                    formEdit.action = btn.dataset.action;
                    document.getElementById('editTahun').value = btn.dataset.tahun;
                    document.getElementById('editJudul').value = btn.dataset.judul;
                    formEdit.querySelector('input[type=file]').value = '';

                    if (btn.dataset.file) {
                        preview.href = fileBase + btn.dataset.file;
                        preview.textContent = btn.dataset.file;
                        preview.classList.remove('text-muted');
                    } else {
                        preview.removeAttribute('href');
                        preview.textContent = 'Tidak ada file';
                        preview.classList.add('text-muted');
                    }
                    editModal.show();
                });
            });

            formEdit.addEventListener('submit', () => {
                btnUpdate.disabled = true;
                btnUpdate.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
            });
            editEl.addEventListener('hidden.bs.modal', () => {
                btnUpdate.disabled = false;
                btnUpdate.innerHTML = btnUpdateHtml;
            });

            // --- Hapus ---
            const formHapus = document.getElementById('formHapus');
            const btnOk = document.getElementById('btnKonfirmasiHapus');
            const btnOkHtml = btnOk.innerHTML;

            document.querySelectorAll('.btn-hapus').forEach(btn => {
                btn.addEventListener('click', () => {
                    formHapus.action = btn.dataset.action;
                    document.getElementById('hapusJudul').textContent = btn.dataset.judul;
                    document.getElementById('hapusTahun').textContent = 'Tahun ' + btn.dataset
                        .tahun;
                    hapusModal.show();
                });
            });

            formHapus.addEventListener('submit', () => {
                btnOk.disabled = true;
                btnOk.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1"></span> Menghapus...';
            });
            hapusEl.addEventListener('hidden.bs.modal', () => {
                btnOk.disabled = false;
                btnOk.innerHTML = btnOkHtml;
            });
        });
    </script>
@endpush
