<?php

namespace App\Http\Controllers;

use App\Models\BarangGudang;
use Illuminate\Http\Request;

class BarangGudangController extends Controller
{
    public function index()
    {
        $items = BarangGudang::latest()->get();

        return view('master.gudang.index', compact('items'));
    }

    public function create()
    {
        return view('master.gudang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'satuan' => 'required|string|max:50', // Pcs, Rim, Box
            'stok_saat_ini' => 'required|integer|min:0', // Stok Awal
        ]);

        BarangGudang::create($request->all());

        return redirect()->route('barang-gudang.index')->with('success', 'Item Gudang berhasil dibuat!');
    }

    public function edit(BarangGudang $barangGudang)
    {
        return view('master.gudang.edit', compact('barangGudang'));
    }

    public function update(Request $request, BarangGudang $barangGudang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            // Stok biasanya tidak diedit disini, tapi kita buka aksesnya untuk koreksi admin
            'stok_saat_ini' => 'required|integer|min:0',
        ]);

        $barangGudang->update($request->all());

        return redirect()->route('barang-gudang.index')->with('success', 'Item Gudang diperbarui!');
    }

    public function destroy(BarangGudang $barangGudang)
    {
        try {
            $barangGudang->delete();

            return redirect()->route('barang-gudang.index')->with('success', 'Item Gudang dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal hapus! Item ini masih ada riwayat transaksinya.');
        }
    }
}
