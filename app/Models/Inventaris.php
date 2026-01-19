<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

    protected $guarded = ['id'];

    // Relasi ke Barang (Parent)
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relasi ke Ruangan (Lokasi)
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    // Relasi ke Laporan Kerusakan
    public function kerusakan()
    {
        return $this->hasMany(Kerusakan::class);
    }
}
