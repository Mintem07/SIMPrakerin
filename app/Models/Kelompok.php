<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelompok',
        'industri_id',
        'status',
    ];

    public function industri()
    {
        return $this->belongsTo(Industri::class, 'industri_id');
    }

    public function anggotaKelompok()
    {
        return $this->hasMany(AnggotaKelompok::class, 'kelompok_id');
    }

    public function pembimbingKelompok()
    {
        return $this->hasOne(PembimbingKelompok::class, 'kelompok_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'kelompok_id');
    }

    public function laporanAkhir()
    {
        return $this->hasOne(LaporanAkhir::class, 'kelompok_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'siswa_id');
    }
}