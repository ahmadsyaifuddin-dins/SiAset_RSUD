<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRusakRequest;
use App\Models\BarangRusak;
use App\Models\Inventaris;
use Illuminate\Support\Facades\DB;

class BarangRusakController extends Controller
{
    public function index()
    {
        // Load data barang rusak beserta detail asetnya (soft delete logic manual)
        // Karena inventarisnya nanti dihapus, kita harus hati-hati.
        // Best practice: Data inventaris jangan di-hard delete, tapi di-replicate atau disimpan history-nya.
        // TAPI untuk simpelnya Project PKL: Kita simpan snapshot datanya di keterangan atau biarkan relasi putus (set null).

        // REVISI LOGIC: Agar aman, kita ambil data BarangRusak yang punya relasi Inventaris (sebelum dihapus)
        // Atau lebih baik: Jangan hapus data inventaris, tapi ubah status/kondisi jadi 'Musnah'.

        $barangRusak = BarangRusak::with(['inventaris.barang', 'inventaris.ruangan'])->latest()->get();

        return view('barang_rusak.index', compact('barangRusak'));
    }

    public function create()
    {
        // Tampilkan barang yang kondisinya 'Rusak Berat' saja
        $inventaris = Inventaris::with(['barang', 'ruangan'])
            ->where('kondisi', 'Rusak Berat')
            ->get();

        return view('barang_rusak.create', compact('inventaris'));
    }

    public function store(StoreBarangRusakRequest $request)
    {
        DB::transaction(function () use ($request) {
            // 1. Simpan ke tabel arsip Barang Rusak
            BarangRusak::create($request->validated());

            // 2. Hapus dari Inventaris Aktif (Hard Delete sesuai request "Penghapusan")
            // Note: Kalau dihapus, relasi di BarangRusak jadi null jika tidak cascade.
            // Solusi Project PKL: Biarkan data inventaris ada, tapi update kondisi jadi 'DIHAPUS'

            $asset = Inventaris::find($request->inventaris_id);
            $asset->update(['kondisi' => 'DIHAPUS']); // Tandai saja biar history terjaga
            // $asset->delete(); // Jangan di-delete biar laporan tidak error
        });

        return redirect()->route('barang-rusak.index')->with('success', 'Aset berhasil dihapus dari daftar aktif!');
    }
}
