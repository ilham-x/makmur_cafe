<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('pesanan.meja')
            ->latest()
            ->paginate(10);

        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load('pesanan.produks','pesanan.meja');

        return view('admin.transaksi.show', compact('transaksi'));
    }

    public function create() {}
    public function store() {}
    public function edit() {}
    public function update() {}
    public function destroy() {}
}