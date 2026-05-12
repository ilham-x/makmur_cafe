<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('welcome'); // kalau belum login
});

use App\Http\Controllers\CustomerController;
Route::get('/menu/{meja}',[CustomerController::class,'index'])->name("customer.menu");

Route::post('/cart/add',[CustomerController::class,'addToCart'])->name('customer.cart');

Route::post('/checkout',[CustomerController::class,'checkout'])->name('customer.checkout');

Route::post('/xendit/webhook',[CustomerController::class,'webhook']);
Route::post('/cart/update', [CustomerController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CustomerController::class, 'removeCartPost'])->name('cart.remove');
Route::get('/payment-success',[CustomerController::class,'success']);

Route::get('/payment-failed',[CustomerController::class,'failed']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get("/cashier",[App\Http\Controllers\CashierController::class,"index"])->name("cashier.dashboard");
    Route::post('/cashier/cart/add', [App\Http\Controllers\CashierController::class, 'addToCart'])
    ->name('cashier.cart.add');
    Route::put('/cart/update', [App\Http\Controllers\CashierController::class, 'updateCart'])->name('cashier.cart.update');
    Route::post('/cart/delete', [App\Http\Controllers\CashierController::class, 'deleteCart'])->name('cashier.cart.delete');
    Route::get('/export-pdf', [App\Http\Controllers\CashierController::class, 'exportPdf']);
    Route::post('/cashier/checkout', [App\Http\Controllers\CashierController::class, 'checkout'])->name('cashier.checkout');
    Route::get('/struk/{id}', [App\Http\Controllers\CashierController::class, 'struk'])->name('struk');
     Route::post('/cashier/bayar/{id}', [App\Http\Controllers\CashierController::class, 'bayar'])->name('cashier.bayar');
    Route::put('/cashier/updateStatus', [App\Http\Controllers\CashierController::class, 'updateStatus'])->name('cashier.updateStatus');
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
