<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerahTerima extends Model
{
    use HasFactory;

    // Nama tabel sesuai migration yang kita buat tadi
    protected $table = 'serah_terima';

    // Izinkan mass assignment untuk semua kolom (kecuali id)
    protected $guarded = ['id'];

    // Relasi ke Model Perbaikan
    // Satu data serah terima milik satu data perbaikan
    public function perbaikan()
    {
        return $this->belongsTo(Perbaikan::class, 'perbaikan_id');
    }
}
