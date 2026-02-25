<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
Route::get('/', function () {
    return view('welcome');
});
Route::get("/customer",[App\Http\Controllers\CustomerController::class,"index"]);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get("/cashier",[App\Http\Controllers\CashierController::class,"index"]);
});

Route::prefix('admin')
->middleware(['auth','role:admin'])
->name('admin.')
->group(function(){

    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');

    Route::resource('produk',ProdukController::class);
    Route::resource('meja',MejaController::class);
    Route::resource('kasir',UserController::class);
    Route::resource('transaksi',TransaksiController::class);

});
require __DIR__.'/auth.php';
