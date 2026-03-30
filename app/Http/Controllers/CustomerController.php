<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Detail_Pesanan;
use Illuminate\Support\Str;

use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class CustomerController extends Controller
{

    public function index($meja)
    {
        $menus = Produk::where('is_available', true)->get();
        $cart = session()->get('cart', []);

        return view('customer.dashboard', [
            'menus' => $menus,
            'nomor_meja' => $meja,
            'cart' => $cart
        ]);
    }

    /*
    | ADD TO CART
    */

    public function addToCart(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);

        $cart = session()->get('cart', []);

        if(isset($cart[$produk->id])){
            $cart[$produk->id]['qty'] += 1;
        }else{
            $cart[$produk->id] = [
                'produk_id' => $produk->id,
                'nama' => $produk->nama_produk,
                'harga' => $produk->harga,
                'qty' => 1
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success','Produk ditambahkan ke keranjang');
    }

    /*
    | REMOVE CART
    */

    public function removeCart($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with('success','Produk dihapus');
    }

    /*
    | CHECKOUT
    */

    public function checkout(Request $request)
    {

        $cart = session()->get('cart');

        if(!$cart){
            return back()->with('error','Keranjang kosong');
        }

        $total = 0;

        foreach($cart as $item){
            $total += $item['harga'] * $item['qty'];
        }

        /*
        | BUAT PESANAN
        */

        $pesanan = Pesanan::create([
            'kode_pesanan' => 'PSN-'.Str::random(6),
            'nama_pelanggan' => $request->nama_pelanggan,
            'nomor_meja' => $request->nomor_meja,
            'total_harga' => $total,
            'status' => 'pending_payment'
        ]);

        /*
        | DETAIL PESANAN
        */

        foreach($cart as $item){

            Detail_Pesanan::create([
                'pesanan_id' => $pesanan->id,
                'produk_id' => $item['produk_id'],
                'qty' => $item['qty'],
                'harga' => $item['harga'],
                'subtotal' => $item['harga'] * $item['qty']
            ]);

        }

        /*
        | HAPUS CART
        */

        session()->forget('cart');

        /*
        | XENDIT PAYMENT
        */

        Configuration::setXenditKey(config('services.xendit.secret_key'));

$apiInstance = new InvoiceApi();

$createInvoiceRequest = new CreateInvoiceRequest([
    'external_id' => $pesanan->kode_pesanan,
    'description' => 'Pembayaran '.$pesanan->kode_pesanan,
    'amount' => $pesanan->total_harga,
    'success_redirect_url' => url('/payment-success'),
    'failure_redirect_url' => url('/payment-failed')
]);

$invoice = $apiInstance->createInvoice($createInvoiceRequest);

/*
| SIMPAN KE TABEL TRANSAKSI
*/

Transaksi::create([
    'pesanan_id' => $pesanan->id,
    'invoice_id' => $invoice['id'],
    'external_id' => $pesanan->kode_pesanan,
    'total_bayar' => $pesanan->total_harga,
    'status' => 'pending'
]);

return redirect($invoice['invoice_url']);
    }

    /*
    | WEBHOOK
    */

    public function webhook(Request $request)
{

    $kode = $request->external_id;

    $pesanan = Pesanan::where('kode_pesanan',$kode)->first();

    if(!$pesanan){
        return response()->json(['message'=>'Pesanan tidak ditemukan'],404);
    }

    $transaksi = Transaksi::where('external_id',$kode)->first();

    if($request->status == 'PAID'){

        $pesanan->update([
            'status' => 'dibayar'
        ]);

        if($transaksi){
            $transaksi->update([
                'status' => 'paid'
            ]);
        }

    }

    return response()->json(['success'=>true]);
} 
    

    /*
    | SUCCESS PAGE
    */

    public function success()
    {
        return view('customer.success');
    }

    /*
    | FAILED PAGE
    */

    public function failed()
    {
        return view('customer.failed');
    }
}