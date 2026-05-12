<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Struk</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: monospace;
    font-size:12px;
    width:280px;
    margin:0 auto;
    color:#000;
    line-height:1.5;
    padding:10px;
    background:#fff;
}

/* ================= GENERAL ================= */

.center{
    text-align:center;
}

.row{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin:3px 0;
    width:100%;
}

hr{
    border:none;
    border-top:1px dashed #000;
    margin:8px 0;
}

.bold{
    font-weight:bold;
}

/* ================= HEADER ================= */

.header{
    text-align:center;
}

.logo{
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:50%;
    display:block;
    margin:0 auto 6px auto;
}

.title{
    font-size:20px;
    font-weight:bold;
    letter-spacing:1px;
    margin-bottom:4px;
}

.address{
    font-size:10px;
    line-height:1.6;
}

/* ================= INFO ================= */

.info{
    width:100%;
}

/* ================= ITEM ================= */

.item{
    margin-top:8px;
}

.item-name{
    font-size:12px;
    font-weight:bold;
    text-align:left;
    margin-bottom:2px;
}

.item-detail{
    display:flex;
    justify-content:space-between;
    font-size:11px;
}

/* ================= TOTAL ================= */

.total-box{
    font-size:14px;
    font-weight:bold;
}

/* ================= QR ================= */

.barcode-section{
    width:100%;
    text-align:center;
    margin-top:12px;
}

.barcode-wrapper{
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
}

.barcode-img{
    width:130px;
    height:130px;
    object-fit:contain;
    display:block;
    margin:0 auto;
}

.barcode-text{
    margin-top:5px;
    font-size:11px;
    letter-spacing:1px;
    text-align:center;
    width:100%;
}

/* ================= FOOTER ================= */

.footer{
    margin-top:10px;
    text-align:center;
    font-size:11px;
    line-height:1.7;
}

.footer small{
    font-size:10px;
}

/* ================= PRINT ================= */

@media print{

    @page{
        margin:0;
    }

    html, body{
        width:280px;
        margin:0 auto;
        padding:10px;
    }

    .barcode-section,
    .barcode-wrapper,
    .barcode-text,
    .footer,
    .header{
        text-align:center !important;
    }

   .barcode-img{
    width:100px;
    max-width:160px;
    height:auto;
    display:block;
    margin:0 auto;
    object-fit:contain;
}
}

</style>

<script>
window.onload = function(){

    window.print();

    window.onafterprint = function(){
        window.close();
    }

}
</script>

</head>

<body>

{{-- ================= HEADER ================= --}}

<div class="header">

    <img 
        src="{{ asset('image/logoo.png') }}"
        class="logo"
        onerror="this.style.display='none'"
    >

    <div class="title">
        COFFEE MAKMUR
    </div>

    <div class="address">
        Jl. Raya Kopi No. 123<br>
        Jakarta Selatan<br>
        Telp: 0812-3456-7890
    </div>

</div>

<hr>

{{-- ================= INFO ================= --}}

<div class="info">

    <div class="row">
        <div>Tanggal</div>
        <div>{{ date('d/m/Y H:i') }}</div>
    </div>

    <div class="row">
        <div>No Trx</div>
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

</div>

<hr>

{{-- ================= PRODUK ================= --}}

@foreach($pesanan->detail as $d)

<div class="item">

    <div class="item-name">
        {{ $d->produk->nama_produk }}
    </div>

    <div class="item-detail">

        <div>
            {{ $d->qty }} x Rp {{ number_format($d->produk->harga ?? 0) }}
        </div>

        <div>
            Rp {{ number_format($d->subtotal) }}
        </div>

    </div>

</div>

@endforeach

<hr>

{{-- ================= TOTAL ================= --}}

<div class="row">
    <div>Subtotal</div>
    <div>Rp {{ number_format($pesanan->total_harga) }}</div>
</div>

@if(isset($pesanan->diskon) && $pesanan->diskon > 0)

<div class="row">
    <div>Diskon</div>
    <div>- Rp {{ number_format($pesanan->diskon) }}</div>
</div>

@endif

<hr>

<div class="row total-box">
    <div>TOTAL</div>
    <div>Rp {{ number_format($pesanan->total_harga) }}</div>
</div>

<hr>

{{-- ================= PAYMENT ================= --}}

@if($pesanan->bayar)

<div class="row">
    <div>Payment</div>
    <div>CASH</div>
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

<div class="row">
    <div>Payment</div>
    <div>
        {{ strtoupper($pesanan->transaksi->metode ?? 'GATEWAY') }}
    </div>
</div>

@endif

<hr>

{{-- ================= QR CODE ================= --}}

<div class="barcode-section">

    <div class="barcode-wrapper">

        <img 
            src="{{ asset('image/barcode.png') }}"
            class="barcode-img"
            alt="QR Code"
            onerror="this.style.display='none'"
        >

        <div class="barcode-text">
            {{ $pesanan->kode_pesanan }}
        </div>

    </div>

</div>

<hr>

{{-- ================= FOOTER ================= --}}

<div class="footer">

    <div class="bold">
        *** PAID ***
    </div>

    <div>
        {{ date('d M Y - H:i') }}
    </div>

    <br>

    <div>
        Thank you ☕
    </div>

    <small>
        Enjoy your coffee!
    </small>

</div>

</body>
</html>