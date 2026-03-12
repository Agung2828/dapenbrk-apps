<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaInformasiController;
use App\Http\Controllers\Admin\LaporanKeuanganController;
use App\Http\Controllers\JumlahPesertaController;
use App\Http\Controllers\Admin\WartaController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\PeraturanController;
use App\Models\Gallery;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\SimulasiManfaatController;
use App\Http\Controllers\Admin\PesertaController;
use App\Http\Controllers\Admin\FormPemutakhiranController;
use App\Http\Controllers\MateriSosialisasiController;
use App\Http\Controllers\PesertaSearchController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| API SEARCH & VERIFY PESERTA (HARUS DI ATAS ROUTE LAINNYA)
|--------------------------------------------------------------------------
*/
Route::get('/peserta/search', [PesertaController::class, 'search'])
    ->name('peserta.search');

// 🔥 VERIFY: dipakai oleh simulasi.blade.php — HARUS di luar admin group
Route::get('/peserta/verify', PesertaSearchController::class)
    ->name('peserta.verify');

/*
|--------------------------------------------------------------------------
| PUBLIC / USER
|--------------------------------------------------------------------------
*/
Route::get('/', [BeritaInformasiController::class, 'dashboard'])->name('dashboard');

Route::get('/profile', fn() => view('Profile'));
Route::get('/pengaduan', fn() => view('Pengaduan'))->name('Pengaduan');

Route::get('/kepesertaan', [JumlahPesertaController::class, 'kepesertaan'])
    ->name('kepesertaan');

/*
|--------------------------------------------------------------------------
| FORMULIR & PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/formulir', [FormPemutakhiranController::class, 'listPublik'])
    ->name('formulir');

Route::get('/simulasi', [SimulasiManfaatController::class, 'index'])
    ->name('simulasi');

Route::get('/peraturan', [PeraturanController::class, 'index'])
    ->name('Peraturan');

Route::get('/warta', [WartaController::class, 'warta'])
    ->name('Warta');

/*
|--------------------------------------------------------------------------
| BERITA
|--------------------------------------------------------------------------
*/
Route::get('/berita/{id}', [BeritaInformasiController::class, 'show'])
    ->name('berita.show');

Route::get('/berita-detail/{id}', [BeritaInformasiController::class, 'detail'])
    ->name('berita.detail');

/*
|--------------------------------------------------------------------------
| GALERI PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/galeri', function () {
    $galleries = Gallery::with('items')->get();
    return view('Galeri', compact('galleries'));
})->name('Galeri');

/*
|--------------------------------------------------------------------------
| ADMIN (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', [BeritaInformasiController::class, 'index'])
            ->name('index');

        // Berita
        Route::resource('berita', BeritaInformasiController::class);

        // Warta
        Route::resource('warta', WartaController::class);

        // Dokumen
        Route::resource('dokumen', DokumenController::class)
            ->except(['show']);

        // Gallery
        Route::resource('gallery', GalleryController::class);

        Route::delete(
            'gallery-item/{id}',
            [GalleryController::class, 'destroyItem']
        )->name('gallery-item.destroy');

        // ============================
        // PESERTA (IMPORT EXCEL)
        // ============================
        Route::delete('peserta/destroy-all', [PesertaController::class, 'destroyAll'])
            ->name('peserta.destroyAll');

        Route::post(
            'peserta/import',
            [PesertaController::class, 'import']
        )->name('peserta.import');

        Route::resource('peserta', PesertaController::class)
            ->except(['show']);

        // ============================
        // FORM PEMUTAKHIRAN
        // ============================
        Route::resource(
            'form-pemutakhiran',
            FormPemutakhiranController::class
        )->except(['show', 'edit', 'update']);

        // ============================
        // LAPORAN KEUANGAN
        // ============================
        Route::get('laporan-keuangan', [LaporanKeuanganController::class, 'index'])
            ->name('laporan.index');

        Route::get('laporan-keuangan/create', [LaporanKeuanganController::class, 'create'])
            ->name('laporan.create');

        Route::post('laporan-keuangan', [LaporanKeuanganController::class, 'store'])
            ->name('laporan.store');

        Route::put('laporan-keuangan/{laporan}', [LaporanKeuanganController::class, 'update'])
            ->name('laporan.update');

        Route::delete('laporan-keuangan/{laporan}', [LaporanKeuanganController::class, 'destroy'])
            ->name('laporan.destroy');

        // ============================
        // JUMLAH PESERTA
        // ============================
        Route::get('jumlah-peserta', [JumlahPesertaController::class, 'index'])
            ->name('jumlah-peserta.index');

        Route::get('jumlah-peserta/{id}/edit', [JumlahPesertaController::class, 'edit'])
            ->name('jumlah-peserta.edit');

        Route::put('jumlah-peserta/{id}', [JumlahPesertaController::class, 'update'])
            ->name('jumlah-peserta.update');

        // Slider
        Route::resource('slider', SliderController::class)
            ->except(['show', 'edit', 'update']);

        // Materi Sosialisasi
        Route::get('materi-sosialisasi', [MateriSosialisasiController::class, 'index'])->name('materi.index');
        Route::get('materi-sosialisasi/create', [MateriSosialisasiController::class, 'create'])->name('materi.create');
        Route::post('materi-sosialisasi', [MateriSosialisasiController::class, 'store'])->name('materi.store');
        Route::get('materi-sosialisasi/{materi}/edit', [MateriSosialisasiController::class, 'edit'])->name('materi.edit');
        Route::put('materi-sosialisasi/{materi}', [MateriSosialisasiController::class, 'update'])->name('materi.update');
        Route::delete('materi-sosialisasi/{materi}', [MateriSosialisasiController::class, 'destroy'])->name('materi.destroy');
    });

/*
|--------------------------------------------------------------------------
| LAINNYA
|--------------------------------------------------------------------------
*/
Route::get('/pengkinian-data', function () {
    return view('pengkinian-data');
});
