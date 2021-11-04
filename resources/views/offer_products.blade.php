@extends('layouts.layout')
@section('container')
<div class="product-area pb-70">
    <div class="container">
        <div class="section-title-6 mt-45 mb-45 text-center">
            <h2>{{ucwords($hotDeals->hotDeals_name)}} Products</h2>
        </div>
        <div class="product-slider-active-2 owl-carousel owl-dot-none">
            @foreach ($skus->unique('fkproductId') as $sku)
                {{-- @dd($sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->first()); --}}
                {{--  @if (!empty($sku->product->hotdealProducts))
                    @php
                        $hotDeal = $sku->product->hotdealProducts
                            ->where('hotdeals.status', 'Available')
                            ->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))
                            ->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))
                            ->where('hotdeals.percentage', '>', 0)
                            ->first();
                    @endphp
                @endif  --}}
                {{-- @dd($sku->product->newarrived); --}}
                @if (!empty($sku->product))
                    <div class="product-wrap mb-25">
                        <div class="product-img">
                            {{-- <a href="product-details.html"> --}}
                            <a href="{{ route('product.details', $sku->skuId) }}">
                                <img class="default-img" src="{{ asset('admin/public/featureImage/'.$sku->product->featureImage) }}" alt="">
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

                            @if ($sku->product->isrecommended == 1)
                                <span class="pink">Feature</span>
                            @endif

                            <div class="product-action">
                                <div class="pro-same-action pro-wishlist">
                                    <a title="Wishlist" href="#" onclick="addToWishList({{ $sku->skuId }})">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                </div>
                                <div class="pro-same-action pro-cart">
                                    @if ($sku->product->type == 'single')
                                        <a title="Add To Cart" href="#" onclick="addTocart({{ $sku->skuId }})">
                                            <i class="pe-7s-cart"></i> Add to cart
                                        </a>
                                    @endif

                                    @if ($sku->product->type == 'variation')
                                        <a title="Add To Cart" href="{{ route('product.details', $sku->skuId) }}">
                                            <i class="pe-7s-cart"></i> Add to cart
                                        </a>
                                    @endif
                                </div>
                                <div class="pro-same-action pro-quickview">
                                    <a href="#" data-toggle="modal" data-target="#exampleModal" data-sku_id="{{ $sku->skuId }}" class="quickView">
                                        <i class="pe-7s-look"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content text-center">
                            <h3><a href="{{ route('product.details', $sku->skuId) }}">{{ substr($sku->product->productName, 0, 16)."..." }}</a></h3>
                            <div class="product-price">
                                {{-- <span>৳  {{$sku->salePrice}}</span> --}}
                                {{-- @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first() @endphp --}}

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
@endsection
