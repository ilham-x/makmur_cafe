@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Detail Transaksi</h2>

    {{-- Info Transaksi --}}
    <div class="card mb-3">
        <div class="card-header">Informasi Transaksi</div>
        <div class="card-body">
            <p><strong>Invoice:</strong> {{ $transaksi->invoice_id }}</p>
            <p><strong>External ID:</strong> {{ $transaksi->external_id }}</p>
            <p><strong>Status:</strong> {{ $transaksi->status }}</p>
            <p><strong>Total Bayar:</strong> Rp {{ number_format($transaksi->total_bayar,0,',','.') }}</p>
        </div>
    </div>

    {{-- Info Pesanan --}}
    <div class="card mb-3">
        <div class="card-header">Informasi Pesanan</div>
        <div class="card-body">
            <p><strong>Kode Pesanan:</strong> {{ $transaksi->pesanan->kode_pesanan }}</p>
            <p><strong>Nama Pelanggan:</strong> {{ $transaksi->pesanan->nama_pelanggan }}</p>
            <p><strong>Nomor Meja:</strong> {{ $transaksi->pesanan->nomor_meja ?? '-' }}</p>
            <p><strong>Status:</strong> {{ $transaksi->pesanan->status }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $transaksi->pesanan->metode_pembayaran }}</p>
        </div>
    </div>

    {{-- Detail Produk --}}
   
</div>
@endsection