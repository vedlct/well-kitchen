<!-- footer start -->
<footer class="footer-area pb-70">
    <div class="container">
        <div class="footer-border pt-100">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="copyright mb-30">
                        <div class="footer-logo">
                            <a href="{{url('/')}}">
                                <img alt="" class="img-fluid" src="{{asset('public/assets/img/logo/logo.png')}}">
                            </a>
                        </div>
                        <p>© 2021 <a href="#">Well Kitchen</a><br> All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="footer-widget mb-30 ml-30">
                        <div class="footer-title">
                            <h3>ABOUT US</h3>
                        </div>
                        <div class="footer-list">
                            <ul>
                                <li><a href="{{url('/about')}}">About us</a></li>
                                <li><a href="{{url('/contact')}}">Contact</a></li>
                                <li><a href="{{url('/faq')}}">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="footer-widget mb-30 ml-50">
                        <div class="footer-title">
                            <h3>USEFUL LINKS</h3>
                        </div>
                        <div class="footer-list">
                            <ul>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Support Policy</a></li>
                                <li><a href="#">Size guide</a></li>
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
                            <ul>
                                <li><a href="#">Facebook</a></li>
                                <li><a href="#">Twitter</a></li>
                                <li><a href="#">Instagram</a></li>
                                <li><a href="#">Youtube</a></li>
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
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="tab-content quickview-big-img">
                            <div id="pro-1" class="tab-pane fade show active">
                                <img src="{{asset('public/assets/img/product/quickview-l1.jpg')}}" alt="">
                            </div>
                            <div id="pro-2" class="tab-pane fade">
                                <img src="{{asset('public/assets/img/product/quickview-l2.jpg')}}" alt="">
                            </div>
                            <div id="pro-3" class="tab-pane fade">
                                <img src="{{asset('public/assets/img/product/quickview-l3.jpg')}}" alt="">
                            </div>
                            <div id="pro-4" class="tab-pane fade">
                                <img src="{{asset('public/assets/img/product/quickview-l2.jpg')}}" alt="">
                            </div>
                        </div>
                        <!-- Thumbnail Large Image End -->
                        <!-- Thumbnail Image End -->
                        <div class="quickview-wrap mt-15">
                            <div class="quickview-slide-active owl-carousel nav nav-style-1" role="tablist">
                                <a class="active" data-toggle="tab" href="#pro-1"><img src="{{asset('public/assets/img/product/quickview-s1.jpg')}}" alt=""></a>
                                <a data-toggle="tab" href="#pro-2"><img src="{{asset('public/assets/img/product/quickview-s2.jpg')}}" alt=""></a>
                                <a data-toggle="tab" href="#pro-3"><img src="{{asset('public/assets/img/product/quickview-s3.jpg')}}" alt=""></a>
                                <a data-toggle="tab" href="#pro-4"><img src="{{asset('public/assets/img/product/quickview-s2.jpg')}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="product-details-content quickview-content">
                            <h2>Products Name Here</h2>
                            <div class="product-details-price">
                                <span>$18.00 </span>
                                <span class="old">$20.00 </span>
                            </div>
                            <div class="pro-details-rating-wrap">
                                <div class="pro-details-rating">
                                    <i class="fa fa-star-o yellow"></i>
                                    <i class="fa fa-star-o yellow"></i>
                                    <i class="fa fa-star-o yellow"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <span>3 Reviews</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisic elit eiusm tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim venialo quis nostrud exercitation ullamco</p>
                            <div class="pro-details-list">
                                <ul>
                                    <li>- 0.5 mm Dail</li>
                                    <li>- Inspired vector icons</li>
                                    <li>- Very modern style  </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->
<div id="cartPage" >
@include('layouts.partials.cartNav')
</div>
<!-- chat icon start -->
<div class="chat-icon-area">
    <i class="fa fa-comment"></i>
</div>
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
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>--}}

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

    function addTocart() {
        // $.ajax({
        //     type: "post",
        //     url: "",
        //     data:{
        //         _token:'',
        //         _sku:sku,
        //         _quantity:quantity
        //     },
        //     success: function (response) {
        //         console.log('res',response);
        //         $('#cartPage').empty().html(response.cart)
        //         $('#mobile-cart').html(`<i class="fas fa-shopping-bag"></i> <br>Cart(${response.cartQuantity})`);
        //         toastr.success('Item added to cart')
        //     },
        //     error:(response)=>{
        //     toastr.error('Out of quantity')
        //     }
        // });


        let quantity=$('#quantity').val() ;
        if(quantity && quantity >= 1){
        }
        if(!quantity || quantity<1){
            quantity = 1;
        }
        $.ajax({
            type: "post",
            url: "{{route('product.addTocart')}}",
            data:{
                _token:'{{csrf_token()}}',
                _sku:sku,
                _quantity:quantity
            },
            success: function (response) {
                console.log('res',response);
                $('#cartPage').empty().html(response.cart)
                $('#mobile-cart').html(`<i class="fas fa-shopping-bag"></i> <br>Cart(${response.cartQuantity})`);
                toastr.success('Item added to cart')
            },
            error:(response)=>{
            toastr.error('Out of quantity')
            }
        });
    }
</script>
@yield('js')


</body>

</html>
