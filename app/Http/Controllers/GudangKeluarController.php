<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGudangKeluarRequest;
use App\Models\BarangGudang;
use App\Models\GudangKeluar;
use App\Models\Ruangan;

class GudangKeluarController extends Controller
{
    public function index()
    {
        $riwayat = GudangKeluar::with(['barangGudang', 'ruangan'])->latest()->get();

        return view('master.gudang.keluar.index', compact('riwayat'));
    }

    public function create()
    {
        $items = BarangGudang::where('stok_saat_ini', '>', 0)->get(); // Hanya tampilkan yg ada stoknya
        $ruangans = Ruangan::all();

        return view('master.gudang.keluar.create', compact('items', 'ruangans'));
    }

    public function store(StoreGudangKeluarRequest $request)
    {
        // Validasi Manual Stok Cukup gak? (Observer juga handle, tapi ini double check biar UX bagus)
        $barang = BarangGudang::find($request->barang_gudang_id);
        if ($barang->stok_saat_ini < $request->jumlah_keluar) {
            return back()->with('error', 'Stok tidak cukup! Sisa: '.$barang->stok_saat_ini);
        }

        GudangKeluar::create($request->validated());

        return redirect()->route('gudang-keluar.index')->with('success', 'Barang berhasil didistribusikan!');
    }

    public function destroy(GudangKeluar $gudangKeluar)
    {
        $gudangKeluar->delete();

        return redirect()->route('gudang-keluar.index')->with('success', 'Transaksi dibatalkan (Stok dikembalikan).');
    }
}
