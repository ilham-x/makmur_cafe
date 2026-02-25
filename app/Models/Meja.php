<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $fillable = [
        'nomor_meja',
        'kode_qr',
        'status',
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }
}