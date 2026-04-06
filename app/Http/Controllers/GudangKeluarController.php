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
        $query = GudangKeluar::with(['barangGudang', 'ruangan', 'user'])->latest();

        // Kepala Ruangan cuma bisa lihat permintaannya sendiri
        if (auth()->user()->role === 'kepala_ruangan') {
            $query->where('user_id', auth()->id());
        }

        $riwayat = $query->get();

        return view('master.gudang.keluar.index', compact('riwayat'));
    }

    public function create()
    {
        $items = BarangGudang::where('stok_saat_ini', '>', 0)->get();
        $ruangans = Ruangan::all();

        return view('master.gudang.keluar.create', compact('items', 'ruangans'));
    }

    public function store(StoreGudangKeluarRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        // Logika Status: Jika Admin = Langsung ACC (1). Jika Kepala Ruangan = Nunggu (0).
        $data['status'] = (auth()->user()->role === 'admin') ? 1 : 0;

        // Cek stok khusus admin (karena langsung potong)
        if ($data['status'] == 1) {
            $barang = BarangGudang::find($request->barang_gudang_id);
            if ($barang->stok_saat_ini < $request->jumlah_keluar) {
                return back()->with('error', 'Stok tidak cukup! Sisa: '.$barang->stok_saat_ini);
            }
        }

        GudangKeluar::create($data);

        $msg = (auth()->user()->role === 'admin')
                ? 'Barang berhasil didistribusikan!'
                : 'Permintaan terkirim. Menunggu ACC dari Gudang.';

        return redirect()->route('gudang-keluar.index')->with('success', $msg);
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID, lalu hapus
        $gudangKeluar = GudangKeluar::findOrFail($id);
        $gudangKeluar->delete();

        return redirect()->route('gudang-keluar.index')->with('success', 'Transaksi dibatalkan.');
    }

    public function approve($id)
    {
        $keluar = GudangKeluar::findOrFail($id);

        // Cek stok sekali lagi sebelum di-ACC biar aman
        if ($keluar->barangGudang->stok_saat_ini < $keluar->jumlah_keluar) {
            return back()->with('error', 'Gagal ACC! Stok tersisa tinggal: '.$keluar->barangGudang->stok_saat_ini);
        }

        $keluar->update(['status' => 1]); // Ini akan trigger Observer untuk potong stok

        return back()->with('success', 'Permintaan disetujui, stok gudang otomatis terpotong.');
    }

    public function reject($id)
    {
        $keluar = GudangKeluar::findOrFail($id);
        $keluar->update(['status' => 2]); // Status Ditolak

        return back()->with('success', 'Permintaan telah ditolak.');
    }
}
