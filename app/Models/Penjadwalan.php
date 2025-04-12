<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kegiatan',
        'tgl_mulai',
        'tgl_selesai',
        'is_active',
        'order',
    ];

    protected static function boot()
{
    parent::boot();
    
    static::saving(function ($model) {
        $today = now()->format('Y-m-d');
        $model->is_active = ($today >= $model->tgl_mulai && $today <= $model->tgl_selesai);
    });
}
}
