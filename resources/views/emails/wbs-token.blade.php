<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nomor Tiket WBS</title>
</head>

<body style="margin:0; padding:0; background:#f5f7fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="100%"
                    style="max-width:520px; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 5px 20px rgba(0,0,0,.08);">
                    <tr>
                        <td style="background:linear-gradient(135deg,#1e3c72 0%,#2a5298 100%); padding:28px 32px;">
                            <h2 style="color:#fff; margin:0; font-size:20px;">Whistleblowing System</h2>
                            <p style="color:#dbeafe; margin:4px 0 0; font-size:13px;">Dana Pensiun Bank Riau Kepri</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px;">
                            <p style="color:#374151; font-size:14.5px; line-height:1.7;">
                                Terima kasih telah menyampaikan laporan melalui Whistleblowing System Dana Pensiun
                                Bank Riau Kepri. Berikut nomor tiket laporan Anda:
                            </p>

                            <div
                                style="background:#eff6ff; border:1.5px dashed #2a5298; border-radius:10px; padding:18px; text-align:center; margin:20px 0;">
                                <span style="font-size:20px; font-weight:700; color:#1e3c72; letter-spacing:1px;">
                                    {{ $laporan->ticket_token }}
                                </span>
                            </div>

                            <p style="color:#374151; font-size:14px; line-height:1.7;">
                                Simpan nomor tiket ini untuk melacak status laporan Anda melalui menu
                                <strong>WBS &rsaquo; Lacak Pelaporan</strong> di situs resmi Dana Pensiun Bank Riau
                                Kepri.
                            </p>

                            <p style="color:#6b7280; font-size:13px; line-height:1.7; margin-top:20px;">
                                Kerahasiaan identitas dan substansi laporan Anda kami jamin sepenuhnya sesuai
                                kebijakan Whistleblowing System kami.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:18px 32px; background:#f8fafc; text-align:center;">
                            <p style="color:#9ca3af; font-size:12px; margin:0;">
                                Email ini dikirim otomatis, mohon tidak membalas ke alamat ini.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
