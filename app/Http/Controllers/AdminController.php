<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $totalPendapatan = Transaksi::sum('total_bayar');

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

        

$raw = Transaksi::selectRaw(
        'DATE(created_at) as tanggal, SUM(total_bayar) as total'
    )
    ->where('created_at', '>=', Carbon::now()->subDays(6)) // ✅ 7 hari
    ->groupBy('tanggal')
    ->orderBy('tanggal', 'ASC')
    ->get()
    ->keyBy('tanggal');

// 🔥 generate 7 hari penuh
$pendapatanPerHari = collect();

for ($i = 6; $i >= 0; $i--) {
    $tanggal = Carbon::now()->subDays($i)->format('Y-m-d');

    $pendapatanPerHari->push([
        'tanggal' => Carbon::parse($tanggal)->format('d M'),
        'total' => $raw[$tanggal]->total ?? 0
    ]);
}


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