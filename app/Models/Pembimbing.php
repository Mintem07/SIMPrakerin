<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pembimbing',
        'jenis_kelamin',
        'telp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pembimbingKelompok()
    {
        return $this->hasMany(PembimbingKelompok::class, 'pembimbing_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'pembimbing_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'pembimbing_id');
    }
}
