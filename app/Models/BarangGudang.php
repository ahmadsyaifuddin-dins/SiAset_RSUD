<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangGudang extends Model
{
    use HasFactory;

    protected $table = 'barang_gudang';

    protected $guarded = ['id'];

    public function barangMasuk()
    {
        return $this->hasMany(GudangMasuk::class);
    }

    public function barangKeluar()
    {
        return $this->hasMany(GudangKeluar::class);
    }
}
