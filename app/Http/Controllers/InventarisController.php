<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventarisRequest;
use App\Http\Requests\UpdateInventarisRequest;
use App\Models\Barang;
use App\Models\Inventaris;
use App\Models\Ruangan;

class InventarisController extends Controller
{
    public function index()
    {
        // Load relasi barang dan ruangan biar tidak N+1 Problem (Loading lama)
        $inventaris = Inventaris::with(['barang', 'ruangan'])->latest()->get();

        return view('inventaris.index', compact('inventaris'));
    }

    public function create()
    {
        // Ambil data untuk Dropdown
        $barangs = Barang::all();
        $ruangans = Ruangan::all();

        return view('inventaris.create', compact('barangs', 'ruangans'));
    }

    public function store(StoreInventarisRequest $request)
    {
        Inventaris::create($request->validated());

        return redirect()->route('inventaris.index')->with('success', 'Data Inventaris berhasil ditambahkan!');
    }

    public function edit(Inventaris $inventaris)
    {
        $barangs = Barang::all();
        $ruangans = Ruangan::all();

        return view('inventaris.edit', compact('inventaris', 'barangs', 'ruangans'));
    }

    public function update(UpdateInventarisRequest $request, Inventaris $inventaris)
    {
        $inventaris->update($request->validated());

        return redirect()->route('inventaris.index')->with('success', 'Data Inventaris diperbarui!');
    }

    public function destroy(Inventaris $inventaris)
    {
        $inventaris->delete();

        return redirect()->route('inventaris.index')->with('success', 'Data dihapus!');
    }
}
