<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'pesanan_id',
        'user_id', // cashier yang memproses
        'metode_pembayaran',
        'jumlah_bayar',
        'kembalian',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function cashier()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}