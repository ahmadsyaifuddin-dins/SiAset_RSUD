<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSerahTerimaRequest;
use App\Models\Perbaikan;
use App\Models\SerahTerima;
use Barryvdh\DomPDF\Facade\Pdf;

class SerahTerimaController extends Controller
{
    public function index()
    {
        $serahTerima = SerahTerima::with(['perbaikan.kerusakan.inventaris.barang'])->latest()->get();

        return view('serah_terima.index', compact('serahTerima'));
    }

    public function create()
    {
        // Cari perbaikan yang SUDAH SELESAI tapi BELUM DISERAHKAN
        // Logic: Ambil semua perbaikan selesai, filter yg id-nya belum ada di tabel serah_terima
        $sudahDiserahIds = SerahTerima::pluck('perbaikan_id');

        $perbaikanSiap = Perbaikan::with(['kerusakan.inventaris.barang'])
            ->whereHas('kerusakan', function ($q) {
                $q->where('status', 'Selesai');
            })
            ->whereNotIn('id', $sudahDiserahIds)
            ->get();

        return view('serah_terima.create', compact('perbaikanSiap'));
    }

    public function store(StoreSerahTerimaRequest $request)
    {
        SerahTerima::create($request->validated());

        // Update kondisi inventaris jadi BAIK kembali (karena sudah diserah terima)
        $perbaikan = Perbaikan::find($request->perbaikan_id);
        $perbaikan->kerusakan->inventaris->update(['kondisi' => 'Baik']);

        return redirect()->route('serah-terima.index')->with('success', 'Berita Acara Serah Terima berhasil dibuat!');
    }

    public function cetakPdf($id)
    {
        // Ambil data detail relasi sampai ke akar-akarnya
        $data = SerahTerima::with(['perbaikan.kerusakan.inventaris.barang', 'perbaikan.kerusakan.inventaris.ruangan'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('laporan.pdf.berita_acara', [
            'data' => $data,
            'judul' => 'BERITA ACARA SERAH TERIMA BARANG',
        ]);

        return $pdf->stream('BA_Serah_Terima_'.$data->id.'.pdf');
    }
}
