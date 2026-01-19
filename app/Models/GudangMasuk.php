<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangMasuk extends Model
{
    use HasFactory;

    protected $table = 'gudang_masuk';

    protected $guarded = ['id'];

    public function barangGudang()
    {
        return $this->belongsTo(BarangGudang::class);
    }
}
