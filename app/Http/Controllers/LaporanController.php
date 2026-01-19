<?php

namespace App\Http\Controllers;

use App\Models\BarangGudang;
use App\Models\GudangKeluar;
use App\Models\GudangMasuk;
use App\Models\Inventaris;
use App\Models\Kerusakan;
use App\Models\Ruangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Halaman Menu Laporan
    public function index()
    {
        $ruangans = Ruangan::all(); // Untuk filter per ruangan

        return view('laporan.index', compact('ruangans'));
    }

    // 1. Laporan Inventaris Per Ruangan
    public function inventaris(Request $request)
    {
        $ruangan = Ruangan::findOrFail($request->ruangan_id);

        $data = Inventaris::with('barang')
            ->where('ruangan_id', $request->ruangan_id)
            ->get();

        $pdf = Pdf::loadView('laporan.pdf.inventaris', [
            'data' => $data,
            'ruangan' => $ruangan,
            'judul' => 'Laporan Inventaris Ruangan: '.$ruangan->nama_ruangan,
        ]);

        return $pdf->stream('Laporan_Inventaris.pdf');
    }

    // 2. Laporan Stok Gudang (BHP)
    public function stokGudang()
    {
        $data = BarangGudang::all();

        $pdf = Pdf::loadView('laporan.pdf.stok_gudang', [
            'data' => $data,
            'judul' => 'Laporan Stok Barang Gudang (BHP)',
        ]);

        return $pdf->stream('Laporan_Stok_Gudang.pdf');
    }

    // 3. Laporan Barang Masuk (Restock)
    public function barangMasuk(Request $request)
    {
        // Bisa tambah filter tanggal disini via $request->start_date
        $data = GudangMasuk::with('barangGudang')->latest()->get();

        $pdf = Pdf::loadView('laporan.pdf.barang_masuk', [
            'data' => $data,
            'judul' => 'Laporan Riwayat Barang Masuk',
        ]);

        return $pdf->stream('Laporan_Barang_Masuk.pdf');
    }

    // 4. Laporan Barang Keluar (Distribusi)
    public function barangKeluar(Request $request)
    {
        $data = GudangKeluar::with(['barangGudang', 'ruangan'])->latest()->get();

        $pdf = Pdf::loadView('laporan.pdf.barang_keluar', [
            'data' => $data,
            'judul' => 'Laporan Riwayat Distribusi Barang',
        ]);

        return $pdf->stream('Laporan_Barang_Keluar.pdf');
    }

    // 5. Laporan Perbaikan (Maintenance)
    public function perbaikan()
    {
        $data = Kerusakan::with(['inventaris.barang', 'perbaikan'])->get();

        $pdf = Pdf::loadView('laporan.pdf.perbaikan', [
            'data' => $data,
            'judul' => 'Laporan Kerusakan & Perbaikan Aset',
        ]);

        $pdf->setPaper('a4', 'landscape'); // Landscape karena kolom banyak

        return $pdf->stream('Laporan_Perbaikan.pdf');
    }
}
