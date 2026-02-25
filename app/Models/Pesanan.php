<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'meja_id',
        'kode_pesanan',
        'status',
        'total_harga',
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    public function produks()
    {
        return $this->belongsToMany(Produk::class)
                    ->withPivot('qty', 'harga')
                    ->withTimestamps();
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }
}