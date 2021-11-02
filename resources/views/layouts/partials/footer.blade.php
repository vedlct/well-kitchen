<!-- footer start -->
<footer class="footer-area pb-70">
    <div class="container">
        <div class="footer-border pt-100">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="copyright mb-30">
                        <div class="footer-logo">
                            <a href="{{url('/')}}">
                                <img alt="" class="img-fluid" src="{{asset('admin/public/settingImage/'.$setting->imageLink)}}">
                            </a>
                        </div>
                        <p>© 2021 <a href="{{route('home')}}">{{$setting->companyName}}</a><br> All Rights Reserved</p>
                    </div>
                </div>
                {{-- <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="footer-widget mb-30 ml-30">
                        <div class="footer-title">
                            <h3>ABOUT US</h3>
                        </div>
                        <div class="footer-list">
                            <ul>
                                @foreach($menu->where('menuType','Footer')->sortByDesc('menuOrder')->take(4) as $footerMenu)
                                <li><a href="{{route('page',$footerMenu->fkpageId)}}">{{$footerMenu->menuName}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="footer-widget mb-30 ml-50">
                        <div class="footer-title">
                            <h3>USEFUL LINKS</h3>
                        </div>
                        <div class="footer-list">
                            <ul>
                                @foreach($menu->where('menuType','Footer')->sortByDesc('menuOrder')->take(4) as $footerMenu)
                                <li><a href="{{route('page',$footerMenu->fkpageId)}}">{{$footerMenu->menuName}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget mb-30 ml-75">
                        <div class="footer-title">
                            <h3>FOLLOW US</h3>
                        </div>
                        <div class="footer-list">
                            <ul class="social-icon">
                                <li><a href=" {{($setting->facebook)}} "><i class="fa fa-facebook"></i></a></li>
                                <li><a href=" {{($setting->twitter)}} "><i class="fa fa-twitter"></i></a></li>
                                <li><a href=" {{$setting->instagram}} "><i class="fa fa-linkedin"></i></a></li>
                                {{-- <li><a href="#">Youtube</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer-widget mb-30 ml-70">
                        <div class="footer-title">
                            <h3>SUBSCRIBE</h3>
                        </div>
                        <div class="subscribe-style">
                            <p>Get E-mail updates about our latest shop and special offers.</p>
                            <div class="subscribe-form">
                                <form class="validate" novalidate="" target="_blank" name="mc-embedded-subscribe-form" method="post" action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef">
                                    <div class="mc-form">
                                        <input class="email" type="email" required="" placeholder="Enter your email here.." name="EMAIL" value="">
                                        <div class="mc-news" aria-hidden="true">
                                            <input type="text" value="" tabindex="-1" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef">
                                        </div>
                                        <div class="clear">
                                            <input class="button" type="submit" name="subscribe" value="Subscribe">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="payment-img py-3">
                            <img src="{{asset('public/assets/img/card1.jpg')}}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-sm-12 col-xs-12 fff" >
                        <div class="tab-content quickview-big-img imgtab">

                        </div>

                        <div class="quickview-wrap mt-15">
                            <div class="quickview-slide-active owl-carousel nav nav-style-1 imgtaball" role="tablist">

                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="product-details-content quickview-content">
                            <h2 class="pname"></h2>
                            <div class="product-details-price">
                                <span class="salePrice"></span>
                                <span class="old oldprice"></span>
                            </div>
                            <div class="pro-details-rating-wrap">
                                <div class="pro-details-rating starHas" >

{{--                                    <i class="fa fa-star-o yellow"></i>--}}
{{--                                    <i class="fa fa-star-o yellow"></i>--}}
{{--                                    <i class="fa fa-star-o yellow"></i>--}}
{{--                                    <i class="fa fa-star-o"></i>--}}
{{--                                    <i class="fa fa-star-o"></i>--}}
                                </div>
                                <span><span class="reviewsCount"></span> Reviews</span>
                            </div>
                            <p class="productDetail">Lorem ipsum dolor sit amet, consectetur adipisic elit eiusm tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim venialo quis nostrud exercitation ullamco</p>
                            <div class="pro-details-list">
                               <p class="productDescription"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->



<div id="cartPage">
@include('layouts.partials.cartNav')
</div>
<!-- chat icon start -->
{{--<div class="chat-icon-area">--}}
{{--    <i class="fa fa-comment"></i>--}}
{{--</div>--}}
<!-- chat icon end -->


<!-- All JS is here
============================================ -->

<script src="{{asset('public/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('public/assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('public/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('public/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/assets/js/plugins.js')}}"></script>
<!-- Main JS -->
<script src="{{asset('public/assets/js/main.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@yield('js')

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>--}}

  <!-- preloader js -->
  <script>
    $(window).on("load", function(){
      $(".loader_bg").fadeOut("slow");

    });
  </script>

  <script>
      toastr.options.preventDuplicates = true;
    toastr.options.showMethod = 'slideDown';
    @if(session()->has('success'))
    toastr.success('{{session('success')}}');
    @endif
    @if(session()->has('error'))
    toastr.error('{{session('error')}}');
    @endif
    @if(session()->has('warning'))
    toastr.warning('{{session('warning')}}');
    @endif


    $(document).on('click', '.quickView', function(){

        $("#exampleModal").on("hidden.bs.modal", function (e) {
            location.reload();
            // $(".imgtab").ajax.load();

        });
       let sku_id = $(this).data('sku_id');
        // setTimeout(function(){
        //
        // }, 3000);
        $.ajax({
            type: "post",
            url: "{{route('product.quickView')}}",
            data:{
                _token:'{{csrf_token()}}',
                sku_id:sku_id,
            },
            success: function (data) {
                // $(".imgtab").load(location.href + " .imgtab");
                // $(".imgtaball").load(location.href + " .imgtaball");

                // console.log(data);
                $(".pname").html(data.sku.product['productName']);
                $(".productDetail").html(data.sku.product.details['fabricDetails']);
                $(".productDescription").html(data.sku.product.details['description']);

                $.each(data.images, function(k,v) {
                        $(".imgtab").append('<div id="pro-'+k+'" class="tab-pane fade '+(k == 0 ? "show active": "")+' ">' +
                            '<img src="{{ URL::asset('/admin/public/productImages') }}/'+v.image+'"></div>');
                        $(".imgtaball").append('<a data-toggle="tab" href="#pro-'+k+'" class="'+(k == 0 ? "active": "")+' ">' +
                            '<img src="{{ URL::asset('/admin/public/productImages') }}/'+v.image+'"></a>');
                });


                if(data.hotdeal != null && data.discount != null){
                    $('.salePrice').empty().append("<span>"+"৳ "+data.afterDiscountPrice+"</span>")
                    $('.old').empty().append("<span class='old'>"+"৳ "+data.sku.regularPrice+"</span>")
                }
                if(data.hotdeal == null && data.discount != null){
                    $('.salePrice').empty().append("<span>"+"৳ "+data.sku.salePrice+"</span>")
                    $('.old').empty().append("<span class='old'>"+"৳ "+data.sku.regularPrice+"</span>")
                }
                if(data.hotdeal != null && data.discount == null) {
                    $('.salePrice').empty().append("<span>"+"৳ "+data.afterDiscountPrice+"</span>")
                    $('.old').empty().append("<span class='old'>"+"৳ "+data.sku.regularPrice+"</span>")
                }
                if(data.hotdeal == null && data.discount == null) {
                    $('.salePrice').empty().append("<span>"+"৳ "+data.sku.regularPrice+"</span>")
                    $('.old').empty();
                }



                {{--  if(data.hotdeal == null){
                    $(".salePrice").html('৳ '+data.saleprice);
                    $(".oldprice").html('');
                }
                else{
                    $(".salePrice").html('৳ '+data.saleprice);
                    $(".oldprice").html('৳ '+data.oldprice);
                }  --}}
                $(".reviewsCount").html(data.revCount);

                if(data.finalRating > 0) {
                    for ($i = 0; $i <= data.finalRating; $i++) {
                        $(".starHas").append('<i class="fa fa-star-o yellow"></i>')

                    }
                    for ($i = 0; $i < 5 - data.finalRating; $i++) {
                        $(".starHas").append('<i class="fa fa-star-o"></i>')
                    }
                }else {
                    $(".starHas").append(' <i class="fa fa-star-o "></i><i class="fa fa-star-o "></i><i class="fa fa-star-o "></i><i class="fa fa-star-o "></i><i class="fa fa-star-o "></i>')
                }

                $(".quickview-slide-active").owlCarousel({
                    loop: true,
                    navText: [
                        "<i class='fa fa-angle-left'></i>",
                        "<i class='fa fa-angle-right'></i>",
                    ],
                    margin: 15,
                    smartSpeed: 1000,
                    nav: true,
                    dots: false,
                    responsive: {
                        0: {
                            items: 3,
                            autoplay: true,
                            smartSpeed: 300,
                        },
                        576: {
                            items: 3,
                        },
                        768: {
                            items: 3,
                        },
                        1000: {
                            items: 3,
                        },
                    },
                });

                $(".quickview-slide-active a").on("click", function () {
                    $(".quickview-slide-active a").removeClass("active");
                });

            },
        });
    });



    function addTocart(skuId) {
        if(skuId == 0){
            toastr.warning('Please Choose a variation');
        }

        if(skuId != 0){
        let quantity=$('#quantity').val() ;
        if(quantity && quantity >= 1){
            quantity;
        }
        if(!quantity || quantity<1){
            quantity = 1;
        }
        $.ajax({
            type: "post",
            url: "{{route('product.addTocart')}}",
            data:{
                _token:'{{csrf_token()}}',
                _quantity:quantity,
                _sku:skuId
            },
            success: function (response) {
                console.log(response);
                toastr.success('Item Added to Cart');
                var getTotalQuantity=0;
                var getSubTotal=0;
                var cartItems=""

                // $('#cartPage').empty().html(response.cart)
                 $('#headerCartBag').load(document.URL + ' #headerCartBag');
                $('#mobile-cart').html(`<i class="fas fa-shopping-bag"></i> <br>Cart(${response.cartQuantity})`);
                // toastr.success('Item added to cart')

                $.each(response.cart,(index,row)=>
                    {
                        console.log('row',row);
                        // getTotalQuantity+=response.cartQuantity
                        getTotalQuantity+=parseFloat(row.quantity)
                        getSubTotal+=parseFloat(row.price)
                        cartItems+=`<div class="product-area my-md-5 my-4">
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                                        <div>
                                            <img src="{{asset('admin/public/featureImage/')}}/${row.associatedModel.featureImage}" alt="" class="product-img">
                                           </div>
                                            <div class="name-area px-2">
                                            <h5 class="product-name"><a href="javascript:void(0)">${row.name}</a></h5>
                                            <h6 class="quantity">${row.quantity} x &#2547; ${row.price}</h6>
                                            </div>
                                            <div class="" onclick="removeItem(${row.id})">
                                                <i class="fa fa-trash"></i>
                                            </div>
                                        </div>
                                        </div>`
                    })
                    $('#cart').html('')
                    $('#cart').append(`
                        <div class="cart-button-fixed" onclick="showNav()">
                            <i class="pe-7s-shopbag"></i>
                            <h5 class="mb-0">Cart <span class="cart_count">${response.cartQuantity} </span></h5>
                        </div>
                        <div class="full-body-overlay" id="fullBodyOverlay" onclick="hideOverlay()"></div>
                        <section class="side-cart side-nav px-3 py-md-5 py-3" id="sideNav">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Shopping Cart</h4>
                            </div>
                            <div class="">
                                <i class="fa fa-times close-icon" onclick="hideNav()"></i>
                            </div>
                        </div>
                        ${cartItems}

                                ${getSubTotal != 0 ? `<div class="d-flex justify-content-between"><div> <h5>Sub-Total:</h5> </div>
                                <div class="">
                                <h5>&#2547;${response.total}</h5>
                                </div>
                            </div>
                            <div class="row my-md-5 my-4">
                                <div class="col-6">
                                    <a href="{{route('cart')}}" class="btn btn-secondary w-100">View Cart</a>
                                </div>
                                <div class="col-6">
                                    <a href="{{route('checkout.index')}}" class="btn btn-danger w-100">checkout</a>
                                </div>
                            </div>
                            </div>` :`<p style="font-weight: bold; font-size: 14px; text-align: center">Cart Is Empty</p>` }
                        </section>`
                )

            },
            error:function (response){
                toastr.error('Stock not available')
            }
        });
     }
    }

    function addToWishList(skuId){
        $.ajax({
            type: "POST",
            url: "{{route('wishlistAdd')}}",
            data:{
                _token:'{{csrf_token()}}',
                _sku:skuId
            },
            success: function (response) {
                if(response.error == "itemHas") {
                        toastr.warning('You have already added this item');
                    }
                if(response.error == null) {
                    $('.header-wishlist').load(document.URL + ' .header-wishlist');
                        toastr.success('Item added to wishlist');
                    }
                if(response.error == 'login') {
                        toastr.warning('You need to be logged in to add item to wishlist');
                    }
            },
            error:function (response){
            toastr.error('Stock not available')
            }
        });
    }

      {{--function quantityUpdate(data){--}}
      {{--  console.log(data);--}}
      {{--  let qtyvalue = $("#qtyBtn"+data).val();--}}
      {{--    if(qtyvalue && qtyvalue >= 1){--}}
      {{--        qtyvalue--}}
      {{--    }--}}
      {{--    if(!qtyvalue || qtyvalue<1){--}}
      {{--        qtyvalue = 1;--}}
      {{--    }--}}
      {{--    console.log(qtyvalue);--}}
      {{--    $.ajax({--}}
      {{--        type: "POST",--}}
      {{--        url: "{{route('product.cartUpdateQuantity')}}",--}}
      {{--        data: {--}}
      {{--            _token:'{{csrf_token()}}',--}}
      {{--            _sku:data,--}}
      {{--            _quantity:qtyvalue,--}}
      {{--        },--}}
      {{--        success: function (response) {--}}
      {{--          toastr.success('Item removed From Cart');--}}
      {{--          var getTotalQuantity=0;--}}
      {{--          var getSubTotal=0;--}}
      {{--          var cartItems=""--}}
      {{--          //   console.log('res',response);--}}
      {{--          //   $('#cartPage').empty().html(response.cart)--}}
      {{--           $('#headerCartBag').load(document.URL + ' #headerCartBag');--}}
      {{--           $('#mobile-cart').html(`<i class="fas fa-shopping-bag"></i> <br>Cart(${response.cartQuantity})`);--}}
      {{--          //   toastr.success('Item update successfully')--}}
      {{--            $(".updatereload").load(location.href + " .updatereload");--}}
      {{--          //   $(".cartTotal").load(location.href + " .cartTotal");--}}

      {{--          //   $(".total").load(location.href + " .total");--}}
      {{--          //   window.location.reload();--}}
      {{--          $.each(response.cart,(index,row)=>--}}
      {{--              {--}}
      {{--                  // console.log('res',row);--}}
      {{--                  getTotalQuantity+=parseFloat(row.quantity)--}}
      {{--                  getSubTotal+=parseFloat(row.price)--}}
      {{--                  cartItems+=`<div class="product-area my-md-5 my-4">--}}
      {{--                              <div class="d-flex justify-content-between align-items-center border-bottom py-2">--}}
      {{--                                  <div>--}}
      {{--                                      <img src="{{asset('admin/public/featureImage/')}}/${row.associatedModel.featureImage}" alt="" class="product-img">--}}
      {{--                                  </div>--}}
      {{--                                      <div class="name-area px-2">--}}
      {{--                                      <h5 class="product-name"><a href="javascript:void(0)">${row.name}</a></h5>--}}
      {{--                                      <h6 class="quantity">${row.quantity} x &#2547; ${row.price}</h6>--}}
      {{--                                      </div>--}}
      {{--                                      <div class="" onclick="removeItem(${row.id})">--}}
      {{--                                          <i class="fa fa-trash"></i>--}}
      {{--                                      </div>--}}
      {{--                                  </div>--}}
      {{--                                  </div>`--}}

      {{--              })--}}
      {{--              $('#cart').html('')--}}
      {{--              $('#cart').append(`--}}
      {{--                  <div class="cart-button-fixed" onclick="showNav()" id="cartNav">--}}
      {{--                      <i class="pe-7s-shopbag"></i>--}}
      {{--                      <h5 class="mb-0">Cart <span class="cart_count">${response.cartQuantity} </span></h5>--}}
      {{--                  </div>--}}
      {{--                  <div class="full-body-overlay" id="fullBodyOverlay" onclick="hideOverlay()"></div>--}}
      {{--                  <section class="side-cart side-nav px-3 py-md-5 py-3" id="sideNav">--}}
      {{--                  <div class="d-flex justify-content-between">--}}
      {{--                      <div>--}}
      {{--                          <h4>Shopping Cart</h4>--}}
      {{--                      </div>--}}
      {{--                      <div class="">--}}
      {{--                          <i class="fa fa-times close-icon" onclick="hideNav()"></i>--}}
      {{--                      </div>--}}
      {{--                  </div>--}}
      {{--                  ${cartItems}--}}

      {{--                          ${getSubTotal != 0 ? `<div class="d-flex justify-content-between"><div> <h5>Sub-Total:</h5> </div>--}}
      {{--                          <div class="">--}}
      {{--                          <h5>&#2547;${response.total}</h5>--}}
      {{--                          </div>--}}
      {{--                      </div>--}}
      {{--                      <div class="row my-md-5 my-4">--}}
      {{--                          <div class="col-6">--}}
      {{--                              <a href="{{route('cart')}}" class="btn btn-secondary w-100">View Cart</a>--}}
      {{--                          </div>--}}
      {{--                          <div class="col-6">--}}
      {{--                              <a href="{{route('checkout.index')}}" class="btn btn-danger w-100">checkout</a>--}}
      {{--                          </div>--}}
      {{--                      </div>--}}
      {{--                      </div>` :`<p style="font-weight: bold; font-size: 14px; text-align: center">Cart Is Empty</p>` }--}}
      {{--                  </section>`--}}
      {{--              )--}}

      {{--        },--}}
      {{--        error:function (response){--}}
      {{--            toastr.error('Stock not available')--}}
      {{--        }--}}
      {{--    });--}}
      {{--}--}}


      function removeItem(id) {

        $.ajax({
            type: "POST",
            url: "{{route('product.cartRemove')}}",
            data: {
                _token:'{{csrf_token()}}',
                skuId:id,
            },
            success: function (response) {
                toastr.success('Item removed From Cart');
                var getTotalQuantity=0;
                var getSubTotal=0;
                var cartItems=""

                $('#headerCartBag').load(document.URL + ' #headerCartBag');
                $(".updatereload").load(location.href + " .updatereload");
                // $("#discountValue").load(" #discountValue");

                $('#mobile-cart').html(`<i class="fas fa-shopping-bag"></i> <br>Cart(${response.cartQuantity})`);


                $.each(response.cart,(index,row)=>
                    {
                        console.log('row',row);
                        // getTotalQuantity+=response.cartQuantity
                        getTotalQuantity+=parseFloat(row.quantity)
                        getSubTotal+=parseFloat(row.price)
                        cartItems+=`<div class="product-area my-md-5 my-4">
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                           <div>
                                                <img src="{{asset('admin/public/featureImage/')}}/${row.associatedModel.featureImage}" alt="" class="product-img">
                                           </div>
                                            <div class="name-area px-2">
                                            <h5 class="product-name"><a href="javascript:void(0)">${row.name}</a></h5>
                                            <h6 class="quantity">${row.quantity} x &#2547; ${row.price}</h6>
                                            </div>
                                            <div class="" onclick="removeItem(${row.id})">
                                                <i class="fa fa-trash"></i>
                                            </div>
                                        </div>
                                        </div>`
                    })
                    $('#cart').html('')
                    $('#cart').append(`
                        <div id="cart">
                            <div class="cart-button-fixed" onclick="showNav()">
                            <i class="pe-7s-shopbag"></i>
                            <h5 class="mb-0">Cart <span class="cart_count">${response.cartQuantity} </span></h5>
                        </div>
                        <div class="full-body-overlay" id="fullBodyOverlay" onclick="hideOverlay()" style="display: block;"></div>
                        <section class="side-cart side-nav px-3 py-md-5 py-3" id="sideNav" style="right: 0px;">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Shopping Cart</h4>
                            </div>
                            <div class="">
                                <i class="fa fa-times close-icon" onclick="hideNav()"></i>
                            </div>
                        </div>
                        ${cartItems}
                        ${getSubTotal != 0 ? `<div class="d-flex justify-content-between cartTable"><div> <h5>Sub-Total:</h5> </div>
                                <div class="">
                                <h5 class="subTotal">&#2547;${response.subTotal}</h5>
                                </div>
                            </div>
                            <div class="row my-md-5 my-4">
                                <div class="col-6">
                                    <a href="{{route('cart')}}" class="btn btn-secondary w-100">View Cart</a>
                                </div>
                                <div class="col-6">
                                    <a href="{{route('checkout.index')}}" class="btn btn-danger w-100">checkout</a>
                                </div>
                            </div></section>` :`<h3 class="emptyCart">Cart is empty</h3>` }
                        </div>`
                    )
            },
              error:function (response){
                  toastr.error('Stock not available')
              }
        });
    }

</script>


</body>

</html>
