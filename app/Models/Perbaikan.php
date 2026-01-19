<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;

    protected $table = 'perbaikan';

    protected $guarded = ['id'];

    public function kerusakan()
    {
        return $this->belongsTo(Kerusakan::class);
    }
}
