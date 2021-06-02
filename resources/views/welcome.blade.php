@extends('layouts.layout')
@section('container')

    <!-- banner slider start -->
    <div class="slider-area">
        <div class="slider-active owl-carousel nav-style-1 owl-dot-none">
            <div class="single-slider-2 slider-height-20 d-flex align-items-center slider-height-res bg-img" style="background-image:url(public/assets/img/slider/slider-20-1.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-content-20 slider-animated-1">
                                <h3 class="animated">Hurry Up</h3>
                                <h1 class="animated">Get 50% Offer</h1>
                                <p class="animated">All Electronic Products & Instrument For This Summer.</p>
                                <div class="slider-btn slider-btn-round btn-hover">
                                    <a class="animated" href="shop.html">SHOP NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider-2 slider-height-20 d-flex align-items-center slider-height-res bg-img" style="background-image:url(public/assets/img/slider/slider-20-1.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-content-20 slider-animated-1">
                                <h3 class="animated">Hurry Up</h3>
                                <h1 class="animated">Get 50% Offer</h1>
                                <p class="animated">All Electronic Products & Instrument For This Summer.</p>
                                <div class="slider-btn slider-btn-round btn-hover">
                                    <a class="animated" href="shop.html">SHOP NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="slider-area">
        <div class="container">
            <div class="slider-active-3 owl-carousel slider-hm8 owl-dot-style">
                <div class="slider-height-6 d-flex align-items-center justify-content-center bg-img" style="background-image:url(assets/img/slider/slider-6.jpg);">
                    <div class="slider-content-5 slider-animated-1 text-center">
                        <h3 class="animated">New Arrival</h3>
                        <h1 class="animated">Final Sale</h1>
                        <p class="animated">30% off Summer Vacation</p>
                    </div>
                </div>
                <div class="slider-height-6 d-flex align-items-center justify-content-center bg-img" style="background-image:url(assets/img/slider/slider-6-1.jpg);">
                    <div class="slider-content-5 slider-animated-1 text-center">
                        <h3 class="animated">New Arrival</h3>
                        <h1 class="animated">Final Sale</h1>
                        <p class="animated">30% off Summer Vacation</p>
                    </div>
                </div>
                <div class="slider-height-6 d-flex align-items-center justify-content-center bg-img" style="background-image:url(assets/img/slider/slider-6-2.jpg);">
                    <div class="slider-content-5 slider-animated-1 text-center">
                        <h3 class="animated">New Arrival</h3>
                        <h1 class="animated">Final Sale</h1>
                        <p class="animated">30% off Summer Vacation</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- banner slider end -->

    <!-- all categories mobile start -->
    <div class="collections-area pt-100 pb-95 d-md-none">
        <div class="container">
            <div class="section-title-3 mb-40">
                <h4>Our Product Categories ss</h4>
            </div>
            <!-- category buttons -->
            <div class="category-buttons">
                <ul class="row nav nav-tabs" id="nav-tab" role="tablist">
                    <li class="col-md-6 col-lg-3 col-6 mb-3">
                        <a class="active" href="./shop.html">
                            <div class="category-name">
                                <h4 class="mb-0">
                                    <span">Baby Care</span>
                                    <img src="assets/img/category-img.jpg" class="ml-3" alt="">
                                </h4>
                            </div>
                        </a>
                    </li>
                    <li class="col-md-6 col-lg-3 col-6 mb-3">
                        <a class="" href="./shop.html">
                            <div class="category-name">
                                <h4 class="mb-0">
                                    <span">Baby Care</span>
                                    <img src="assets/img/category-img.jpg" class="ml-3" alt="">
                                </h4>
                            </div>
                        </a>
                    </li>
                    <li class="col-md-6 col-lg-3 col-6 mb-3">
                        <a class="" href="./shop.html">
                            <div class="category-name">
                                <h4 class="mb-0">
                                    <span">Baby Care</span>
                                    <img src="assets/img/category-img.jpg" class="ml-3" alt="">
                                </h4>
                            </div>
                        </a>
                    </li>
                    <li class="col-md-6 col-lg-3 col-6 mb-3">
                        <a class="" href="./shop.html">
                            <div class="category-name">
                                <h4 class="mb-0">
                                    <span">Baby Care</span>
                                    <img src="assets/img/category-img.jpg" class="ml-3" alt="">
                                </h4>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
    <!-- all categories mobile end -->

    <!-- all categories tab and desktop start -->
    <div class="collections-area pt-100 pb-95 d-none d-md-block">
        <div class="container">
            <div class="section-title-3 mb-40">
                <h4>Our Product Categories </h4>
            </div>
            <!-- category buttons -->
            <div class="category-buttons">
                <ul class="row nav nav-tabs" id="nav-tab" role="tablist">
                    <li class="col-md-6 col-lg-3 col-6 mb-3">
                        <a class="active" id="cat1-tab" data-toggle="tab" href="#cat1" role="tab" aria-selected="true">
                            <div class="category-name">
                                <h4 class="mb-0">
                                    <span">Baby Care </span>
                                    <img src="{{asset('public/assets/img/category-img.jpg')}}" class="ml-3" alt="">
                                </h4>
                            </div>
                        </a>
                    </li>
                    <li class="col-md-6 col-lg-3 col-6 mb-3">
                        <a class="" id="cat2-tab" data-toggle="tab" href="#cat2" role="tab" aria-selected="true">
                            <div class="category-name">
                                <h4 class="mb-0">
                                    <span">Baby Care</span>
                                    <img src="{{asset('public/assets/img/category-img.jpg')}}" class="ml-3" alt="">
                                </h4>
                            </div>
                        </a>
                    </li>
                    <li class="col-md-6 col-lg-3 col-6 mb-3">
                        <a class="" id="cat3-tab" data-toggle="tab" href="#cat3" role="tab" aria-selected="true">
                            <div class="category-name">
                                <h4 class="mb-0">
                                    <span">Baby Care</span>
                                    <img src="{{asset('public/assets/img/category-img.jpg')}}" class="ml-3" alt="">
                                </h4>
                            </div>
                        </a>
                    </li>
                    <li class="col-md-6 col-lg-3 col-6 mb-3">
                        <a class="" id="cat4-tab" data-toggle="tab" href="#cat4" role="tab" aria-selected="true">
                            <div class="category-name">
                                <h4 class="mb-0">
                                    <span">Baby Care</span>
                                    <img src="{{asset('public/assets/img/category-img.jpg')}}" class="ml-3" alt="">
                                </h4>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- category img show -->
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="cat1" role="tabpanel">
                    <div class="product-slider-active-2 owl-carousel owl-dot-none">
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-9.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                    <span class="old">৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-11.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-12.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                    <span class="old">৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="cat2" role="tabpanel">
                    <div class="product-slider-active-2 owl-carousel owl-dot-none">
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-9.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                    <span class="old">৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-11.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-12.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                    <span class="old">৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="cat3" role="tabpanel" aria-labelledby="cat3-tab">
                    <div class="product-slider-active-2 owl-carousel owl-dot-none">
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-9.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                    <span class="old">৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-11.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-12.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                    <span class="old">৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="cat4" role="tabpanel" aria-labelledby="cat4-tab">
                    <!-- <div class="collection-wrap">
                        <div class="collection-active owl-carousel owl-dot-none">
                            <div class="collection-product">
                                <div class="collection-img">
                                    <a href="./shop.html"><img src="assets/img/product/hm8-pro-1.jpg" alt=""></a>
                                </div>
                                <div class="collection-content text-center">
                                    <span>Baby Care</span>
                                    <h4><a href="./shop.html">Product title here</a></h4>
                                </div>
                            </div>
                            <div class="collection-product">
                                <div class="collection-img">
                                    <a href="./shop.html"><img src="assets/img/product/hm8-pro-2.jpg" alt=""></a>
                                </div>
                                <div class="collection-content text-center">
                                    <span>Baby Care</span>
                                    <h4><a href="./shop.html">Product title here</a></h4>
                                </div>
                            </div>
                            <div class="collection-product">
                                <div class="collection-img">
                                    <a href="./shop.html"><img src="assets/img/product/hm8-pro-3.jpg" alt=""></a>
                                </div>
                                <div class="collection-content text-center">
                                    <span>Baby Care</span>
                                    <h4><a href="./shop.html">Product title here</a></h4>
                                </div>
                            </div>
                            <div class="collection-product">
                                <div class="collection-img">
                                    <a href="./shop.html"><img src="assets/img/product/hm8-pro-4.jpg" alt=""></a>
                                </div>
                                <div class="collection-content text-center">
                                    <span>Baby Care</span>
                                    <h4><a href="./shop.html">Product title here</a></h4>
                                </div>
                            </div>
                            <div class="collection-product">
                                <div class="collection-img">
                                    <a href="./shop.html"><img src="assets/img/product/hm8-pro-2.jpg" alt=""></a>
                                </div>
                                <div class="collection-content text-center">
                                    <span>Baby Care</span>
                                    <h4><a href="./shop.html">Product title here</a></h4>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="product-slider-active-2 owl-carousel owl-dot-none">
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-9.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                    <span class="old">৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-11.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-12.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                    <span class="old">৳  60.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap mb-25">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                                </a>
                                <div class="product-action">
                                    <div class="pro-same-action pro-wishlist">
                                        <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-same-action pro-cart">
                                        <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                                    </div>
                                    <div class="pro-same-action pro-quickview">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h3><a href="product-details.html">Product Title Here</a></h3>
                                <div class="product-price">
                                    <span>৳  60.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            
        </div>
    </div>
    <!-- all categories tab and desktop end -->

    <!-- banner start -->
    <div class="banner-area pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="single-banner mb-30">
                        <a href="product-details.html"><img src="{{asset('public/assets/img/banner/banner-70.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="single-banner mb-30">
                        <a href="product-details.html"><img src="{{asset('public/assets/img/banner/banner-71.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->

    <!-- product area start -->
    <div class="product-area pb-70">
        <div class="container">
            <div class="tab-filter-wrap mb-60">
                <div class="product-tab-list-2 nav">
                    <a class="active" href="#product-1" data-toggle="tab" >
                        <h4>New Arrivals </h4>
                    </a>
                    <a href="#product-2" data-toggle="tab">
                        <h4>Best Selling Products </h4>
                    </a>
                    <a href="#product-3" data-toggle="tab">
                        <h4>Featured Product</h4>
                    </a>
                </div>
            </div>
            <div class="tab-content jump">
                <div class="tab-pane active" id="product-1">
                    <div class="row">
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-5.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  60.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-6.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-10%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  40.00</span>
                                        <span class="old">৳  500.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-7.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  70.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-8.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-20%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  60.00</span>
                                        <span class="old">৳  80.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-9.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  80.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-10.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-30%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  40.00</span>
                                        <span class="old">৳  70.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-11.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  90.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-12.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-20%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  70.00</span>
                                        <span class="old">৳  90.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="product-2">
                    <div class="row">
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-12.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  60.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-11.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-10%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  40.00</span>
                                        <span class="old">৳  500.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-10.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  70.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-9.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-20%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  60.00</span>
                                        <span class="old">৳  80.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-8.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  80.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-7.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-30%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  40.00</span>
                                        <span class="old">৳  70.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-6.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  90.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-5.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-20%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  70.00</span>
                                        <span class="old">৳  90.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="product-3">
                    <div class="row">
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-10.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  60.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-9.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-10%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  40.00</span>
                                        <span class="old">৳  500.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-8.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  70.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-7.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-20%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  60.00</span>
                                        <span class="old">৳  80.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-6.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  80.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-5.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-30%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  40.00</span>
                                        <span class="old">৳  70.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-12.jpg')}}" alt="">
                                    </a>
                                    <span class="purple">New</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  90.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <div class="product-wrap-5 mb-25">
                                <div class="product-img">
                                    <a href="product-details.html">
                                        <img src="{{asset('public/assets/img/product/hm8-pro-11.jpg')}}" alt="">
                                    </a>
                                    <span class="pink">-20%</span>
                                    <div class="product-action-4">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-5 text-center">
                                    <h3><a href="product-details.html">Product Title Here</a></h3>
                                    <div class="price-5">
                                        <span>৳  70.00</span>
                                        <span class="old">৳  90.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product area end -->

    <!-- single product start -->
    <div class="product-area pb-70">
        <div class="container">
            <div class="section-title-6 mb-45 text-center">
                <h2>Furniture</h2>
            </div>
            <div class="product-slider-active-2 owl-carousel owl-dot-none">
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-9.jpg')}}" alt="">
                        </a>
                        <span class="purple">Stock Out</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                        </a>
                        <span class="pink">-10%</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                            <span class="old">৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-11.jpg')}}" alt="">
                        </a>
                        <span class="purple">New</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-12.jpg')}}" alt="">
                        </a>
                        <span class="pink">-10%</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                            <span class="old">৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                        </a>
                        <span class="purple">New</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="./shop.html" class="btn btn-secondary">View All Products</a>
            </div>
        </div>
    </div>
    <!-- single product end -->

     <!-- single product start -->
     <div class="product-area pb-70">
        <div class="container">
            <div class="section-title-6 mb-45 text-center">
                <h2>Home Appliances</h2>
            </div>
            <div class="product-slider-active-2 owl-carousel owl-dot-none">
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-9.jpg')}}" alt="">
                        </a>
                        <span class="purple">New</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                        </a>
                        <span class="pink">-10%</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                            <span class="old">৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-11.jpg')}}" alt="">
                        </a>
                        <span class="purple">New</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-12.jpg')}}" alt="">
                        </a>
                        <span class="pink">-10%</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                            <span class="old">৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                        </a>
                        <span class="purple">New</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="./shop.html" class="btn btn-secondary">View All Products</a>
            </div>
        </div>
    </div>
    <!-- single product end -->

    <!-- offer product start -->
    <div class="product-area pb-70">
        <div class="container">
            <div class="section-title-6 mb-45 text-center">
                <h2>Special Offers</h2>
            </div>
            <div class="product-slider-active-2 owl-carousel owl-dot-none">
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-9.jpg')}}" alt="">
                        </a>
                        <span class="purple">-50%</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                            <span class="old">৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                        </a>
                        <span class="pink">-10%</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                            <span class="old">৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-11.jpg')}}" alt="">
                        </a>
                        <span class="purple">-50%</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                            <span class="old">৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-12.jpg')}}" alt="">
                        </a>
                        <span class="pink">-10%</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                            <span class="old">৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                        </a>
                        <span class="purple">-50%</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                            <span class="old">৳  60.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offer product end -->

    <!-- testimonial start -->
    <div class="testimonial-area bg-img pt-100 pb-95" style="background-image:url(assets/img/bg/section-bg-3.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 ml-auto mr-auto">
                    <div class="testimonial-active owl-carousel nav-style-1 nav-testi-style owl-dot-none">
                        <div class="single-testimonial text-center">
                            <img src="{{asset('public/assets/img/testimonial/testi-1.png')}}" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            <div class="client-info">
                                <i class="fa fa-map-signs"></i>
                                <h5>Grace Alvarado</h5>
                                <span>Customer</span>
                            </div>
                        </div>
                        <div class="single-testimonial text-center">
                            <img src="{{asset('public/assets/img/testimonial/testi-1.png')}}" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            <div class="client-info">
                                <i class="fa fa-map-signs"></i>
                                <h5>Grace Alvarado</h5>
                                <span>Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial end -->

    <!-- top view product start -->
    <div class="product-area mt-50 pb-70">
        <div class="container">
            <div class="section-title-6 mb-45 text-center">
                <h2>Most View Products</h2>
            </div>
            <div class="product-slider-active-2 owl-carousel owl-dot-none">
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-9.jpg')}}" alt="">
                        </a>
                        <span class="purple">New</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                        </a>
                        <span class="pink">-10%</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                            <span class="old">৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-11.jpg')}}" alt="">
                        </a>
                        <span class="purple">New</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-12.jpg')}}" alt="">
                        </a>
                        <span class="pink">-10%</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                            <span class="old">৳  60.00</span>
                        </div>
                    </div>
                </div>
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="product-details.html">
                            <img class="default-img" src="{{asset('public/assets/img/product/hm29-pro-10.jpg')}}" alt="">
                        </a>
                        <span class="purple">New</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="product-details.html">Product Title Here</a></h3>
                        <div class="product-price">
                            <span>৳  60.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top view product end -->

    <!-- subscribe area start -->
    <div class="subscribe-area-3 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 ml-auto mr-auto">
                    <div class="subscribe-style-3 text-center">
                        <h2>Subscribe </h2>
                        <p>Subscribe to our newsletter to receive news on update</p>
                        <div id="mc_embed_signup" class="subscribe-form-3 mt-35">
                            <form id="mc-embedded-subscribe-form" class="validate" novalidate="" target="_blank" name="subscribe-form" method="post" action="">
                                <div id="mc_embed_signup_scroll" class="mc-form">
                                    <input class="email" type="email" required="" placeholder="Your Email Address" name="EMAIL" value="">
                                    <div class="mc-news" aria-hidden="true">
                                        <input type="text" value="" tabindex="-1" name="subscribe">
                                    </div>
                                    <div class="clear-3">
                                        <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value="Subscribe">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- subscribe area end -->

    @endsection