<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Detail_Pesanan;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class CustomerController extends Controller
{

   public function index(Request $request, $meja)
{
    $query = Produk::where('is_available', true);

    // 🔍 SEARCH
    if ($request->q) {
        $query->where('nama_produk', 'like', '%' . $request->q . '%');
    }

    // 📂 FILTER KATEGORI
    if ($request->kategori) {
        $query->where('kategori', $request->kategori);
    }

    $menus = $query->get();

    // 🔥 BEST SELLER MINGGU INI
    $bestSellerIds = \App\Models\Detail_Pesanan::where('created_at', '>=', Carbon::now()->subDays(7))
        ->select('produk_id')
        ->selectRaw('SUM(qty) as total_qty')
        ->groupBy('produk_id')
        ->orderByDesc('total_qty')
        ->limit(5)
        ->pluck('produk_id');

    $bestSellers = Produk::whereIn('id', $bestSellerIds)->get();

    $cart = session()->get('cart', []);

    return view('customer.dashboard', [
        'menus' => $menus,
        'bestSellers' => $bestSellers,
        'nomor_meja' => $meja,
        'cart' => $cart
    ]);
}

    public function addToCart(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);

        $cart = session()->get('cart', []);

        if(isset($cart[$produk->id])){
            $cart[$produk->id]['qty']++;
        } else {
            $cart[$produk->id] = [
                'produk_id' => $produk->id,
                'nama' => $produk->nama_produk,
                'harga' => $produk->harga,
                'qty' => 1
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success','Produk ditambahkan');
    }

    public function removeCart($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back();
    }

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

        $pesanan = Pesanan::create([
            'kode_pesanan' => 'PSN-'.Str::random(6),
            'nama_pelanggan' => $request->nama_pelanggan,
            'nomor_meja' => $request->nomor_meja,
            'total_harga' => $total,
            'status' => 'pending_payment',
            'metode_pembayaran' =>  $request->metode_pembayaran,
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

        $metode = $request->metode_pembayaran;

        // ================= CASH =================
        if($metode == 'cash'){

            $pesanan->update([
                'status' => 'pending_payment'
            ]);
             Transaksi::create([
            'pesanan_id' => $pesanan->id,
            'total_bayar' => $pesanan->total_harga,
            'status' => 'pending'
        ]);
            session()->forget('cart');

            return back()->with('success','Pembayaran cash berhasil');
        }

        // ================= ONLINE (XENDIT) =================
        Configuration::setXenditKey(config('services.xendit.secret_key'));

        $apiInstance = new InvoiceApi();

        $createInvoiceRequest = new CreateInvoiceRequest([
            'external_id' => $pesanan->kode_pesanan,
            'description' => 'Pembayaran '.$pesanan->kode_pesanan,
            'amount' => $pesanan->total_harga,
            'success_redirect_url' => url('/payment-success?meja='.$request->nomor_meja),
            'failure_redirect_url' => url('/payment-failed')
        ]);

        $invoice = $apiInstance->createInvoice($createInvoiceRequest);

        Transaksi::create([
            'pesanan_id' => $pesanan->id,
            'invoice_id' => $invoice['id'],
            'external_id' => $pesanan->kode_pesanan,
            'total_bayar' => $pesanan->total_harga,
            'status' => 'pending'
        ]);

        session()->forget('cart');

        return redirect($invoice['invoice_url']);
    }

    public function success(Request $request)
{
    $meja = $request->meja;

    return view('customer.success', compact('meja'));
}

     public function failed(Request $request)
{
    $meja = $request->meja;

    return view('customer.failed', compact('meja'));
}
}