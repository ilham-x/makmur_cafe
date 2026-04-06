<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kasir</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
:root{
  --bg:#fefefe;
  --primary:#7ca36a;
  --secondary:#f4d35e;
  --dark:#111;
  --light:#fff;
}

*{
  box-sizing:border-box;
  font-family:Arial, Helvetica, sans-serif;
}

body{
  margin:0;
  background:var(--bg);
  color:var(--dark);
}

.container{
  max-width:1200px;
  margin:auto;
  padding:20px;
}

h1,h2{
  font-weight:900;
  margin-top:0;
}

/* GRID UTAMA */
.grid{
  display:grid;
  grid-template-columns:2fr 1fr;
  gap:15px;
}

/* GRID PRODUK (FIX TIDAK PANJANG) */
.menu-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill, minmax(140px, 1fr));
  gap:10px;
  align-items:start; /* 🔥 FIX UTAMA */
}

/* CARD PRODUK */
.card{
  background:var(--light);
  border:2px solid var(--dark);
  padding:8px;
  text-align:center;
  display:flex;
  flex-direction:column;
  justify-content:space-between;
}

/* GAMBAR */
.card img{
  width:100%;
  height:90px;
  object-fit:cover;
  border:2px solid var(--dark);
  margin-bottom:5px;
}

/* TEXT */
.card h4{
  font-size:12px;
  margin:3px 0;
}

.card p{
  font-size:11px;
  margin:2px 0;
}

/* BUTTON */
button{
  width:100%;
  background:var(--primary);
  color:#fff;
  border:2px solid var(--dark);
  padding:5px;
  font-size:11px;
  font-weight:bold;
  cursor:pointer;
  margin-top:5px;
}

/* CART */
.cart{
  background:#fff;
  padding:12px;
  border:2px solid var(--dark);
  position:sticky;
  top:20px;
}

/* INPUT */
input{
  width:100%;
  padding:6px;
  border:2px solid var(--dark);
  margin-top:5px;
}

/* STATUS */
.status-badge{
  display:inline-block;
  padding:3px 8px;
  color:#fff;
  font-size:11px;
  border:2px solid var(--dark);
}

hr{
  border:none;
  border-top:2px solid var(--dark);
  margin:10px 0;
}
.card{
  border-radius:8px;
}
</style>
</head>

<body>

<div class="container">

<h1>☕ Kasir</h1>

<div class="grid">

<!-- MENU -->
<div class="menu-grid">
@foreach($anjlok as $menu)

<div class="card">

@if($menu->gambar)
<img src="{{ asset('storage/'.$menu->gambar) }}">
@else
<div style="height:90px; background:#eee; display:flex; align-items:center; justify-content:center; border:2px solid var(--dark);">
Tidak ada
</div>
@endif

<h4>{{ $menu->nama_produk }}</h4>
<p>Rp {{ number_format($menu->harga) }}</p>

<form action="{{ route('customer.cart') }}" method="POST">
@csrf
<input type="hidden" name="produk_id" value="{{ $menu->id }}">
<input type="hidden" name="nama" value="{{ $menu->nama_produk }}">
<input type="hidden" name="harga" value="{{ $menu->harga }}">
<button type="submit">Tambah</button>
</form>

</div>

@endforeach
</div>

<!-- CART -->
<div class="cart">
@include('cashier.cart_partial')
</div>

</div>

<hr>

<h2>📋 Daftar Pesanan</h2>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:12px;">

@foreach($pesanans as $psn)

<div class="card" style="text-align:left;padding:10px;">

<!-- HEADER -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:5px;">
<b>#{{ $psn->kode_pesanan }}</b>

<span class="status-badge" style="
background:
{{ 
 $psn->status == 'menunggu' ? '#6c757d' :
($psn->status == 'pending_payment' ? '#f4d35e' :
($psn->status == 'dibayar' ? '#7ca36a' :
'black'))
}};
font-size:10px;
">
{{ $psn->status }}
</span>
</div>

<!-- INFO -->
<div style="font-size:11px;margin-bottom:5px;">
Meja: <b>{{ $psn->nomor_meja }}</b> |
{{ $psn->nama_pelanggan }}
</div>

<hr style="margin:6px 0;">

<!-- DETAIL PRODUK -->
<div style="font-size:11px;max-height:80px;overflow:auto;">
@foreach($psn->detail as $d)
<div style="display:flex;justify-content:space-between;">
<span>{{ $d->produk->nama_produk }} x{{ $d->qty }}</span>
<span>Rp {{ number_format($d->subtotal) }}</span>
</div>
@endforeach
</div>

<hr style="margin:6px 0;">

<!-- TOTAL -->
<div style="display:flex;justify-content:space-between;font-size:12px;font-weight:bold;">
<span>Total</span>
<span>Rp {{ number_format($psn->total_harga) }}</span>
</div>

<!-- BUTTON -->
<div style="margin-top:8px;display:flex;gap:5px;flex-wrap:wrap;">

@if($psn->status == 'menunggu')

<form method="POST" action="{{ route('cashier.updateStatus',$psn->id) }}">
@csrf
<input type="hidden" name="status" value="pending_payment">
<button style="font-size:10px;padding:5px;">Kirim</button>
</form>

@elseif($psn->status == 'pending_payment')

@if($psn->metode_pembayaran == 'cash')

<form method="POST" action="{{ route('cashier.bayar',$psn->id) }}">
@csrf
<input type="number" name="bayar" placeholder="Bayar" style="font-size:10px;padding:4px;">
<button style="font-size:10px;padding:5px;">Bayar</button>
</form>

@else

<form method="POST" action="{{ route('cashier.bayar',$psn->id) }}">
@csrf
<button style="font-size:10px;padding:5px;">Konfirmasi</button>
</form>

@endif

@elseif($psn->status == 'dibayar')

<form method="POST" action="{{ route('cashier.updateStatus',$psn->id) }}">
@csrf
<input type="hidden" name="status" value="selesai">
<button style="font-size:10px;padding:5px;">Selesai</button>
</form>

<a href="{{ route('struk',$psn->id) }}" target="_blank">
<button type="button" style="font-size:10px;padding:5px;background:var(--secondary);">Cetak</button>
</a>

@else
<span style="font-size:11px;">✔️ Selesai</span>
@endif

</div>

</div>

@endforeach

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