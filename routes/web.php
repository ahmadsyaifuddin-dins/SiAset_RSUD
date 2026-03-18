<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangGudangController;
use App\Http\Controllers\BarangRusakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangKeluarController;
use App\Http\Controllers\GudangMasukController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SerahTerimaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// GROUP AUTH (Semua user login bisa akses ini)
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. DASHBOARD (Admin, Pimpinan, Karu Bisa Akses)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. PROFILE (Semua butuh ganti password/nama)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. PUSAT LAPORAN (Semua Role Bisa Akses)
    Route::prefix('laporan')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');

        // Gudang
        Route::get('/stok', [LaporanController::class, 'stokGudang'])->name('laporan.stok');
        Route::get('/masuk', [LaporanController::class, 'barangMasuk'])->name('laporan.masuk');
        Route::get('/keluar', [LaporanController::class, 'barangKeluar'])->name('laporan.keluar');

        // Aset
        Route::get('/inventaris', [LaporanController::class, 'inventaris'])->name('laporan.inventaris');
        Route::get('/kerusakan', [LaporanController::class, 'kerusakan'])->name('laporan.kerusakan');
        Route::get('/perbaikan', [LaporanController::class, 'perbaikan'])->name('laporan.perbaikan');
        Route::get('/pemusnahan', [LaporanController::class, 'pemusnahan'])->name('laporan.pemusnahan');
        Route::get('/serah-terima', [LaporanController::class, 'serahTerima'])->name('laporan.serah-terima-rekap');
    });

    // 4. GUDANG KELUAR / PERMINTAAN BARANG (Admin & Kepala Ruangan)
    Route::prefix('gudang')->group(function () {
        Route::resource('keluar', GudangKeluarController::class)->names([
            'index' => 'gudang-keluar.index',
            'create' => 'gudang-keluar.create',
            'store' => 'gudang-keluar.store',
            'destroy' => 'gudang-keluar.destroy',
        ]);

        // Route Khusus Tombol ACC & Tolak (HANYA ADMIN)
        Route::post('keluar/{id}/approve', [GudangKeluarController::class, 'approve'])->name('gudang-keluar.approve')->middleware('role:admin');
        Route::post('keluar/{id}/reject', [GudangKeluarController::class, 'reject'])->name('gudang-keluar.reject')->middleware('role:admin');
    });

    // KHUSUS ADMIN (Pimpinan & Kepala Ruangan TIDAK BISA Akses)
    Route::middleware(['role:admin'])->group(function () {

        // Manajemen User
        Route::resource('users', UserController::class);

        // Master Data
        Route::prefix('master')->group(function () {
            Route::resource('ruangan', RuanganController::class);
            Route::resource('barang', BarangController::class);
            Route::resource('barang-gudang', BarangGudangController::class);
        });

        // Inventaris
        Route::resource('inventaris', InventarisController::class)->parameters([
            'inventaris' => 'inventaris',
        ]);

        // Cetak Label QR Code
        Route::get('inventaris/{id}/cetak-label', [InventarisController::class, 'cetakLabel'])->name('inventaris.label');

        // Gudang (Masuk & Stok Saja)
        Route::prefix('gudang')->group(function () {
            Route::get('stok', [BarangGudangController::class, 'index'])->name('gudang.stok');
            Route::resource('masuk', GudangMasukController::class)->names([
                'index' => 'gudang-masuk.index',
                'create' => 'gudang-masuk.create',
                'store' => 'gudang-masuk.store',
                'destroy' => 'gudang-masuk.destroy',
            ]);
        });

        // Perbaikan
        Route::prefix('perbaikan')->group(function () {
            Route::resource('kerusakan', KerusakanController::class);
            Route::resource('tindakan', PerbaikanController::class);
        });

        // Akhir Aset (BAP & Serah Terima)
        Route::resource('barang-rusak', BarangRusakController::class)->names([
            'index' => 'barang-rusak.index',
            'create' => 'barang-rusak.create',
            'store' => 'barang-rusak.store',
        ]);
        Route::get('barang-rusak/{id}/bap', [BarangRusakController::class, 'cetakBap'])->name('barang-rusak.bap');

        Route::resource('serah-terima', SerahTerimaController::class)->names([
            'index' => 'serah-terima.index',
            'create' => 'serah-terima.create',
            'store' => 'serah-terima.store',
        ]);
        Route::get('serah-terima/{id}/cetak', [SerahTerimaController::class, 'cetakPdf'])->name('serah-terima.cetak');
    });
});

require __DIR__.'/auth.php';
