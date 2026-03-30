<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


   class Transaksi extends Model
{
    protected $table = 'transaksis';

    protected $fillable = [
        'pesanan_id',
        'invoice_id',
        'external_id',
        'total_bayar',
        'status'
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