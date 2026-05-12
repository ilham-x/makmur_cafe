<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kasir</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
:root{
  /* WARNE NEOBRUTALISM (Lebih Bold & Cerah) */
  --bg-color: #fffbf0;
  --primary: #00ff9f;      /* Hijau Neon */
  --secondary: #ffea00;    /* Kuning Mentega */
  --accent: #ff006e;       /* Pink Terang */
  --dark: #000000;         /* Hitam Pekat */
  --light: #ffffff;
  --border-width: 3px;
}

*{
  box-sizing:border-box;
  font-family:'Courier New', Courier, monospace; /* Font ala mesin tik/kalkulator */
}

body{
  margin:0;
  /* PATTERN BACKGROUND NEOBRUTALISM (Titik-titik) */
  background-color: var(--bg-color);
  background-image: radial-gradient(var(--dark) 1px, transparent 1px);
  background-size: 20px 20px;
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
  margin-bottom:25px;
  padding:15px;
  background:var(--light);
  border: var(--border-width) solid var(--dark);
  box-shadow: 5px 5px 0px var(--dark);
}

.header h1{
  margin:0;
  font-size:32px;
  text-transform:uppercase;
  letter-spacing:2px;
  text-shadow: 2px 2px 0px rgba(0,0,0,0.2);
}

.logout-btn{
  width:auto;
  padding:10px 20px;
  font-size:14px;
  background:var(--accent);
  color:var(--light);
  text-transform:uppercase;
  font-weight:bold;
  border: var(--border-width) solid var(--dark);
  box-shadow: 3px 3px 0px var(--dark);
  transition:0.1s;
}

.logout-btn:hover{
  transform:translate(1px, 1px);
  box-shadow: 2px 2px 0px var(--dark);
}

.logout-btn:active{
  transform:translate(3px, 3px);
  box-shadow: 0px 0px 0px var(--dark);
}

/* GRID UTAMA */
.grid{
  display:grid;
  grid-template-columns:2fr 1fr;
  gap:20px;
}

/* GRID PRODUK */
.menu-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill, minmax(160px, 1fr));
  gap:15px;
  align-items:start;
}

/* CARD - GAYA NEOBRUTALISM */
.card{
  background:var(--light);
  border: var(--border-width) solid var(--dark);
  padding:15px;
  text-align:center;
  display:flex;
  flex-direction:column;
  justify-content:space-between;
  box-shadow: 6px 6px 0px var(--dark);
  transition:0.2s;
}

.card:hover{
  transform:translate(-2px, -2px);
  box-shadow: 8px 8px 0px var(--dark);
}

/* GAMBAR */
.card img{
  width:100%;
  height:120px;
  object-fit:cover;
  border: var(--border-width) solid var(--dark);
  border-radius:8px;
  margin-bottom:10px;
  background:#eee;
}

/* TEXT */
.card h4{
  font-size:14px;
  margin:5px 0;
  font-weight:900;
  text-transform:uppercase;
  line-height:1.2;
}

.card p{
  font-size:14px;
  margin:5px 0;
  font-weight:bold;
  background:var(--secondary);
  display:inline-block;
  padding:2px 8px;
  border:2px solid var(--dark);
}

/* BUTTON - GAYA NEOBRUTALISM */
button{
  width:100%;
  background:var(--primary);
  color:var(--dark);
  border: var(--border-width) solid var(--dark);
  padding:10px;
  font-size:14px;
  font-weight:900;
  text-transform:uppercase;
  cursor:pointer;
  margin-top:10px;
  box-shadow: 4px 4px 0px var(--dark);
  transition:0.1s;
}

button:hover{
  filter: brightness(1.1);
}

button:active{
  transform:translate(3px, 3px);
  box-shadow: 1px 1px 0px var(--dark);
}

/* CART */
.cart{
  background:var(--light);
  padding:20px;
  border: var(--border-width) solid var(--dark);
  border-radius:12px;
  box-shadow: 6px 6px 0px var(--dark);
  
  /* LOGIC TETAP DIPERTAHANKAN */
  position:relative;
  height:auto;
  max-height:75vh;
  overflow-y:auto;
}

/* SCROLLBAR CUSTOM */
.cart::-webkit-scrollbar{
  width:10px;
}
.cart::-webkit-scrollbar-track{
  background:var(--light);
  border:2px solid var(--dark);
}
.cart::-webkit-scrollbar-thumb{
  background:var(--dark);
  border:2px solid var(--light);
  border-radius:10px;
} 

/* INPUT */
input{
  width:100%;
  padding:10px;
  border: var(--border-width) solid var(--dark);
  margin-top:8px;
  border-radius:6px;
  font-weight:bold;
  background:var(--light);
  font-family:inherit;
}

input:focus{
  outline:none;
  background:var(--secondary);
}

/* STATUS BADGE */
.status-badge{
  display:inline-block;
  padding:5px 10px;
  color:var(--dark);
  font-size:11px;
  font-weight:900;
  text-transform:uppercase;
  border: var(--border-width) solid var(--dark);
  box-shadow: 3px 3px 0px var(--dark);
  transform: rotate(-2deg); /* Efek miring */
}

hr{
  border:none;
  border-top: var(--border-width) solid var(--dark);
  margin:15px 0;
}

/* JUDUL DAFTAR PESANAN */
h2{
  text-transform:uppercase;
  border-bottom: var(--border-width) solid var(--dark);
  padding-bottom:10px;
  background: var(--secondary);
  display:inline-block;
  padding-right:20px;
  box-shadow: 4px 4px 0px var(--dark);
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
<div style="height:120px;background:#eee;display:flex;align-items:center;justify-content:center;border:var(--border-width) solid var(--dark);border-radius:6px;font-weight:bold;">
NO IMG
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

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;">

@foreach($pesanans as $psn)

<div class="card" style="text-align:left;">

<!-- HEADER -->
<div style="display:flex;justify-content:space-between;align-items:center;">
<b style="font-size:16px;">#{{ $psn->kode_pesanan }}</b>

<span class="status-badge" style="
background:
{{ 
 $psn->status == 'menunggu' ? '#adb5bd' :
($psn->status == 'pending_payment' ? 'var(--secondary)' :
($psn->status == 'dibayar' ? 'var(--primary)' :
'var(--accent)'))
}};
">
{{ $psn->status }}
</span>
</div>

<div style="font-size:13px;margin:10px 0;font-weight:bold;">
Meja: {{ $psn->nomor_meja }} | {{ $psn->nama_pelanggan }}
</div>

<hr>

<!-- DETAIL -->
<div style="font-size:13px;max-height:100px;overflow:auto;border:2px solid #eee;padding:5px;">
@foreach($psn->detail as $d)
<div style="display:flex;justify-content:space-between;margin-bottom:4px;">
<span>{{ $d->produk->nama_produk }} x{{ $d->qty }}</span>
<span>Rp {{ number_format($d->subtotal) }}</span>
</div>
@endforeach
</div>

<hr>

<!-- TOTAL -->
<div style="display:flex;justify-content:space-between;font-weight:900;font-size:16px;margin:5px 0;">
<span>TOTAL</span>
<span>Rp {{ number_format($psn->total_harga) }}</span>
</div>

<!-- BUTTON -->
<div style="margin-top:15px;display:flex;gap:8px;flex-wrap:wrap;">

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
<input type="number" name="bayar" placeholder="Jumlah Bayar">
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
<button type="button" style="background:var(--accent);color:var(--light);">Cetak</button>
</a>

@else
<span style="background:var(--secondary);padding:5px 10px;border:2px solid var(--dark);font-weight:bold;">✔️ Selesai</span>
@endif

</div>

</div>

@endforeach

</div>

<script>
function updateCart(id, type){
 fetch("{{ route('cashier.cart.update') }}", {
  method:"PUT",
  headers:{
   "X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content,
   "Content-Type":"application/json",
   "Accept":"application/json"
  },
  body:JSON.stringify({
    produk_id:id,
    type:type
  })
 })
 .then(async res => {
    let text = await res.text();

    try {
        let data = JSON.parse(text);
        console.log("JSON:", data);
        location.reload();
    } catch(e){
        console.error("❌ BUKAN JSON:");
        console.log(text);
    }
 })
 .catch(err => console.error("Fetch error:", err));
}


function deleteCart(id){
 fetch("{{ route('cashier.cart.delete') }}", {
  method:"POST",
  headers:{
   "X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content,
   "Content-Type":"application/json",
   "Accept":"application/json"
  },
  body:JSON.stringify({produk_id:id})
 })
 .then(async res => {
   if(!res.ok){
     const text = await res.text();
     console.error("ERROR RESPONSE:", text);
     throw new Error("Server Error");
   }
   return res.json();
 })
 .then(data => {
   if(data.success){
     location.reload();
   }
 })
 .catch(err => {
   console.error("Fetch error:", err);
 });
}
</script>

</body>
</html>