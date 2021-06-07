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

<!-- cart button right fixed start -->
<div class="cart-button-fixed" onclick="showNav()">
    <i class="pe-7s-shopbag"></i>
    <h5 class="mb-0">Cart</h5>
</div>
<!-- cart button right fixed end -->

<!-- right fixed cart start -->
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
  <div class="product-area my-md-5 my-4">
    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
        <div>
            <img src="{{asset('public/assets/img/product/hm10-pro-1.jpg')}}" alt="" class="product-img">
        </div>
        <div class="name-area px-2">
          <h5 class="product-name"><a href="#">Yellow premium Chair</a></h5>
          <h6 class="quantity">1 x $49.00</h6>
        </div>
        <div class="">
            <i class="fa fa-trash"></i>
          </div>
    </div>
    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
        <div>
            <img src="{{asset('public/assets/img/product/hm10-pro-1.jpg')}}" alt="" class="product-img">
        </div>
        <div class="name-area px-2">
          <h5 class="product-name"><a href="#">Yellow premium Chair</a></h5>
          <h6 class="quantity">1 x $49.00</h6>
        </div>
        <div class="">
            <i class="fa fa-trash"></i>
          </div>
    </div>
    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
        <div>
            <img src="{{asset('public/assets/img/product/hm10-pro-1.jpg')}}" alt="" class="product-img">
        </div>
        <div class="name-area px-2">
          <h5 class="product-name"><a href="#">Yellow premium Chair</a></h5>
          <h6 class="quantity">1 x $49.00</h6>
        </div>
        <div class="">
            <i class="fa fa-trash"></i>
          </div>
    </div>
  </div>
  <div class="d-flex justify-content-between">
        <div>
            <h5>Sub-Total:</h5>
        </div>
        <div class="">
        <h5>$20</h5>
        </div>
    </div>
    <div class="row my-md-5 my-4">
        <div class="col-6">
            <a href="{{url('/cart')}}" class="btn btn-secondary w-100">View Cart</a>
        </div>
        <div class="col-6">
            <a href="{{url('/checkout')}}" class="btn btn-danger w-100">checkout</a>
        </div>
    </div>
</section>
<!-- right fixed cart end -->

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

</body>

</html>