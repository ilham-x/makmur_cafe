<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu Coffee Makmur</title>

<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
:root{
 --bg:#ffe8d6;
 --primary:#00c2a8;
 --secondary:#ff7a00;
 --accent:#ff3d71;
 --dark:#000;
 --light:#fff;

 --radius:14px;
 --border:3px solid #000;
 --shadow:6px 6px 0 #000;
}

*{box-sizing:border-box;}

body{
 margin:0;
 font-family:Arial, sans-serif;
 background-image: url("{{ asset('image/Desain tanpa judul (1).jpg') }}");
 background-size: cover;
 background-position: center;
 background-attachment: fixed;
}

.container{
 max-width:1200px;
 margin:auto;
 padding:20px;
}

/* HEADER */
.header{
 display:flex;
 justify-content:space-between;
 align-items:center;
 margin-bottom:20px;
 gap:10px;
 flex-wrap:wrap;
}

h1{
 font-size:26px;
 background:var(--light);
 padding:10px 15px;
 border:var(--border);
 box-shadow:var(--shadow);
 border-radius:var(--radius);
}

.meja{
 background:var(--secondary);
 padding:10px 15px;
 border:var(--border);
 box-shadow:var(--shadow);
 border-radius:var(--radius);
 font-weight:bold;
}

/* SEARCH */
.search-box{
 margin-bottom:10px;
}

.search-box input{
 width:100%;
 padding:10px;
 border:var(--border);
 border-radius:var(--radius);
 box-shadow:var(--shadow);
 font-weight:bold;
 background:#fff;
}

/* FILTER */
.filter-box{
 background:#fff;
 padding:12px;
 border:var(--border);
 border-radius:var(--radius);
 box-shadow:var(--shadow);
 margin-bottom:15px;
}

.filter-box select{
 width:100%;
 padding:10px;
 border:var(--border);
 border-radius:10px;
 font-weight:bold;
 background:#fff;
 cursor:pointer;
}

/* GRID */
.grid{
 display:grid;
 grid-template-columns:2fr 1fr;
 gap:20px;
}

/* MENU */
.menu-grid{
 display:grid;
 grid-template-columns:repeat(auto-fill,minmax(180px,1fr));
 gap:15px;
}

/* CARD */
.card{
 position:relative;
 background:var(--light);
 border:var(--border);
 border-radius:var(--radius);
 padding:12px;
 box-shadow:var(--shadow);
 transition:0.15s;
}

.card:hover{
 transform:translate(-4px,-4px);
 box-shadow:10px 10px 0 #000;
}

/* BADGE */
.badge{
 position:absolute;
 top:10px;
 left:-5px;
 background:var(--accent);
 color:#fff;
 padding:4px 10px;
 font-size:11px;
 border:var(--border);
 box-shadow:3px 3px 0 #000;
 transform:rotate(-5deg);
}

/* IMAGE */
.card img{
 width:100%;
 height:120px;
 object-fit:cover;
 border:var(--border);
 border-radius:10px;
 margin-bottom:8px;
}

/* TEXT */
.card h3{
 margin:5px 0;
 font-size:14px;
}

.card p{
 margin:4px 0;
 font-weight:bold;
 font-size:13px;
}

/* BUTTON */
button{
 width:100%;
 padding:8px;
 border:var(--border);
 border-radius:10px;
 background:var(--primary);
 font-weight:bold;
 cursor:pointer;
 box-shadow:var(--shadow);
 transition:0.15s;
}

button:hover{
 transform:translate(-3px,-3px);
 box-shadow:8px 8px 0 #000;
}

/* CART (FIX UTAMA DI SINI) */
.cart{
 background:var(--light);
 border:var(--border);
 border-radius:var(--radius);
 padding:15px;
 box-shadow:var(--shadow);

 position:sticky;
 top:20px;

 max-height:420px;           /* 🔥 BATAS TINGGI */
 display:flex;
 flex-direction:column;
}

/* SCROLL AREA */
.cart-items{
 overflow-y:auto;
 flex:1;
 margin-bottom:10px;
}

/* ITEM */
.cart-item{
 display:flex;
 justify-content:space-between;
 font-size:13px;
 margin-bottom:5px;
}

/* TOTAL */
.total{
 font-weight:bold;
 margin-top:10px;
}

/* INPUT */
input, select{
 width:100%;
 padding:8px;
 border:var(--border);
 border-radius:10px;
 margin-top:8px;
 box-shadow:var(--shadow);
}

/* SCROLLBAR */
.cart-items::-webkit-scrollbar{
 width:6px;
}
.cart-items::-webkit-scrollbar-thumb{
 background:#000;
}

/* MOBILE */
@media(max-width:768px){
 .grid{grid-template-columns:1fr;}
 .header{flex-direction:column;}
 h1{text-align:center;}
 .cart{max-height:none;}
}
</style>
</head>

<body>

<div class="container">

<div class="header">
<h1>🫘 Coffee Makmur</h1>
<div class="meja">Meja {{ $nomor_meja }}</div>
</div>

<!-- SEARCH -->
<form method="GET" class="search-box">
<input type="text" name="q" placeholder="Cari menu..." value="{{ request('q') }}">
</form>

<!-- FILTER (TIDAK DIUBAH) -->
<form method="GET" class="filter-box">
<select name="kategori" onchange="this.form.submit()">
<option value="">-- Semua Kategori --</option>
<option value="Kopi" {{ request('kategori')=='Kopi'?'selected':'' }}>Kopi</option>
<option value="Non-Kopi" {{ request('kategori')=='Non-Kopi'?'selected':'' }}>Non-Kopi</option>
<option value="Soda" {{ request('kategori')=='Soda'?'selected':'' }}>Soda</option>
<option value="Makanan Ringan" {{ request('kategori')=='Makanan Ringan'?'selected':'' }}>Makanan Ringan</option>
<option value="Tansu" {{ request('kategori')=='Tansu'?'selected':'' }}>Tansu</option>
<option value="Roti Panggang" {{ request('kategori')=='Roti Panggang'?'selected':'' }}>Roti Panggang</option>
<option value="Makanan Berat" {{ request('kategori')=='Makanan Berat'?'selected':'' }}>Makanan Berat</option>
<option value="Mie Rebus/Goreng" {{ request('kategori')=='Mie Rebus/Goreng'?'selected':'' }}>Mie Rebus/Goreng</option>
</select>
</form>

<div class="grid">

<!-- LEFT -->
<div>

<h2>🔥 Best Seller Minggu Ini</h2>

<div class="menu-grid">
@foreach($bestSellers as $menu)
<div class="card">
<span class="badge">Best Seller</span>

@if($menu->gambar)
<img src="{{ asset('storage/'.$menu->gambar) }}">
@endif

<h3>{{ $menu->nama_produk }}</h3>
<p>Rp {{ number_format($menu->harga) }}</p>

<form action="{{ route('customer.cart') }}" method="POST">
@csrf
<input type="hidden" name="produk_id" value="{{ $menu->id }}">
<button style="background:var(--accent);color:#fff;">Tambah</button>
</form>
</div>
@endforeach
</div>

<h2 style="margin-top:25px;">📋 Semua Menu</h2>

<div class="menu-grid">
@foreach($menus as $menu)
<div class="card">

@if($menu->gambar)
<img src="{{ asset('storage/'.$menu->gambar) }}">
@endif

<h3>{{ $menu->nama_produk }}</h3>
<p>Rp {{ number_format($menu->harga) }}</p>

<form action="{{ route('customer.cart') }}" method="POST">
@csrf
<input type="hidden" name="produk_id" value="{{ $menu->id }}">
<button>Tambah</button>
</form>

</div>
@endforeach
</div>

</div>

<!-- CART -->
<div class="cart">

<h3>Keranjang</h3>

<div class="cart-items">
@php $total = 0; @endphp

@forelse($cart as $item)
<div class="cart-item">
<span>{{ $item['nama'] }} x{{ $item['qty'] }}</span>
<span>Rp {{ number_format($item['harga'] * $item['qty']) }}</span>
</div>
@php $total += $item['harga'] * $item['qty']; @endphp
@empty
<p>Kosong</p>
@endforelse
</div>

<hr>

<div class="total">Total: Rp {{ number_format($total) }}</div>

<form action="{{ route('customer.checkout') }}" method="POST">
@csrf

<input type="hidden" name="nomor_meja" value="{{ $nomor_meja }}">
<input type="text" name="nama_pelanggan" placeholder="Nama Pemesan" required>

<select name="metode_pembayaran" required>
<option value="">Pilih Pembayaran</option>
<option value="cash">Cash</option>
<option value="online">Online</option>
</select>

<br>
<button>Checkout</button>

</form>

</div>

</div>

</div>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init();
</script>

</body>
</html>