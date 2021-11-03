@extends('layouts.layout')
@section('container')
<div class="breadcrumb-area pt-35">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li>
                    <a href="{{route('home')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('category.products')}}">Category</a>
                </li>

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
            </ul>
        </div>
    </div>
</div>

<!-- shop area start -->
<div class="shop-area pt-60 pb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-12">
                <div class="shop-top-bar">
                    <div class="select-shoing-wrap">
                        <div class="shop-select">

                            <select name="price"  onchange="getPrice(this);">

                                <option value="">Sort by...</option>
                                <option value="a-z">A to Z</option>
                                <option value="z-a"> Z to A</option>
                                <option value="High to Low">High to Low </option>
                                <option value="Low to High">Low to High</option>
                                <option value="instock">In stock</option>
                            </select>
                        </div>
{{--                        <p>Showing 1–12 of 20 result</p>--}}
                    </div>
                    <div class="column-select-area d-none d-md-block">
                        <a href="javascript: void(0)" class="line-item" onclick="showTwoCol()">
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                        </a>
                        <a href="javascript: void(0)" class="line-item" onclick="showThreeCol()">
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                        </a>
                        <a href="javascript: void(0)" class="line-item" onclick="showFourCol()">
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                            <span class="line-single">|</span>
                        </a>
                    </div>
                </div>
                <div class="shop-bottom-area mt-35">
                    {{-- <div class="tab-content jump">
                        <div id="shop-1" class="tab-pane active">

                        <div id="productdetails"></div>

                            <div class="pro-pagination-style text-center mt-30 yy">

                               {{ $skus->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div> --}}
                    <div class="tab-content jump">
                        <div id="shop-1" class="tab-pane active">

                             





<div id="productShorting">
    <div class="row" id="">

        @foreach ($skuss->unique('fkproductId') as $sku)
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
                                    <a title="Wishlist" href="javascript: void(0)" onclick="addToWishList({{$sku->skuId}})"><i class="pe-7s-like"></i></a>
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
                            <h3><a href="{{route('product.details',$sku->skuId)}}">{{substr($sku->product()->first()->productName, 0, 16)."..."}}</a></h3>
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
                </div>
            </div>
        
        </div>
    </div>
</div>

<!-- shop area end -->

@endsection

@section('js')

    <script>


        let sks;
        let  categoryId = {{$categoryId}};
        let  max = {{$minmaxPrice?$minmaxPrice->max_price:''}}
        let  min = {{$minmaxPrice?$minmaxPrice->min_price:''}}
        console.log(min);

        var sliderrange = $("#slider-range");
        var amountprice = $("#amount");
        $(function () {
          sliderrange.slider({
            range: true,
            min: min,
            max: max,
            values: [min, max],
            slide: function (event, ui) {
              amountprice.val("৳ " + ui.values[0] + " - ৳ " + ui.values[1]);
            },
          });
          amountprice.val(
            "৳ " +
              sliderrange.slider("values", 0) +
              " - ৳ " +
              sliderrange.slider("values", 1)
          );
        });

        function readyFn() {
            filter();
        };

        $(document).ready(readyFn);




        
        $("#slider-range").click(function (){

            $( "#slider-range" ).slider({
                change: function( event, ui ) {
                    priceMin=(ui.values[0]);
                    priceMax=(ui.values[1]);
                    filter();
                }
            });

        });

        function  filter(){
            $.ajax({
                url: "{{route('filter.products')}}",
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    // catSS: catSS,
                    colorSS: colorSS,
                    sizeSS: sizeSS,
                    saleSS: saleSS,
                    newSS: newSS,
                    instockSS: instockSS,
                    priceMin: priceMin,
                    priceMax: priceMax,
                    alphaOrderSS: alphaOrderSS,
                    categoryId: categoryId
                },
                success: function(data) {
                    console.log(data);
                    $(document).on('click', '.page', function(event){
                        event.preventDefault();
                        let page = $(this).data('page_id');
                        console.log(sks);
                        $.ajax({
                            url: "{{route('filter.products')}}",
                            method: 'POST',
                            data: {
                                _token: "{{csrf_token()}}",
                                page : page,
                                colorSS: colorSS,
                                sizeSS: sizeSS,
                                saleSS: saleSS,
                                newSS: newSS,
                                instockSS: instockSS,
                                priceMin: priceMin,
                                priceMax: priceMax,
                                alphaOrderSS: alphaOrderSS,
                                categoryId: categoryId
                                // sks: sks
                            },
                            success: function(data) {
                                console.log(data);
                                $("#productdetails").html(data.html);
                                $(window).scrollTop(0);

                            }
                        });
                    });


                    $(document).on('click', '.prev,.next', function(event){
                        event.preventDefault();

                        let container = $(this).closest('.pager');
                        let page =parseInt(container.find('.active').text());
                        let clicked_class = $(this).hasClass('prev');
                        if(clicked_class)
                        {
                            --page;
                        }
                        else{
                            page++;
                        }
                        $.ajax({
                            url: "{{route('filter.products')}}",
                            method: 'POST',
                            data: {
                                _token: "{{csrf_token()}}",
                                page : page,
                                colorSS: colorSS,
                                sizeSS: sizeSS,
                                saleSS: saleSS,
                                newSS: newSS,
                                instockSS: instockSS,
                                priceMin: priceMin,
                                priceMax: priceMax,
                                alphaOrderSS: alphaOrderSS,
                                categoryId: categoryId
                            },
                            success: function(data) {

                                $("#productdetails").html(data.html);
                                $(window).scrollTop(0);

                            }
                        });
                    });
                    $("#productdetails").html(data.html);

                }
            });
        }


        function getPrice(sel)
	{
        console.log('sel',sel.value);
        price = sel.value;
		 if(price){
			// $('#pre-loader').show()
            $.ajax({
                type: "POST",
                url: "{{route('price.filter')}}",
                data: {
                    _token:'{{csrf_token()}}',
                    price:price,
                    categoryId: categoryId
                },
                success: function (response) {
                    console.log('res',response);
                    // $('#filteredPackage').html('')
                    $('#productShorting').html('')
                    $('#productShorting').html(response.html)
                    $("#productdetails").html(response.html);
                    // $('#filteredPackage').html(response.html)
                    // $('#pre-loader').hide()
                },
                error:((error)=>{
                    console.log(error);
                })
            });
		 }

	}







        {{--$(document).on('click', '.page', function(event){--}}
        {{--    event.preventDefault();--}}
        {{--    let page = $(this).data('page_id');--}}
        {{--    // alert(page);--}}
        {{--    // console.log(page);--}}
        {{--    console.log(sks);--}}
        {{--    $.ajax({--}}
        {{--        url: "{{route('filter.products')}}",--}}
        {{--        method: 'POST',--}}
        {{--        data: {--}}
        {{--            _token: "{{csrf_token()}}",--}}
        {{--            page : page,--}}
        {{--           --}}
        {{--            // sks: sks--}}
        {{--        },--}}
        {{--        success: function(data) {--}}
        {{--            console.log('ffff');--}}
        {{--            console.log(data);--}}
        {{--            $("#productdetails").html(data.html);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}


        {{--$(document).on('click', '.prev,.next', function(event){--}}
        {{--    event.preventDefault();--}}

        {{--    let container = $(this).closest('.pager');--}}
        {{--    let page =parseInt(container.find('.active').text());--}}
        {{--    let clicked_class = $(this).hasClass('prev');--}}
        {{--    if(clicked_class)--}}
        {{--    {--}}
        {{--        --page;--}}
        {{--    }--}}
        {{--    else{--}}
        {{--            page++;--}}
        {{--    }--}}
        {{--    $.ajax({--}}
        {{--        url: "{{route('filter.products')}}",--}}
        {{--        method: 'POST',--}}
        {{--        data: {--}}
        {{--            _token: "{{csrf_token()}}",--}}
        {{--            page : page--}}
        {{--        },--}}
        {{--        success: function(data) {--}}
        {{--            console.log(data);--}}
        {{--            $("#productdetails").html(data.html);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endsection
