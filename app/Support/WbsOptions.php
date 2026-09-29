<?php

namespace App\Support;

class WbsOptions
{
    public static function kategoriPengaduan(): array
    {
        return [
            'Kecurangan Laporan Keuangan' =>
            'Kesalahan penyajian yang disengaja atau kelalaian dalam jumlah/pengungkapan laporan keuangan yang tidak sesuai praktik akuntansi yang berlaku umum.',
            'Korupsi' =>
            'Penyalahgunaan wewenang atau jabatan untuk keuntungan pribadi/kelompok yang merugikan Dapen.',
            'Pembocoran Informasi/Data Rahasia' =>
            'Tindakan sengaja memberikan, meneruskan, atau menyebarkan data dan informasi rahasia Dapen kepada pihak yang tidak berhak.',
            'Penipuan' =>
            'Perbuatan tidak jujur atau tipu muslihat yang menimbulkan kerugian bagi Dapen, peserta, atau pihak lain.',
            'Penyalahgunaan Aset' =>
            'Penggunaan aset Dapen di luar peruntukan resmi atau untuk kepentingan pribadi.',
            'Tindakan Lain yang Dapat Dipersamakan dengan Fraud' =>
            'Pelanggaran lain di luar kategori di atas yang berpotensi merugikan Dapen, peserta, atau pihak lain.',
        ];
    }

    public static function jabatanTerlapor(): array
    {
        return [
            'Pengurus (Direksi)',
            'Dewan Pengawas',
            'Departemen Investasi',
            'Departemen Kepesertaan',
            'Departemen Akuntansi',
            'Departemen SI',
            'Departemen Umum',
            'Pihak Eksternal (Pihak Ketiga)',
        ];
    }

    public static function hubunganDapen(): array
    {
        return [
            'karyawan'          => 'Karyawan Internal DAPEN',
            'peserta_pensiunan' => 'Peserta / Pensiunan (Penerima Manfaat)',
            'vendor'            => 'Vendor / Pihak Ketiga (Mitra Investasi, IT, dll)',
            'masyarakat_umum'   => 'Masyarakat Umum',
        ];
    }

    public static function statusList(): array
    {
        return [
            'diajukan' => 'Diajukan',
            'diterima' => 'Diterima',
            'dalam_antrian' => 'Dalam Antrian',
            'diproses' => 'Diproses',
            'ditolak' => 'Ditolak',
            'selesai' => 'Selesai',
        ];
    }

    public static function buktiMaxFiles(): int
    {
        return 5;
    }
    public static function buktiMaxSizeMb(): int
    {
        return 10;
    }

    public static function buktiExt(): array
    {
        return [
            'pdf',
            'doc',
            'docx',
            'xls',
            'xlsx',
            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp',
            'mp3',
            'wav',
            'm4a',
            'mp4',
            'mov',
            'avi',
            'mkv'
        ];
    }
}
