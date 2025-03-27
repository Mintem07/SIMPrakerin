<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAkhir extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelompok_id',
        'file_laporan_akhir',
        'tanggal_upload',
    ];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }
}
