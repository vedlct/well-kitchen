{{-- <div id="" class="tab-pane active"> --}}
<div id="productShorting">
    <div class="row" id="">
        @foreach ($skuss as $sku)
{{--            {{dd($sku)}}--}}
{{--            {{ dd($sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))) }}--}}
           {{--  @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp  --}}
@php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

            @if(!empty($sku->product()))
                <div class="col-6 col-md-3 shop-col-item">
                    <div class="product-wrap mb-25 scroll-zoom">
                        <div class="product-img">
                            <a href="{{route('product.details',$sku->skuId)}}">
                                <img class="default-img" src="{{asset('admin/public/featureImage/'.$sku->product()->first()->featureImage)}}" alt="">
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

                            {{--  @if(!empty($hotDeal))
                                <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                            @endif  --}}

                        @if($sku->product->isrecommended == 1)
                            <span class="pink">Feature</span>
                            @endif

                            <div class="product-action">
                                <div class="pro-same-action pro-wishlist">
                                    <a title="Wishlist" href="#"><i class="pe-7s-like"></i></a>
                                </div>
                                <div class="pro-same-action pro-cart">
                                    @if($sku->product()->first()->type == "single")
                                        <a title="Add To Cart" href="javascript: void(0)" onclick="addTocart({{$sku->skuId}})"><i class="pe-7s-cart"></i> Add to cart</a>
                                    @endif
                                    @if($sku->product()->first()->type == "variation")
                                        <a title="Add To Cart" href="{{route('product.details',$sku->skuId)}}"><i class="pe-7s-cart"></i> Add to cart</a>
                                    @endif
                                    {{-- <a title="Add To Cart" href="javascript: void(0)"><i class="pe-7s-cart"></i> Add to cart</a>--}}
                                </div>
                                <div class="pro-same-action pro-quickview">
                                    <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content text-center">
                            <h3><a href="{{route('product.details',$sku->skuId)}}">{{$sku->product()->first()->productName}}</a></h3>
                            <div class="product-price">
{{--                                <span>৳  {{$sku->salePrice}}</span>--}}


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







                                {{--  @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->where('hotdeals.percentage', '>', 0)->first()@endphp

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
    
                                        <span>৳  {{$afterDiscountPrice}}</span>
                                        <span class="old">৳  {{$sku->salePrice}}</span>
                                    @endif  --}}

                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
            <div class="pro-pagination-style text-center mt-30">
                {{ $skuss->links('vendor.pagination.custom') }}
            </div>

</div>



