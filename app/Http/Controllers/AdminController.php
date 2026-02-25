<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIK UTAMA
        |--------------------------------------------------------------------------
        */

        // Total pendapatan dari transaksi
        $totalPendapatan = Transaksi::sum('jumlah_bayar');

        // Total transaksi
        $totalTransaksi = Transaksi::count();

        // Total pesanan
        $totalPesanan = Pesanan::count();

        // Total produk
        $totalProduk = Produk::count();


        /*
        |--------------------------------------------------------------------------
        | GRAFIK PENDAPATAN 7 HARI TERAKHIR
        |--------------------------------------------------------------------------
        */

        $pendapatanPerHari = Transaksi::selectRaw(
                'DATE(created_at) as tanggal, SUM(jumlah_bayar) as total'
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PRODUK TERLARIS
        |--------------------------------------------------------------------------
        */

        $produkTerlaris = Produk::withCount('pesanans')
            ->orderBy('pesanans_count', 'DESC')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | ULASAN TERBARU
        |--------------------------------------------------------------------------
        */

        $ulasanTerbaru = Ulasan::with('produk')
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(
            'totalPendapatan',
            'totalTransaksi',
            'totalPesanan',
            'totalProduk',
            'pendapatanPerHari',
            'produkTerlaris',
            'ulasanTerbaru'
        ));
    }
}