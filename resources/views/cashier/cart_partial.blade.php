<h3 style="margin-bottom:10px;">🛒 Keranjang</h3>

@php 
 $cart = session('cart', []);
 $total = 0;
@endphp

@forelse($cart as $item)

<div class="card" style="
margin-bottom:8px;
padding:10px;
display:flex;
justify-content:space-between;
align-items:center;
border-radius:8px;
">

<!-- INFO -->
<div style="flex:1;">
<div style="font-size:13px;font-weight:bold;">
{{ $item['nama'] }}
</div>
<div style="font-size:11px;color:#555;">
{{ $item['qty'] }} x Rp {{ number_format($item['harga']) }}
</div>
</div>

<!-- BUTTON -->
<div style="display:flex;gap:4px;margin:0 8px;">
<button onclick="updateCart({{ $item['produk_id'] }},'minus')" style="padding:4px 7px;">-</button>
<button onclick="updateCart({{ $item['produk_id'] }},'plus')" style="padding:4px 7px;">+</button>
<button onclick="deleteCart({{ $item['produk_id'] }})" style="padding:4px 7px;background:var(--accent);">x</button>
</div>

<!-- SUBTOTAL -->
<div style="font-size:12px;font-weight:bold;">
Rp {{ number_format($item['harga'] * $item['qty']) }}
</div>

</div>

@php $total += $item['harga'] * $item['qty']; @endphp

@empty
<div class="card" style="text-align:center;padding:15px;border-radius:8px;">
Keranjang kosong
</div>
@endforelse

<hr style="margin:12px 0;">

<!-- TOTAL -->
<div class="card" style="
padding:12px;
font-weight:bold;
font-size:14px;
display:flex;
justify-content:space-between;
border-radius:8px;
background:#f9f9f9;
">
<span>Total</span>
<span>Rp {{ number_format($total) }}</span>
</div>

<!-- METODE -->
<div class="card" style="margin-top:10px;padding:10px;border-radius:8px;">
<select id="metode" style="width:100%;padding:8px;border-radius:6px;">
    <option value="cash">💵 Cash</option>
    <option value="debit">💳 Debit</option>
    <option value="ewallet">📱 E-Wallet</option>
</select>
</div>

<!-- CASH -->
<div id="cash-area" class="card" style="margin-top:10px;padding:10px;border-radius:8px;">

<input type="number" id="bayar" placeholder="Uang bayar" style="margin-bottom:6px;border-radius:6px;">

<input type="text" id="kembalian" readonly placeholder="Kembalian" 
style="background:#f0f0f0;border-radius:6px;">

</div>

<!-- FORM -->
<form method="POST" action="{{ route('cashier.checkout') }}" class="card" style="margin-top:10px;padding:12px;border-radius:8px;">
@csrf

<input type="hidden" name="bayar" id="bayar_fix">
<input type="hidden" name="kembalian" id="kembalian_fix">
<input type="hidden" name="metode_pembayaran" id="metode_fix">

<input type="text" name="nama_pelanggan" placeholder="Nama pelanggan" required style="margin-bottom:8px;border-radius:6px;">

<select name="nomor_meja" required style="margin-bottom:8px;border-radius:6px;">
<option value="">Pilih Meja</option>
@foreach($meja as $m)
<option value="{{ $m->nomor_meja }}">
Meja {{ $m->nomor_meja }}
</option>
@endforeach
</select>

<button style="
padding:10px;
font-size:13px;
border-radius:6px;
background:var(--primary);
">
Checkout
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