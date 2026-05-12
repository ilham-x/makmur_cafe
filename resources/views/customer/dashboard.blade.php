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
 --primary-dark:#009e88;
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
 margin-bottom:15px;
 position:relative;
}

.search-box input{
 width:100%;
 padding:12px 45px 12px 15px;
 border:var(--border);
 border-radius:var(--radius);
 box-shadow:var(--shadow);
 font-weight:bold;
 background:#fff;
 transition:0.25s ease;
}

.search-box::after{
 content:"🔍";
 position:absolute;
 right:15px;
 top:50%;
 transform:translateY(-50%);
 font-size:16px;
 pointer-events:none;
}

.search-box input:hover{
 transform:translate(-2px,-2px);
 box-shadow:8px 8px 0 #000;
}

.search-box input:focus{
 outline:none;
 background:#fefae0;
 transform:scale(1.02);
 box-shadow:10px 10px 0 #000;
}

.search-box input::placeholder{
 transition:0.3s;
}

.search-box input:focus::placeholder{
 opacity:0.5;
 transform:translateX(5px);
}

/* FILTER BOX */
.filter-box{
 background:linear-gradient(135deg, #ffffff 70%, #ffe8d6);
 padding:14px;
 border:var(--border);
 border-radius:var(--radius);
 box-shadow:var(--shadow);
 margin-bottom:15px;
 position:relative;
 transition:0.2s;
}

.filter-box:hover{
 transform:translate(-3px,-3px);
 box-shadow:10px 10px 0 #000;
}

.filter-box::before{
 content:"📂 Pilih Kategori";
 position:absolute;
 top:-10px;
 left:12px;
 background:var(--secondary);
 padding:3px 10px;
 font-size:11px;
 font-weight:bold;
 border:2px solid #000;
 border-radius:8px;
 box-shadow:2px 2px 0 #000;
}

.filter-box select{
 width:100%;
 padding:12px 40px 12px 12px;
 border:var(--border);
 border-radius:10px;
 font-weight:bold;
 background:#fff;
 cursor:pointer;
 appearance:none; 
 -webkit-appearance:none;
 -moz-appearance:none;
 transition:0.2s;
}

.filter-box::after{
 content:"⬇";
 position:absolute;
 right:20px;
 top:50%;
 transform:translateY(-50%);
 font-size:14px;
 pointer-events:none;
}

.filter-box select:hover{
 transform:translate(-2px,-2px);
 box-shadow:6px 6px 0 #000;
}

.filter-box select:focus{
 outline:none;
 background:#fefae0;
 box-shadow:8px 8px 0 #000;
}

.filter-box select option{
 font-weight:bold;
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

.card img{
 width:100%;
 height:120px;
 object-fit:cover;
 border:var(--border);
 border-radius:10px;
 margin-bottom:8px;
}

.card h3{
 margin:5px 0;
 font-size:14px;
}

.card p{
 margin:4px 0;
 font-weight:bold;
 font-size:13px;
}

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

/* CART */
.cart{
 background:linear-gradient(135deg, #ffffff 70%, #ffe8d6);
 border:3px solid #000;
 border-radius:16px;
 padding:15px;
 box-shadow:6px 6px 0 #000;
 position:sticky;
 top:20px;
 display:flex;
 flex-direction:column;
 gap:10px;
 max-height:420px;
}

.cart-items{
 overflow-y:auto;
 max-height:300px;
}

/* SCROLLBAR */
.cart-items::-webkit-scrollbar{
 width:6px;
}
.cart-items::-webkit-scrollbar-thumb{
 background:#000;
}

/* ITEM */
.cart-item{
 background:#fff;
 border:2px solid #000;
 border-radius:12px;
 padding:10px;
 box-shadow:3px 3px 0 #000;
 transition:0.2s;
}

.cart-item:hover{
 transform:translate(-2px,-2px);
 box-shadow:6px 6px 0 #000;
}

.total{
 font-weight:bold;
 margin-top:10px;
}

input, select{
 width:100%;
 padding:8px;
 border:var(--border);
 border-radius:10px;
 margin-top:8px;
 box-shadow:var(--shadow);
}

.section-title{
 display:inline-block;
 background:rgba(255,255,255,0.85);
 backdrop-filter: blur(4px);
 padding:8px 14px;
 border:3px solid #000;
 border-radius:12px;
 box-shadow:4px 4px 0 #000;
 font-weight:bold;
 margin-bottom:10px;
 transition:0.2s;
}

.section-title:hover{
 transform:translate(-2px,-2px);
 box-shadow:6px 6px 0 #000;
}

.cart-row{
 display:flex;
 justify-content:space-between;
 align-items:center;
 gap:10px;
 margin-bottom:8px;
}

.cart-name{
 max-width:60%;
 word-wrap:break-word;
}

.cart-price{
 font-weight:bold;
 color:#ff3d71;
}

.cart-actions{
 display:flex;
 align-items:center;
 gap:8px;
 margin-top:5px;
}

.cart-qty{
 min-width:25px;
 text-align:center;
 font-weight:bold;
 background:#fff;
 border:2px solid #000;
 border-radius:6px;
 padding:4px 6px;
}

.btn-minus{ background:#ff7a00; }
.btn-plus{ background:#00c2a8; }
.btn-delete{ background:#ff3d71; color:#fff; }

.btn-minus,
.btn-plus,
.btn-delete{
 border:2px solid #000;
 border-radius:6px;
 padding:4px 6px;
 cursor:pointer;
 transition:0.15s;
}

.btn-minus:hover,
.btn-plus:hover,
.btn-delete:hover{
 transform:translate(-2px,-2px);
 box-shadow:4px 4px 0 #000;
}

/* =========================================
   MODAL POPUP (REVAMPED)
   ========================================= */
.modal-overlay {
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.6);
    display: flex;
    justify-content: center;
    align-items: center; /* CENTER VERTICALLY */
    z-index: 2000;
    opacity: 0;
    pointer-events: none;
    transition: 0.3s;
    backdrop-filter: blur(4px);
}

.modal-overlay.active {
    opacity: 1;
    pointer-events: all;
}

.modal-box {
    background: #fff;
    border: var(--border);
    border-radius: var(--radius);
    box-shadow: 10px 10px 0 #000;
    padding: 30px;
    max-width: 400px;
    width: 90%;
    text-align: center;
    transform: scale(0.8);
    transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.modal-overlay.active .modal-box {
    transform: scale(1);
}

/* --- VIEW 1: KONFIRMASI --- */
.modal-icon-lg {
    font-size: 50px;
    margin-bottom: 15px;
    display: block;
    animation: bounce 2s infinite;
}

.modal-title {
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 10px;
    color: var(--dark);
}

.modal-desc {
    margin-bottom: 25px;
    font-size: 14px;
    color: #555;
    line-height: 1.6;
}

.modal-actions {
    display: flex;
    flex-direction: column; 
    gap: 12px;
}

.btn-modal {
    padding: 12px;
    border: var(--border);
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: var(--shadow);
    transition: 0.2s;
    text-decoration: none;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 16px;
}

.btn-confirm {
    background: var(--primary);
    color: white;
}

.btn-cancel {
    background: #fff;
    color: var(--dark);
}

.btn-modal:hover {
    transform: translate(-2px,-2px);
    box-shadow: 6px 6px 0 #000;
}

/* --- VIEW 2: NOTIFIKASI SUKSES (Hidden by default) --- */
.view-notification {
    display: none; /* Hidden */
    text-align: center;
}

/* Animasi untuk ikon Sukses */
.success-icon {
    font-size: 60px;
    margin-bottom: 20px;
    display: inline-block;
    background: #d1fae5;
    width: 100px;
    height: 100px;
    line-height: 100px;
    border-radius: 50%;
    border: var(--border);
    box-shadow: 4px 4px 0 #000;
    animation: popIn 0.5s ease forwards;
}

.success-text-main {
    font-size: 20px;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 10px;
}

.success-text-sub {
    font-size: 14px;
    color: #555;
    margin-bottom: 20px;
}

.highlight-cashier {
    color: var(--secondary);
    font-weight: bold;
    font-size: 16px;
    display: block;
    margin-top: 5px;
    background: #fffbeb;
    padding: 5px 10px;
    border: 2px dashed var(--secondary);
    border-radius: 8px;
    display: inline-block;
}

/* Loading Bar */
.progress-container {
    width: 100%;
    height: 8px;
    background: #eee;
    border-radius: 4px;
    overflow: hidden;
    border: 2px solid #000;
    margin-top: 15px;
}

.progress-bar {
    height: 100%;
    background: var(--primary);
    width: 0%;
    transition: width 2s linear;
}

/* Animations */
@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
    40% {transform: translateY(-10px);}
    60% {transform: translateY(-5px);}
}

@keyframes popIn {
    0% { transform: scale(0); opacity: 0; }
    70% { transform: scale(1.1); }
    100% { transform: scale(1); opacity: 1; }
}

/* Mobile Fixes */
@media(max-width:768px){
 .grid{grid-template-columns:1fr;}
 .header{flex-direction:column;}
 h1{text-align:center;}
 .cart{max-height:none;}
 .cart-items{overflow:visible; max-height:none;}
 .footer-container{ grid-template-columns:1fr; gap: 30px; }
}

/* =========================================
   FOOTER REVAMP (NEO-BRUTALIST STYLE)
   ========================================= */
.footer{
 margin-top:60px;
 background:#fff;
 border-top:var(--border);
 position: relative;
 z-index: 2;
 padding-bottom: 0;
}

.footer-container{
 max-width:1200px;
 margin:auto;
 display:grid;
 grid-template-columns: 1.5fr 1fr 1fr 1.5fr;
 gap:25px;
 padding:40px 20px;
}

/* Footer Headings */
.footer h2, .footer h4 {
 margin:0 0 15px;
 font-family:Arial, sans-serif;
}

/* Brand Section */
.footer-brand h2 {
 background: var(--dark);
 color: var(--light);
 display: inline-block;
 padding: 8px 15px;
 border-radius: 10px;
 box-shadow: 4px 4px 0 var(--secondary);
}

.footer-brand p {
 font-size:14px;
 line-height: 1.6;
 color:#333;
 margin-bottom: 15px;
}

.social {
 display:flex;
 gap:10px;
}

.social a {
 width:40px;
 height:40px;
 border-radius:50%;
 display:flex;
 align-items:center;
 justify-content:center;
 color:#fff;
 font-size:16px;
 text-decoration:none;
 border: 2px solid #000;
 box-shadow: 3px 3px 0 #000;
 transition:0.2s;
}

.social a:hover {
 transform: translate(-2px, -2px);
 box-shadow: 5px 5px 0 #000;
}

.wa{ background:#25D366; }
.ig{ background:linear-gradient(45deg,#f9ce34,#ee2a7b,#6228d7); }

/* Hours Section */
.footer-section-title {
 background: var(--secondary);
 color: #fff;
 display: inline-block;
 padding: 5px 12px;
 border: 2px solid #000;
 border-radius: 8px;
 font-weight: bold;
 font-size: 14px;
 margin-bottom: 15px;
 box-shadow: 3px 3px 0 #000;
}

.hours {
 display:flex;
 flex-direction:column;
 gap:8px;
}

.hours div {
 display:flex;
 justify-content:space-between;
 align-items:center;
 padding:8px 12px;
 border:2px solid #000;
 border-radius:10px;
 background:#fff;
 font-size:13px;
 font-weight:bold;
 transition:0.2s;
 box-shadow: 2px 2px 0 rgba(0,0,0,0.1);
}

.hours div:hover {
 transform: translate(-1px, -1px);
 box-shadow: 4px 4px 0 #000;
}

.hours div.today{
 background:var(--primary);
 color:#fff;
 transform:translate(-2px,-2px);
 box-shadow:4px 4px 0 #000;
}

/* Status Box */
#statusBuka {
 margin-top:15px;
 padding:10px;
 border:2px solid #000;
 border-radius:10px;
 font-weight:bold;
 text-align:center;
 background:#fff;
 box-shadow: 3px 3px 0 #000;
 font-size: 14px;
 transition:0.3s;
}

#statusBuka.open{
 background:var(--primary);
 color:#fff;
 box-shadow: 4px 4px 0 #000;
 transform: scale(1.02);
}

#statusBuka.closed{
 background:var(--accent);
 color:#fff;
 box-shadow: 4px 4px 0 #000;
}

/* Contact Section */
.footer-contact p {
 margin:10px 0;
 display:flex;
 gap:10px;
 align-items:center;
 font-size:14px;
 color:#333;
}

.footer-contact i {
 width:24px;
 height:24px;
 background:var(--bg);
 color:var(--dark);
 display:flex;
 align-items:center;
 justify-content:center;
 border: 2px solid #000;
 border-radius: 6px;
 font-size: 12px;
}

.btn-reservasi {
 margin-top:10px;
 padding:10px;
 width:100%;
 border:var(--border);
 border-radius:10px;
 background:var(--dark);
 color:#fff;
 font-weight:bold;
 cursor:pointer;
 box-shadow:4px 4px 0 var(--secondary);
 transition:0.2s;
}

.btn-reservasi:hover {
 transform:translate(-2px,-2px);
 box-shadow:6px 6px 0 var(--secondary);
 background:var(--secondary);
 color:#000;
}

/* Map Section - Style Frame */
.map-frame {
 border:var(--border);
 border-radius:var(--radius);
 box-shadow:var(--shadow);
 overflow:hidden;
 height: 100%;
 min-height: 200px;
 background: #eee;
}

.map-frame iframe {
 width:100%;
 height:100%;
 border:none;
 display:block;
}

/* Footer Bottom */
.footer-bottom {
 text-align:center;
 padding:15px;
 background:var(--bg);
 border-top:2px solid #000;
 font-size:12px;
 font-weight:bold;
 color:#555;
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
    <div class="search-input">
        <input type="text" name="q" placeholder="Cari menu..." value="{{ request('q') }}">
    </div>
</form>

<!-- FILTER -->
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

<h2 class="section-title">🔥 Best Seller Minggu Ini</h2>

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

<h2 class="section-title" style="margin-top:25px;">📋 Semua Menu</h2>

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

@php
 $id = $item['produk_id'] ?? $item['id'] ?? null;
@endphp

<div class="cart-item">

    <!-- TOP -->
    <div class="cart-row">
        <span class="cart-name">{{ $item['nama'] }}</span>
        <span class="cart-price">
            Rp {{ number_format($item['harga'] * $item['qty']) }}
        </span>
    </div>

    <!-- BOTTOM -->
    <div class="cart-actions">

        <!-- KURANG -->
        <form action="{{ route('cart.update') }}" method="POST">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $id }}">
        <input type="hidden" name="action" value="decrease">
        <button class="btn-minus">➖</button>
        </form>

        <!-- QTY -->
        <div class="cart-qty">
            {{ $item['qty'] }}
        </div>

        <!-- TAMBAH -->
        <form action="{{ route('cart.update') }}" method="POST">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $id }}">
        <input type="hidden" name="action" value="increase">
        <button class="btn-plus">➕</button>
        </form>

        <!-- HAPUS -->
        <form action="{{ route('cart.remove') }}" method="POST">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $id }}">
        <button class="btn-delete">🗑️</button>
        </form>

    </div>

</div>

@php $total += $item['harga'] * $item['qty']; @endphp

@empty
<p>Kosong</p>
@endforelse
</div>
<hr>

<div class="total">Total: Rp {{ number_format($total) }}</div>

<!-- FORM CHECKOUT DENGAN EVENT HANDLER -->
<form id="checkoutForm" action="{{ route('customer.checkout') }}" method="POST" onsubmit="handleCheckout(event)">
@csrf

<input type="hidden" name="nomor_meja" value="{{ $nomor_meja }}">
<input type="text" name="nama_pelanggan" placeholder="Nama Pemesan" required>

<select name="metode_pembayaran" required id="metodePembayaran">
<option value="">Pilih Pembayaran</option>
<option value="cash">Cash (Tunai)</option>
<option value="online">QRIS / Online</option>
</select>

<br>
<button type="submit">Checkout</button>

</form>

</div>

</div>

</div>

<!-- MODAL POPUP (MENGGUNAKAN 2 VIEW) -->
<div class="modal-overlay" id="cashModal">
    <div class="modal-box">
        
        <!-- VIEW 1: KONFIRMASI CASH -->
        <div id="viewConfirm">
            <span class="modal-icon-lg">💵</span>
            <h3 class="modal-title">Pembayaran Tunai?</h3>
            <p class="modal-desc">
                Pesanan Anda akan dikirim ke kasir. Silakan bawa uang tunai Anda ke meja kasir.
            </p>
            <div class="modal-actions">
                <button class="btn-modal btn-confirm" onclick="goToNotification()">Siap, Lanjutkan</button>
                <button class="btn-modal btn-cancel" onclick="closeModal()">Batal</button>
            </div>
        </div>

        <!-- VIEW 2: NOTIFIKASI SUKSES (MENARIK) -->
        <div id="viewNotification" class="view-notification">
            <div class="success-icon">🏃‍♂️</div>
            <h3 class="success-text-main">Pesanan Diterima!</h3>
            <p class="success-text-sub">
                Mohon segera menuju ke <span class="highlight-cashier">KASIR</span> untuk pembayaran.
            </p>
            <div class="progress-container">
                <div class="progress-bar" id="progressBar"></div>
            </div>
        </div>

    </div>
</div>

<!-- ICON -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<footer class="footer">

  <div class="footer-container">

    <!-- BRAND -->
    <div class="footer-brand">
      <h2>☕ Coffee Makmur</h2>
      <p>Nikmati kopi terbaik dengan suasana hangat dan nyaman setiap hari. Tempat nongkrong asik buat kamu dan teman-teman!</p>

      <div class="social">
        <a href="https://wa.me/6287723499891" target="_blank" class="wa"><i class="fab fa-whatsapp"></i></a>
        <a href="https://www.instagram.com/kopitokomakmur?igsh=MTBtNWU0ZndwY3hnaQ==" target="_blank" class="ig"><i class="fab fa-instagram"></i></a>
      </div>
    </div>

    <!-- JAM OPERASIONAL -->
    <div class="footer-hours">
      <span class="footer-section-title">🕒 Jam Buka</span>

      <div class="hours">
        <div data-day="1"><span>Senin - Kamis</span><b>10.00 - 22.00</b></div>
        <div data-day="5"><span>Jumat</span><b>10.00 - 00.00</b></div>
        <div data-day="6"><span>Sabtu</span><b>10.00 - 00.00</b></div>
        <div data-day="0"><span>Minggu</span><b>10.00 - 22.00</b></div>
      </div>

      <div id="statusBuka" class="status">Checking...</div>
    </div>

    <!-- KONTAK -->
    <div class="footer-contact">
      <span class="footer-section-title">📍 Kontak Kami</span>
      <p><i class="fas fa-map-marker-alt"></i> Jl. Waliwis No.2, Tanah Sareal, Bogor</p>
      <p><i class="fas fa-phone"></i> 0812-8430-3742</p>
      <p><i class="fas fa-envelope"></i> @Kopitokomakmur.id</p>

      <button class="btn-reservasi" onclick="keWA()">
  Reservasi Meja
</button>
    </div>

    <!-- MAP -->
    <div class="footer-map">
      <div class="map-frame">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4058730.4879689272!2d102.18446558750003!3d-6.571560499999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c500488daea7%3A0xad79791451fbcc34!2sKopi%20Toko%20Makmur!5e0!3m2!1sid!2sid!4v1777511120988!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>

  </div>

  <!-- BOTTOM -->
  <div class="footer-bottom">
    © 2026 Coffee Makmur — All Rights Reserved
  </div>

</footer>

<script>
// LOGIC JS TUTUP JAM (Tetap sama)
const now = new Date();
const day = now.getDay(); 
const hour = now.getHours();

const rows = document.querySelectorAll('.hours div');
const status = document.getElementById('statusBuka');

/* highlight hari */
rows.forEach(row => {
  const d = parseInt(row.getAttribute('data-day'));

  if(d === 1 && day >= 1 && day <= 4){
    row.classList.add('today');
  }
  else if(d === 5 && day === 5){
    row.classList.add('today');
  }
  else if(d === 6 && day === 6){
    row.classList.add('today');
  }
  else if(d === 0 && day === 0){
    row.classList.add('today');
  }
});

/* cek buka/tutup */
let buka = false;

if(day >= 1 && day <= 4){ 
  buka = (hour >= 10 && hour < 22);
}
else if(day === 5 || day === 6){ 
  buka = (hour >= 10 && hour < 24);
}
else if(day === 0){ 
  buka = (hour >= 10 && hour < 22);
}

if(buka){
  status.innerHTML = "🟢 Sedang Buka";
  status.classList.add("open");
}else{
  status.innerHTML = "🔴 Sudah Tutup";
  status.classList.add("closed");
}

// LOGIC WHATSAPP
function keWA() {
  window.open("https://api.whatsapp.com/send?phone=6287723499891&text=Saya%20ingin%20reservasi%20meja", "_blank");
}

// =========================================
// LOGIK MODAL CHECKOUT CASH (UPDATED)
// =========================================
const modal = document.getElementById('cashModal');
const form = document.getElementById('checkoutForm');
const viewConfirm = document.getElementById('viewConfirm');
const viewNotification = document.getElementById('viewNotification');
const progressBar = document.getElementById('progressBar');

function handleCheckout(event) {
    event.preventDefault();
    
    const metode = document.getElementById('metodePembayaran').value;
    
    if (metode === 'cash') {
        // Tampilkan Modal View 1
        viewConfirm.style.display = 'block';
        viewNotification.style.display = 'none';
        modal.classList.add('active');
    } 
    else {
        form.submit();
    }
}

function closeModal() {
    modal.classList.remove('active');
}

function goToNotification() {
    // Sembunyikan view konfirmasi, tampilkan view notifikasi
    viewConfirm.style.display = 'none';
    viewNotification.style.display = 'block';

    // Jalankan animasi progress bar
    setTimeout(() => {
        progressBar.style.width = '100%';
    }, 100);

    // Tunggu 2 detik (sesuai animasi), lalu submit form
    setTimeout(() => {
        form.submit();
    }, 2000);
}
</script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init();
</script>

</body>
</html>