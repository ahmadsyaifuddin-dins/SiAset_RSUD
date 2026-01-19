<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        // Ambil semua data ruangan, urutkan dari yang terbaru
        $ruangans = Ruangan::latest()->get();

        return view('master.ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('master.ruangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'kepala_ruangan' => 'nullable|string|max:255',
        ]);

        Ruangan::create($request->all());

        // Redirect dengan pesan sukses (nanti ditangkap SweetAlert)
        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('master.ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'kepala_ruangan' => 'nullable|string|max:255',
        ]);

        $ruangan->update($request->all());

        return redirect()->route('ruangan.index')->with('success', 'Data Ruangan diperbarui!');
    }

    public function destroy(Ruangan $ruangan)
    {
        try {
            $ruangan->delete();

            return redirect()->route('ruangan.index')->with('success', 'Ruangan dihapus!');
        } catch (\Exception $e) {
            // Error handling kalau ruangan masih punya inventaris (Relasi Foreign Key)
            return redirect()->back()->with('error', 'Gagal hapus! Ruangan ini masih memiliki Aset/Inventaris.');
        }
    }
}
