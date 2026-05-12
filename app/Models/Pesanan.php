<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{   protected $table = "pesanans";
    protected $fillable = [
        'nomor_meja',
         'nama_pelanggan',
        'kode_pesanan',
        'status',
        'total_harga',
        'metode_pembayaran'
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

   public function produks()
{
    return $this->belongsToMany(Produk::class, 'pesanan_produk', 'pesanan_id', 'produk_id')
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
    public function detail()
{
    return $this->hasMany(Detail_Pesanan::class, 'pesanan_id');
}
}