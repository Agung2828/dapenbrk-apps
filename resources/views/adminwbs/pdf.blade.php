<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #222;
        }

        .header-table {
            width: 100%;
            border-bottom: 3px solid #1e3c72;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header-table img {
            height: 50px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            color: #1e3c72;
            margin: 0;
        }

        .subtitle {
            font-size: 11px;
            color: #666;
            margin: 0;
        }

        .section-title {
            background: #1e3c72;
            color: #fff;
            padding: 6px 10px;
            font-weight: bold;
            margin-top: 16px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        table.data td {
            padding: 6px 10px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        table.data td.label {
            width: 32%;
            background: #f8fafc;
            font-weight: bold;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 10px;
            color: #fff;
            font-weight: bold;
            background: #2a5298;
        }

        .footer-note {
            margin-top: 30px;
            font-size: 10px;
            color: #888;
            text-align: center;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td style="width:60px;">
                @php
                    $logoPath = public_path('image/logodapenbrk.png');
                    $logoBase64 = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
                @endphp
                @if ($logoBase64)
                    <img src="data:image/png;base64,{{ $logoBase64 }}">
                @endif
            </td>
            <td>
                <p class="title">Laporan Whistleblowing System</p>
                <p class="subtitle">Dana Pensiun Bank Riau Kepri</p>
            </td>
            <td style="text-align:right;">
                <span class="status-badge">{{ \App\Models\WbsLaporan::statusLabel($laporan->status) }}</span>
            </td>
        </tr>
    </table>

    <div class="section-title">Informasi Tiket</div>
    <table class="data">
        <tr>
            <td class="label">Nomor Tiket</td>
            <td>{{ $laporan->ticket_token }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Lapor</td>
            <td>{{ $laporan->created_at->translatedFormat('d F Y, H:i') }}</td>
        </tr>
    </table>

    <div class="section-title">Data Pelapor</div>
    <table class="data">
        @if ($laporan->is_anonim)
            <tr>
                <td colspan="2">Pelapor memilih untuk <strong>Anonim (Rahasia)</strong>.</td>
            </tr>
        @else
            <tr>
                <td class="label">Nama</td>
                <td>{{ $laporan->nama_lengkap }}</td>
            </tr>
            <tr>
                <td class="label">Hubungan dengan DAPEN</td>
                <td>{{ $laporan->hubungan_dapen }}</td>
            </tr>
            <tr>
                <td class="label">No. Identitas</td>
                <td>{{ $laporan->nomor_identitas ?: '-' }}</td>
            </tr>
            <tr>
                <td class="label">No. Kontak</td>
                <td>{{ $laporan->no_kontak ?: '-' }}</td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td>{{ $laporan->email_pribadi ?: '-' }}</td>
            </tr>
        @endif
    </table>

    <div class="section-title">Rincian Kejadian</div>
    <table class="data">
        <tr>
            <td class="label">Kategori</td>
            <td>{{ $laporan->kategori_pengaduan }}</td>
        </tr>
        <tr>
            <td class="label">Deskripsi Kejadian</td>
            <td>{{ $laporan->deskripsi_kejadian }}</td>
        </tr>
        <tr>
            <td class="label">Deskripsi Kerugian</td>
            <td>{{ $laporan->deskripsi_kerugian ?: '-' }}</td>
        </tr>
    </table>

    <div class="section-title">Daftar Terlapor</div>
    <table class="data">
        @forelse ($laporan->terlapors as $i => $t)
            <tr>
                <td class="label">Terlapor {{ $i + 1 }}</td>
                <td>
                    <strong>{{ $t->nama_terlapor }}</strong>
                    @if ($t->jabatan_terlapor)
                        &mdash; {{ $t->jabatan_terlapor }}
                    @endif
                    @if ($t->info_tambahan_terlapor)
                        <br><em>{{ $t->info_tambahan_terlapor }}</em>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2">Tidak ada data terlapor.</td>
            </tr>
        @endforelse
    </table>

    <div class="section-title">Bukti Pendukung</div>
    <table class="data">
        @forelse ($laporan->bukti as $b)
            <tr>
                <td>{{ $b->nama_file_asli }}</td>
                <td>{{ $b->jenis_bukti }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">Tidak ada bukti dilampirkan.</td>
            </tr>
        @endforelse
    </table>

    @if ($laporan->catatan_admin)
        <div class="section-title">Catatan Tim Anti Fraud</div>
        <table class="data">
            <tr>
                <td>{{ $laporan->catatan_admin }}</td>
            </tr>
        </table>
    @endif

    <p class="footer-note">Dokumen ini dihasilkan otomatis oleh Sistem Whistleblowing Dana Pensiun Bank Riau Kepri
        &mdash; bersifat rahasia.</p>
</body>

</html>
