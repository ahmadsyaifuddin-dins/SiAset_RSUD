<?php

namespace App\Http\Controllers;

use App\Models\BarangGudang;
use App\Models\GudangKeluar;
use App\Models\GudangMasuk;
use App\Models\Inventaris;
use App\Models\Kerusakan;
use App\Models\Ruangan;
use App\Models\SerahTerima;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Halaman Menu Laporan
    public function index()
    {
        $ruangans = Ruangan::all();

        return view('laporan.index', compact('ruangans'));
    }

    // ==========================================
    // KATEGORI 1: LAPORAN GUDANG (BHP)
    // ==========================================

    // 1. Laporan Stok Gudang (BHP)
    public function stokGudang()
    {
        $data = BarangGudang::orderBy('nama_barang', 'asc')->get();

        $pdf = Pdf::loadView('laporan.pdf.stok_gudang', [
            'data' => $data,
            'judul' => 'Laporan Stok Barang Gudang (BHP)',
        ]);

        return $pdf->stream('Laporan_Stok_Gudang.pdf');
    }

    // 2. Laporan Barang Masuk (Restock)
    public function barangMasuk(Request $request)
    {
        $request->validate(['start_date' => 'nullable|date', 'end_date' => 'nullable|date']);

        $query = GudangMasuk::with('barangGudang')->latest('tanggal_masuk');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_masuk', [$request->start_date, $request->end_date]);
            $periode = \Carbon\Carbon::parse($request->start_date)->format('d/m/Y').' - '.\Carbon\Carbon::parse($request->end_date)->format('d/m/Y');
        } else {
            $periode = 'Semua Waktu';
        }

        $pdf = Pdf::loadView('laporan.pdf.barang_masuk', [
            'data' => $query->get(),
            'judul' => 'Laporan Riwayat Barang Masuk',
            'periode' => $periode,
        ]);

        return $pdf->stream('Laporan_Barang_Masuk.pdf');
    }

    // 3. Laporan Barang Keluar (Distribusi)
    public function barangKeluar(Request $request)
    {
        $request->validate(['start_date' => 'nullable|date', 'end_date' => 'nullable|date']);

        $query = GudangKeluar::with(['barangGudang', 'ruangan', 'user'])->where('status', 1)->latest('tanggal_keluar');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_keluar', [$request->start_date, $request->end_date]);
            $periode = \Carbon\Carbon::parse($request->start_date)->format('d/m/Y').' - '.\Carbon\Carbon::parse($request->end_date)->format('d/m/Y');
        } else {
            $periode = 'Semua Waktu';
        }

        $pdf = Pdf::loadView('laporan.pdf.barang_keluar', [
            'data' => $query->get(),
            'judul' => 'Laporan Distribusi Barang Gudang',
            'periode' => $periode,
        ]);

        return $pdf->stream('Laporan_Distribusi_Barang.pdf');
    }

    // 4. Laporan Inventaris Per Ruangan
    public function inventaris(Request $request)
    {
        $request->validate(['ruangan_id' => 'required']);

        $query = Inventaris::with(['barang', 'ruangan'])->where('status_aset', 'Aktif');

        if ($request->ruangan_id !== 'semua') {
            $query->where('ruangan_id', $request->ruangan_id);
            $ruangan = Ruangan::findOrFail($request->ruangan_id);
            $nama_ruangan = $ruangan->nama_ruangan;
        } else {
            $nama_ruangan = 'Semua Ruangan';
        }

        $data = $query->get();

        $pdf = Pdf::loadView('laporan.pdf.inventaris', [
            'data' => $data,
            'judul' => 'Laporan Daftar Inventaris Aset Aktif',
            'ruangan' => $nama_ruangan,
        ]);

        return $pdf->stream('Laporan_Inventaris.pdf');
    }

    // 5. Laporan Kerusakan
    public function kerusakan(Request $request)
    {
        $request->validate(['start_date' => 'nullable|date', 'end_date' => 'nullable|date']);

        $query = Kerusakan::with(['inventaris.barang', 'inventaris.ruangan'])->latest('tanggal_laporan');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_laporan', [$request->start_date, $request->end_date]);
            $periode = \Carbon\Carbon::parse($request->start_date)->format('d/m/Y').' - '.\Carbon\Carbon::parse($request->end_date)->format('d/m/Y');
        } else {
            $periode = 'Semua Waktu';
        }

        $pdf = Pdf::loadView('laporan.pdf.kerusakan', [
            'data' => $query->get(),
            'judul' => 'Laporan Rekapitulasi Kerusakan Aset',
            'periode' => $periode,
        ]);

        return $pdf->stream('Laporan_Kerusakan.pdf');
    }

    // 6. Laporan Perbaikan (Maintenance)
    public function perbaikan(Request $request)
    {
        $request->validate(['start_date' => 'nullable|date', 'end_date' => 'nullable|date']);

        $query = Kerusakan::with(['inventaris.barang', 'perbaikan'])->has('perbaikan');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_laporan', [$request->start_date, $request->end_date]);
            $periode = \Carbon\Carbon::parse($request->start_date)->format('d/m/Y').' - '.\Carbon\Carbon::parse($request->end_date)->format('d/m/Y');
        } else {
            $periode = 'Semua Waktu';
        }

        $pdf = Pdf::loadView('laporan.pdf.perbaikan', [
            'data' => $query->get(),
            'judul' => 'Laporan Riwayat Pemeliharaan & Perbaikan Aset',
            'periode' => $periode,
        ]);

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan_Perbaikan.pdf');
    }

    // 7. Laporan Pemusnahan Aset (Pemutihan)
    public function pemusnahan(Request $request)
    {
        $request->validate(['start_date' => 'nullable|date', 'end_date' => 'nullable|date']);

        $query = Inventaris::with(['barang', 'ruangan'])->where('status_aset', 'Dimusnahkan')->latest('tanggal_dihapus');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_dihapus', [$request->start_date, $request->end_date]);
            $periode = \Carbon\Carbon::parse($request->start_date)->format('d/m/Y').' - '.\Carbon\Carbon::parse($request->end_date)->format('d/m/Y');
        } else {
            $periode = 'Semua Waktu';
        }

        $pdf = Pdf::loadView('laporan.pdf.pemusnahan', [
            'data' => $query->get(),
            'judul' => 'Laporan Rekapitulasi Pemusnahan Aset',
            'periode' => $periode,
        ]);

        return $pdf->stream('Laporan_Pemusnahan.pdf');
    }

    // 8. Laporan Riwayat Serah Terima Aset
    public function serahTerima(Request $request)
    {
        $request->validate(['start_date' => 'nullable|date', 'end_date' => 'nullable|date']);

        // Mengambil data relasi dari tabel SerahTerima -> Perbaikan -> Kerusakan -> Inventaris
        $query = SerahTerima::with(['perbaikan.kerusakan.inventaris.barang', 'perbaikan.kerusakan.inventaris.ruangan'])
            ->latest('tanggal_serah');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_serah', [$request->start_date, $request->end_date]);
            $periode = \Carbon\Carbon::parse($request->start_date)->format('d/m/Y').' - '.\Carbon\Carbon::parse($request->end_date)->format('d/m/Y');
        } else {
            $periode = 'Semua Waktu';
        }

        $pdf = Pdf::loadView('laporan.pdf.serah_terima_rekap', [
            'data' => $query->get(),
            'judul' => 'Laporan Rekapitulasi Serah Terima Aset',
            'periode' => $periode,
        ]);

        return $pdf->stream('Laporan_Serah_Terima.pdf');
    }
}
