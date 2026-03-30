<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Pesanan extends Model
{
   protected $table = 'detail_pesanans';

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'qty',
        'harga',
        'subtotal'
    ];

    // relasi ke pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    // relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}

