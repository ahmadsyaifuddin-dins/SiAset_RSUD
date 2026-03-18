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
        // Jika Admin yang input langsung, statusnya otomatis 1 (ACC). Maka potong stok.
        if ($gudangKeluar->status == 1) {
            $this->potongStok($gudangKeluar);
        }
    }

    /**
     * Handle the GudangKeluar "updated" event.
     */
    public function updated(GudangKeluar $gudangKeluar): void
    {
        // Jika status berubah dari 0 (Menunggu) menjadi 1 (Di-ACC)
        if ($gudangKeluar->isDirty('status') && $gudangKeluar->status == 1) {
            $this->potongStok($gudangKeluar);
        }
    }

    /**
     * Handle the GudangKeluar "deleted" event.
     */
    public function deleted(GudangKeluar $gudangKeluar): void
    {
        // Kalau data dihapus, stok dikembalikan HANYA JIKA sebelumnya sudah di-ACC (status 1)
        if ($gudangKeluar->status == 1) {
            $gudangKeluar->barangGudang()->increment('stok_saat_ini', $gudangKeluar->jumlah_keluar);
        }
    }

    /**
     * Fungsi private untuk potong stok agar tidak DRY (Don't Repeat Yourself)
     */
    private function potongStok(GudangKeluar $gudangKeluar): void
    {
        $stokTersedia = $gudangKeluar->barangGudang->stok_saat_ini;

        if ($stokTersedia < $gudangKeluar->jumlah_keluar) {
            throw ValidationException::withMessages([
                'error' => 'Gagal ACC! Stok tidak mencukupi. Sisa stok: '.$stokTersedia,
            ]);
        }

        $gudangKeluar->barangGudang()->decrement('stok_saat_ini', $gudangKeluar->jumlah_keluar);
    }
}
