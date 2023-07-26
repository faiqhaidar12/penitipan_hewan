<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    // Metode untuk mengambil data hewan yang tidak sedang digunakan pada data penitipan
    public static function availableForPenitipan()
    {
        return static::whereNotExists(function ($query) {
            $query->select('hewan_id')
                ->from('penitipan')
                ->whereColumn('hewan_id', 'hewan.id');
        })->get();
    }

    // Metode untuk mengambil data hewan yang tidak sedang digunakan pada data penitipan saat ini
    public function scopeAvailableForUpdate(Builder $query, $penitipan_id, $hewan_id)
    {
        return $query->where(function ($subQuery) use ($penitipan_id, $hewan_id) {
            // Pilih semua hewan yang tidak memiliki ID yang sama dengan hewan yang sedang diupdate
            $subQuery->where('id', '!=', $hewan_id);

            // Pilih hewan yang tidak sedang digunakan dalam data penitipan lainnya
            $subQuery->whereNotExists(function ($nestedQuery) use ($penitipan_id, $hewan_id) {
                $nestedQuery->select('hewan_id')
                    ->from('penitipan')
                    ->whereColumn('hewan_id', 'hewan.id')
                    ->where('id', '!=', $penitipan_id);
            });
        });
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }

    public function penitipan()
    {
        return $this->hasOne(Penitipan::class);
    }
}
