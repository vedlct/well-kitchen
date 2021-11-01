@extends('layouts.layout')
@section('container')

<!-- banner slider start -->
<div class="slider-area">
    <div class="slider-active owl-carousel nav-style-1">
        @foreach ($sliders as $slider)
        <a href="{{$slider->pageLink}}">
            <div class="single-slider-2 slider-height-20 d-flex align-items-center slider-height-res bg-img"
                style="background-image:url('{{ 'admin/public/sliderImage/' . $slider->imageLink }}');">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-11">
                            <div class="slider-content-20 slider-animated-1">
                                <h3 class="animated">{{ $slider->titletext }}</h3>
                                <h1 class="animated">{{ $slider->subText }}</h1>
                                <p class="animated">{{ $slider->mainText }}</p>
                                {{-- <div class="slider-btn slider-btn-round btn-hover"> --}}
                                {{-- <a class="animated" href="shop.html">SHOP NOW</a> --}}
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>

<!-- all categories mobile start -->
<!-- <div class="collections-area pt-100 pb-95 d-md-none">
        <div class="container">
            <div class="section-title-3 mb-40">
                <h4>Our Product Categories</h4>
            </div> -->
<!-- category buttons -->
<!-- <div class="category-buttons">
                <ul class="row nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach ($categories as $key=>$category)
        <li class="col-md-6 col-lg-3 col-6 mb-3">
            <a class="{{$key == 0 ? 'active' : '' }}" href="{{route('category.products', $category->categoryId)}}">
                            <div class="category-name h-100">
                                <h4 class="mb-0">
                                    <span>{{$category->categoryName}}</span>
                                    <img src="{{asset('admin/public/categoryImage/'.$category->imageLink)}}" class="ml-3" alt="">
                                </h4>
                            </div>
                        </a>
                    </li>
                    @endforeach
        </ul>
    </div> -->



<!-- </div>
</div> -->
<!-- all categories mobile end -->

<!-- all categories tab and desktop start -->
<div class="collections-area pt-60 pb-80">
    <div class="container">
        <div class="section-title-3 mb-40">
            <h4>Our Product Categories </h4>
        </div>

        <div class="row">

            @foreach ($catgoriesFirstShow as $categoryFS)

            @if(count($categoryFS->products) > 0 && !empty($categoryFS->imageLink))
            <div class="col-img category_image banner-2">
                <a href="{{route('category.products', $categoryFS->categoryId)}}" style="">
                    <img class="default-img" src="{{ asset('admin/public/categoryImage/'.$categoryFS->imageLink) }}"
                        alt="">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">{{$categoryFS->categoryName}}
                    </p>
                </a>
            </div>
            @endif
            @endforeach

            {{--  <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/2" style=""><img src="https://babygleebd.com/admin/public/categoryImage/4770.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Boy Baby</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/3" style=""><img src="https://babygleebd.com/admin/public/categoryImage/5700.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Girl Baby</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/4" style=""><img src="https://babygleebd.com/admin/public/categoryImage/3346.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Baby Unisex</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/5" style=""><img src="https://babygleebd.com/admin/public/categoryImage/54.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Kids Shoes</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/6" style=""><img src="https://babygleebd.com/admin/public/categoryImage/7253.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Boy</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/7" style=""><img src="https://babygleebd.com/admin/public/categoryImage/4104.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Girl</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/8" style=""><img src="https://babygleebd.com/admin/public/categoryImage/770.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Socks</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/9" style=""><img src="https://babygleebd.com/admin/public/categoryImage/953.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Clothing</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/10" style=""><img src="https://babygleebd.com/admin/public/categoryImage/9786.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Baby Safety</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/11" style=""><img src="https://babygleebd.com/admin/public/categoryImage/4507.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Baby Feeding</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/12" style=""><img src="https://babygleebd.com/admin/public/categoryImage/3898.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Baby Care</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/13" style=""><img src="https://babygleebd.com/admin/public/categoryImage/7162.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Activity &amp; Gear</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/14" style=""><img src="https://babygleebd.com/admin/public/categoryImage/5334.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Boy</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/15" style=""><img src="https://babygleebd.com/admin/public/categoryImage/374.jpg">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Girl</p></a>
                </div>
                <div class="col-img category_image banner-2">
                    <a href="https://babygleebd.com/category/16" style=""><img src="https://babygleebd.com/admin/public/categoryImage/294.JPG">
                    <p style="text-align: center; margin-top: 12px; font-weight: 600;">Kids Unisex</p></a>
                </div>  --}}
        </div>

        <!-- category buttons -->
        <!-- <div class="category-buttons mb-4">
                <div class="category-name-slider nav" id="nav-tab" role="tablist">
                    @foreach ($categories as $key => $category)
            <a class="{{ $key == 0 ? 'active' : '' }} nav-link nav-items" id="cat1-tab{{ $category->categoryId }}" data-toggle="tab"
                            href="#cat{{ $category->categoryId }}" role="tab" aria-selected="false">
                            <div class="category-name">
                                <h4 class="mb-0">
                                    <span>{{ $category->categoryName }}
                <img src="{{ asset('admin/public/categoryImage/' . $category->imageLink) }}"
                                            class="ml-3" alt="">
                                    </span>
                                </h4>
                            </div>
                        </a>
                    @endforeach
            </div>
        </div> -->

        <!-- category img show -->
        <!-- <div class="tab-content" id="nav-tabContent">
                @foreach ($categories as $key => $category)
            @php
                $catSkus = App\Models\Sku::whereHas('product', function ($query) use ($category) {
                        $query->where('categoryId', $category->categoryId)->where('status', 'active');
                    })->take(15)->get()
            @endphp
                <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="cat{{ $category->categoryId }}"
                        role="tabpanel">
                        <div class="product-slider-active-2 owl-carousel owl-dot-none">
                            @foreach ($catSkus->unique('fkproductId') as $sku)
                {{-- @dd($sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->first()); --}}
                {{--  @if (!empty($sku->product->hotdealProducts))
                    @php
                        $hotDeal = $sku->product->hotdealProducts
                            ->where('hotdeals.status', 'Available')
                            ->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))
                            ->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))
                            ->where('hotdeals.percentage', '>', 0)
                            ->first()
                    @endphp
                @endif  --}}
                {{-- @dd($sku->product->newarrived); --}}
                @if (!empty($sku->product) && $sku->product->categoryId == $category->categoryId)
                    <div class="product-wrap mb-25">
                        <div class="product-img">
{{-- <a href="product-details.html"> --}}
                        <a href="{{ route('product.details', $sku->skuId) }}">
                                                <img class="default-img"
                                                    src="{{ asset('admin/public/featureImage/'.$sku->product->featureImage) }}"
                                                    alt="">
                                            </a>
                                            @if ($sku->product->newarrived == 1)
                                                <span class="purple">New</span>
                                            @endif

                                            @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                                            @if (!empty($hotDeal) && !empty($sku->discount))
                                            <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                                            @endif
                                            @if (!empty($hotDeal) && empty($sku->discount))
                                            <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                                            @endif

                                            @if(empty($hotDeal) && !empty($sku->discount))
                                            <span class="blue discount">-{{$sku->discount}}%</span>
                                        @endif

                                            {{--  @if (!empty($hotDeal))
                                                <span
                                                    class="blue discount">-{{ $hotDeal->hotdeals ? $hotDeal->hotdeals->percentage : '' }}%</span>
                                            @endif  --}}
                                            @if ($sku->product->isrecommended == 1)
                                                <span class="pink">Feature</span>
                                            @endif
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="javascript:void(0)"
                                    onclick="addToWishList({{ $sku->skuId }})"><i
                                                            class="pe-7s-like"></i></a>
                                                </div>
                                                <div class="pro-same-action pro-cart">
                                                    @if ($sku->product->type == 'single')
                                                    <a title="Add To Cart" href="javascript: void(0)"
                                                        onclick="addTocart({{ $sku->skuId }})"><i
                                                        class="pe-7s-cart"></i> Add to cart</a>
                                                    @endif
                    @if ($sku->product->type == 'variation')
                        <a title="Add To Cart"
                            href="{{ route('product.details', $sku->skuId) }}"><i
                                                                class="pe-7s-cart"></i> Add to cart</a>
                                                    @endif
                        </div>
                        <div class="pro-same-action pro-quickview">
                            <a href="#" data-toggle="modal" data-target="#exampleModal"
                                data-sku_id="{{ $sku->skuId }}" class="quickView"><i
                                                            class="pe-7s-look"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content text-center">
                                            <h3><a
                                                    href="{{ route('product.details', $sku->skuId) }}">{{ substr($sku->product->productName, 0, 16)."..." }}</a>
                                            </h3>
                                            <div class="product-price">
                                                {{-- <span>৳  {{$sku->salePrice}}</span> --}}
                                                @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                                                @if (empty($hotDeal) && empty($sku->discount))
                                                                    <span class="salePrice">৳ {{ $sku->regularPrice }} </span>
                                                                @endif

                                                                @if (!empty($hotDeal) && !empty($sku->discount))
                                                                    @php
                                                                        $percentage = $hotDeal->hotdeals->percentage;
                                                                        $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                                    @endphp

                                                                    <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                                    <span class="old">৳ {{ $sku->regularPrice }}</span>
                                                                @endif

                                                                @if (!empty($hotDeal) && empty($sku->discount))
                                                                    @php
                                                                        $percentage = $hotDeal->hotdeals->percentage;
                                                                        $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                                    @endphp

                                                                    <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                                    <span class="old">৳ {{ $sku->regularPrice }}</span>
                                                                @endif

                                                                @if(empty($hotDeal) && !empty($sku->discount))
                                                                @php
                                                                   $afterDiscountPrice = $sku->salePrice;
                                                                @endphp

                                                                <span class="salePrice">৳  {{$afterDiscountPrice}}</span>
                                                                <span class="old">৳  {{$sku->regularPrice}}</span>
                                                            @endif
                        </div>
                    </div>
                </div>
@endif
            @endforeach
                </div>
            </div>
@endforeach
            </div> -->
    </div>
</div>
<!-- all categories tab and desktop end -->

<!-- banner start -->
<div class="banner-area pb-50">
    <div class="container">
        <div class="row">

            @foreach ($banners as $item)

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="single-banner mb-30">
                    <a href="{{$item->pageLink}}"><img src="{{ asset('admin/public/bannerImage/' . $item->imageLink) }}"
                            alt=""></a>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</div>
<!-- banner end -->

<!-- new arrival start -->
<div class="product-area pb-70">
    <div class="container">
        <div class="section-title-6 mb-45 text-center">
            <h2>New Arrival</h2>
        </div>
        <div class="row">
            @foreach ($newArrivals->unique('fkproductId') as $sku)


                <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                    <div class="product-wrap-5 mb-25">
                        <div class="product-img">
                            <a href="{{ route('product.details', $sku->skuId) }}">
                                <img src="{{ asset('admin/public/featureImage/' . $sku->product->featureImage) }}"
                                    alt="">
                            </a>

                            @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                            @if (!empty($hotDeal) && !empty($sku->discount))
                            <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                            @endif
                            @if (!empty($hotDeal) && empty($sku->discount))
                            <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                            @endif

                            @if(empty($hotDeal) && !empty($sku->discount))
                            <span class="blue discount">-{{$sku->discount}}%</span>
                        @endif

                            @if ($sku->product->newarrived == 1)
                            <span class="purple">New</span>
                            @endif

                            <div class="product-action-4">
                                <div class="pro-same-action pro-wishlist">
                                    <a title="Wishlist" href="javascript:void(0)" onclick="addToWishList({{ $sku->skuId }})"><i
                                            class="pe-7s-like"></i></a>
                                </div>
                                <div class="pro-same-action pro-cart">
                                    @if ($sku->product->type == 'single')
                                    <a title="Add To Cart" href="javascript: void(0)"
                                        onclick="addTocart({{ $sku->skuId }})"><i class="pe-7s-cart"></i></a>
                                    @endif
                                    @if ($sku->product->type == 'variation')
                                    <a title="Add To Cart" href="{{ route('product.details', $sku->skuId) }}"><i
                                            class="pe-7s-cart"></i></a>
                                    @endif
                                </div>
                                <div class="pro-same-action pro-quickview">
                                    <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"
                                        data-sku_id="{{ $sku->skuId }}" class="quickView"><i class="pe-7s-look"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-5 text-center">
                            <h3><a
                                    href="{{ route('product.details', $sku->skuId) }}">{{ substr($sku->product->productName, 0, 16)."..." }}</a>
                            </h3>
                            <div class="price-5">
                                {{-- <span>৳  {{$sku->salePrice}}</span> --}}
                                @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                                                @if (empty($hotDeal) && empty($sku->discount))
                                                                    <span class="salePrice">৳ {{ $sku->regularPrice }} </span>
                                                                @endif

                                                                @if (!empty($hotDeal) && !empty($sku->discount))
                                                                    @php
                                                                        $percentage = $hotDeal->hotdeals->percentage;
                                                                        $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                                    @endphp

                                                                    <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                                    <span class="old">৳ {{ $sku->regularPrice }}</span>
                                                                @endif

                                                                @if (!empty($hotDeal) && empty($sku->discount))
                                                                    @php
                                                                        $percentage = $hotDeal->hotdeals->percentage;
                                                                        $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                                    @endphp

                                                                    <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                                    <span class="old">৳ {{ $sku->regularPrice }}</span>
                                                                @endif

                                                                @if(empty($hotDeal) && !empty($sku->discount))
                                                                @php
                                                                   $afterDiscountPrice = $sku->salePrice;
                                                                @endphp

                                                                <span class="salePrice">৳  {{$afterDiscountPrice}}</span>
                                                                <span class="old">৳  {{$sku->regularPrice}}</span>
                                                            @endif
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach


        </div>
    </div>
</div>
<!-- new arrival end -->

<!-- Offer Product -->
@if($offerSkus->count() > 0)
<div class="product-area mt-50 pb-70">
    <div class="container">
        <div class="section-title-6 mb-45 text-center">
            <h2>Offer Products</h2>
        </div>
        <div class="product-slider-active-2 owl-carousel owl-dot-none">
            @foreach ($offerSkus->unique('fkproductId') as $sku)


                @if (!empty($sku->product))
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="{{route('product.details',$sku->skuId)}}">
                            <img class="default-img"
                                src="{{asset('admin/public/featureImage/'.$sku->product->featureImage)}}" alt="">
                        </a>
                        @if($sku->product->newarrived == 1)
                        <span class="purple">New</span>
                        @endif
                        @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                        @if (!empty($hotDeal) && !empty($sku->discount))
                        <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                        @endif
                        @if (!empty($hotDeal) && empty($sku->discount))
                        <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                        @endif

                        @if(empty($hotDeal) && !empty($sku->discount))
                        <span class="blue discount">-{{$sku->discount}}%</span>
                    @endif


                        @if($sku->product->isrecommended == 1)
                        <span class="pink">Feature</span>
                        @endif
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="javascript:void(0)" onclick="addToWishList({{$sku->skuId}})"><i
                                        class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                @if($sku->product->type == "single")
                                <a title="Add To Cart" href="#" onclick="addTocart({{ $sku->skuId }})"><i
                                        class="pe-7s-cart"></i> Add to cart</a>
                                @endif
                                @if($sku->product->type == "variation")
                                <a title="Add To Cart" href="{{ route('product.details', $sku->skuId) }}"><i
                                        class="pe-7s-cart"></i> Add to cart</a>
                                @endif
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"
                                    data-sku_id="{{ $sku->skuId }}" class="quickView"><i class="pe-7s-look"></i></a>
                            </div>

                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3>
                            <a href="{{route('product.details',$sku->skuId)}}">{{ substr($sku->product->productName, 0, 16)."..." }}</a>
                        </h3>
                        <div class="product-price">

                            @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                            @if (empty($hotDeal) && empty($sku->discount))
                                                <span class="salePrice">৳ {{ $sku->regularPrice }} </span>
                                            @endif

                                            @if (!empty($hotDeal) && !empty($sku->discount))
                                                @php
                                                    $percentage = $hotDeal->hotdeals->percentage;
                                                    $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                @endphp

                                                <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                <span class="old">৳ {{ $sku->regularPrice }}</span>
                                            @endif

                                            @if (!empty($hotDeal) && empty($sku->discount))
                                                @php
                                                    $percentage = $hotDeal->hotdeals->percentage;
                                                    $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                @endphp

                                                <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                <span class="old">৳ {{ $sku->regularPrice }}</span>
                                            @endif

                                            @if(empty($hotDeal) && !empty($sku->discount))
                                            @php
                                               $afterDiscountPrice = $sku->salePrice;
                                            @endphp

                                            <span class="salePrice">৳  {{$afterDiscountPrice}}</span>
                                            <span class="old">৳  {{$sku->regularPrice}}</span>
                                        @endif
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
        </div>
    </div>
</div>
</div>
@endif
<!-- Offer Product -->

<!-- featured product start -->
<div class="product-area pb-70">
    <div class="container">
        <div class="section-title-6 mb-45 text-center">
            <h2>Featured Products</h2>
        </div>
        <div class="row">
            @foreach ($recommendeds->unique('fkproductId') as $sku)


                <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6">
                    <div class="product-wrap-5 mb-25">
                        <div class="product-img">
                            <a href="{{ route('product.details', $sku->skuId) }}">
                                <img src="{{ asset('admin/public/featureImage/' . $sku->product->featureImage) }}"
                                    alt="">
                            </a>

                            @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                            @if (!empty($hotDeal) && !empty($sku->discount))
                            <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                            @endif
                            @if (!empty($hotDeal) && empty($sku->discount))
                            <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                            @endif

                            @if(empty($hotDeal) && !empty($sku->discount))
                            <span class="blue discount">-{{$sku->discount}}%</span>
                        @endif


                            @if ($sku->product->isrecommended == 1)
                            <span class="pink">Feature</span>
                            @endif

                            {{-- @php
                            $userId = Auth::user()->userId;
                            $customer = App\Models\Customer::where('fkuserId', $userId)->pluck('customerId')->first();
                            // @dd($customer);
                            $wishlist = App\Models\Wishlist::where('fkcustomerId', $customer)->first();
                            // @dd($wishlist);
                        @endphp --}}
                            {{-- @dd(Auth::user()->userId); --}}

                            <div class="product-action-4">
                                <div class="pro-same-action pro-wishlist">
                                    {{-- <a title="Wishlist" href="{{route('wishlistAdd', $sku->skuId)}}"><i
                                        class="pe-7s-like"></i></a> --}}
                                    <a title="Wishlist" href="javascript:void(0)" onclick="addToWishList({{ $sku->skuId }})"><i
                                            class="pe-7s-like"></i></a>
                                </div>
                                <div class="pro-same-action pro-cart">
                                    @if ($sku->product->type == 'single')
                                    <a title="Add To Cart" href="javascript: void(0)"
                                        onclick="addTocart({{ $sku->skuId }})"><i class="pe-7s-cart"></i></a>
                                    @endif
                                    @if ($sku->product->type == 'variation')
                                    <a title="Add To Cart" href="{{ route('product.details', $sku->skuId) }}"><i
                                            class="pe-7s-cart"></i></a>
                                    @endif

                                </div>
                                <div class="pro-same-action pro-quickview">
                                    <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"
                                        data-sku_id="{{ $sku->skuId }}" class="quickView"><i class="pe-7s-look"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-5 text-center">
                            <h3><a
                                    href="{{ route('product.details', $sku->skuId) }}">{{ substr($sku->product->productName, 0, 16)."..." }}</a>
                            </h3>
                            <div class="price-5">
                                {{-- <span>৳  {{$sku->salePrice}}</span> --}}
                                @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                                @if (empty($hotDeal) && empty($sku->discount))
                                                    <span class="salePrice">৳ {{ $sku->regularPrice }} </span>
                                                @endif

                                                @if (!empty($hotDeal) && !empty($sku->discount))
                                                    @php
                                                        $percentage = $hotDeal->hotdeals->percentage;
                                                        $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                    @endphp

                                                    <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                    <span class="old">৳ {{ $sku->regularPrice }}</span>
                                                @endif

                                                @if (!empty($hotDeal) && empty($sku->discount))
                                                    @php
                                                        $percentage = $hotDeal->hotdeals->percentage;
                                                        $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                    @endphp

                                                    <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                    <span class="old">৳ {{ $sku->regularPrice }}</span>
                                                @endif

                                                @if(empty($hotDeal) && !empty($sku->discount))
                                                @php
                                                   $afterDiscountPrice = $sku->salePrice;
                                                @endphp

                                                <span class="salePrice">৳  {{$afterDiscountPrice}}</span>
                                                <span class="old">৳  {{$sku->regularPrice}}</span>
                                            @endif
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('feature.viewAll') }}" class="btn btn-secondary">View All
                Products</a>
        </div>
    </div>
</div>
<!-- featured product end -->

<!-- single product start -->
@foreach ($categories as $key => $category)

@if($category->products->count() > 0 )
@php
$catSkus = App\Models\Sku::whereHas('product', function ($query) use ($category) {
$query->where('categoryId', $category->categoryId)->where('status', 'active');
})->take(10)->get()
@endphp

{{-- remove carosal --}}

<div class="product-area pb-70">
    <div class="container">
        <div class="section-title-6 mb-45 text-center">
            <h2>{{ $category->categoryName }}</h2>
        </div>
        <div class="row">
            @foreach ($catSkus->unique('fkproductId') as $key => $sku)


                <div class="col-6 col-xl-3 col-md-6 col-lg-4 col-sm-6 {{ $key>3 ? 'd-none d-md-block' : '' }} ">
                    <div class="product-wrap-5 mb-25">
                        <div class="product-img">
                            <a href="{{ route('product.details', $sku->skuId) }}">
                                <img src="{{ asset('admin/public/featureImage/' . $sku->product->featureImage) }}"
                                    alt="">
                            </a>
                            @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                            @if (!empty($hotDeal) && !empty($sku->discount))
                            <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                            @endif
                            @if (!empty($hotDeal) && empty($sku->discount))
                            <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                            @endif

                            @if(empty($hotDeal) && !empty($sku->discount))
                            <span class="blue discount">-{{$sku->discount}}%</span>
                        @endif

                            @if ($sku->product->isrecommended == 1)
                            <span class="pink">Feature</span>
                            @endif

                            {{-- @php
                                    $userId = Auth::user()->userId;
                                    $customer = App\Models\Customer::where('fkuserId', $userId)->pluck('customerId')->first();
                                    // @dd($customer);
                                    $wishlist = App\Models\Wishlist::where('fkcustomerId', $customer)->first();
                                    // @dd($wishlist);

                                @endphp --}}
                            {{-- @dd(Auth::user()->userId); --}}

                            <div class="product-action-4">
                                <div class="pro-same-action pro-wishlist">
                                    {{-- <a title="Wishlist" href="{{route('wishlistAdd', $sku->skuId)}}"><i
                                        class="pe-7s-like"></i></a> --}}
                                    <a title="Wishlist" href="javascript:void(0)" onclick="addToWishList({{ $sku->skuId }})"><i
                                            class="pe-7s-like"></i></a>
                                </div>
                                <div class="pro-same-action pro-cart">
                                    @if ($sku->product->type == 'single')
                                    <a title="Add To Cart" href="javascript: void(0)"
                                        onclick="addTocart({{ $sku->skuId }})"><i class="pe-7s-cart"></i></a>
                                    @endif
                                    @if ($sku->product->type == 'variation')
                                    <a title="Add To Cart" href="{{ route('product.details', $sku->skuId) }}"><i
                                            class="pe-7s-cart"></i></a>
                                    @endif

                                </div>
                                <div class="pro-same-action pro-quickview">
                                    <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"
                                        data-sku_id="{{ $sku->skuId }}" class="quickView"><i class="pe-7s-look"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-5 text-center">
                            <h3><a
                                    href="{{ route('product.details', $sku->skuId) }}">{{ substr($sku->product->productName, 0, 16)."..." }}</a>
                            </h3>
                            <div class="price-5">
                                {{-- <span>৳  {{$sku->salePrice}}</span> --}}
                                @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                                @if (empty($hotDeal) && empty($sku->discount))
                                                    <span class="salePrice">৳ {{ $sku->regularPrice }} </span>
                                                @endif

                                                @if (!empty($hotDeal) && !empty($sku->discount))
                                                    @php
                                                        $percentage = $hotDeal->hotdeals->percentage;
                                                        $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                    @endphp

                                                    <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                    <span class="old">৳ {{ $sku->regularPrice }}</span>
                                                @endif

                                                @if (!empty($hotDeal) && empty($sku->discount))
                                                    @php
                                                        $percentage = $hotDeal->hotdeals->percentage;
                                                        $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                    @endphp

                                                    <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                    <span class="old">৳ {{ $sku->regularPrice }}</span>
                                                @endif

                                                @if(empty($hotDeal) && !empty($sku->discount))
                                                @php
                                                   $afterDiscountPrice = $sku->salePrice;
                                                @endphp

                                                <span class="salePrice">৳  {{$afterDiscountPrice}}</span>
                                                <span class="old">৳  {{$sku->regularPrice}}</span>
                                            @endif
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach


        </div>
        <div class="text-center">
            <a href="{{ route('category.products', $category->categoryId) }}" class="btn btn-secondary">View
                All
                Products</a>
        </div>
    </div>
</div>


{{-- <div class="product-area pb-70">
                <div class="container">
                    <div class="section-title-6 mb-45 text-center">
                        <h2>{{ $category->categoryName }}</h2>
</div>
<div class="product-slider-active-2 owl-carousel owl-dot-none owl-loaded owl-drag">
    <div class="owl-stage-outer">
        <div class="owl-stage"
            style="transform: translate3d(-1200px, 0px, 0px); transition: all 0s ease 0s; width: 3900px;">
            @foreach ($catSkus->unique('fkproductId') as $sku)
            @if (!empty($sku->product->hotdealProducts))
            @php
            $hotDeal = $sku->product->hotdealProducts
            ->where('hotdeals.status', 'Available')
            ->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s')) ->where('hotdeals.endDate', '>=', date('Y-m-d
                H:i:s'))
                ->where('hotdeals.percentage', '>', 0)
                ->first();
                @endphp
                @endif
                @if (!empty($sku->product) && $sku->product->categoryId == $category->categoryId)
                <div class="owl-item active" style="width: 270px; margin-right: 30px;">
                    <div class="product-wrap mb-25">
                        <div class="product-img">
                            <a href="{{ route('product.details', $sku->skuId) }}">
                                <img class="default-img"
                                    src="{{ asset('admin/public/featureImage/' . $sku->product->featureImage) }}"
                                    alt="">
                            </a>
                            @if ($sku->product->newarrived == 1)
                            <span class="purple">New</span>
                            @endif
                            @if (!empty($hotDeal))
                            <span
                                class="blue discount">-{{ $hotDeal->hotdeals ? $hotDeal->hotdeals->percentage : '' }}%</span>
                            @endif
                            @if ($sku->product->isrecommended == 1)
                            <span class="pink">Feature</span>
                            @endif
                            <div class="product-action">
                                <div class="pro-same-action pro-wishlist">
                                    <a title="Wishlist" href="#" onclick="addToWishList({{ $sku->skuId }})"><i
                                            class="pe-7s-like"></i></a>
                                </div>
                                <div class="pro-same-action pro-cart">
                                    @if ($sku->product->type == 'single')
                                    <a title="Add To Cart" href="javascript: void(0)"
                                        onclick="addTocart({{ $sku->skuId }})"><i class="pe-7s-cart"></i> Add to
                                        cart</a>
                                    @endif
                                    @if ($sku->product->type == 'variation')
                                    <a title="Add To Cart" href="{{ route('product.details', $sku->skuId) }}"><i
                                            class="pe-7s-cart"></i> Add to cart</a>
                                    @endif
                                </div>
                                <div class="pro-same-action pro-quickview">
                                    <a href="#" data-toggle="modal" data-target="#exampleModal"
                                        data-sku_id="{{ $sku->skuId }}" class="quickView"><i class="pe-7s-look"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content text-center">
                            <h3><a
                                    href="{{ route('product.details', $sku->skuId) }}">{{ $sku->product->productName }}</a>
                            </h3>
                            <div class="product-price">
                                @if (empty($hotDeal) && empty($sku->discount))
                                <span>৳ {{ $sku->salePrice }} </span>
                                @endif

                                @if (!empty($hotDeal) && !empty($sku->discount))
                                @php
                                $percentage = $hotDeal->hotdeals->percentage;
                                $afterDiscountPrice = $sku->salePrice - ($sku->salePrice * $percentage) / 100;
                                @endphp

                                <span>৳ {{ $afterDiscountPrice }}</span>
                                <span class="old">৳ {{ $sku->salePrice }}</span>
                                @endif

                                @if(empty($hotDeal) && !empty($sku->discount))
                                @php
                                $afterDiscountPrice = ($sku->salePrice) - ($sku->discount);
                                @endphp

                                <span>৳ {{$afterDiscountPrice}}</span>
                                <span class="old">৳ {{$sku->salePrice}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
        </div>
    </div>
    <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span
                aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span
                aria-label="Next">›</span></button></div>
    <div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button role="button"
            class="owl-dot"><span></span></button></div>
</div>
<div class="text-center">
    <a href="{{ route('category.products', $category->categoryId) }}" class="btn btn-secondary">View All
        Products</a>
</div>
</div>
</div> --}}

@endif
@endforeach
<!-- single product end -->



<!-- testimonial start -->
<div class="testimonial-area bg-img pt-100 pb-95"
    style="background-image:url({{ url('public/assets/img/bg/section-bg-3.png') }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 ml-auto mr-auto">
                <div class="testimonial-active owl-carousel nav-style-1 nav-testi-style owl-dot-none">
                    @foreach ($testimonials as $testimonial)
                    <div class="single-testimonial text-center">
                        <img src="{{ asset('admin/public/testimonialImage/' . $testimonial->imageLink) }}" alt="">
                        <p> {{ $testimonial->details }}</p>
                        <div class="client-info">
                            <i class="fa fa-map-signs"></i>
                            <h5>{{ $testimonial->name }}</h5>
                            <span>{{ $testimonial->designation }}</span>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
<!-- testimonial end -->





<!-- top view product start -->
@if($mostViewedProducts->count() > 0)
<div class="product-area mt-50 pb-70">
    <div class="container">
        <div class="section-title-6 mb-45 text-center">
            <h2>Hot Selling Products</h2>
        </div>
        <div class="product-slider-active-2 owl-carousel owl-dot-none">
            @foreach ($mostViewskus->unique('fkproductId') as $sku)


                @if (!empty($sku->product))
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="{{route('product.details',$sku->skuId)}}">
                            <img class="default-img"
                                src="{{asset('admin/public/featureImage/'.$sku->product->featureImage)}}" alt="">
                        </a>
                        @if($sku->product->newarrived == 1)
                        <span class="purple">New</span>
                        @endif

                        @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                            @if (!empty($hotDeal) && !empty($sku->discount))
                            <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                            @endif
                            @if (!empty($hotDeal) && empty($sku->discount))
                            <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                            @endif

                            @if(empty($hotDeal) && !empty($sku->discount))
                            <span class="blue discount">-{{$sku->discount}}%</span>
                        @endif

                        @if($sku->product->isrecommended == 1)
                        <span class="pink">Feature</span>
                        @endif
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="javascript:void(0)" onclick="addToWishList({{$sku->skuId}})"><i
                                        class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                @if($sku->product->type == "single")
                                <a title="Add To Cart" href="javascript: void(0)"
                                    onclick="addTocart({{ $sku->skuId }})"><i class="pe-7s-cart"></i> Add to cart</a>
                                @endif
                                @if($sku->product->type == "variation")
                                <a title="Add To Cart" href="{{ route('product.details', $sku->skuId) }}"><i
                                        class="pe-7s-cart"></i> Add to cart</a>
                                @endif
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a title="Quick View" href="#" data-toggle="modal" data-target="#exampleModal"
                                    data-sku_id="{{ $sku->skuId }}" class="quickView"><i class="pe-7s-look"></i></a>
                            </div>

                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3>
                            <a href="{{route('product.details',$sku->skuId)}}">{{ substr($sku->product->productName, 0, 16)."..." }}</a>
                        </h3>
                        <div class="product-price">

                            @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

                                @if (empty($hotDeal) && empty($sku->discount))
                                                    <span class="salePrice">৳ {{ $sku->regularPrice }} </span>
                                                @endif

                                                @if (!empty($hotDeal) && !empty($sku->discount))
                                                    @php
                                                        $percentage = $hotDeal->hotdeals->percentage;
                                                        $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                    @endphp

                                                    <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                    <span class="old">৳ {{ $sku->regularPrice }}</span>
                                                @endif

                                                @if (!empty($hotDeal) && empty($sku->discount))
                                                    @php
                                                        $percentage = $hotDeal->hotdeals->percentage;
                                                        $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                                    @endphp

                                                    <span class="salePrice">৳ {{ $afterDiscountPrice }}</span>
                                                    <span class="old">৳ {{ $sku->regularPrice }}</span>
                                                @endif

                                                @if(empty($hotDeal) && !empty($sku->discount))
                                                @php
                                                   $afterDiscountPrice = $sku->salePrice;
                                                @endphp

                                                <span class="salePrice">৳  {{$afterDiscountPrice}}</span>
                                                <span class="old">৳  {{$sku->regularPrice}}</span>
                                            @endif
                        </div>
                    </div>
                </div>
                @endif

                {{--  @foreach ($mostViewedProducts as $item)
                            @php
                                $skuProduct = App\Models\Sku::where('skuId',$item->fkskuId)->with('product')->first();
                            @endphp
                        @if (!empty($skuProduct->product()) )
                        @php
                            $hotDeal = $skuProduct->product->hotdealProducts
                                ->where('hotdeals.status', 'Available')
                                ->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))
                                ->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))
                                ->first();
                        @endphp  --}}
                {{--  @if (!empty($sku->product))
                        <div class="owl-item active" style="width: 270px; margin-right: 30px;">
                            <div class="product-wrap mb-25">
                                <div class="product-img">
                                    <a href="{{route('product.details', $skuProduct->skuId)}}">
                <img class="default-img"
                    src="{{ asset('admin/public/featureImage/' . $skuProduct->product->featureImage) }}" alt="">
                </a>
                @if ($skuProduct->product->newarrived == 1)
                <span class="purple">New</span>
                @endif
                @if (!empty($hotDeal))
                <span class="blue discount">-{{ $hotDeal->hotdeals ? $hotDeal->hotdeals->percentage : '' }}%</span>
                @endif
                @if ($skuProduct->product->isrecommended == 1)
                <span class="pink">Feature</span>
                @endif
                <div class="product-action">
                    <div class="pro-same-action pro-wishlist">
                        <a title="Wishlist" href="#" onclick="addToWishList({{ $skuProduct->skuId }})"><i
                                class="pe-7s-like"></i></a>
                    </div>
                    <div class="pro-same-action pro-cart">
                        @if ($skuProduct->product->type == 'single')
                        <a title="Add To Cart" href="javascript: void(0)"
                            onclick="addTocart({{ $skuProduct->skuId }})"><i class="pe-7s-cart"></i> Add to cart</a>
                        @endif
                        @if ($skuProduct->product->type == 'variation')
                        <a title="Add To Cart" href="{{ route('product.details', $skuProduct->skuId) }}"><i
                                class="pe-7s-cart"></i> Add to cart</a>
                        @endif
                    </div>
                    <div class="pro-same-action pro-quickview">
                        <a href="#" data-toggle="modal" data-target="#exampleModal"
                            data-sku_id="{{ $skuProduct->skuId }}" class="quickView"><i class="pe-7s-look"></i></a>
                    </div>
                </div>
        </div>
        <div class="product-content text-center">
            <h3><a href="{{route('product.details', $skuProduct->skuId)}}">{{$skuProduct->product->productName}}</a>
            </h3>
            <div class="product-price">
                @if (empty($hotDeal))
                <span>৳ {{ $skuProduct->salePrice }} </span>
                @endif
                @if (!empty($hotDeal))
                @php
                $percentage = $hotDeal->hotdeals->percentage;
                $afterDiscountPrice = $skuProduct->salePrice - ($skuProduct->salePrice * $percentage) / 100;
                @endphp
                <span>৳ {{ $afterDiscountPrice }}</span>
                <span class="old">৳ {{ $skuProduct->salePrice }}</span>
                @endif

            </div>
        </div>
    </div>
</div>
@endif --}}
@endforeach

</div>
{{--  </div>  --}}
{{--  <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span
                            aria-label="Previous">‹</span></button><button type="button" role="presentation"
                        class="owl-next"><span aria-label="Next">›</span></button></div>
                <div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button
                        role="button" class="owl-dot"><span></span></button></div>  --}}
</div>
</div>
</div>
@endif
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
                        <form id="mc-embedded-subscribe-form" class="validate" novalidate="" target="_blank"
                            name="subscribe-form" method="post" action="">
                            <div id="mc_embed_signup_scroll" class="mc-form">
                                <input class="email" type="email" required="" placeholder="Your Email Address"
                                    name="EMAIL" value="">
                                <div class="mc-news" aria-hidden="true">
                                    <input type="text" value="" tabindex="-1" name="subscribe">
                                </div>
                                <div class="clear-3">
                                    <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe"
                                        value="Subscribe">
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

@section('js')
<!-- .category-name-slider -->

<script>
    $(".category-name-slider .nav-link").click(function () {
        $(".category-name-slider .nav-link").removeClass("active");
    });

</script>
@endsection
