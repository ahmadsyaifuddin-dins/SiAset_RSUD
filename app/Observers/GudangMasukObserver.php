<?php

namespace App\Observers;

use App\Models\GudangMasuk;

class GudangMasukObserver
{
    /**
     * Handle the GudangMasuk "created" event.
     */
    public function created(GudangMasuk $gudangMasuk): void
    {
        // Otomatis TAMBAH stok di tabel master barang_gudang
        $gudangMasuk->barangGudang()->increment('stok_saat_ini', $gudangMasuk->jumlah_masuk);
    }

    /**
     * Handle the GudangMasuk "updated" event.
     */
    public function updated(GudangMasuk $gudangMasuk): void
    {
        // Logic edit agak kompleks, biasanya untuk PKL di-skip dulu.
        // Asumsinya kalau salah, hapus lalu input ulang.
    }

    /**
     * Handle the GudangMasuk "deleted" event.
     */
    public function deleted(GudangMasuk $gudangMasuk): void
    {
        // Kalau data masuk dihapus, stok harus DIKURANGI balik
        $gudangMasuk->barangGudang()->decrement('stok_saat_ini', $gudangMasuk->jumlah_masuk);
    }
}
