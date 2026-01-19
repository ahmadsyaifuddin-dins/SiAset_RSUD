<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangGudangController;
use App\Http\Controllers\BarangRusakController;
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

// use App\Http\Controllers\GudangMasukController;
// use App\Http\Controllers\GudangKeluarController;
// use App\Http\Controllers\KerusakanController;
// use App\Http\Controllers\PerbaikanController;
// use App\Http\Controllers\BarangRusakController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Bisa diarahkan ke login langsung jika mau
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group Middleware Auth (Hanya yang login bisa akses)
Route::middleware('auth')->group(function () {

    // 1. PROFILE & USER
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Jika nanti butuh manajemen user lain
    Route::resource('users', UserController::class);
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    // 2. MASTER DATA (Sidebar: Master Data)
    // Prefix 'master' biar URL rapi: /master/ruangan, /master/barang
    Route::prefix('master')->group(function () {
        Route::resource('ruangan', RuanganController::class);
        Route::resource('barang', BarangController::class); // Aset Tetap (Laptop, dll)
        Route::resource('barang-gudang', BarangGudangController::class); // BHP (Kertas, dll)
    });

    // 3. INVENTARIS (Sidebar: Inventaris Barang)
    Route::resource('inventaris', InventarisController::class)->parameters([
        'inventaris' => 'inventaris',
    ]);

    // 4. GUDANG
    Route::prefix('gudang')->group(function () {

        // Menu Stok Gudang (Re-use dari Master Barang Gudang)
        Route::get('stok', [BarangGudangController::class, 'index'])->name('gudang.stok');

        // Transaksi Masuk
        Route::resource('masuk', GudangMasukController::class)->names([
            'index' => 'gudang-masuk.index',
            'create' => 'gudang-masuk.create',
            'store' => 'gudang-masuk.store',
            'destroy' => 'gudang-masuk.destroy',
        ]);

        // Transaksi Keluar
        Route::resource('keluar', GudangKeluarController::class)->names([
            'index' => 'gudang-keluar.index',
            'create' => 'gudang-keluar.create',
            'store' => 'gudang-keluar.store',
            'destroy' => 'gudang-keluar.destroy',
        ]);
    });

    // 5. PERBAIKAN / MAINTENANCE (Sidebar: Perbaikan)
    Route::prefix('perbaikan')->group(function () {
        // Permintaan Perbaikan (Lapor Kerusakan)
        Route::resource('kerusakan', KerusakanController::class);

        // Tindakan Perbaikan (Teknisi Eksekusi)
        Route::resource('tindakan', PerbaikanController::class);
    });

    //  6. SERAH TERIMA & BARANG RUSAK (Sidebar: Bawah)
    // Barang Rusak Berat
    Route::resource('barang-rusak', BarangRusakController::class)->names([
        'index' => 'barang-rusak.index',
        'create' => 'barang-rusak.create',
        'store' => 'barang-rusak.store',
        // 'destroy' tidak perlu karena ini log penghapusan
    ]);

    // Serah Terima
    Route::resource('serah-terima', SerahTerimaController::class)->names([
        'index' => 'serah-terima.index',
        'create' => 'serah-terima.create',
        'store' => 'serah-terima.store',

    ]);

    Route::get('serah-terima/{id}/cetak', [SerahTerimaController::class, 'cetakPdf'])->name('serah-terima.cetak');

    // Laporan (Sidebar: Laporan)
    Route::prefix('laporan')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');

        // Route untuk Cetak PDF
        Route::get('/inventaris', [LaporanController::class, 'inventaris'])->name('laporan.inventaris');
        Route::get('/stok', [LaporanController::class, 'stokGudang'])->name('laporan.stok');
        Route::get('/masuk', [LaporanController::class, 'barangMasuk'])->name('laporan.masuk');
        Route::get('/keluar', [LaporanController::class, 'barangKeluar'])->name('laporan.keluar');
        Route::get('/perbaikan', [LaporanController::class, 'perbaikan'])->name('laporan.perbaikan');
    });
});

require __DIR__.'/auth.php';
