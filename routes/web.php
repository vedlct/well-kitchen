<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product-details/{id}', [HomeController::class, 'productDetails'])->name('product.details');
Route::get('/categories/{categoryId?}', [CategoryController::class, 'categoryProducts'])->name('category.products');

Route::get('/cart',[HomeController::class,'cartIndex'])->name('cart');
Route::get('/checkout' ,[HomeController::class,'index'])->name('checkout.index');

Route::post('add-to-cart',[HomeController::class,'addToCart'])->name('product.addTocart');
Route::post('cart-remove',[HomeController::class,'removeItem'])->name('product.cartRemove');
Route::post('cart-update-quantity',[HomeController::class,'updateQuantity'])->name('product.cartUpdateQuantity');

//Search
Route::post('/search-category-product' ,[CategoryController::class,'searchByProducts'])->name('search.product');

    Route::get('wish-list',[WishlistController::class,'index'])->name('wishlist');
    Route::get('add-to-wishlist/{id}',[WishlistController::class,'AddToWishlist'])->name('wishlistAdd');
    Route::get('remove-wishlist/{id}',[WishlistController::class,'RemoveItem'])->name('wishlistRemove');


Route::get('/wishlist', function () {
    return view('wishlist');
});

//Route::get('/shop', function () {
//    return view('shop');
//});

Route::get('/my-order', function () {
    return view('myOrder');
});

Route::get('/my-account', function () {
    return view('myAccount');
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



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
