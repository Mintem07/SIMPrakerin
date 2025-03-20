<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_industri',
        'alamat',
    ];

    // Relasi ke tabel kelompok
    public function kelompok()
    {
        return $this->hasMany(Kelompok::class, 'industri_id');
    }
}
