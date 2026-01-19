<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    use HasFactory;

    protected $table = 'kerusakan';

    protected $guarded = ['id'];

    public function inventaris()
    {
        return $this->belongsTo(Inventaris::class);
    }

    public function perbaikan()
    {
        return $this->hasOne(Perbaikan::class);
    }
}
