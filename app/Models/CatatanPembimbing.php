<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPembimbing extends Model
{
    use HasFactory;

    protected $fillable = ['absensi_id', 'catatan'];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'absensi_id');
    }
}
