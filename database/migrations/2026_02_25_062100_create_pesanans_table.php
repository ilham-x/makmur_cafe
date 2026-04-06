<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('pesanans', function (Blueprint $table) {
    $table->id();
    $table->string('kode_pesanan');
    $table->string('nama_pelanggan')->nullable();
    $table->integer('nomor_meja')->nullable();
    $table->integer('total_harga');

    $table->enum('status', [
        'menunggu',
        'pending_payment',
        'dibayar',
        'selesai'
    ])->default('menunggu');
    $table->string('metode_pembayaran')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
