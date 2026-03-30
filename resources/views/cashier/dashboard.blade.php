<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kasir Coffee Makmur</title>

<style>

:root{
--bg:#f8f8f8;
--primary:#4ade80;
--secondary:#fde047;
--accent:#fb7185;
--dark:#000;
--light:#fff;
--shadow:6px 6px 0px #000;
}

*{
box-sizing:border-box;
font-family:Arial, Helvetica, sans-serif;
}

body{
margin:0;
background:var(--bg);
}

.container{
max-width:1200px;
margin:auto;
padding:25px;
}

/* HEADER */

.header{
background:var(--secondary);
border:4px solid var(--dark);
box-shadow:var(--shadow);
padding:16px 20px;
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.header h1{
margin:0;
font-size:22px;
font-weight:900;
}

/* BUTTON */

button{
background:var(--primary);
border:3px solid var(--dark);
padding:8px 14px;
font-weight:900;
cursor:pointer;
box-shadow:var(--shadow);
}

button:hover{
transform:translate(-3px,-3px);
box-shadow:8px 8px 0px #000;
}

/* GRID */

.grid{
display:grid;
grid-template-columns:2fr 1fr;
gap:20px;
}

/* CARD */

.card{
background:var(--light);
border:4px solid var(--dark);
box-shadow:var(--shadow);
padding:18px;
}

/* PRODUK */

.product-grid{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:16px;
margin-top:15px;
}

.product{
border:3px solid var(--dark);
padding:14px;
box-shadow:var(--shadow);
}

.product h3{
margin:0 0 8px;
}

.product p{
margin:0 0 10px;
font-weight:bold;
}

/* CART */

.cart-item{
display:flex;
justify-content:space-between;
border-bottom:3px solid #ddd;
padding:8px 0;
font-weight:bold;
}

.total{
display:flex;
justify-content:space-between;
font-size:18px;
font-weight:900;
margin-top:10px;
}

</style>
</head>

<body>

<div class="container">

<!-- HEADER -->

<div class="header">

<h1>☕ Coffee Makmur - Kasir</h1>

<div style="display:flex; gap:10px; align-items:center;">

<span>Halo, <b>{{$ire->name}}</b></span>

<form action="{{ route('logout') }}" method="post">
@csrf
<button type="submit">
Logout
</button>
</form>

</div>

</div>

<div class="grid">

<!-- PRODUK -->

<div class="card">

<h2>Daftar Produk</h2>

<div class="product-grid">

<div class="card">
    <div style="
        display:grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap:20px;
    ">

        @foreach($anjlok as $produk)
        <div style="
            border:3px solid #000;
            padding:15px;
            box-shadow:4px 4px 0px #000;
            background:white;
        ">
            
            {{-- Gambar --}}
            @if($produk->gambar)
                <img src="{{ asset('storage/'.$produk->gambar) }}" 
                     style="width:100%; height:150px; object-fit:cover; margin-bottom:10px;">
            @else
                <div style="
                    height:150px;
                    background:#eee;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    margin-bottom:10px;
                ">
                    Tidak ada gambar
                </div>
            @endif

            <form action="{{ route('cashier.cart.add') }}" method="POST">
@csrf

<input type="hidden" name="produk_id" value="{{ $produk->id }}">
<input type="hidden" name="nama" value="{{ $produk->nama_produk }}">
<input type="hidden" name="harga" value="{{ $produk->harga }}">


            <p>
                Stok: 
                <strong>
                    {{ $produk->stok }}
                </strong>
            </p>

            {{-- Aksi --}}
            <div style="margin-top:10px;">
                <button style="width:100%; margin-top:12px; background:var(--accent);">
Tambah
</button>
</form>
            </div>

        </div>
        @endforeach

    </div>
</div>
</div>

</div>

<!-- KERANJANG -->

<div class="card">

<h2>Keranjang</h2>

@php
$cart = session('cart', []);
$total = 0;
@endphp

@forelse($cart as $item)
<div class="cart-item">
    <span>{{ $item['nama'] }} (x{{ $item['qty'] }})</span>
    <span>Rp {{ number_format($item['harga'] * $item['qty']) }}</span>
</div>

@php
$total += $item['harga'] * $item['qty'];
@endphp

@empty
<p>Keranjang kosong</p>
@endforelse

<div class="total">
<span>Total</span>
<span>Rp {{ number_format($total) }}</span>

</div>

</div>

</div>

</body>
</html>