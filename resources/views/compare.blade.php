@extends('layouts.layout')
@section('container')
    <div class="breadcrumb-area pt-35">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li>
                        <a href="{{route('home')}}">Home</a>
                    </li>
                    <li class="active">Compare</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- compare section start -->
    <section class="compare-section-area pt-60 pb-60">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td class="col-4">
                            <h3>Product Comparison</h3>
                            <p>
                                Find and select products to see the differences and similarities between them
                            </p>
                        </td>
                        <td class="col-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control compareProductOne" placeholder="Search & Select Product">
                                <div class="input-group-append">
                                    <span class="input-group-text searchToCompareOne" id="basic-addon2"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="compareImageOne"></div>
                            <div class="compareOneHide">
                            <img src="{{asset('admin/public/featureImage/'.$sku->product->featureImage)}}" alt="" class="img-fluid mb-3 w-100">
                            <h4 class="text-center">
                                <a href="{{route('product.details', $sku->skuId)}}">{{$sku->product->productName}}</a>
                            </h4>
                            <h5 class="text-center compare-price">{{$sku->salePrice}}৳</h5>
                            </div>
                        </td>
                        <td class="col-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control compareProductTwo" placeholder="Search & Select Product">
                                <div class="input-group-append">
                                    <span class="input-group-text searchToCompareTwo" id="basic-addon2"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <p class="text-center find">
                                Find and select product to compare
                            </p>
                            <div class="compareImageTwo"></div>

                        </td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td class="compare-category-one">{{$sku->product->category->categoryName}}</td>
                        <td class="compare-category-two"></td>
                    </tr>
                    <tr>
                        <td>Brand</td>
                        <td class="compare-brand-one">{{$sku->product->brand->brandName}}</td>
                        <td class="compare-brand-two"></td>
                    </tr>
                    <tr>
                        <td>Rating</td>
                        <td>
                            <div class="pro-details-rating-wrap reviews">
                                <div class="pro-details-rating ">

                                    @if($finalRating > 0)
                                        @for ($i = 5; $i >= $finalRating; $i--)
                                            <i class="fa fa-star-o yellow"></i>
                                        @endfor
                                            @for ($i = 0; $i < 5-$finalRating; $i++)
                                                <i class="fa fa-star-o"></i>
                                        @endfor
                                    @else

                                        <i class="fa fa-star-o "></i>
                                        <i class="fa fa-star-o "></i>
                                        <i class="fa fa-star-o "></i>
                                        <i class="fa fa-star-o "></i>
                                        <i class="fa fa-star-o "></i>
                                    @endif


                                </div>
                                <span class="totalReviews">{{$reviews->count()}} Reviews</span>
                            </div>
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>Summary</td>
                        <td>
                            <p class="compare-summary-one">{{ strip_tags($sku->product->details->fabricDetails)}}</p>
                        </td>
                        <td><p class="compare-summary-two"></p></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- compare section end -->

@endsection

@section('js')
    <script>

        $(document).on('click', '.searchToCompareOne', function(){
            
            $(".compareOneHide").hide();
            var searchTxt = $(".compareProductOne").val();

            $.ajax({
                url: "{{route('product.compareSearch')}}",
                method: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    searchTxt: searchTxt,
                },
                success: function (data){
                    console.log(data.product.sku[0]['salePrice']);
                    $(".find").hide();
                    $(".compareImageOne").empty().append('<img src="{{ URL::asset('/admin/public/featureImage') }}/'+data.product["featureImage"]+'" class="img-fluid mb-3 w-100">' +
                        '<h4 class="text-center"><a href="{{URL('product-details/')}}/'+data.product.sku[0]["skuId"]+'">'+data.product["productName"]+'</a></h4>'+
                        '<h5 class="text-center compare-price">'+data.product.sku[0]["salePrice"]+'৳</h5>');
                    $(".compare-category-one").empty().append(data.product.category["categoryName"]);
                    $(".compare-brand-one").empty().append(data.product.brand["brandName"]);
                    $(".compare-summary-one").empty().append(data.product.details["fabricDetails"]);
                    $(".reviews").empty().append(data.reviews);
                }
            });
        });

        $(document).on('click', '.searchToCompareTwo', function(){
            var searchTxt = $(".compareProductTwo").val();
            $.ajax({
               url: "{{route('product.compareSearch')}}",
               method: "POST",
               data: {
                   _token: "{{csrf_token()}}",
                   searchTxt: searchTxt,
               },
                success: function (data){
                   console.log(data.reviews);
                   $(".find").hide();
                    // $(".totalReviews").hide();

                    $(".compareImageTwo").empty().append('<img src="{{ URL::asset('/admin/public/featureImage') }}/'+data.product["featureImage"]+'" class="img-fluid mb-3 w-100">' +
                        '<h4 class="text-center"><a href="{{URL('product-details/')}}/'+data.product.sku[0]["skuId"]+'">'+data.product["productName"]+'</a></h4>'+
                        '<h5 class="text-center compare-price">'+data.product.sku[0]["salePrice"]+'৳</h5>');
                    $(".compare-category-two").empty().append(data.product.category["categoryName"]);
                    $(".compare-brand-two").empty().append(data.product.brand["brandName"]);
                    $(".compare-summary-two").empty().append(data.product.details["fabricDetails"]);
                    // $(".totalReviews").empty().append(<div class="pro-details-rating"><div class="pro-details-rating"></div>);
                }
            });
        });
    </script>
@endsection
