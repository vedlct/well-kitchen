@extends('layouts.layout')
@section('container')
<div class="breadcrumb-area pt-35">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li>
                    <a href="index.html">Shop</a>
                </li>
                <li>
                    <a href="#">Gadget</a>
                </li>
                <li class="active">Watch</li>
            </ul>
        </div>
    </div>
</div>

<!-- details start -->
<div class="shop-area pt-60 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details">
                    <div class="product-details-img">
                        <div class="tab-content jump mb-4">
                            @foreach ($product->images as $key=>$itemImg)
                            <div id="shop-details-{{$key}}" class="zoom tab-pane {{$key == 0 ? 'active' : '' }} large-img-style" style="background-image: url({{asset('admin/public/productImages/'.$itemImg->image)}});">
                                <img src="{{asset('admin/public/productImages/'.$itemImg->image)}}" alt="">
                            </div>
                            @endforeach
                        </div>
                        <div class="quickview-slide-active owl-carousel nav nav-style-1">
                            @foreach ($product->images as $key=>$itemImg)
                                <a class="shop-details-overly {{$key == 0 ? 'active' : '' }}" href="#shop-details-{{$key}}" data-toggle="tab">
                                    <img src="{{asset('admin/public/productImages/'.$itemImg->image)}}" alt="">
                                </a>
                            @endforeach
                        </div>
                        {{-- <div class="shop-details-tab nav">
                           @foreach ($product->images as $key=>$itemImg)
                                <a class="shop-details-overly {{$key == 0 ? 'active' : '' }}" href="#shop-details-{{$key}}" data-toggle="tab">
                                    <img src="{{asset('admin/public/productImages/'.$itemImg->image)}}" alt="">
                                </a>
                            @endforeach
                        </div>  --}}

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product-details-content ml-70">
                    <h2>{{$product->productName}}</h2>
                    <div class="product-details-price">
                            <span class="salePrice">৳ {{$sku->salePrice}} </span>
                    </div>
                    <div class="pro-details-rating-wrap">
                        <div class="pro-details-rating">
                            {{-- @dd($product->review->count()); --}}
                            @if($product->review->count()>0)

                                    @for ($i = 0; $i < ceil($product->review->avg('rating')); $i++)
                                        <i class="fa fa-star-o yellow"></i>
                                    @endfor
                                    @for ($i = 0; $i < $count=4-($product->review->avg('rating')); $i++)
                                        <i class="fa fa-star-o red"></i>
                                    @endfor
                                @else

                                <i class="fa fa-star-o yellow"></i>
                                <i class="fa fa-star-o yellow"></i>
                                <i class="fa fa-star-o yellow"></i>
                                <i class="fa fa-star-o yellow"></i>
                                <i class="fa fa-star-o yellow"></i>
                                @endif

                        </div>
                        {{-- @dd($product); --}}
                        <span><a href="#">{{$product->review->count()}} Reviews</a></span>
                    </div>
                    <p>{!! $product->details->fabricDetails !!}</p>

                    <div class="pro-details-size-color" >
                        <div class="pro-details-color-wrap" id="colors">

                            <span>Color</span>
                            <div class="pro-details-color-content">
                                <!-- select color -->
                                @foreach($product->sku as $productsku)
                                @foreach($productsku->variationRelation as $variationRelation)

                                @if($variationRelation->variationDetailsdata->variationType == "Color")
                                          <input type="radio" name="color" id="red{{$variationRelation->variationDetailsdata->variationId}}" />
                                    <label for="red{{$variationRelation->variationDetailsdata->variationId}}"><span onclick="changeVariation({{$variationRelation->variationRelationId}})"  style="background: {{$variationRelation->variationDetailsdata->variationValue}}" class=""></span></label>
                                @endif
                                @endforeach
                                @endforeach

                            </div>
                        </div>
                        <div class="pro-details-size" id="sizes">
                            <span>Size</span>
                            <div class="pro-details-size-content">
                                <!-- select size -->
                                @foreach($product->sku as $productsku)
                                @foreach($productsku->variationRelation as $variationRelation)

                                @if($variationRelation->variationDetailsdata->variationType == "Size")
                                           <input type="radio" id="size-1{{$variationRelation->variationDetailsdata->variationId}}" name="size">
                                <label for="size-1{{$variationRelation->variationDetailsdata->variationId}}" class="text-center">
                                    <div class="variant-select_wrapper">
                                        <span class="variant-select__title" onclick="changeVariation({{$variationRelation->variationRelationId}})">{{$variationRelation->variationDetailsdata->variationValue}}</span>
                                    </div>
                                </label>
                                @endif
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="pro-details-quality">
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" id="quantity" value="1">
                        </div>
                        <div class="pro-details-cart btn-hover addtocartsku">
                            <a href="#" onclick="addTocart({{$sku->skuId}})">Add To Cart</a>
                        </div>
                        <div class="pro-details-wishlist">
                            <a href="#"><i class="fa fa-heart-o"></i></a>
                        </div>
                        <div class="pro-details-compare">
                            <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-shuffle"></i></a>
                        </div>
                    </div>
                    <div class="pro-details-meta">
                        <span>Categories :</span>
                        <ul>
                            <li><a href="#">Minimal,</a></li>
                            <li><a href="#">Furniture,</a></li>
                            <li><a href="#">Fashion</a></li>
                        </ul>
                    </div>
                    <div class="pro-details-meta">
                        <span>Tag :</span>
                        <ul>
                            <li><a href="#">Fashion, </a></li>
                            <li><a href="#">Furniture,</a></li>
                            <li><a href="#">Electronic</a></li>
                        </ul>
                    </div>
                    <div class="pro-details-social">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- details end -->

<!-- description start -->
<div class="description-review-area pb-90">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a data-toggle="tab" href="#des-details1">Additional information</a>
                <a class="active" data-toggle="tab" href="#des-details2">Description</a>
                <a data-toggle="tab" href="#des-details3">Reviews ( {{$product->review->count()}} )</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details2" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p>{!! $product->details->description!!}</p>
                    </div>
                </div>
                <div id="des-details1" class="tab-pane ">
                    <div class="product-anotherinfo-wrapper">
                        <ul>
                            <li><span>Weight</span> 400 g</li>
                            <li><span>Dimensions</span>10 x 10 x 15 cm </li>
                            <li><span>Materials</span> 60% cotton, 40% polyester</li>
                            <li><span>Other Info</span> American heirloom jean shorts pug seitan letterpress</li>
                        </ul>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="review-wrapper">
                                {{-- @dd($product->review->where('fkproductId',$product->productId)) --}}
                               @foreach ($product->review as $item)
                                {{-- @dd($item->where('fkproduct',$product->productId)); --}}
                                    <div class="single-review">
                                        <div class="review-img">
                                        <img src="assets/img/testimonial/1.jpg" alt="">
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">

                                                        {{-- @php
                                                            $name = $item->customer->user->firstName;

                                                        @endphp --}}
                                                         {{-- @dd($name); --}}
                                                         {{-- {{$name}} --}}
                                                        <h4>jhon doe</h4>
                                                        {{-- <h4>{{dd($item->customer)}}</h4> --}}
                                                    </div>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>{{$item->review}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="ratting-form-wrapper pl-50">
                                <h3>Add a Review</h3>
                                <div class="ratting-form">
                                    <form  method="POST" action="{{route('review.submit')}}">
                                        @csrf
                                        <input type="hidden" name="productId" value="{{$product->productId}}">
                                        <div class="star-box">
                                            <span>Your rating:</span>
                                            <div class="star-rating">
                                                <input type="radio" id="5-stars" name="rating" value="5" />
                                                <label for="5-stars" class="star">&#9733;</label>
                                                <input type="radio" id="4-stars" name="rating" value="4" />
                                                <label for="4-stars" class="star">&#9733;</label>
                                                <input type="radio" id="3-stars" name="rating" value="3" />
                                                <label for="3-stars" class="star">&#9733;</label>
                                                <input type="radio" id="2-stars" name="rating" value="2" />
                                                <label for="2-stars" class="star">&#9733;</label>
                                                <input type="radio" id="1-star" name="rating" value="1" required/>
                                                <label for="1-star" class="star">&#9733;</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rating-form-style mb-10">
                                                    <input placeholder="Name" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style mb-10">
                                                    <input placeholder="Email" type="email">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="review" placeholder="Message" required></textarea>
                                                    <input type="submit" value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- description end -->

<!-- related product start -->
<div class="product-area pb-70">
    <div class="container">
        <div class="section-title-6 mb-45 text-center">
            <h2>Related Products</h2>
        </div>
        <div class="product-slider-active-2 owl-carousel owl-dot-none">
            {{-- @dd($skus); --}}
            @foreach ($skus as $sku)
                {{-- @dd($sku->product);                 --}}

                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="{{route('product.details',$sku->skuId)}}">
                           <img class="default-img" src="{{asset('admin/public/featureImage/'.$sku->product->featureImage)}}" alt="">
                        </a>
                        <span class="purple">New</span>
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="{{route('wishlistAdd', $sku->skuId)}}"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                <a title="Add To Cart" href="#"><i class="pe-7s-cart"></i> Add to cart</a>
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a href="#" data-toggle="modal" data-target="#quickView"><i class="pe-7s-look"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="{{route('product.details',$sku->skuId)}}">{{$sku->product->productName}}</a></h3>
                        <div class="product-price">
                            <span>৳ {{$sku->salePrice}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- related product start -->

@endsection

@section('js')

<script>
    function changeVariation(id)
    {
        variationRelationId = id;
        $.ajax({
            url: "{{route('color.choose')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
                variationRelationId: variationRelationId,
            },
            success: function(data){
                console.log(data);
                var data = data;
                $('.salePrice').empty().append("<span>"+"৳ "+data.sku.salePrice+"</span>")
                $('.addtocartsku').empty().append("<a href='#' onclick='addTocart("+data.sku.skuId+")'>Add To Cart</a>");
                $.each(data.variationDatas, function (key, val)
                {
                    if(val.variation_detailsdata.variationType == "Color"){
                        $('#colors').empty().append("<span>Color</span><div class='pro-details-color-content'><input type='radio' id=`red"+val.variation_detailsdata.variationId+"` name='color'> <label for=`red"+val.variation_detailsdata.variationId+"` class='text-center'><span class='' onclick='changeVariation("+val.variationRelationId+")' style='background:"+ val.variation_detailsdata.variationValue+"'></span></label></div>")
                    }
                    if(val.variation_detailsdata.variationType == "Size"){
                        $('#sizes').empty().append("<span>Size</span><div class='pro-details-size-content'><input type='radio' id=`size-1"+val.variation_detailsdata.variationId+"` name='size'> <label for=`size-1"+val.variation_detailsdata.variationId+"` class='text-center'><div class='variant-select_wrapper'><span class='variant-select__title' onclick='changeVariation("+val.variationRelationId+")'>"+val.variation_detailsdata.variationValue+"</span></div></label></div>")
                    }
                });
            }
        });
    }

    {{--function changeSize(id)--}}
    {{--{--}}
    {{--    var variationRelationId = id;--}}
    {{--    $.ajax({--}}
    {{--        --}}{{--url: "{{route('size.choose')}}",--}}
    {{--        method: 'POST',--}}
    {{--        data: {--}}
    {{--            _token: "{{csrf_token()}}",--}}
    {{--            variationRelationId: variationRelationId,--}}
    {{--        },--}}
    {{--        success: function (data) {--}}
    {{--            console.log(data);--}}
    {{--            var data = data;--}}
    {{--            $('.salePrice').empty().append("<span>"+"Price: ৳ "+data.salePrice+"</span>")--}}
    {{--            if(data.variations.length < 1){--}}
    {{--                $('.sizeColors').hide();--}}
    {{--                $('#colors').empty();--}}
    {{--            }else{--}}
    {{--                $('#colors').empty();--}}
    {{--                $('.sizeColors').show();--}}
    {{--                $.each(data.variations, function (key, val)--}}
    {{--                {--}}
    {{--                    $('#colors').append("<div style='display: inline-block;'>"+"<div class='select-color'>"+"<ul class='colorBlock' style='margin-right: 5px'>"+--}}
    {{--                        "<li value="+val.skuID+" class='colorsize"+val.skuID+"' onclick='colorSize("+val.skuID+")'>"+"<span onclick='colorSize("+val.skuID+")' class='colorsize"+val.skuID+" color-option' style='background-color: "+val.variation_details.variationValue+"'>"+"</span>"+"</li>"+"</ul>"+"</div>"+"</div>")--}}
    {{--                });--}}
    {{--            }--}}
    {{--        }--}}
    {{--    });--}}
    {{--}--}}

</script>


@endsection
