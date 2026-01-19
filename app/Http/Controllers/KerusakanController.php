<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKerusakanRequest;
use App\Http\Requests\UpdateKerusakanRequest;
use App\Models\Inventaris;
use App\Models\Kerusakan;

class KerusakanController extends Controller
{
    public function index()
    {
        // Tampilkan yang terbaru, load relasi biar kenceng
        $kerusakans = Kerusakan::with(['inventaris.barang', 'inventaris.ruangan'])->latest()->get();

        return view('perbaikan.kerusakan.index', compact('kerusakans'));
    }

    public function create()
    {
        // Ambil inventaris yang aktif
        $inventaris = Inventaris::with(['barang', 'ruangan'])->get();

        return view('perbaikan.kerusakan.create', compact('inventaris'));
    }

    public function store(StoreKerusakanRequest $request)
    {
        Kerusakan::create($request->validated());

        // Opsional: Update kondisi barang di inventaris jadi 'Rusak Ringan' otomatis?
        // Inventaris::where('id', $request->inventaris_id)->update(['kondisi' => 'Rusak Ringan']);

        return redirect()->route('kerusakan.index')->with('success', 'Laporan kerusakan berhasil dibuat!');
    }

    public function edit(Kerusakan $kerusakan)
    {
        $inventaris = Inventaris::with(['barang', 'ruangan'])->get();

        return view('perbaikan.kerusakan.edit', compact('kerusakan', 'inventaris'));
    }

    public function update(UpdateKerusakanRequest $request, Kerusakan $kerusakan)
    {
        $kerusakan->update($request->validated());

        return redirect()->route('kerusakan.index')->with('success', 'Laporan diperbarui!');
    }

    public function destroy(Kerusakan $kerusakan)
    {
        $kerusakan->delete();

        return redirect()->route('kerusakan.index')->with('success', 'Laporan dihapus!');
    }
}
