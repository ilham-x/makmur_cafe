<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Meja;
use App\Models\Pesanan;
use App\Models\Detail_Pesanan;
use Illuminate\Support\Str;

class CashierController extends Controller
{
    public function index()
    {
        $anjlok = Produk::all();
        $meja = Meja::all();

        $pesanans = Pesanan::with('detail.produk')
                    ->orderBy('created_at','desc')
                    ->get();

        return view("cashier.dashboard", compact("anjlok","meja","pesanans"));
    }

    // ================= CART =================

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->produk_id;

        if(isset($cart[$id])){
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                "produk_id" => $id,
                "nama" => $request->nama,
                "harga" => $request->harga,
                "qty" => 1
            ];
        }

        session()->put('cart', $cart);

        return back();
    }

  public function updateCart(Request $request)
{
    try {
        $cart = session()->get('cart', []);

        if(isset($cart[$request->produk_id])){
            $cart[$request->produk_id]['qty'] += $request->type == 'plus' ? 1 : -1;

            if($cart[$request->produk_id]['qty'] <= 0){
                unset($cart[$request->produk_id]);
            }
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function deleteCart(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->produk_id]);
        session()->put('cart', $cart);

        return response()->json(['success'=>true]);
    }

    // ================= STATUS =================

    public function updateStatus(Request $request, $id)
{
    $pesanan = Pesanan::findOrFail($id);

    $pesanan->update([
        'status' => $request->status
    ]);

    return back();
}
    // ================= BAYAR =================

    public function bayar(Request $request, $id)
{
    $pesanan = Pesanan::findOrFail($id);

    // kalau cash
    if($pesanan->metode_pembayaran == 'cash'){

        $bayar = $request->bayar;
        $kembalian = $bayar - $pesanan->total_harga;

        if($kembalian < 0){
            return back()->with('error','Uang kurang');
        }

    }

    // non-cash langsung lolos
    $pesanan->update([
        'status' => 'dibayar'
    ]);

    return back()->with('success','Pembayaran berhasil');
}
    // ================= STRUK =================

    public function struk($id)
    {
        $pesanan = Pesanan::with('detail.produk')->findOrFail($id);
        return view('struk', compact('pesanan'));
    }
   public function checkout(Request $request)
{
    $cart = session('cart');

    if(!$cart){
        return back()->with('error','Cart kosong');
    }
   
    $total = 0;
    foreach($cart as $item){
        $total += $item['harga'] * $item['qty'];
    }
    
    $pesanan = Pesanan::create([
        'kode_pesanan' => 'PSN-'.Str::random(6),
        'nama_pelanggan' => $request->nama_pelanggan,
        'nomor_meja' => $request->nomor_meja,
        'total_harga' => $total,
        'status' => 'pending_payment',
        'metode_pembayaran' => $request->metode_pembayaran
    ]);

    foreach($cart as $item){
        Detail_Pesanan::create([
            'pesanan_id' => $pesanan->id,
            'produk_id' => $item['produk_id'],
            'qty' => $item['qty'],
            'harga' => $item['harga'],
            'subtotal' => $item['harga'] * $item['qty']
        ]);
    }

    session()->forget('cart');

    return back()->with('success','Pesanan dibuat');
}

}