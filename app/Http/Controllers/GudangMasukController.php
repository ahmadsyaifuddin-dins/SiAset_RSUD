<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGudangMasukRequest;
use App\Models\BarangGudang;
use App\Models\GudangMasuk;

class GudangMasukController extends Controller
{
    public function index()
    {
        $riwayat = GudangMasuk::with('barangGudang')->latest()->get();

        return view('master.gudang.masuk.index', compact('riwayat'));
    }

    public function create()
    {
        $items = BarangGudang::all(); // Untuk Dropdown

        return view('master.gudang.masuk.create', compact('items'));
    }

    public function store(StoreGudangMasukRequest $request)
    {
        // Observer akan otomatis menambah stok saat create
        GudangMasuk::create($request->validated());

        return redirect()->route('gudang-masuk.index')->with('success', 'Stok berhasil ditambahkan!');
    }

    public function destroy(GudangMasuk $gudangMasuk)
    {
        // Observer akan otomatis mengurangi stok balik saat delete
        $gudangMasuk->delete();

        return redirect()->route('gudang-masuk.index')->with('success', 'Transaksi dibatalkan (Stok dikembalikan).');
    }
}
