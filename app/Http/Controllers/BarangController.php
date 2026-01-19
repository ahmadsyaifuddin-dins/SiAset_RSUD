<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->get();

        return view('master.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('master.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            // SN wajib unik di tabel barang
            'sn' => 'nullable|string|unique:barang,sn',
            'jenis_barang' => 'required|string',
            'kategori_barang' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Aset Barang berhasil didaftarkan!');
    }

    public function edit(Barang $barang)
    {
        return view('master.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            // Validasi unik SN, tapi kecualikan (ignore) barang yang sedang diedit ini
            'sn' => ['nullable', 'string', Rule::unique('barang', 'sn')->ignore($barang->id)],
            'jenis_barang' => 'required|string',
            'kategori_barang' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Data Aset diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        try {
            $barang->delete();

            return redirect()->route('barang.index')->with('success', 'Aset dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal hapus! Barang ini sudah terdaftar di Inventaris ruangan.');
        }
    }
}
