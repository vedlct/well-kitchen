<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CuponController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/product-details/{id}', [HomeController::class, 'productDetails'])->name('product.details');
Route::get('/categories/{categoryId?}', [CategoryController::class, 'categoryProducts'])->name('category.products');
Route::post('filter/products',[CategoryController::class,'filterProducts'])->name('filter.products');

Route::get('/cart',[HomeController::class,'cartIndex'])->name('cart');
Route::get('/checkout' ,[HomeController::class,'index'])->name('checkout.index');

Route::post('add-to-cart',[HomeController::class,'addToCart'])->name('product.addTocart');
Route::post('cart-remove',[HomeController::class,'removeItem'])->name('product.cartRemove');
Route::post('cart-update-quantity',[HomeController::class,'updateQuantity'])->name('product.cartUpdateQuantity');


//product
Route::get('product-details/{id}', [ProductController::class, 'productDetails'])->name('product.details');
Route::post('variation/color/choose',[ProductController::class,'colorChoose'])->name('color.choose');


//Search
Route::post('/search-category-product' ,[CategoryController::class,'searchByProducts'])->name('search.product');

    Route::get('wish-list',[WishlistController::class,'index'])->name('wishlist');
    // Route::get('add-to-wishlist/{id}',[WishlistController::class,'AddToWishlist'])->name('wishlistAdd');
    Route::post('add-to-wishlist',[WishlistController::class,'AddToWishlist'])->name('wishlistAdd');
    Route::get('remove-wishlist/{id}',[WishlistController::class,'RemoveItem'])->name('wishlistRemove');


    Route::get('page/{id}',[PageController::class,'index'])->name('page');

    Route::post('review-submit',[ReviewController::class,'ReviewSubmit'])->name('review.submit');

    Route::get('/checkout' ,[CheckoutController::class,'index'])->name('checkout.index');
    Route::post('checkout-submit',[CheckoutController::class,'checkoutSubmit'])->name('checkout.submit');

    Route::post('order/shippingZone',[CheckoutController::class,'shippingZone'])->name('shippingZone.change');




    //coupon
    Route::post('coupon-submit',[CuponController::class,'couponSubmit'])->name('coupon.submit');


    Route::get('autocomplete',[CheckoutController::class,'autocomplete']);
    Route::post('search-user',[CheckoutController::class,'searchUserByPhone'])->name('search.user');




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



