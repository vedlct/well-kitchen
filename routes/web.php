<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product-details/{id}', [HomeController::class, 'productDetails'])->name('product.details');


Route::get('/wishlist', function () {
    return view('wishlist');
});

Route::get('/shop', function () {
    return view('shop');
});

Route::get('/my-order', function () {
    return view('myOrder');
});

Route::get('/my-account', function () {
    return view('myAccount');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/checkout', function () {
    return view('checkout');
});
