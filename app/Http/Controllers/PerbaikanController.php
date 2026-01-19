<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePerbaikanRequest;
use App\Models\Kerusakan;
use App\Models\Perbaikan;

class PerbaikanController extends Controller
{
    public function index()
    {
        $perbaikans = Perbaikan::with(['kerusakan.inventaris.barang'])->latest()->get();

        return view('perbaikan.tindakan.index', compact('perbaikans'));
    }

    public function create()
    {
        // Hanya tampilkan laporan yg belum selesai
        $laporanPending = Kerusakan::where('status', '!=', 'Selesai')->get();

        return view('perbaikan.tindakan.create', compact('laporanPending'));
    }

    public function store(StorePerbaikanRequest $request)
    {
        // 1. Simpan Data Perbaikan
        Perbaikan::create($request->validated());

        // 2. Update Status Laporan Kerusakan jadi "Selesai"
        $laporan = Kerusakan::find($request->kerusakan_id);
        $laporan->update(['status' => 'Selesai']);

        // 3. Opsional: Kembalikan kondisi inventaris jadi 'Baik'
        // $laporan->inventaris()->update(['kondisi' => 'Baik']);

        return redirect()->route('tindakan.index')->with('success', 'Perbaikan berhasil dicatat!');
    }

    public function destroy(Perbaikan $tindakan) // Ubah parameter jadi $tindakan (custom route) atau $perbaikan
    {
        $tindakan->delete();

        return redirect()->route('tindakan.index')->with('success', 'Data perbaikan dihapus.');
    }
}
