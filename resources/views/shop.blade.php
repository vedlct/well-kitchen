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
                    <a href="{{route('category.products')}}">Shop</a>
                </li>
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
                            <select class="alphaCheck">
                                <option value="">Sort by newness</option>
                                <option value="A">A to Z</option>
                                <option value="Z"> Z to A</option>
                                <option value="instock">In stock</option>
                            </select>
                        </div>
{{--                        <p>Showing 1–12 of 20 result</p>--}}
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
                        <h4 class="pro-sidebar-title">Colour </h4>
                        <div class="sidebar-widget-list mt-20">
                            <ul>
                                @foreach($skus as $productsku)
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
                                                    <input type="checkbox" class="sizeCheck" value="{{$variationRelation->variationDetailsdata->variationId}}" ><a
                                                        href=""> {{ $variationRelation->variationDetailsdata->variationValue }}</a>
                                                    <span class="checkmark" ></span>
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
                                @foreach($skus->unique('fkproductId') as $key=>$sku)
                                        <li><a href="#" class="tagCheck">{{$sku->product->tag}}</a></li>
                                @endforeach

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




        function readyFn() {
            var categoryId = {{$categoryId}} ;
            $.ajax({
                url: "{{route('filter.products')}}",
                method: 'GET',
                data: {
                    _token: "{{csrf_token()}}",
                    categoryId: categoryId
                },
                success: function (data) {
                    console.log(data);
                    $("#productdetails").html(data);
                }
            });
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
                method: 'GET',
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
                },
                success: function(data) {
                    console.log(data);
                    $("#productdetails").html(data);
                    // $(".yy").html(data.html);
                    // $("#shop-1").append("<div class='pro-pagination-style text-center mt-30 pageinateLink'>"+data.skus+"</div>");
{{--                        {{ $skus->links('vendor.pagination.custom') }}--}}
                }
            });
        }

        $(document).on('click', '.page', function(event){
            event.preventDefault();
            let page = $(this).data('page_id');
            {{--  alert(page);  --}}
            $.ajax({
                url: "{{route('filter.products')}}",
                method: 'GET',
                data: {
                    page : page
                },
                success: function(data) {
                    console.log(data);
                    $("#productdetails").html(data);
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
                method: 'GET',
                data: {
                    page : page
                },
                success: function(data) {
                    console.log(data);
                    $("#productdetails").html(data);
                }
            });
        });
    </script>
@endsection
