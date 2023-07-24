<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    use HasFactory;
    protected $table = "hewan";
    protected $fillable = [
        'nama_hewan',
        'jenis_hewan',
        'umur',
        'berat',
        'pelanggan_id'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
