<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangKeluar extends Model
{
    use HasFactory;

    protected $table = 'gudang_keluar';

    protected $guarded = ['id'];

    public function barangGudang()
    {
        return $this->belongsTo(BarangGudang::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
