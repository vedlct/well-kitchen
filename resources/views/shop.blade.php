@extends('layouts.layout')
@section('container')
<div class="breadcrumb-area pt-35">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/shop')}}">Shop</a>
                </li>
                <li class="active">Men dresses </li>
            </ul>
        </div>
    </div>
</div>

<!-- shop area start -->
<div class="shop-area pt-60 pb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="shop-top-bar">
                    <div class="select-shoing-wrap">
                        <div class="shop-select">
                            <select>
                                <option value="">Sort by newness</option>
                                <option value="">A to Z</option>
                                <option value=""> Z to A</option>
                                <option value="">In stock</option>
                            </select>
                        </div>
                        <p>Showing 1–12 of 20 result</p>
                    </div>
                    <div class="column-select-area d-none d-md-block">
                        <a href="#" class="line-item" onclick="showTwoCol()">
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                        </a>
                        <a href="#" class="line-item" onclick="showThreeCol()">
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                        </a>
                        <a href="#" class="line-item" onclick="showFourCol()">
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                        </a>
                    </div>
                </div>
                <div class="shop-bottom-area mt-35">
                    <div class="tab-content jump">
                        <div id="productdetails"></div>
                        <div id="shop-1" class="tab-pane active">
                            <div class="row">
                                @foreach ($skus->unique('fkproductId') as $sku)
                                    @if(!empty($sku->product()))
                                <div class="col-6 col-md-4 shop-col-item">
                                    <div class="product-wrap mb-25 scroll-zoom">
                                        <div class="product-img">
                                            <a href="{{route('product.details',$sku->skuId)}}">
                                                <img class="default-img" src="{{asset('admin/public/featureImage/'.$sku->product()->first()->featureImage)}}" alt="">
                                            </a>
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
                    </div>
{{--                    {{ $products->links() }}--}}
                    <div class="pro-pagination-style text-center mt-30">
                        <ul>
                            <li><a class="prev" href="#"><i class="fa fa-angle-double-left"></i></a></li>
                            <li><a class="active" href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a class="next" href="#"><i class="fa fa-angle-double-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar-style mr-30">
                    <div class="sidebar-widget">
                        <h4 class="pro-sidebar-title">Search </h4>
                        <div class="pro-sidebar-search mb-50 mt-25">
                            <form class="pro-sidebar-search-form" action="#">
                                <input type="text" placeholder="Search here...">
                                <button>
                                    <i class="pe-7s-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget">
                        <h4 class="pro-sidebar-title">Refine By </h4>
                        <div class="sidebar-widget-list mt-30">
                            <ul>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox"> <a href="#">On Sale <span>4</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">New <span>4</span></a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">In Stock <span>4</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget mt-45">
                        <h4 class="pro-sidebar-title">Filter By Price </h4>
                        <div class="price-filter mt-10">
                            <div class="price-slider-amount">
                                <input type="text" id="amount" name="price"  placeholder="Add Your Price" />
                            </div>
                            <div id="slider-range"></div>
                        </div>
                    </div>

                    <div class="sidebar-widget mt-50">
                        <h4 class="pro-sidebar-title">Colour </h4>
                        <div class="sidebar-widget-list mt-20">
                            <ul>
                                @foreach($skus as $productsku)
                                    @foreach($productsku->variationRelation as $variationRelation)
                                        @if($variationRelation->variationDetailsdata->variationType == "Color")
                                            <li>
                                                <div class="sidebar-widget-list-left">
{{--                                                    <a  href="#" onclick="filterSize({{$variationRelation->variationDetailsdata->variationId}})">--}}
                                                    <input type="checkbox" class="colorCheck" value="{{$variationRelation->variationDetailsdata->variationId}}"><a
                                                        href=""> {{ array_key_exists($variationRelation->variationDetailsdata->variationValue, unserialize(COLOR_CODE)) ? unserialize(COLOR_CODE)[$variationRelation->variationDetailsdata->variationValue] : unserialize(COLOR_CODE)["NOT"]  }}</a>
                                                    <span style="background: {{$variationRelation->variationDetailsdata->variationValue}}" class="checkmark"></span>
{{--                                                    </a>--}}
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget mt-40">
                        <h4 class="pro-sidebar-title">Size </h4>
                        <div class="sidebar-widget-list mt-20">
                            <ul>
                                @foreach($skus as $productsku)
                                    @foreach($productsku->variationRelation as $variationRelation)
                                        @if($variationRelation->variationDetailsdata->variationType == "Size")
                                            <li>
                                                <div class="sidebar-widget-list-left">
{{--                                                    <a  href="#" onclick="filterSize({{$variationRelation->variationDetailsdata->variationId}})">--}}
                                                    <input type="checkbox" class="sizeCheck" value="{{$variationRelation->variationDetailsdata->variationId}}" ><a
                                                        href=""> {{ $variationRelation->variationDetailsdata->variationValue }}</a>
                                                    <span class="checkmark" ></span>
{{--                                                    </a>--}}
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget mt-50">
                        <h4 class="pro-sidebar-title">Tag </h4>
                        <div class="sidebar-widget-tag mt-25">
                            <ul>
                                <li><a href="#">Clothing</a></li>
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">For Men</a></li>
                                <li><a href="#">Women</a></li>
                                <li><a href="#">Fashion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shop area end -->

@endsection

@section('js')
    <script>
        // let allc = [];
        {{--function filterSize(id)--}}
        {{--{--}}

        {{--    console.log(id);--}}
        {{--    // console.log(allc);--}}
        {{--    if(this.checked) {--}}
        {{--        allc.push(id);--}}
        {{--    }--}}
        {{--    console.log(allc);--}}
        {{--    variationId = id;--}}
        {{--    $.ajax({--}}
        {{--        url: "{{route('variation.choose')}}",--}}
        {{--        method: 'POST',--}}
        {{--        data: {--}}
        {{--            _token: "{{csrf_token()}}",--}}
        {{--            // variationRelationId: variationRelationId,--}}
        {{--        },--}}
        {{--        success: function(data){--}}
        {{--            console.log(data);--}}
        {{--            // var data = data;--}}
        {{--            // $('.salePrice').empty().append("<span>"+"৳ "+data.sku.salePrice+"</span>")--}}
        {{--            // $('.addtocartsku').empty().append("<a href='#' onclick='addTocart("+data.sku.skuId+")'>Add To Cart</a>");--}}
        {{--            // $.each(data.variationDatas, function (key, val)--}}
        {{--            // {--}}
        {{--            //     if(val.variation_detailsdata.variationType == "Color"){--}}
        {{--            //         $('#colors').empty().append("<span>Color</span><div class='pro-details-color-content'><input type='radio' id=`red"+val.variation_detailsdata.variationId+"` name='color'> <label for=`red"+val.variation_detailsdata.variationId+"` class='text-center'><span class='' onclick='changeVariation("+val.variationRelationId+")' style='background:"+ val.variation_detailsdata.variationValue+"'></span></label></div>")--}}
        {{--            //     }--}}
        {{--            //     if(val.variation_detailsdata.variationType == "Size"){--}}
        {{--            //         $('#sizes').empty().append("<span>Size</span><div class='pro-details-size-content'><input type='radio' id=`size-1"+val.variation_detailsdata.variationId+"` name='size'> <label for=`size-1"+val.variation_detailsdata.variationId+"` class='text-center'><div class='variant-select_wrapper'><span class='variant-select__title' onclick='changeVariation("+val.variationRelationId+")'>"+val.variation_detailsdata.variationValue+"</span></div></label></div>")--}}
        {{--            //     }--}}
        {{--            // });--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}

        {{--function readyFn() {--}}
        {{--    var category_id = {{$categoriesid}} ;--}}
        {{--    $.ajax({--}}
        {{--        url: "{{route('all-products')}}",--}}
        {{--        method: 'POST',--}}
        {{--        data: {--}}
        {{--            _token: "{{csrf_token()}}",--}}
        {{--            categoryId: category_id--}}
        {{--        },--}}
        {{--        success: function (data) {--}}
        {{--            $("#productdetails").html(data);--}}
        {{--        }--}}
        {{--    });--}}
        {{--};--}}
        {{--$(document).ready(readyFn);--}}

        var catSS = [];
        $(".catCheck").change(function() {
            if(this.checked) {
                catSS.push(this.value);
            }else{
                if(jQuery.inArray(this.value, catSS) !== -1){
                    if (catSS.indexOf(this.value) !== -1) catSS.splice(catSS.indexOf(this.value), 1);
                }
            }
            filter();
        });

        var colorSS = [];
        $(".colorCheck").change(function() {
            if(this.checked) {
                colorSS.push(this.value);
            }else{
                if(jQuery.inArray(this.value, colorSS) !== -1){
                    if (colorSS.indexOf(this.value) !== -1) colorSS.splice(colorSS.indexOf(this.value), 1);
                }
            }
            filter();
        });
        var sizeSS = [];
        $(".sizeCheck").change(function(){
            if(this.checked){
                sizeSS.push(this.value);
            }else{
                if(jQuery.inArray(this.value, sizeSS) !== -1){
                    if(sizeSS.indexOf(this.value) !== -1) sizeSS.splice(sizeSS.indexOf(this.value), 1);
                }
            }
            filter()
        });
        function  filter(){
            $.ajax({
                url: "{{route('filter.products')}}",
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    catSS: catSS,
                    colorSS: colorSS,
                    sizeSS: sizeSS
                },
                success: function(data) {
                    console.log(data);
                    $("#shop-1").hide();
                    $("#productdetails").html(data);
                }
            });
        }

    </script>
@endsection
