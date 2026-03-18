<?php

namespace App\Http\Controllers;

use App\Models\BarangGudang;
use App\Models\GudangKeluar;
use App\Models\Inventaris;
use App\Models\Kerusakan;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Statistik Utama
        $totalAset = Inventaris::where('status_aset', 'Aktif')->count();
        $asetRusak = Inventaris::where('status_aset', 'Aktif')
            ->whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])
            ->count();
        $perbaikanPending = Kerusakan::where('status', 'Pending')->count();

        // [FITUR BARU] Hitung stok kritis (Batas <= 5)
        $stokKritisCount = BarangGudang::where('stok_saat_ini', '<=', 5)->count();

        // [FITUR BARU] Hitung permintaan BHP yang menunggu ACC (status 0)
        $permintaanPending = GudangKeluar::where('status', 0)->count();

        // 2. Ambil Data Detail untuk Tabel Mini
        $listStokKritis = BarangGudang::where('stok_saat_ini', '<=', 5)
            ->orderBy('stok_saat_ini', 'asc')
            ->limit(5)
            ->get();

        $laporanTerbaru = Kerusakan::with(['inventaris.barang', 'inventaris.ruangan'])
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalAset',
            'asetRusak',
            'perbaikanPending',
            'stokKritisCount',
            'permintaanPending', // <-- Pass ke view
            'listStokKritis',
            'laporanTerbaru'
        ));
    }
}
