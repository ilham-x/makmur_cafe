<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Cashier;
use App\Models\Produk;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ire = Auth::user();
        $anjlok=Produk::all();
        return view("cashier.dashboard",compact("ire","anjlok"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cashier $cashier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cashier $cashier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cashier $cashier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cashier $cashier)
    {
        //
    }
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
    $cart = session()->get('cart', []);

    if(isset($cart[$request->produk_id])){
        $cart[$request->produk_id]['qty'] += $request->type == 'plus' ? 1 : -1;

        if($cart[$request->produk_id]['qty'] <= 0){
            unset($cart[$request->produk_id]);
        }
    }

    session()->put('cart', $cart);

    return response()->json(['success'=>true]);
}
public function deleteCart(Request $request)
{
    $cart = session()->get('cart', []);
    unset($cart[$request->produk_id]);
    session()->put('cart', $cart);

    return response()->json(['success'=>true]);
}
}
