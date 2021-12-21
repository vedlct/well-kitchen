<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

Auth::routes();

//Register
Route::group(['as'=>'Register.'], function(){
    Route::get('user-register',[UserController::class, 'register'])->name('index');
    Route::post('user-register',[UserController::class, 'registerInsert'])->name('insert');
    Route::get('otp-index',[UserController::class, 'OtpIndex'])->name('otp.index');
    Route::post('otp-submit',[UserController::class, 'verifyOtp'])->name('otp.submit');
    Route::post('otp-resend',[UserController::class, 'OtpResend'])->name('otp.resend');
});

//Login
Route::group(['as'=>'Login.'], function(){
    Route::post('normal-login',[LoginController::class, 'NormalLogin'])->name('normal');
    Route::post('otp-login',[LoginController::class, 'OtpLogin'])->name('otp');
    Route::get('forgot-password',[LoginController::class, 'ForgotPassword'])->name('forgotPassword');
    Route::post('forgot-password',[LoginController::class, 'ForgotPasswordSubmit'])->name('forgotPasswordSubmit');
    Route::get('new-password',[LoginController::class, 'NewPasswordForm'])->name('newPassword');
    Route::post('new-password',[LoginController::class, 'NewPasswordSubmit'])->name('passwordSave');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/offers', [HomeController::class, 'offers'])->name('offers');
Route::get('/offers/product/{id}', [HomeController::class, 'offersProduct'])->name('offers.product');
// Route::get('/product-details/{id}', [HomeController::class, 'productDetails'])->name('product.details');
Route::get('/categories/{categoryId?}', [CategoryController::class, 'categoryProducts'])->name('category.products');
Route::get('/feature/all/products', [CategoryController::class, 'featureviewAll'])->name('feature.viewAll');
Route::post('filter/products',[CategoryController::class,'filterProducts'])->name('filter.products');
Route::post('filter-price/products',[CategoryController::class,'filterProductsPrice'])->name('price.filter');

Route::get('/cart',[HomeController::class,'cartIndex'])->name('cart');
Route::get('/checkout' ,[HomeController::class,'index'])->name('checkout.index');

Route::post('add-to-cart',[HomeController::class,'addToCart'])->name('product.addTocart');
Route::post('cart-remove',[HomeController::class,'removeItem'])->name('product.cartRemove');
Route::post('cart-update-quantity',[HomeController::class,'updateQuantity'])->name('product.cartUpdateQuantity');
Route::post('quick-view',[HomeController::class,'quickView'])->name('product.quickView');



//product
Route::get('product-details/{slug?}', [ProductController::class, 'productDetails'])->name('product.details');
//Route::get('product-details/{id}', [ProductController::class, 'productDetails'])->name('product.details');
Route::post('variation/color/choose',[ProductController::class,'colorChoose'])->name('color.choose');
Route::get('compare/{skuId}',[ProductController::class,'compare'])->name('product.compare');
Route::post('compare/search',[ProductController::class,'compareSearch'])->name('product.compareSearch');


//Search
// Route::post('password/email' ,[ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');


Route::post('/search-category-product' ,[CategoryController::class,'searchByProducts'])->name('search.product');

    Route::get('wish-list',[WishlistController::class,'index'])->name('wishlist');
    // Route::get('add-to-wishlist/{id}',[WishlistController::class,'AddToWishlist'])->name('wishlistAdd');
    Route::post('add-to-wishlist',[WishlistController::class,'AddToWishlist'])->name('wishlistAdd');
    Route::get('remove-wishlist/{id}',[WishlistController::class,'RemoveItem'])->name('wishlistRemove');


    Route::get('page/{id}',[PageController::class,'index'])->name('page');

    Route::post('review-submit',[ReviewController::class,'ReviewSubmit'])->name('review.submit')->middleware('auth');

    Route::get('/checkout' ,[CheckoutController::class,'index'])->name('checkout.index')->middleware('auth');
    Route::post('checkout-submit',[CheckoutController::class,'checkoutSubmit'])->name('checkout.submit');

    Route::post('order/shippingZone',[CheckoutController::class,'shippingZone'])->name('shippingZone.change');




    //coupon

    Route::post('coupon-submit',[CuponController::class,'couponSubmit'])->name('coupon.submit');
    Route::post('promo-submit',[CuponController::class,'promoSubmit'])->name('promo.submit');


    Route::get('autocomplete',[CheckoutController::class,'autocomplete']);
    Route::post('search-user',[CheckoutController::class,'searchUserByPhone'])->name('search.user');


    Route::get('my-order',[MyOrderController::class,'index'])->name('myOrder')->middleware('auth');





Route::get('/my-account', [MyProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/user-info-update', [MyProfileController::class, 'updateUserInfo'])->name('userinfo.update')->middleware('auth');
Route::post('/user-address-update', [MyProfileController::class, 'updateAddressInfo'])->name('address.update')->middleware('auth');
Route::post('/user-password-update', [MyProfileController::class, 'updatePassword'])->name('profile.password.update')->middleware('auth');




Route::get('/faq', function () {
    return view('faq');
});





Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-submit', [ContactController::class, 'submitContactInfo'])->name('contact.submit');

Route::get('/about', function () {
    return view('about');
});

Route::post('email-subscription',[SubscriptionController::class,'subscribe'])->name('subscription');



