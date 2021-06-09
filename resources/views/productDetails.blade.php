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

                <!-- <div class="product-details-img mr-20 product-details-tab">
                    <div class="zoompro-wrap zoompro-2 pr-20">
                         <div class="zoompro-border zoompro-span">
                             <img class="zoompro" src="assets/img/product-details/product-detalis-l1.jpg" data-zoom-image="assets/img/product-details/product-detalis-l1.jpg" alt=""/>          
                             <span>-29%</span>
                             <div class="product-video">
                                 <a class="video-popup" href="https://www.youtube.com/watch?v=tce_Ap96b0c">
                                     <i class="fa fa-video-camera"></i>
                                     View Video
                                 </a>
                             </div>
                         </div>
                     </div>
                     <div id="gallery" class="product-dec-slider-2">
                         <a data-image="assets/img/product-details/product-detalis-l1.jpg" data-zoom-image="assets/img/product-details/product-detalis-l1.jpg">
                             <img src="assets/img/product-details/product-detalis-l1.jpg" alt="">
                         </a>
                         <a data-image="assets/img/product-details/product-detalis-l2.jpg" data-zoom-image="assets/img/product-details/product-detalis-l2.jpg">
                             <img src="assets/img/product-details/product-detalis-l2.jpg" alt="">
                         </a>
                         <a data-image="assets/img/product-details/product-detalis-l3.jpg" data-zoom-image="assets/img/product-details/product-detalis-l3.jpg">
                             <img src="assets/img/product-details/product-detalis-l3.jpg" alt="">
                         </a>
                         <a data-image="assets/img/product-details/product-detalis-l5.jpg" data-zoom-image="assets/img/product-details/product-detalis-l5.jpg">
                             <img src="assets/img/product-details/product-detalis-l5.jpg" alt="">
                         </a> 
                         <a data-image="assets/img/product-details/product-detalis-l5.jpg" data-zoom-image="assets/img/product-details/product-detalis-l5.jpg">
                             <img src="assets/img/product-details/product-detalis-l5.jpg" alt="">
                         </a> 
                     </div>
                 </div> -->

                <div class="product-details">
                    <div class="product-details-img">
                        <div class="tab-content jump">
                            @foreach ($productDetails->images as $key=>$itemImg)
                            <div id="shop-details-{{$key}}" class="zoom tab-pane {{$key == 0 ? 'active' : '' }} large-img-style" style="background-image: url({{asset('admin/public/productImages/'.$itemImg->image)}});">
                                <img src="{{asset('admin/public/productImages/'.$itemImg->image)}}" alt="">
                                <span class="dec-price">-10%</span>
                            </div>
                            @endforeach
                        </div>
                        <div class="shop-details-tab nav">
                            @foreach ($productDetails->images as $key=>$itemImg)
                                <a class="shop-details-overly {{$key == 0 ? 'active' : '' }}" href="#shop-details-{{$key}}" data-toggle="tab">
                                    <img src="{{asset('admin/public/productImages/'.$itemImg->image)}}" alt="">
                                </a>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
            {{-- @dd($productDetails->sku->first()->salePrice); --}}
            <div class="col-lg-6 col-md-6">
                <div class="product-details-content ml-70">
                    <h2>{{$productDetails->productName}}</h2>
                    <div class="product-details-price">
                      
                            <span>৳ {{$productDetails->sku->first()->salePrice}} </span>
                        
                       
                        <span class="old">৳ 20.00 </span>
                    </div>
                    <div class="pro-details-rating-wrap">
                        <div class="pro-details-rating">
                            <i class="fa fa-star-o yellow"></i>
                            <i class="fa fa-star-o yellow"></i>
                            <i class="fa fa-star-o yellow"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <span><a href="#">3 Reviews</a></span>
                    </div>
                    <p>{!! $productDetails->details->fabricDetails !!}</p>
                    <div class="pro-details-list">
                        <ul>
                            <li>- 0.5 mm Dail</li>
                            <li>- Inspired vector icons</li>
                            <li>- Very modern style </li>
                        </ul>
                    </div>
                    <div class="pro-details-size-color">
                        <div class="pro-details-color-wrap">
                            <span>Color</span>
                            <div class="pro-details-color-content">
                                <!-- <ul>
                                    <li class="blue"></li>
                                    <li class="maroon active"></li>
                                    <li class="gray"></li>
                                    <li class="green"></li>
                                    <li class="yellow"></li>
                                </ul> -->

                                <!-- select color -->
                                {{-- @dd($productDetails->sku->first()->skuId); --}}
                                @foreach($productDetails->sku as $productsku)
                                @foreach($productsku->variationRelation as $variationRelation)
                                 
                                @if($variationRelation->variationDetailsdata->variationType == "Color")
                                {{-- @dd($variationRelation->variationDetailsdata); --}}
                                    <input type="radio" name="color" id="red" value="{{$variationRelation->variationDetailsdata->variationId}}" />
                                    <label for="red"><span style="background: {{$variationRelation->variationDetailsdata->variationValue}}" class=""></span></label>
                                @endif
                                @endforeach
                                @endforeach
                              
                            </div>
                        </div>
                        <div class="pro-details-size">
                            <span>Size</span>
                            <div class="pro-details-size-content">
                                <!-- <ul>
                                    <li><a href="#">s</a></li>
                                    <li><a href="#">m</a></li>
                                    <li><a href="#">l</a></li>
                                    <li><a href="#">xl</a></li>
                                    <li><a href="#">xxl</a></li>
                                </ul> -->

                                <!-- select size -->
                                @foreach($productDetails->sku as $productsku)
                                @foreach($productsku->variationRelation as $variationRelation)
                                 
                                @if($variationRelation->variationDetailsdata->variationType == "Size")
                                {{-- @dd($variationRelation->variationDetailsdata); --}}
                                <input type="radio" id="size-1" name="size" value="{{$variationRelation->variationDetailsdata->variationId}}">
                                <label for="size-1" class="text-center">
                                    <div class="variant-select_wrapper">
                                        <span class="variant-select__title">{{$variationRelation->variationDetailsdata->variationValue}}</span>
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
                        <div class="pro-details-cart btn-hover">
                            <a href="#" onclick="addTocart()">Add To Cart</a>
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
                <a data-toggle="tab" href="#des-details3">Reviews (2)</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details2" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p>{!! $productDetails->details->description!!}</p>
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
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="assets/img/testimonial/1.jpg" alt="">
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
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
                                            <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                euismod vehicula. Phasellus quam nisi, congue id nulla.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="assets/img/testimonial/2.jpg" alt="">
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
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
                                            <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Sus pen disse viverra ed viverra. Mauris ullarper
                                                euismod vehicula. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="ratting-form-wrapper pl-50">
                                <h3>Add a Review</h3>
                                <div class="ratting-form">
                                    <form action="#">
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
                                                <input type="radio" id="1-star" name="rating" value="1" />
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
                                                    <textarea name="Your Review" placeholder="Message"></textarea>
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
            <div class="product-wrap mb-25">
                <div class="product-img">
                    <a href="product-details.html">
                        <img class="default-img" src="assets/img/product/hm29-pro-9.jpg" alt="">
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
                            <a href="#" data-toggle="modal" data-target="#quickView"><i class="pe-7s-look"></i></a>
                        </div>
                    </div>
                </div>
                <div class="product-content text-center">
                    <h3><a href="product-details.html">Product Title Here</a></h3>
                    <div class="product-price">
                        <span>৳ 60.00</span>
                    </div>
                </div>
            </div>
            <div class="product-wrap mb-25">
                <div class="product-img">
                    <a href="product-details.html">
                        <img class="default-img" src="assets/img/product/hm29-pro-10.jpg" alt="">
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
                            <a href="#" data-toggle="modal" data-target="#quickView"><i class="pe-7s-look"></i></a>
                        </div>
                    </div>
                </div>
                <div class="product-content text-center">
                    <h3><a href="product-details.html">Product Title Here</a></h3>
                    <div class="product-price">
                        <span>৳ 60.00</span>
                        <span class="old">৳ 60.00</span>
                    </div>
                </div>
            </div>
            <div class="product-wrap mb-25">
                <div class="product-img">
                    <a href="product-details.html">
                        <img class="default-img" src="assets/img/product/hm29-pro-11.jpg" alt="">
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
                            <a href="#" data-toggle="modal" data-target="#quickView"><i class="pe-7s-look"></i></a>
                        </div>
                    </div>
                </div>
                <div class="product-content text-center">
                    <h3><a href="product-details.html">Product Title Here</a></h3>
                    <div class="product-price">
                        <span>৳ 60.00</span>
                    </div>
                </div>
            </div>
            <div class="product-wrap mb-25">
                <div class="product-img">
                    <a href="product-details.html">
                        <img class="default-img" src="assets/img/product/hm29-pro-12.jpg" alt="">
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
                            <a href="#" data-toggle="modal" data-target="#quickView"><i class="pe-7s-look"></i></a>
                        </div>
                    </div>
                </div>
                <div class="product-content text-center">
                    <h3><a href="product-details.html">Product Title Here</a></h3>
                    <div class="product-price">
                        <span>৳ 60.00</span>
                        <span class="old">৳ 60.00</span>
                    </div>
                </div>
            </div>
            <div class="product-wrap mb-25">
                <div class="product-img">
                    <a href="product-details.html">
                        <img class="default-img" src="assets/img/product/hm29-pro-10.jpg" alt="">
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
                            <a href="#" data-toggle="modal" data-target="#quickView"><i class="pe-7s-look"></i></a>
                        </div>
                    </div>
                </div>
                <div class="product-content text-center">
                    <h3><a href="product-details.html">Product Title Here</a></h3>
                    <div class="product-price">
                        <span>৳ 60.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- related product start -->

@endsection

@section('js')

<script>
    let sku='{{$productDetails->sku->first()->skuId}}'
    

    function addTocart(){
       
        let quantity=$('#quantity').val() ;
        
        $.ajax({
            type: "post",
            url: "{{route('product.addTocart')}}",
            data:{
                _token:'{{csrf_token()}}',
                _sku:sku,
                _quantity:quantity
            },
            success: function (response) {
                console.log(response);
                $('#cartPage').empty().html(response.cart)
                $('#mobile-cart').html(`<i class="fas fa-shopping-bag"></i> <br>Cart(${response.cartQuantity})`);
                toastr.success('Item added to cart')
            },
            error:(response)=>{
            toastr.error('Out of quantity')
            }
        });
    }

    function removeItem(id) {
            $.ajax({
                type: "POST",
                url: "{{route('product.cartRemove')}}",
                data: {
                    _token:'{{csrf_token()}}',
                    _sku:id,
                },
                success: function (response) {
                    $('#cartPage').empty().html(response.cart);
                    $('#mobile-cart').html(`<i class="fas fa-shopping-bag"></i> <br> Cart(${response.cartQuantity})`);
                    toastr.success('Item delete from cart')
                }
            });
        }

</script>


@endsection