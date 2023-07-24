<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = "pelanggan";
    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'telepon',
        'email',
        'foto',
    ];

    public function hewan()
    {
        return $this->hasMany(Hewan::class);
    }
}
