<?php

namespace App\Http\Controllers;

use App\Models\BarangGudang;
use App\Models\Inventaris;
use App\Models\Kerusakan;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Statistik Utama
        $totalAset = Inventaris::count();

        // Aset Rusak (Ringan + Berat)
        $asetRusak = Inventaris::whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])->count();

        // Laporan Kerusakan yang statusnya masih 'Pending' (Belum ditangani)
        $perbaikanPending = Kerusakan::where('status', 'Pending')->count();

        // Stok Gudang yang kritis (misal di bawah 10 unit)
        $stokKritisCount = BarangGudang::where('stok_saat_ini', '<=', 10)->count();

        // 2. Ambil Data Detail untuk Tabel Mini

        // 5 Barang Gudang dengan stok paling sedikit (biar admin aware)
        $listStokKritis = BarangGudang::where('stok_saat_ini', '<=', 10)
            ->orderBy('stok_saat_ini', 'asc')
            ->limit(5)
            ->get();

        // 5 Laporan Kerusakan Terbaru
        $laporanTerbaru = Kerusakan::with(['inventaris.barang', 'inventaris.ruangan'])
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalAset',
            'asetRusak',
            'perbaikanPending',
            'stokKritisCount',
            'listStokKritis',
            'laporanTerbaru'
        ));
    }
}
