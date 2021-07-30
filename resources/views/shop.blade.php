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
            <div class="col-lg-9">
                <div class="shop-top-bar">
                    <div class="select-shoing-wrap">
                        <div class="shop-select">
                         
                            <select name="price" onchange="getPrice(this);">
                              
                                <option value="">Sort by...</option>
                                <option value="A">A to Z</option>
                                <option value="Z"> Z to A</option>
                                <option value="High to Low">High to Low</option>
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
                    <div class="tab-content jump">
                        <div id="shop-1" class="tab-pane active">

                        <div id="productdetails"></div>

                            <div class="pro-pagination-style text-center mt-30 yy">

{{--                                {{ $skus->links('vendor.pagination.custom') }}--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar-style mr-30">
                    <div class="sidebar-widget">
                        <h4 class="pro-sidebar-title">Refine By </h4>
                        <div class="sidebar-widget-list mt-30">
                            <ul>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" class="saleCheck" value="discount"> <a href="javascript:void(0)">On Sale </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" class="newCheck" value="new"> <a href="javascript:void(0)">New </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" class="instockCheck" value="instock"> <a href="javascript:void(0)">In Stock </a>
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
                                <input type="text" id="amount" readonly class="priceCheck" name="price"  placeholder="Add Your Price" />
                            </div>
                            <div id="slider-range"></div>
                        </div>
                    </div>

                    <div class="sidebar-widget mt-50">
                        @if($variationColorIds->count() > 0)
                        <h4 class="pro-sidebar-title">Colour </h4>
                        @endif
                        <div class="sidebar-widget-list mt-20">
                            <ul>
                               
                                @foreach($variations->unique('variationData') as $variationRelation)
                                        @if($variationRelation->variationDetailsdata->variationType == "Color")
                                            <li>
                                                <div class="sidebar-widget-list-left">
                                                    <input type="checkbox" class="colorCheck" value="{{$variationRelation->variationDetailsdata->variationId}}"><a
                                                        href=""> {{ array_key_exists($variationRelation->variationDetailsdata->variationValue, unserialize(COLOR_CODE)) ? unserialize(COLOR_CODE)[$variationRelation->variationDetailsdata->variationValue] : unserialize(COLOR_CODE)["NOT"]  }}</a>
                                                    <span style="background: {{$variationRelation->variationDetailsdata->variationValue}}" class="checkmark"></span>
                                                </div>
                                            </li>
                                        @endif
                                @endforeach

                                {{-- @foreach($skus as $productsku)
                                 @if(isset($productsku->variationRelation))
                                    @foreach($productsku->variationRelation as $variationRelation)
                                        @if($variationRelation->variationDetailsdata->variationType == "Color")
                                            <li>
                                                <div class="sidebar-widget-list-left">
                                                    <input type="checkbox" class="colorCheck" value="{{$variationRelation->variationDetailsdata->variationId}}"><a
                                                        href=""> {{ array_key_exists($variationRelation->variationDetailsdata->variationValue, unserialize(COLOR_CODE)) ? unserialize(COLOR_CODE)[$variationRelation->variationDetailsdata->variationValue] : unserialize(COLOR_CODE)["NOT"]  }}</a>
                                                    <span style="background: {{$variationRelation->variationDetailsdata->variationValue}}" class="checkmark"></span>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                  @endif
                                @endforeach --}}
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget mt-40">
                        @if($variationSizeIds->count() > 0)
                        <h4 class="pro-sidebar-title">Size </h4>
                        @endif
                        <div class="sidebar-widget-list mt-20">
                            <ul>
                                @foreach($variations->unique('variationData') as $variationRelation)
                                        @if($variationRelation->variationDetailsdata->variationType == "Size")
                                            <li>
                                                <div class="sidebar-widget-list-left">
                                                    <input type="checkbox" class="sizeCheck" value="{{$variationRelation->variationDetailsdata->variationId}}" ><a
                                                        href=""> {{ $variationRelation->variationDetailsdata->variationValue }}</a>
                                                    <span class="checkmark" ></span>
                                                </div>
                                            </li>
                                        @endif
                                @endforeach

                                {{-- @foreach($skus as $productsku)
                                  @if(isset($productsku->variationRelation))
                                    @foreach($productsku->variationRelation as $variationRelation)
                                        @if($variationRelation->variationDetailsdata->variationType == "Size")
                                            <li>
                                                <div class="sidebar-widget-list-left">
                                                    <input type="checkbox" class="sizeCheck" value="{{$variationRelation->variationDetailsdata->variationId}}" ><a
                                                        href=""> {{ $variationRelation->variationDetailsdata->variationValue }}</a>
                                                    <span class="checkmark" ></span>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                   @endif
                                @endforeach --}}
                            </ul>
                        </div>
                    </div>
                    {{-- <div class="sidebar-widget mt-50">
                        <h4 class="pro-sidebar-title">Tag </h4>
                        <div class="sidebar-widget-tag mt-25">
                            <ul>
                                @foreach($skus->unique('fkproductId') as $key=>$sku)
                                        <li><a href="#" class="tagCheck">{{$sku->product->tag}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- {{ dd($minmaxPrice->min_price)}} --}}
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




        var alphaOrderSS;
        $(".alphaCheck").change(function() {
            alphaOrderSS = $(".alphaCheck").val();
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

        var saleSS = [];
        $(".saleCheck").change(function() {
            if(this.checked) {
                saleSS.push(this.value);

            }else{
                if(jQuery.inArray(this.value, saleSS) !== -1){
                    if (saleSS.indexOf(this.value) !== -1) saleSS.splice(saleSS.indexOf(this.value), 1);
                }
            }
            filter();
        });

        var newSS = [];
        $(".newCheck").change(function() {

            if(this.checked) {
                newSS.push(this.value); 

            }else{
                if(jQuery.inArray(this.value, newSS) !== -1){
                    if (newSS.indexOf(this.value) !== -1) newSS.splice(newSS.indexOf(this.value), 1);
                }
            }
            filter();
        });

        var instockSS = [];
        $(".instockCheck").change(function() {
            if(this.checked) {
                instockSS.push(this.value);

            }else{
                if(jQuery.inArray(this.value, instockSS) !== -1){
                    if (instockSS.indexOf(this.value) !== -1) instockSS.splice(instockSS.indexOf(this.value), 1);
                }
            }
            filter();
        });

        var priceMin;
        var priceMax;
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
        // console.log('sel',sel.value);
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
