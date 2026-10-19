@extends('layout.admin.index')

@section('page-title', 'Form Pemutakhiran Data')

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
            max-width: 460px;
            word-break: break-word;
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
            margin-bottom: 10px;
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

        /* Modal hapus */
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

    <div class="panel">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <h5 class="panel-title">Form Pemutakhiran Data (PDF)</h5>
                <div class="panel-sub">{{ count($data) }} form</div>
            </div>
            <a href="{{ route('admin.form-pemutakhiran.create') }}" class="btn btn-primary btn-tambah">
                <i class="bi bi-plus-lg"></i> Tambah Form PDF
            </a>
        </div>

        @if (count($data) === 0)
            <div class="empty-state">
                <i class="bi bi-file-earmark-pdf"></i>
                Belum ada form.
            </div>
        @else
            {{-- ===== TABEL: tablet & desktop ===== --}}
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:60px">No</th>
                            <th>Judul Form</th>
                            <th style="width:140px">File PDF</th>
                            <th class="text-end" style="width:120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr style="animation-delay: {{ min($loop->index, 15) * 50 }}ms;">
                                <td>{{ $loop->iteration }}</td>
                                <td class="judul-cell">{{ $item->judul }}</td>
                                <td>
                                    <a href="{{ asset('uploads/form_pemutakhiran/' . $item->file_pdf) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-file-earmark-pdf"></i> Lihat
                                    </a>
                                </td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-hapus"
                                        data-action="{{ route('admin.form-pemutakhiran.destroy', $item->id) }}"
                                        data-judul="{{ $item->judul }}">
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
                @foreach ($data as $item)
                    <div class="doc-card" style="animation-delay: {{ min($loop->index, 15) * 60 }}ms;">
                        <div class="pdf-ic"><i class="bi bi-file-earmark-pdf-fill"></i></div>
                        <div class="doc-body">
                            <div class="doc-title">{{ $item->judul }}</div>
                            <div class="doc-actions">
                                <a href="{{ asset('uploads/form_pemutakhiran/' . $item->file_pdf) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm btn-hapus"
                                    data-action="{{ route('admin.form-pemutakhiran.destroy', $item->id) }}"
                                    data-judul="{{ $item->judul }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ===== MODAL KONFIRMASI HAPUS ===== --}}
    <div class="modal fade modal-confirm" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <form method="POST" id="formHapus" class="modal-content">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <div class="confirm-icon"><i class="bi bi-trash3-fill"></i></div>
                    <div class="confirm-title">Hapus form ini?</div>
                    <div class="confirm-text">Data yang sudah dihapus tidak dapat dikembalikan.</div>

                    <div class="confirm-item">
                        <div class="pdf-ic"><i class="bi bi-file-earmark-pdf-fill"></i></div>
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
            const modalEl = document.getElementById('modalHapus');
            document.body.appendChild(modalEl); // pastikan selalu di atas backdrop

            const modal = new bootstrap.Modal(modalEl);
            const form = document.getElementById('formHapus');
            const btnOk = document.getElementById('btnKonfirmasiHapus');
            const btnOkHtml = btnOk.innerHTML;

            document.querySelectorAll('.btn-hapus').forEach(btn => {
                btn.addEventListener('click', () => {
                    form.action = btn.dataset.action;
                    document.getElementById('hapusJudul').textContent = btn.dataset.judul;
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
