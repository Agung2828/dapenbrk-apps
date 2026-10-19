@extends('layout.admin.index')

@section('page-title', 'Tambah Slider')

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
            max-width: 760px;
            animation: fadeUp .45s ease both;
        }

        .panel-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        .form-control {
            border-radius: 10px;
            border-color: #e2e8f0;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
        }

        .preview-wrap {
            display: none;
            margin-top: 10px;
        }

        .preview-wrap img {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .form-actions .btn {
            border-radius: 10px;
            padding: 10px 18px;
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="panel-title">Tambah Slider</h5>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data" id="formSlider">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul Besar</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Background</label>
                <input type="file" name="image" id="inputImage" class="form-control" accept="image/*" required>
                <small class="text-muted">Disarankan ukuran 1920x1080</small>
                <div class="preview-wrap" id="previewWrap">
                    <img src="" alt="Preview" id="previewImg">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Urutan</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.slider.index') }}" class="btn btn-light border">Batal</a>
                <button type="submit" class="btn btn-success" id="btnSimpan">
                    <i class="bi bi-check-lg"></i> Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('inputImage');
            const wrap = document.getElementById('previewWrap');
            const img = document.getElementById('previewImg');
            const form = document.getElementById('formSlider');
            const btn = document.getElementById('btnSimpan');

            input.addEventListener('change', () => {
                const file = input.files[0];
                if (!file) {
                    wrap.style.display = 'none';
                    return;
                }
                img.src = URL.createObjectURL(file);
                wrap.style.display = 'block';
            });

            form.addEventListener('submit', () => {
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
            });
        });
    </script>
@endpush
