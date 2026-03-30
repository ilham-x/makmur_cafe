<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu Coffee Makmur</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
/* STYLE LU (TIDAK DIUBAH) */
:root{
 --bg:#fefefe;
 --primary:#7ca36a;
 --secondary:#f4d35e;
 --dark:#111;
 --light:#fff;
 --shadow:6px 6px 0 var(--dark);
}

*{box-sizing:border-box;font-family:Arial;}
body{margin:0;background:var(--bg);}
.container{max-width:1200px;margin:auto;padding:30px;}
.header{display:flex;justify-content:space-between;margin-bottom:30px;flex-wrap:wrap;}
.meja{background:var(--secondary);padding:8px 15px;border:3px solid var(--dark);box-shadow:var(--shadow);font-weight:bold;}
.grid{display:grid;grid-template-columns:2fr 1fr;gap:30px;}

@media(max-width:768px){
.grid{grid-template-columns:1fr;}
}

.menu-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:20px;}
.card{border:3px solid var(--dark);padding:15px;background:white;box-shadow:var(--shadow);}
.card img{width:100%;height:140px;object-fit:cover;margin-bottom:10px;}

button{
 width:100%;
 padding:10px;
 border:3px solid var(--dark);
 background:var(--primary);
 color:white;
 font-weight:bold;
 cursor:pointer;
 box-shadow:var(--shadow);
}

.cart{
 border:3px solid var(--dark);
 padding:20px;
 background:white;
 box-shadow:var(--shadow);
}

.cart-item{
 display:flex;
 justify-content:space-between;
 align-items:center;
 margin-bottom:10px;
}

.qty-btn{
 width:30px;
 height:30px;
 font-size:16px;
}

.total{font-weight:bold;margin-top:20px;}
input{width:100%;padding:8px;margin-top:10px;border:2px solid #000;}
</style>
</head>

<body>

<div class="container">

<div class="header">
<h1>☕ Coffee Makmur</h1>
<div class="meja">Meja {{ $nomor_meja }}</div>
</div>

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

<form action="{{ route('customer.cart') }}" method="POST">
@csrf
<input type="hidden" name="produk_id" value="{{ $menu->id }}">
<input type="hidden" name="nama" value="{{ $menu->nama_produk }}">
<input type="hidden" name="harga" value="{{ $menu->harga }}">
<button>Tambah</button>
</form>

</div>
@endforeach
</div>

<!-- CART -->
<div class="cart" id="cart-box">

@include('customer.cart_partial')

</div>

</div>
</div>

<script>
function updateCart(id, type){
 fetch("{{ route('cashier.cart.update') }}", {
  method:"POST",
  headers:{
   "X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content,
   "Content-Type":"application/json"
  },
  body:JSON.stringify({produk_id:id,type:type})
 }).then(()=>location.reload());
}

function deleteCart(id){
 fetch("{{ route('cashier.cart.delete') }}", {
  method:"POST",
  headers:{
   "X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content,
   "Content-Type":"application/json"
  },
  body:JSON.stringify({produk_id:id})
 }).then(()=>location.reload());
}
</script>

</body>
</html>