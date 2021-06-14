<div id="" class="tab-pane active">
    <div class="row">
        @foreach ($skus->unique('fkproductId') as $sku)
            @if(!empty($sku->product()))
                <div class="col-6 col-md-4 shop-col-item">
                    <div class="product-wrap mb-25 scroll-zoom">
                        <div class="product-img">
                            <a href="{{route('product.details',$sku->skuId)}}">
                                <img class="default-img" src="{{asset('admin/public/featureImage/'.$sku->product()->first()->featureImage)}}" alt="">
                            </a>
                            @if($sku->product->newarrived == 1)
                            <span class="purple">New</span>
                            @endif
                            @if($sku->product->isrecommended == 1)
                            <span class="purple">Feature</span>
                            @endif
                            <div class="product-action">
                                <div class="pro-same-action pro-wishlist">
                                    <a title="Wishlist" href="#"><i class="pe-7s-like"></i></a>
                                </div>
                                <div class="pro-same-action pro-cart">
                                    @if($sku->product()->first()->type == "single")
                                        <a title="Add To Cart" href="#" onclick="addTocart({{$sku->skuId}})"><i class="pe-7s-cart"></i> Add to cart</a>
                                    @endif
                                    @if($sku->product()->first()->type == "variation")
                                        <a title="Add To Cart" href="{{route('product.details',$sku->skuId)}}"><i class="pe-7s-cart"></i> Add to cart</a>
                                    @endif
                                    {{--                                                    <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>--}}
                                </div>
                                <div class="pro-same-action pro-quickview">
                                    <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content text-center">
                            <h3><a href="{{route('product.details',$sku->skuId)}}">{{$sku->product()->first()->productName}}</a></h3>
                            <div class="product-price">
                                <span>৳  {{$sku->salePrice}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
