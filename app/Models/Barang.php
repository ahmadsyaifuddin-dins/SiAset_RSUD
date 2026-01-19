<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; // Nama tabel singular

    protected $guarded = ['id'];

    // Relasi: Satu jenis barang bisa ada di banyak inventaris (karena beda ruangan/kondisi)
    public function inventaris()
    {
        return $this->hasMany(Inventaris::class);
    }
}
