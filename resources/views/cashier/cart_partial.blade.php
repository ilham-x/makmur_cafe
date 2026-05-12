<h3 style="
margin-bottom:14px;
font-size:18px;
font-weight:900;
letter-spacing:1px;
text-transform:uppercase;
display:flex;
align-items:center;
gap:8px;
">
🛒 Keranjang
</h3>

@php 
 $cart = session('cart', []);
 $total = 0;
@endphp

@forelse($cart as $item)

<div class="cart-brutal-card" style="
margin-bottom:14px;
padding:14px;
display:flex;
justify-content:space-between;
align-items:center;
gap:12px;
border:3px solid #000;
border-radius:18px;
background:#fff;
box-shadow:6px 6px 0 #000;
transition:0.2s;
flex-wrap:wrap;
">

<!-- INFO -->
<div style="
flex:1;
min-width:140px;
">

<div style="
font-size:15px;
font-weight:900;
margin-bottom:6px;
color:#000;
text-transform:capitalize;
line-height:1.3;
">
{{ $item['nama'] }}
</div>

<div style="
display:inline-block;
padding:5px 10px;
background:#ffe082;
border:2px solid #000;
border-radius:10px;
font-size:11px;
font-weight:bold;
box-shadow:3px 3px 0 #000;
">
{{ $item['qty'] }} x Rp {{ number_format($item['harga']) }}
</div>

</div>

<!-- BUTTON -->
<div style="
display:flex;
align-items:center;
gap:6px;
">

<button 
onclick="updateCart({{ $item['produk_id'] }},'minus')" 
style="
width:34px;
height:34px;
border:none;
background:#ffb703;
border:2px solid #000;
border-radius:10px;
font-size:18px;
font-weight:bold;
cursor:pointer;
box-shadow:3px 3px 0 #000;
transition:0.15s;
">
-
</button>

<button 
onclick="updateCart({{ $item['produk_id'] }},'plus')" 
style="
width:34px;
height:34px;
border:none;
background:#80ed99;
border:2px solid #000;
border-radius:10px;
font-size:18px;
font-weight:bold;
cursor:pointer;
box-shadow:3px 3px 0 #000;
transition:0.15s;
">
+
</button>

<button 
onclick="deleteCart({{ $item['produk_id'] }})" 
style="
width:34px;
height:34px;
border:none;
background:#ff4d6d;
color:#fff;
border:2px solid #000;
border-radius:10px;
font-size:15px;
font-weight:bold;
cursor:pointer;
box-shadow:3px 3px 0 #000;
transition:0.15s;
">
✕
</button>

</div>

<!-- SUBTOTAL -->
<div style="
background:#000;
color:#fff;
padding:8px 12px;
border-radius:12px;
font-size:13px;
font-weight:900;
border:2px solid #000;
box-shadow:4px 4px 0 #ffde59;
min-width:120px;
text-align:center;
">
Rp {{ number_format($item['harga'] * $item['qty']) }}
</div>

</div>

@php $total += $item['harga'] * $item['qty']; @endphp

@empty

<div style="
text-align:center;
padding:24px;
border-radius:18px;
background:#fff;
border:3px dashed #000;
font-weight:bold;
box-shadow:6px 6px 0 #000;
font-size:14px;
">
Keranjang kosong
</div>

@endforelse

<hr style="
margin:18px 0;
border:none;
height:3px;
background:#000;
border-radius:20px;
">

<!-- TOTAL -->
<div style="
padding:16px;
font-weight:900;
font-size:15px;
display:flex;
justify-content:space-between;
align-items:center;
border-radius:18px;
background:#00e5ff;
border:3px solid #000;
box-shadow:7px 7px 0 #000;
margin-bottom:14px;
">

<span style="font-size:16px;">
💰 TOTAL
</span>

<span style="
background:#fff;
padding:7px 12px;
border-radius:12px;
border:2px solid #000;
box-shadow:3px 3px 0 #000;
">
Rp {{ number_format($total) }}
</span>

</div>

<!-- METODE -->
<div style="
margin-top:10px;
padding:14px;
border-radius:18px;
background:#fff;
border:3px solid #000;
box-shadow:6px 6px 0 #000;
">

<div style="
font-size:13px;
font-weight:900;
margin-bottom:8px;
text-transform:uppercase;
">
💳 Metode Pembayaran
</div>

<select id="metode" style="
width:100%;
padding:12px;
border-radius:12px;
border:3px solid #000;
font-weight:bold;
font-size:13px;
background:#f8f8f8;
outline:none;
">
    <option value="cash">💵 Cash</option>
    <option value="debit">💳 Debit</option>
    <option value="ewallet">📱 E-Wallet</option>
</select>

</div>

<!-- CASH -->
<div id="cash-area" style="
margin-top:14px;
padding:14px;
border-radius:18px;
background:#fff;
border:3px solid #000;
box-shadow:6px 6px 0 #000;
">

<div style="
font-size:13px;
font-weight:900;
margin-bottom:10px;
text-transform:uppercase;
">
💵 Pembayaran Cash
</div>

<input 
type="number" 
id="bayar" 
placeholder="Uang bayar" 
style="
margin-bottom:10px;
border-radius:12px;
border:3px solid #000;
padding:12px;
font-weight:bold;
background:#fff;
">

<input 
type="text" 
id="kembalian" 
readonly 
placeholder="Kembalian"
style="
background:#f1f1f1;
border-radius:12px;
border:3px solid #000;
padding:12px;
font-weight:bold;
">

</div>

<!-- FORM -->
<form 
method="POST" 
action="{{ route('cashier.checkout') }}" 
style="
margin-top:16px;
padding:16px;
border-radius:20px;
background:#fff;
border:3px solid #000;
box-shadow:7px 7px 0 #000;
">

@csrf

<input type="hidden" name="bayar" id="bayar_fix">
<input type="hidden" name="kembalian" id="kembalian_fix">
<input type="hidden" name="metode_pembayaran" id="metode_fix">

<div style="
font-size:14px;
font-weight:900;
margin-bottom:12px;
text-transform:uppercase;
">
📝 Data Pelanggan
</div>

<input 
type="text" 
name="nama_pelanggan" 
placeholder="Nama pelanggan" 
required 
style="
margin-bottom:12px;
border-radius:12px;
border:3px solid #000;
padding:12px;
font-weight:bold;
background:#fff;
">

<select 
name="nomor_meja" 
required 
style="
margin-bottom:14px;
border-radius:12px;
border:3px solid #000;
padding:12px;
font-weight:bold;
background:#fff;
">

<option value="">Pilih Meja</option>

@foreach($meja as $m)
<option value="{{ $m->nomor_meja }}">
Meja {{ $m->nomor_meja }}
</option>
@endforeach

</select>

<button style="
padding:13px;
font-size:14px;
font-weight:900;
border-radius:14px;
background:#80ed99;
border:3px solid #000;
box-shadow:5px 5px 0 #000;
cursor:pointer;
transition:0.2s;
text-transform:uppercase;
letter-spacing:1px;
">

🚀 Checkout Sekarang

</button>

</form>

<script>
let metode = document.getElementById('metode');
let cashArea = document.getElementById('cash-area');

document.getElementById('metode_fix').value = metode.value;

metode.addEventListener('change', function(){
    document.getElementById('metode_fix').value = this.value;

    if(this.value == 'cash'){
        cashArea.style.display = 'block';
    } else {
        cashArea.style.display = 'none';
    }
});

document.getElementById('bayar').addEventListener('input', function(){

 let total = {{ $total }};
 let bayar = this.value;

 let kembali = bayar - total;

 if(kembali >= 0){
    document.getElementById('kembalian').value = 'Rp ' + kembali.toLocaleString();      
    document.getElementById('bayar_fix').value = bayar;
    document.getElementById('kembalian_fix').value = kembali;
    } else {
    document.getElementById('kembalian').value = "Uang kurang";
 }

});
</script>