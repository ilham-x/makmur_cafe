<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        'is_available',
    ];

    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class)
                    ->withPivot('qty', 'harga')
                    ->withTimestamps();
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }
}