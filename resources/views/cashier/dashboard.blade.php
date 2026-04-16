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

/* HEADER */
.header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:15px;
}

.header h1{
  margin:0;
  font-size:28px;
}

.logout-btn{
  width:auto;
  padding:8px 14px;
  font-size:12px;
  background:#dc3545;
}

/* GRID UTAMA */
.grid{
  display:grid;
  grid-template-columns:2fr 1fr;
  gap:15px;
}

/* GRID PRODUK */
.menu-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill, minmax(140px, 1fr));
  gap:12px;
  align-items:start;
}

/* CARD */
.card{
  background:var(--light);
  border:2px solid var(--dark);
  padding:10px;
  text-align:center;
  display:flex;
  flex-direction:column;
  justify-content:space-between;
  border-radius:10px;
  transition:0.2s;
}

.card:hover{
  transform:scale(1.02);
}

/* GAMBAR */
.card img{
  width:100%;
  height:100px;
  object-fit:cover;
  border:2px solid var(--dark);
  border-radius:6px;
  margin-bottom:6px;
}

/* TEXT */
.card h4{
  font-size:13px;
  margin:4px 0;
}

.card p{
  font-size:12px;
  margin:2px 0;
}

/* BUTTON */
button{
  width:100%;
  background:var(--primary);
  color:#fff;
  border:2px solid var(--dark);
  padding:6px;
  font-size:12px;
  font-weight:bold;
  cursor:pointer;
  margin-top:6px;
  border-radius:6px;
}

/* CART */
.cart{
  background:#fff;
  padding:12px;
  border:2px solid var(--dark);
  position:sticky;
  top:20px;
  border-radius:10px;
}

/* INPUT */
input{
  width:100%;
  padding:6px;
  border:2px solid var(--dark);
  margin-top:5px;
  border-radius:5px;
}

/* STATUS */
.status-badge{
  display:inline-block;
  padding:3px 8px;
  color:#fff;
  font-size:11px;
  border:2px solid var(--dark);
  border-radius:6px;
}

hr{
  border:none;
  border-top:2px solid var(--dark);
  margin:10px 0;
}
</style>
</head>

<body>

<div class="container">

<!-- HEADER -->
<div class="header">
<h1>🫘 Kasir</h1>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="logout-btn">Logout</button>
</form>
</div>

<div class="grid">

<!-- MENU -->
<div class="menu-grid">
@foreach($anjlok as $menu)

<div class="card">

@if($menu->gambar)
<img src="{{ asset('storage/'.$menu->gambar) }}">
@else
<div style="height:100px;background:#eee;display:flex;align-items:center;justify-content:center;border:2px solid var(--dark);border-radius:6px;">
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

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:15px;">

@foreach($pesanans as $psn)

<div class="card" style="text-align:left;">

<!-- HEADER -->
<div style="display:flex;justify-content:space-between;align-items:center;">
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

<div style="font-size:12px;margin:6px 0;">
Meja: <b>{{ $psn->nomor_meja }}</b> | {{ $psn->nama_pelanggan }}
</div>

<hr>

<!-- DETAIL -->
<div style="font-size:12px;max-height:90px;overflow:auto;">
@foreach($psn->detail as $d)
<div style="display:flex;justify-content:space-between;">
<span>{{ $d->produk->nama_produk }} x{{ $d->qty }}</span>
<span>Rp {{ number_format($d->subtotal) }}</span>
</div>
@endforeach
</div>

<hr>

<!-- TOTAL -->
<div style="display:flex;justify-content:space-between;font-weight:bold;">
<span>Total</span>
<span>Rp {{ number_format($psn->total_harga) }}</span>
</div>

<!-- BUTTON -->
<div style="margin-top:8px;display:flex;gap:6px;flex-wrap:wrap;">

@if($psn->status == 'menunggu')

<form method="POST" action="{{ route('cashier.updateStatus',$psn->id) }}">
@csrf
@method("PUT")
<input type="hidden" name="status" value="pending_payment">
<button>Kirim</button>
</form>

@elseif($psn->status == 'pending_payment')

@if($psn->metode_pembayaran == 'cash')

<form method="POST" action="{{ route('cashier.bayar',$psn->id) }}">
@csrf
<input type="number" name="bayar" placeholder="Bayar">
<button>Bayar</button>
</form>

@else

<form method="POST" action="{{ route('cashier.bayar',$psn->id) }}">
@csrf
<button>Konfirmasi</button>
</form>

@endif

@elseif($psn->status == 'dibayar')

<form method="POST" action="{{ route('cashier.updateStatus',$psn->id) }}">
@csrf
<input type="hidden" name="status" value="selesai">
<button>Selesai</button>
</form>

<a href="{{ route('struk',$psn->id) }}" target="_blank" style="width:100%;">
<button type="button" style="background:var(--secondary);color:#000;">Cetak</button>
</a>

@else
<span>✔️ Selesai</span>
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