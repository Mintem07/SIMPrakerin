<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'nama_siswa',
        'kelas',
        'jurusan',
        'jenis_kelamin',
        'telp',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function anggotaKelompok()
    {
        return $this->hasOne(AnggotaKelompok::class, 'siswa_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'siswa_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'siswa_id');
    }
}
