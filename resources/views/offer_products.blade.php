@extends('layouts.layout')
@section('container')
<div class="product-area pb-70">
    <div class="container">
        <div class="section-title-6 mt-45 mb-45 text-center">
            <h2>{{ucwords($hotDeals->hotDeals_name)}} Products</h2>
        </div>





        <div>
            <div class="row" id="">

                @foreach ($skus->unique('fkproductId') as $sku)

                    @php
                        $hotDeal = $sku->product->hotdealProducts
                            ->where('hotdeals.status', 'Available')
                            ->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))
                            ->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))
                            ->where('hotdeals.percentage', '>', 0)
                            ->first();
                    @endphp

                    @if (!empty($sku->product()))
                        <div class="col-6 col-md-3 shop-col-item">
                            <div class="product-wrap mb-25 scroll-zoom">
                                <div class="product-img">
                                    <a href="{{ route('product.details', $sku->product->slug) }}">
                                        <img class="default-img"
                                            src="{{ asset('admin/public/featureImage/' . $sku->product()->first()->featureImage) }}"
                                            alt="">
                                    </a>
                                    @if ($sku->product->newarrived == 1)
                                        <span class="purple">New</span>
                                    @endif


                                    @php
                                        $hotDeal = $sku->product->hotdealProducts
                                            ->where('hotdeals.status', 'Available')
                                            ->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))
                                            ->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))
                                            ->where('hotdeals.percentage', '>', 0)
                                            ->first();
                                    @endphp

                                    @if (!empty($hotDeal) && !empty($sku->discount))
                                        <span
                                            class="blue discount">-{{ $hotDeal->hotdeals ? $hotDeal->hotdeals->percentage : '' }}%</span>
                                    @endif
                                    @if (!empty($hotDeal) && empty($sku->discount))
                                        <span
                                            class="blue discount">-{{ $hotDeal->hotdeals ? $hotDeal->hotdeals->percentage : '' }}%</span>
                                    @endif

                                    @if (empty($hotDeal) && !empty($sku->discount))
                                        <span class="blue discount">-{{ $sku->discount }}%</span>
                                    @endif



                                    @if ($sku->product->isrecommended == 1)
                                        <span class="pink">Feature</span>
                                    @endif

                                    <div class="product-action">
                                        <div class="pro-same-action pro-wishlist">
                                            <a title="Wishlist" href="javascript: void(0)"
                                                onclick="addToWishList({{ $sku->skuId }})"><i
                                                    class="pe-7s-like"></i></a>
                                        </div>
                                        <div class="pro-same-action pro-cart">
                                            @if ($sku->product()->first()->type == 'single')
                                                <a title="Add To Cart" href="javascript: void(0)"
                                                    onclick="addTocart({{ $sku->skuId }})"><i
                                                        class="pe-7s-cart"></i> Add to cart</a>
                                            @endif
                                            @if ($sku->product()->first()->type == 'variation')
                                                <a title="Add To Cart"
                                                    href="{{ route('product.details', $sku->product->slug) }}"><i
                                                        class="pe-7s-cart"></i> Add to cart</a>
                                            @endif

                                        </div>
                                        <div class="pro-same-action pro-quickview">
                                            <a href="#" data-toggle="modal" class="quickView"
                                                data-target="#exampleModal" data-sku_id="{{ $sku->skuId }}"><i
                                                    class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content text-center">
                                    <h3><a
                                            href="{{ route('product.details', $sku->product->slug) }}">{{ substr($sku->product()->first()->productName, 0, 16) . '...' }}</a>
                                    </h3>
                                    <div class="product-price">



                                        @php
                                            $hotDeal = $sku->product->hotdealProducts
                                                ->where('hotdeals.status', 'Available')
                                                ->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))
                                                ->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))
                                                ->where('hotdeals.percentage', '>', 0)
                                                ->first();
                                        @endphp

                                        @if (empty($hotDeal) && empty($sku->discount))
                                            <span class="salePrice">৳
                                                {{ $sku->regularPrice }} </span>
                                        @endif

                                        @if (!empty($hotDeal) && !empty($sku->discount))
                                            @php
                                                $percentage = $hotDeal->hotdeals->percentage;
                                                $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                            @endphp

                                            <span class="salePrice">৳
                                                {{ $afterDiscountPrice }}</span>
                                            <span class="old">৳
                                                {{ $sku->regularPrice }}</span>
                                        @endif

                                        @if (!empty($hotDeal) && empty($sku->discount))
                                            @php
                                                $percentage = $hotDeal->hotdeals->percentage;
                                                $afterDiscountPrice = $sku->regularPrice - ($sku->regularPrice * $percentage) / 100;
                                            @endphp

                                            <span class="salePrice">৳
                                                {{ $afterDiscountPrice }}</span>
                                            <span class="old">৳
                                                {{ $sku->regularPrice }}</span>
                                        @endif

                                        @if (empty($hotDeal) && !empty($sku->discount))
                                            @php
                                                $afterDiscountPrice = $sku->salePrice;
                                            @endphp

                                            <span class="salePrice">৳
                                                {{ $afterDiscountPrice }}</span>
                                            <span class="old">৳
                                                {{ $sku->regularPrice }}</span>
                                        @endif




                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="pro-pagination-style text-center mt-30">
                {{-- {{ $skuss->links('vendor.pagination.custom') }} --}}
            </div>

        </div>
















    </div>
</div>
@endsection
