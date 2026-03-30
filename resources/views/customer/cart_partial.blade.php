<h3>Keranjang</h3>

@php 
$cart = session('cart', []);
$total = 0; 
@endphp

@forelse($cart as $item)

<div class="cart-item">

<div>
{{ $item['nama'] }} <br>
<small>x{{ $item['qty'] }}</small>
</div>

<div>
<button class="qty-btn" onclick="updateCart({{ $item['produk_id'] }},'minus')">-</button>
<button class="qty-btn" onclick="updateCart({{ $item['produk_id'] }},'plus')">+</button>
<button onclick="deleteCart({{ $item['produk_id'] }})">❌</button>
</div>

<div>
Rp {{ number_format($item['harga'] * $item['qty']) }}
</div>

</div>

@php $total += $item['harga'] * $item['qty']; @endphp

@empty
<p>Keranjang kosong</p>
@endforelse

<div class="total">
Total: Rp {{ number_format($total) }}
</div>

<form action="{{ route('customer.checkout') }}" method="POST">
@csrf
<input type="hidden" name="nomor_meja" value="{{ $nomor_meja }}">
<input type="text" name="nama_pelanggan" placeholder="Nama Pemesan" required>
<button style="margin-top:15px;">Checkout</button>
</form>