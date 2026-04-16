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
       Schema::create('transaksis', function (Blueprint $table) {
    $table->id();

    $table->foreignId('pesanan_id')->constrained()->cascadeOnDelete();

    $table->string('invoice_id')->nullable();
    $table->string('external_id')->nullable();

    $table->integer('total_bayar');

    $table->enum('status',[
        'pending',
        'paid',
        'failed'
    ])->default('pending');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
