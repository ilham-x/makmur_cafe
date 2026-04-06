<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu Coffee Makmur</title>

<style>
:root{
 --bg:#fefefe;
 --primary:#7ca36a;
 --secondary:#f4d35e;
 --dark:#111;
 --shadow:6px 6px 0 var(--dark);
}
body{margin:0;font-family:Arial;background:var(--bg);}
.container{max-width:1200px;margin:auto;padding:30px;}
.header{display:flex;justify-content:space-between;margin-bottom:30px;}
.meja{background:var(--secondary);padding:8px;border:3px solid #000;box-shadow:var(--shadow);}
.grid{display:grid;grid-template-columns:2fr 1fr;gap:30px;}
.menu-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:20px;}
.card{border:3px solid #000;padding:15px;background:#fff;box-shadow:var(--shadow);}
.card img{width:100%;height:140px;object-fit:cover;}
button{width:100%;padding:10px;background:var(--primary);color:#fff;border:3px solid #000;cursor:pointer;box-shadow:var(--shadow);}
.cart{border:3px solid #000;padding:20px;background:#fff;box-shadow:var(--shadow);}
.cart-item{display:flex;justify-content:space-between;margin-bottom:10px;}
.total{font-weight:bold;margin-top:20px;}
input,select{width:100%;padding:8px;margin-top:10px;border:2px solid #000;}
</style>
</head>

<body>

<div class="container">

<div class="header">
<h1>☕ Coffee Makmur</h1>
<div class="meja">Meja {{ $nomor_meja }}</div>
</div>

@if(session('success'))
<p>{{ session('success') }}</p>
@endif

@if(session('error'))
<p style="color:red">{{ session('error') }}</p>
@endif

<div class="grid">

<!-- MENU -->
<div class="menu-grid">

@foreach($menus as $menu)
<div class="card">

@if($menu->gambar)
<img src="{{ asset('storage/'.$menu->gambar) }}">
@endif

<h3>{{ $menu->nama_produk }}</h3>
<p>Rp {{ number_format($menu->harga) }}</p>

<!-- TAMBAH CART -->
<form action="{{ route('customer.cart') }}" method="POST">
@csrf
<input type="hidden" name="produk_id" value="{{ $menu->id }}">
<button>Tambah</button>
</form>

</div>
@endforeach

</div>


<!-- CART -->
<div class="cart">

<h3>Keranjang</h3>

@php $total = 0; @endphp

@forelse($cart as $item)

<div class="cart-item">
<div>{{ $item['nama'] }} x{{ $item['qty'] }}</div>
<div>Rp {{ number_format($item['harga'] * $item['qty']) }}</div>
</div>

<a href="{{ route('cart.remove', $item['produk_id']) }}" style="color:red;">Hapus</a>

@php $total += $item['harga'] * $item['qty']; @endphp

@empty
<p>Keranjang kosong</p>
@endforelse

<div class="total">
Total: Rp {{ number_format($total) }}
</div>


<!-- CHECKOUT -->
<form action="{{ route('customer.checkout') }}" method="POST">
@csrf

<input type="hidden" name="nomor_meja" value="{{ $nomor_meja }}">

<input type="text" name="nama_pelanggan" placeholder="Nama Pemesan" required>

<select name="metode_pembayaran" required>
<option value="">-- Pilih Pembayaran --</option>
<option value="cash">Cash</option>
<option value="online">Online (QRIS / E-Wallet)</option>
</select>

<br><br>

<button>Checkout</button>

</form>

</div>

</div>
</div>

</body>
</html>