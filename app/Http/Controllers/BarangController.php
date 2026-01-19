<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Barang;
use Illuminate\Support\Facades\File;

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

    public function store(StoreBarangRequest $request)
    {
        $data = $request->validated();

        // Logic Upload Old School
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();

            $path = public_path('uploads/barang');
            if (! File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $file->move($path, $filename);
            $data['foto'] = 'barang/'.$filename;
        }

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Aset Barang berhasil didaftarkan!');
    }

    public function edit(Barang $barang)
    {
        return view('master.barang.edit', compact('barang'));
    }

    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            // Hapus file lama
            if ($barang->foto && File::exists(public_path('uploads/'.$barang->foto))) {
                File::delete(public_path('uploads/'.$barang->foto));
            }

            // Upload baru
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/barang'), $filename);

            $data['foto'] = 'barang/'.$filename;
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Data Aset diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        // Hapus foto fisik
        if ($barang->foto && File::exists(public_path('uploads/'.$barang->foto))) {
            File::delete(public_path('uploads/'.$barang->foto));
        }

        try {
            $barang->delete();

            return redirect()->route('barang.index')->with('success', 'Aset dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal hapus! Barang masih dipakai di Inventaris.');
        }
    }
}
