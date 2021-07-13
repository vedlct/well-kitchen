@extends('layouts.layout')
@section('container')
<div class="breadcrumb-area pt-35">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li>
                    <a href="{{route('home')}}">Home</a>
                </li>
                {{-- <li>
                    <a href="{{route('category.products')}}">Category</a>
                </li> --}}
                @if($subCategory != null)
                    @if($parentCategory != null)
                        <li class="active"><a href="{{route('category.products', $parentCategory->categoryId)}}">{{$parentCategory->categoryName}}</a></li>
                    @endif

                        <li class="active"><a href="{{route('category.products', $subCategory->categoryId)}}">{{$subCategory->categoryName}}</a></li>

                    @else
                    @if($parentCategory != null)
                        <li class="active"><a href="{{route('category.products', $parentCategory->categoryId)}}">{{$parentCategory->categoryName}}</a></li>
                    @endif
                @endif
                @if($categoryId != null)
                    <li class="active">{{$category->categoryName}}</li>
                @endif
                {{-- <li class="active">{{ $product->productName}}</li> --}}
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
                            <div id="shop-details-{{$key}}" class="zoom tab-pane fade {{$key == 0 ? 'active' : '' }} large-img-style" style="background-image: url('{{asset('admin/public/productImages/'.$itemImg->image)}}');">
                                <img src="{{asset('admin/public/productImages/'.$itemImg->image)}}" alt="">
                            </div>
                            @endforeach
                        </div>
                        <div class="productDetails-slide-active owl-carousel nav nav-style-1">
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
                        @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->first()@endphp

                        @if(empty($hotDeal))
                            <span class="salePrice">৳ {{$sku->salePrice}} </span>
                        @endif

                        @if(!empty($hotDeal))
                            @php
                              $percentage = $hotDeal->hotdeals->percentage;
                              $afterDiscountPrice = ($sku->salePrice) - (($sku->salePrice)*$percentage)/100;
                            @endphp
                            <span class="salePrice">৳ {{$afterDiscountPrice}} </span>
                            <span class="old">৳ {{$sku->salePrice}}</span>
{{--                            &nbsp;--}}
                            <p class="ml-3"> -{{$percentage}}% <small style="color: #0ac282; font-weight: bold">Free</small></p>
                        @endif

                    </div>
                    <div class="pro-details-rating-wrap">
                        <div class="pro-details-rating">
                            {{-- @dd($product->review->count()); --}}
                            @if($finalRating? $finalRating  > 0: "")
                                @for ($i = 5; $i >= $finalRating; $i--)
                                    <i class="fa fa-star-o yellow"></i>
                                @endfor
                                @for ($i = 0; $i < 5-$finalRating; $i++)
                                    <i class="fa fa-star-o red"></i>
                                @endfor
                            @else
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o "></i>
                                <i class="fa fa-star-o "></i>
                                <i class="fa fa-star-o "></i>
                                <i class="fa fa-star-o "></i>
                            @endif
                        </div>
                        <span><a href="#">{{$product->review->count()}} Reviews</a></span>
                    </div>
                    @if(isset($product->details->fabricDetails))
                    <p>{!! $product->details->fabricDetails !!}</p>
                    @endif

                    <div class="pro-details-size-color" >
                        <div class="pro-details-color-wrap" id="colors">
                            {{-- @foreach($product->sku as $productsku)
                            @foreach($productsku->variationRelation as $variationRelation)

                            @if($variationRelation->variationDetailsdata->variationType == "Color") --}}
                            @if($variationColorIds->count() > 0)
                            <span>Color</span>
                            @endif
                            {{-- @endif
                            @endforeach
                            @endforeach --}}
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
                            {{-- @foreach($product->sku as $productsku)
                                @foreach($productsku->variationRelation as $variationRelation)

                                @if($variationRelation->variationDetailsdata->variationType == "Size") --}}
                                @if($variationSizeIds->count() > 0)
                            <span>Size</span>
                            @endif
                            {{-- @endif
                            @endforeach
                            @endforeach --}}
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



                        {{-- @if ($sku->product->type == 'single')
                        <a href="javascript: void(0)" onclick="addTocart({{$sku->skuId}})">Add To Cart</a>
                    @endif
                    @if ($sku->product->type == 'variation')
                        <a title="Add To Cart"
                            href="{{ route('product.details', $sku->skuId) }}"><i
                                class="pe-7s-cart"></i> Add to cart</a>
                    @endif --}}

                        <div class="pro-details-cart btn-hover addtocartsku">

                            <a href="javascript: void(0)" onclick="addTocart({{$sku->product->type == "single" ? $sku->skuId : '0'}})">Add To Cart</a>
                        </div>
                        <div class="pro-details-wishlist">
                            <a href="#" onclick="addToWishList({{$sku->skuId}})"><i class="fa fa-heart-o"></i></a>
                        </div>
                        <div class="pro-details-compare">
                            <a href="{{route('product.compare', $sku->skuId)}}"><i class="pe-7s-shuffle"></i></a>
{{--                            <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="pe-7s-shuffle"></i></a>--}}
                        </div>
                    </div>
                    <div class="pro-details-meta">
                        <span>Categories :</span>
                        <ul>
                            <li><a href="#">{{$product->category->categoryName}}</a></li>
                        </ul>
                    </div>
                    <div class="pro-details-meta">
                        <span>Tag :</span>
                        <ul>
                            <li><a href="#">{{$product->tag}} </a></li>
                        </ul>
                    </div>
                    {{-- @dd($setting); --}}
                    <div class="pro-details-social">
                        <ul>
                            <li><a href=" {{($setting->facebook)}} "><i class="fa fa-facebook"></i></a></li>
                            <li><a href=" {{($setting->twitter)}} "><i class="fa fa-twitter"></i></a></li>
                            <li><a href=" {{$setting->instagram}} "><i class="fa fa-linkedin"></i></a></li>
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
                        @if(isset($product->details->description))
                        <p>{!!  $product->details->description !!}</p>
                            @endif
                    </div>
                </div>
                <div id="des-details1" class="tab-pane ">
                    <div class="product-anotherinfo-wrapper">
                        <ul>
                            @if(isset($product->details->fabricDetails))
                            <li><span>Details</span> {!! $product->details->fabricDetails !!}</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div id="des-details3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="review-wrapper">
                               {{-- @foreach ($product->review as $item) --}}
                              @if(isset($reviewAll))
                               @foreach ($reviewAll as $item)

                               {{-- @dd($item->customer->user->firstName) --}}
                                    <div class="single-review">
                                        <div class="review-img">
                                        <img src="assets/img/testimonial/1.jpg" alt="">
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        {{-- @dd($item->getRating->value); --}}
                                                         <h4>{{$item->customer->user->firstName}}</h4>

                                                    </div>
                                                    <div class="review-rating">
                                                        @for ($i = 1; $i < 5; $i++)
                                                        @if ($i < $item->getRating->value)
                                                            {{-- <span class="star star--gold"></span> --}}
                                                            <i class="fa fa-star"></i>
                                                        @else
                                                            <span class="star"></span>
                                                        @endif
                                                        @endfor
                                                        <i class="fa fa-star"></i>

                                                    </div>

                                                    {{-- <div class="ml-5"> {{date('Y-m-d H:i:s', strtotime($item->created_at))}} </div> --}}
                                                    <div class="ml-5"> {{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}} </div>

                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>{{$item->review}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
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
                                                <input type="radio" id="5-stars" name="rating" value="5"  />
                                                <label for="5-stars" class="star">&#9733;</label>
                                                <input type="radio" id="4-stars" name="rating" value="4"  />
                                                <label for="4-stars" class="star">&#9733;</label>
                                                <input type="radio" id="3-stars" name="rating" value="3"  />
                                                <label for="3-stars" class="star">&#9733;</label>
                                                <input type="radio" id="2-stars" name="rating" value="2"  />
                                                <label for="2-stars" class="star">&#9733;</label>
                                                <input type="radio" id="1-star" name="rating" value="1" />
                                                <label for="1-star" class="star">&#9733;</label>
                                                @error('rating')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rating-form-style mb-10">
                                                    @if(Auth::check())
                                                    <input placeholder="Name" type="hidden" name="customerId" value="{{$customer?$customer->customerId:''}}">
                                                    <input placeholder="Name" type="text" value="{{Auth::user()->firstName}}" readonly>
                                                    @else
                                                    <input placeholder="Name" type="text" name="customerId" required>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style mb-10">
                                                    @if(Auth::check())
                                                    <input placeholder="Email" type="email" name="email" value="{{Auth::user()->email}}" readonly>
                                                    @else
                                                    <input placeholder="Email" type="email" name="email" required>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="review" placeholder="Type Your Message here......"></textarea>
                                                    @if(Auth::check())
                                                    <input type="submit" value="Submit">
                                                    @else
                                                    {{-- <a href="{{route('login')}}" class="btn btn-warning"> Login<p>to add Review</p> </a> --}}
                                                    {{-- <button onclick="myFunction()">Try it</button> --}}
                                                    <input type="submit" value="Submit" onclick="myFunction()">
                                                    @endif
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
                @if(!empty($sku->product()))
                @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->first()@endphp
                <div class="product-wrap mb-25">
                    <div class="product-img">
                        <a href="{{route('product.details',$sku->skuId)}}">
                           <img class="default-img" src="{{asset('admin/public/featureImage/'.$sku->product->featureImage)}}" alt="">
                        </a>
                        @if($sku->product->newarrived == 1)
                            <span class="purple">New</span>
                        @endif

                        @if(!empty($hotDeal))
                            <span class="blue discount">-{{$hotDeal->hotdeals? $hotDeal->hotdeals->percentage : ''}}%</span>
                        @endif

                        @if($sku->product->isrecommended == 1)
                            <span class="pink">Feature</span>
                        @endif
                        <div class="product-action">
                            <div class="pro-same-action pro-wishlist">
                                <a title="Wishlist" href="#" onclick="addToWishList({{$sku->skuId}})"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-same-action pro-cart">
                                @if($sku->product->type == "single")
                                    <a title="Add To Cart" href="javascript: void(0)" onclick="addTocart({{$sku->skuId}})"><i class="pe-7s-cart">Add to cart</i></a>
                                @endif
                                @if($sku->product->type == "variation")
                                    <a title="Add To Cart" href="{{route('product.details',$sku->skuId)}}" ><i class="pe-7s-cart">Add to cart</i></a>
                                @endif
                            </div>
                            <div class="pro-same-action pro-quickview">
                                <a title="Quick View" href="#" data-toggle="modal"
                                   data-target="#exampleModal" data-sku_id="{{ $sku->skuId }}"
                                   class="quickView"><i class="pe-7s-look"></i></a>
                            </div>

                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="{{route('product.details',$sku->skuId)}}">{{$sku->product->productName}}</a></h3>
                        <div class="product-price">

                            @php $hotDeal = $sku->product->hotdealProducts->where('hotdeals.status', 'Available')->where('hotdeals.startDate', '<=', date('Y-m-d H:i:s'))->where('hotdeals.endDate', '>=', date('Y-m-d H:i:s'))->first()@endphp

                            @if(empty($hotDeal))
                                <span>৳ {{$sku->salePrice}} </span>
                            @endif

                            @if(!empty($hotDeal))
                                @php
                                    $percentage = $hotDeal->hotdeals->percentage;
                                    $afterDiscountPrice = ($sku->salePrice) - (($sku->salePrice)*$percentage)/100;
                                @endphp

                                <span>৳  {{$afterDiscountPrice}}</span>
                                <span class="old">৳  {{$sku->salePrice}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<!-- related product start -->

@endsection

@section('js')

<script>
        // zoom image
        $(document).ready(function(){

            $(".zoom").mousemove(function(e){
                zoom(e);
            });

            function zoom(e){
                var x, y;
                var zoomer = e.currentTarget;
                if(e.offsetX) {
                    offsetX = e.offsetX;
                } else {
                    offsetX = e.touches[0].pageX;
                }

                if(e.offsetY) {
                    offsetY = e.offsetY;
                } else {
                    offsetX = e.touches[0].pageX;
                }
                x = offsetX/zoomer.offsetWidth*100;
                y = offsetY/zoomer.offsetHeight*100;
                zoomer.style.backgroundPosition = x+'% '+y+'%';
            }
        });
    </script>

<script>
    function myFunction() {
        toastr.warning('Please Login first');
    }
    // function addRating() {
    //     toastr.warning('click star mark to add Rating');
    // }

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
                if(data.afterDiscountPrice != null){
                    $('.salePrice').empty().append("<span>"+"৳ "+data.afterDiscountPrice+"</span>")
                    $('.old').empty().append("<span class='old'>"+"৳ "+data.sku.salePrice+"</span>")
                }
                if(data.afterDiscountPrice == null) {
                    $('.salePrice').empty().append("<span>" + "৳ " + data.sku.salePrice + "</span>")
                }
                $('.addtocartsku').empty().append("<a href='javascript: void(0)' onclick='addTocart("+data.sku.skuId+")'>Add To Cart</a>");
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
