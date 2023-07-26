<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penitipan extends Model
{
    use HasFactory;
    protected $table = "penitipan";
    protected $fillable = [
        'hewan_id',
        'tgl_masuk',
        'tgl_keluar',
        'biaya',
        'status'
    ];


    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'hewan_id', 'pelanggan_id');
    }
}
