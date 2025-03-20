<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembimbingKelompok extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembimbing_id',
        'kelompok_id',
    ];

    // Relasi ke tabel kelompok
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }

    // Relasi ke tabel pembimbing
    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'pembimbing_id');
    }
}
