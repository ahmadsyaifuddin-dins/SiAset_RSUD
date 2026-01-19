<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangGudangRequest;
use App\Http\Requests\UpdateBarangGudangRequest;
use App\Models\BarangGudang;

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

    public function store(StoreBarangGudangRequest $request)
    {
        BarangGudang::create($request->validated());

        return redirect()->route('barang-gudang.index')->with('success', 'Item Gudang dibuat!');
    }

    public function edit(BarangGudang $barangGudang)
    {
        return view('master.gudang.edit', compact('barangGudang'));
    }

    public function update(UpdateBarangGudangRequest $request, BarangGudang $barangGudang)
    {
        $barangGudang->update($request->validated());

        return redirect()->route('barang-gudang.index')->with('success', 'Item Gudang diperbarui!');
    }

    public function destroy(BarangGudang $barangGudang)
    {
        try {
            $barangGudang->delete();

            return redirect()->route('barang-gudang.index')->with('success', 'Dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal! Item ini ada riwayat transaksinya.');
        }
    }
}
