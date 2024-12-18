<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/cart', function () {
    return 'Produk ditambahkan ke keranjang!';
})->name('cart.add');
