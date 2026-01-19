<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRuanganRequest;
use App\Http\Requests\UpdateRuanganRequest;
use App\Models\Ruangan;
use Illuminate\Support\Facades\File; // Penting buat hapus file lama

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::latest()->get();

        return view('master.ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('master.ruangan.create');
    }

    // Pakai Custom Request untuk Validasi
    public function store(StoreRuanganRequest $request)
    {
        $data = $request->validated();

        // LOGIC OLD SCHOOL UPLOAD
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Nama file unik: time + nama asli
            $filename = time().'_'.$file->getClientOriginalName();

            // Pindah langsung ke public/uploads/ruangan
            $file->move(public_path('uploads/ruangan'), $filename);

            $data['foto'] = 'ruangan/'.$filename; // Simpan path relatif
        }

        Ruangan::create($data);

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dibuat!');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('master.ruangan.edit', compact('ruangan'));
    }

    public function update(UpdateRuanganRequest $request, Ruangan $ruangan)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            // 1. Hapus file lama jika ada (Biar gak nyampah)
            if ($ruangan->foto && File::exists(public_path('uploads/'.$ruangan->foto))) {
                File::delete(public_path('uploads/'.$ruangan->foto));
            }

            // 2. Upload file baru
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/ruangan'), $filename);

            $data['foto'] = 'ruangan/'.$filename;
        }

        $ruangan->update($data);

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diperbarui!');
    }

    public function destroy(Ruangan $ruangan)
    {
        // Hapus foto fisik sebelum hapus data
        if ($ruangan->foto && File::exists(public_path('uploads/'.$ruangan->foto))) {
            File::delete(public_path('uploads/'.$ruangan->foto));
        }

        $ruangan->delete();

        return redirect()->route('ruangan.index')->with('success', 'Ruangan dihapus!');
    }
}
