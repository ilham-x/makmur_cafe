<!DOCTYPE html>
<html>
<head>
<title>Struk</title>

<style>
body{
    font-family: Arial, sans-serif;
    font-size: 13px;
    max-width: 300px;
    margin:auto;
}

.center{text-align:center;}
.right{text-align:right;}
.row{
    display:flex;
    justify-content:space-between;
}

hr{
    border: none;
    border-top:1px dashed #000;
    margin:10px 0;
}
</style>

</head>

<body>

<div class="center">
    <h3>Coffee Makmur</h3>
    <small>Indonesia</small>
</div>

<hr>

<div class="row">
    <div>Date</div>
    <div>{{ date('d M Y H:i') }}</div>
</div>

<div class="row">
    <div>Trx ID</div>
    <div>{{ $pesanan->kode_pesanan }}</div>
</div>

<div class="row">
    <div>Customer</div>
    <div>{{ $pesanan->nama_pelanggan }}</div>
</div>

<div class="row">
    <div>Meja</div>
    <div>{{ $pesanan->nomor_meja }}</div>
</div>

<hr>

{{-- ================= DETAIL PRODUK ================= --}}
@foreach($pesanan->detail as $d)

<div>
    {{ $d->produk->nama_produk }} x{{ $d->qty }}
</div>

<div class="row">
    <div></div>
    <div>Rp {{ number_format($d->subtotal) }}</div>
</div>

@endforeach

<hr>

{{-- ================= TOTAL ================= --}}
<div class="row">
    <div>Subtotal</div>
    <div>Rp {{ number_format($pesanan->total_harga) }}</div>
</div>

{{-- DISKON (OPSIONAL) --}}
@if(isset($pesanan->diskon) && $pesanan->diskon > 0)
<div class="row">
    <div>Diskon</div>
    <div>- Rp {{ number_format($pesanan->diskon) }}</div>
</div>
@endif

<hr>

<div class="row" style="font-weight:bold;">
    <div>Total</div>
    <div>Rp {{ number_format($pesanan->total_harga) }}</div>
</div>

<hr>

{{-- ================= PAYMENT ================= --}}

@if($pesanan->bayar) 
    {{-- CASH --}}
    <div class="row">
        <div>Payment</div>
        <div>Cash</div>
    </div>

    <div class="row">
        <div>Bayar</div>
        <div>Rp {{ number_format($pesanan->bayar) }}</div>
    </div>

    <div class="row">
        <div>Kembali</div>
        <div>Rp {{ number_format($pesanan->kembalian) }}</div>
    </div>

@elseif($pesanan->transaksi)
    {{-- GATEWAY --}}
    <div class="row">
        <div>Payment</div>
        <div>{{ $pesanan->transaksi->metode ?? 'Gateway' }}</div>
    </div>

    <div class="row">
        <div>Total</div>
        <div>Rp {{ number_format($pesanan->total_harga) }}</div>
    </div>
@endif

<hr>

<div class="center">
    <b>PAID</b><br>
    <small>{{ date('d M Y - H:i') }}</small>
</div>

<br>

<div class="center">
    Thank you ☕
</div>

<script>
window.print();
</script>

</body>
</html>