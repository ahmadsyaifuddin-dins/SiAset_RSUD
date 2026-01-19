<?php

namespace App\Observers;

use App\Models\GudangKeluar;
use Illuminate\Validation\ValidationException;

class GudangKeluarObserver
{
    /**
     * Handle the GudangKeluar "created" event.
     */
    public function created(GudangKeluar $gudangKeluar): void
    {
        // Cek dulu, stok cukup gak? (Validasi Backend)
        $stokTersedia = $gudangKeluar->barangGudang->stok_saat_ini;

        if ($stokTersedia < $gudangKeluar->jumlah_keluar) {
            // Ini akan membatalkan simpan data & memunculkan error
            throw ValidationException::withMessages([
                'jumlah_keluar' => 'Stok tidak mencukupi! Sisa stok: '.$stokTersedia,
            ]);
        }

        // Kalau aman, KURANGI stok di tabel master
        $gudangKeluar->barangGudang()->decrement('stok_saat_ini', $gudangKeluar->jumlah_keluar);
    }

    /**
     * Handle the GudangKeluar "deleted" event.
     */
    public function deleted(GudangKeluar $gudangKeluar): void
    {
        // Kalau data keluar dihapus, stok DIKEMBALIKAN (Ditambah)
        $gudangKeluar->barangGudang()->increment('stok_saat_ini', $gudangKeluar->jumlah_keluar);
    }
}
