<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BarangRusakController extends Controller
{
    // 1. Tampilkan daftar aset yang sudah berstatus "Dimusnahkan"
    public function index()
    {
        $barangRusak = Inventaris::with(['barang', 'ruangan'])
            ->where('status_aset', 'Dimusnahkan')
            ->latest('tanggal_dihapus')
            ->get();

        return view('barang_rusak.index', compact('barangRusak'));
    }

    // 2. Proses eksekusi pemusnahan (Akan dipanggil dari Modal di menu Inventaris)
    public function store(Request $request)
    {
        $request->validate([
            'inventaris_id' => 'required|exists:inventaris,id',
            'alasan_hapus' => 'required|string',
            'nama_penyetuju' => 'required|string',
        ]);

        $inventaris = Inventaris::findOrFail($request->inventaris_id);

        // Soft Delete (Update Status)
        $inventaris->update([
            'status_aset' => 'Dimusnahkan',
            'alasan_hapus' => $request->alasan_hapus,
            'nama_penyetuju' => $request->nama_penyetuju,
            'tanggal_dihapus' => now()->toDateString(),
            'kondisi' => 'Rusak Berat', // Pastikan kondisinya dikunci
        ]);

        return redirect()->back()->with('success', 'Aset berhasil dimusnahkan dan masuk ke daftar Arsip BAP.');
    }

    // 3. Cetak PDF Berita Acara Pemusnahan (BAP)
    public function cetakBap($id)
    {
        $data = Inventaris::with(['barang', 'ruangan'])->findOrFail($id);

        $pdf = Pdf::loadView('laporan.pdf.bap', [
            'data' => $data,
            'judul' => 'BERITA ACARA PEMUSNAHAN BARANG ASET',
        ]);

        // Bersihkan karakter '/' atau '\' dari kode inventaris agar bisa jadi nama file
        $safeKode = str_replace(['/', '\\'], '-', $data->kode_inventaris);

        // Nanti nama filenya jadi misal: BAP_Aset_INV-2026-IGD-001.pdf
        return $pdf->stream('BAP_Aset_'.$safeKode.'.pdf');
    }
}
