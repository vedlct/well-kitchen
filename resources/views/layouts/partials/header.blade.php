<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Well Kitchen</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('public/assets/css/icons.min.css')}}">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('public/assets/css/plugins.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('public/assets/css/custom.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">--}}
</head>

<body class="position-relative">

      <!-- preloader start -->
    <div class="loader_bg">
        <div class="loader"></div>
    </div>

    <!-- category for mobile start -->
    <div class="dark-overlay" id="darkOverlay" onclick="hideWithDark()"></div>
    <div class="toggle-nav-cross" id="rightNavClose" onclick="hideWithDark()">
        <i class="fa fa-times close-icon"></i>
    </div>
    <section class="right-toogle-nav" id="showRightNav">
        <div class="inner">
            <ul class="list-unstyled all-item">
                {{-- @foreach($allCategories->where('parent',null) as $key => $parentCategory)
                <li>
                    <a class="d-block" data-toggle="collapse" href="#showCategorySubmenu{{$key}} " role="button" aria-expanded="false" aria-controls="showCategorySubmenu">{{ $parentCategory->categoryName }}
                      <i class="fa fa-angle-right float-right"></i>
                    </a>

                    <div class="collapse" id="showCategorySubmenu{{$key}}">
                        <ul class="ml-3">
                            @foreach($subCategories->where('parent', $parentCategory->categoryId) as $keyItem => $subCategory)
                            <li>
                               <a href="{{route('category.products', $subCategory->categoryId)}}"> {{ $subCategory->categoryName}}</a>

                                <div class="collapse" id="showCategorySubmenu{{$keyItem}}">
                                    <ul class="ml-3">
                                            @foreach($subSubCategories->where('subParent', $subCategory->categoryId) as $subParentCategory)
                                        <li>
                                        <a href="{{route('category.products', $subParentCategory->categoryId)}}"> {{ $subParentCategory->categoryName }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                           @endforeach
                        </ul>
                    </div>
                 </li>
                @endforeach --}}

                @foreach($allCategories as $key => $parentCategory)
                <li>
                    <!-- parent category -->
                    @if(($subCategories->where('parent', $parentCategory->categoryId))->count() > 0 )
                    <a class="d-block collapsed" data-toggle="collapse" href="#one{{$key}} " role="button" aria-expanded="false" aria-controls="showCategorySubmenu">{{ $parentCategory->categoryName }}
                        <i class="fa fa-angle-right float-right"></i>
                    </a>
                    @else
                    <a  href="{{route('category.products', $parentCategory->categoryId)}}">{{ $parentCategory->categoryName }}</a>
                    @endif

                    <!-- sub category -->
                    <div class="collapse" id="one{{$key}}" style="">
                        <ul class="ml-3">
                            @foreach($subCategories->where('parent', $parentCategory->categoryId) as $keyItem => $subCategory)
                        <li>
                            @if($subSubCategories->where('subParent', $subCategory->categoryId)->count() > 0)

                            <a  href="{{route('category.products', $parentCategory->categoryId)}}" >View All</a>

                            <a class="d-block collapsed" data-toggle="collapse" href="#oneTwo{{$keyItem}} " role="button" aria-expanded="false" aria-controls="showCategorySubmenu">{{ $subCategory->categoryName }}

                                <i class="fa fa-angle-right float-right"></i>

                            </a>
                            @else
                            <a  href="{{route('category.products', $subCategory->categoryId)}}" >{{ $subCategory->categoryName }}</a>
                            @endif
                            <!-- sub sub category -->
                            <div class="collapse" id="oneTwo{{$keyItem}}" style="">
                                <ul class="ml-3">
                                    @foreach($subSubCategories->where('subParent', $subCategory->categoryId) as $subParentCategory)
                                    <li>
                                        <a  href="{{route('category.products', $subCategory->categoryId)}}" >View All</a>
                                        <a href="{{route('category.products', $subParentCategory->categoryId)}}"> {{ $subParentCategory->categoryName }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                            @endforeach

                        </ul>
                    </div>
                </li>
                @endforeach
                <li><a href="{{url('/')}}">Home</a>
                    <li><a href="{{route('contact')}}">Contact</a>
                    <li><a href="{{route('offers')}}">Offers</a>
                        @foreach($menu->where('menuType','Header')->sortByDesc('menuOrder')->take(8) as $headerMenu)
                            <li><a href="{{route('page',$headerMenu->fkpageId)}}">{{$headerMenu->menuName}}</a>
                        @endforeach

                <!-- demo category start -->
                {{-- <li>
                    <!-- parent category -->
                    <a class="d-block collapsed" data-toggle="collapse" href="#one " role="button" aria-expanded="false" aria-controls="showCategorySubmenu">Home Appliances
                      <i class="fa fa-angle-right float-right"></i>
                    </a>
                    <!-- sub category -->
                    <div class="collapse" id="one" style="">
                        <ul class="ml-3">
                        <li>
                            <a class="d-block collapsed" data-toggle="collapse" href="#oneTwo " role="button" aria-expanded="false" aria-controls="showCategorySubmenu">Home Appliances
                                <i class="fa fa-angle-right float-right"></i>
                            </a>
                            <!-- sub sub category -->
                            <div class="collapse" id="oneTwo" style="">
                                <ul class="ml-3">
                                    <li>
                                        <a href="http://localhost/well-kitchen/categories/9"> skin powder</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="http://localhost/well-kitchen/categories/9"> skin powder</a>
                        </li>
                        </ul>
                    </div>
                </li> --}}
                <!-- demo category end -->

            </ul>
            <div class="bottom-area py-3">
                <div class="fb-page-like p-2 pl-3">
                    <a href=" {{$setting->facebook}} " class="d-inline-block" target="_blank">
                        <h5 class="text-uppercase mb-0">
                            <i class="fa fa-facebook-square mr-1"></i> Like Us
                        </h5>
                    </a>
                </div>
                <p class="p-2 pl-3 m-0">
                    <i class="fa fa-phone-square"></i> {{$setting->phone}}
                </p>
                <p class="p-2 pl-3 m-0">
                    <i class="fa fa-envelope"></i> {{$setting->email}}
                </p>
                <p class="p-2 pl-3">
                    FAQ ?
                </p>
            </div>
        </div>
    </section>
    <!-- category for mobile end -->

    <header class="header-area header-in-container clearfix">
        <!-- header top start -->
        <div class="header-top-area d-none d-md-block">
            <div class="container">
                <div class="header-top-wap">
                    <div class="language-currency-wrap">
                        <div class="same-language-currency">
                            <p class="contact">Call Us <a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></p>
                        </div>
                    </div>
                    <div class="header-offer">
                        {{-- <p>Free delivery on order over <span>&#2547;{{$setting->free_delivery_on_order_over_tk}}</span></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- header middle start -->
        <div class="header-bottom header-res-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-6">
                        <div class="logo">
                            <!-- category mobile menu icon -->
                            <span class="category-mobile-icon d-lg-none mr-3" onclick="showRightNav()">
                                <i class="fa fa-bars"></i>
                            </span>
                            <!-- logo -->
                            <a href="{{route('home')}}">
                                <img alt="" src="{{asset('admin/public/settingImage/'.$setting->imageLink)}}">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 d-none d-lg-block">
                        <!-- big search -->
                        <div class="big-search">
                         <form action="{{route('search.product')}}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search... "
                                    aria-label="Recipient's username" aria-describedby="basic-addon2"  name="allSearch" id="search" value="{{Session::get('search')}}">
                                <div class="input-group-append">
                                    <button class="input-group-text" id="basic-addon2" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                         </form>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-6">
                        <!-- another all items here -->
                        <div class="header-right-wrap">
                            <div class="same-style header-search d-lg-none">
                            <a class="search-active" href="#"><i class="pe-7s-search"></i></a>

                            <div class="search-content">
                                <form action="{{route('search.product')}}" method="POST">
                                    @csrf
                                    <input type="text" placeholder="Search asdf" name="allSearch" id="search" value="{{Session::get('search')}}" />
                                    <button class="button-search" type="submit"><i class="pe-7s-search"></i></button>
                                </form>
                            </div>
                            </div>
                            <div class="same-style account-satting">
                                <a class="account-satting-active" href="#"><i class="pe-7s-user-female"></i></a>
                                <div class="account-dropdown">
                                    <ul>
                                        @if(!(Auth::check()))
                                            <li><a href="{{url('login')}}">Login/Register</a></li>
                                        @else
                                        <li><a href="">Hello,{{Auth::user()->firstName}}</a></li>
                                        @if(Auth::user()->userType->typeName == 'customer')
                                        <li><a href="{{route('myOrder')}}">My Orders  </a></li>
                                        @endif
                                        <li><a href="{{route('profile')}}">my account</a></li>
                                        @endif
                                        @auth
                                        <li><a href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                        @endauth
                                    </ul>
                                </div>
                            </div>
                            <div class="same-style header-wishlist">
                                
                                <a href="{{route('wishlist')}}"><i class="pe-7s-like">
                                    <sup style="
                                    position: absolute;
                                    top: -9px;
                                    right: -12px;
                                    background-color: #000;
                                    color: #fff;
                                    display: inline-block;
                                    width: 21px;
                                    height: 21px;
                                    border-radius: 100%;
                                    line-height: 21px;
                                    font-size: 12px;
                                    text-align: center;
                                    ">@auth {{ $wishlist }} @endauth @guest 0 @endguest
                                </sup></i>
                                </a>
                            </div>


                            {{-- <div id="cartPagehead" >
                                @include('layouts.partials.cartHead')
                            </div> --}}

                            <div class="same-style cart-wrap" >
                                <button class="icon-cart" id="headerCartBag" onclick="showNav()">
                                    <i class="pe-7s-shopbag"></i>
                                   <span class="count-style headerCartBag" > {{\Cart::getContent()->count()}}</span>
                                </button>
                                <!-- <div class="shopping-cart-content">
                                    <div class="full-wrapper position-relative">
                                        <div class="top-area">
                                            <ul>
                                                <li class="single-shopping-cart">
                                                    <div class="shopping-cart-img">
                                                        <a href="#"><img alt="" src="assets/img/cart/cart-1.png"></a>
                                                    </div>
                                                    <div class="shopping-cart-title">
                                                        <h4><a href="#">T- Shart & Jeans </a></h4>
                                                        <h6>Qty: 02</h6>
                                                        <span>৳260.00</span>
                                                    </div>
                                                    <div class="shopping-cart-delete">
                                                        <a href="#"><i class="fa fa-times-circle"></i></a>
                                                    </div>
                                                </li>
                                                <li class="single-shopping-cart">
                                                    <div class="shopping-cart-img">
                                                        <a href="#"><img alt="" src="assets/img/cart/cart-2.png"></a>
                                                    </div>
                                                    <div class="shopping-cart-title">
                                                        <h4><a href="#">T- Shart & Jeans </a></h4>
                                                        <h6>Qty: 02</h6>
                                                        <span>৳260.00</span>
                                                    </div>
                                                    <div class="shopping-cart-delete">
                                                        <a href="#"><i class="fa fa-times-circle"></i></a>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="shopping-cart-total">
                                                <h4>Shipping : <span>৳20.00</span></h4>
                                                <h4>Total : <span class="shop-total">৳260.00</span></h4>
                                            </div>
                                        </div>
                                        <div class="shopping-cart-btn btn-hover text-center">
                                            <a class="default-btn" href="cart-page.html">view cart</a>
                                            <a class="default-btn" href="checkout.html">checkout</a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- mobile menu items here -->
                <!-- <div class="mobile-menu-area">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li><a href="index.html">HOME</a>
                                </li>
                                <li><a href="shop.html">Collection</a></li>
                                <li><a href="about.html">About us</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="#">Pages</a>
                                    <ul>
                                        <li><a href="about.html">about us</a></li>
                                        <li><a href="cart-page.html">cart page</a></li>
                                        <li><a href="checkout.html">checkout </a></li>
                                        <li><a href="wishlist.html">wishlist </a></li>
                                        <li><a href="my-account.html">my account</a></li>
                                        <li><a href="login-register.html">login / register </a></li>
                                        <li><a href="contact.html">contact us </a></li>
                                        <li><a href="./faq.html">FAQ</a></li>
                                        <li><a href="404.html">404 page </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- header bottom start -->
        <div class="header-bottom-two d-none sticky-bar d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <!-- category menu items -->
                        <div class="category-collapse">
                            <ul class="menuH">
                                <li class="home-nav-category-btn"><a href="#" class="arrow heading w-100"><i class="fa fa-bars mr-2"></i> All
                                        Category</a>
                                @if(Request::path() == '/')
                                     <ul class="home-parent-categories">
                                  @else
                                      <ul>
                                @endif
                                        @foreach($allCategories as $parentCategory)
                                        <li>

                                            <a href="{{route('category.products', $parentCategory->categoryId)}}">{{ $parentCategory->categoryName }}
                                                @if($subCategories->where('parent', $parentCategory->categoryId)->count() > 0)
                                                <i class="fa fa-angle-right float-right"></i>
                                                @endif
                                            </a>
                                            @foreach($subCategories->where('parent', $parentCategory->categoryId) as $subCategory)
                                            <ul>
                                                @foreach($subCategories->where('parent', $parentCategory->categoryId) as $subCategory)
                                                <li>

                                                    <a href="{{route('category.products', $subCategory->categoryId)}}">{{ $subCategory->categoryName }}
                                                        @if($subSubCategories->where('subParent', $subCategory->categoryId)->count() > 0)
                                                        <i class="fa fa-angle-right float-right"></i>
                                                        @endif
                                                    </a>
                                                    @foreach($subSubCategories->where('subParent', $subCategory->categoryId) as $subParentCategory)
                                                    <ul>
                                                        @foreach($subSubCategories->where('subParent', $subCategory->categoryId) as $subParentCategory)
                                                            <li><a href="{{route('category.products', $subParentCategory->categoryId)}}">{{ $subParentCategory->categoryName }} </a>

                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    @endforeach
                                                </li>
                                                @endforeach
                                            </ul>
                                                @endforeach
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- main menu for desktop -->
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li><a href="{{url('/')}}">Home</a>
                                    <li><a href="{{route('contact')}}">Contact</a>
                                    <li><a href="{{route('offers')}}">Offers</a>
                                    @foreach($menu->where('menuType','Header')->sortByDesc('menuOrder')->take(8) as $headerMenu)

                                    {{-- <li><a href="{{url('/')}}">Home</a>
                                    </li>
                                    <li><a href="{{route('category.products')}}">Collection</a></li>
                                    <li><a href="{{url('/about')}}"> About </a></li>
                                    <li><a href="{{url('/contact')}}"> Contact</a></li>
                                    <li><a href="#"> Pages <i class="fa fa-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li><a href="{{url('product-details')}}">product details</a></li>
                                            <li><a href="{{url('/about')}}">about us</a></li>
                                            <li><a href="{{url('/cart')}}">cart page</a></li>
                                            <li><a href="{{url('/checkout')}}">checkout </a></li>
                                            <li><a href="{{url('/wishlist')}}">wishlist </a></li>
                                            <li><a href="{{('my-account')}}">my account</a></li>
                                            <li><a href="{{url('/login')}}">login / register </a></li>
                                            <li><a href="{{url('/contact')}}">contact us </a></li>
                                            <li><a href="{{url('/faq')}}">FAQ</a></li>
                                            <li><a href="404.html">404 page </a></li>
                                        </ul>
                                    </li> --}}
                                        <li><a href="{{route('page',$headerMenu->fkpageId)}}">{{$headerMenu->menuName}}</a>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="header-right-wrap">
                            <div class="same-style header-search d-none">
                                <a class="search-active" href="#"><i class="pe-7s-search"></i></a>
                                <div class="search-content">
                                    <form action="{{route('search.product')}}" method="POST">
                                        @csrf
                                        <input type="text" placeholder="Search" name="allSearch" id="search" value="{{Session::get('search')}}" />
                                        <button class="button-search" type="submit"><i class="pe-7s-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <!-- fb page link -->
                            <div class="fb-page-like text-right ml-3">
                                <a href="{{($setting->facebook)}}" class="d-inline-block" target="_blank">
                                    <h5 class="text-uppercase mb-0">
                                        <i class="fa fa-facebook-square mr-1"></i> Like Us
                                    </h5>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('header')


      <!-- Messenger Chat Plugin Code -->
      <div id="fb-root"></div>

      <!-- Your Chat Plugin code -->
      <div id="fb-customer-chat" class="fb-customerchat">
      </div>

      <script>
          var chatbox = document.getElementById('fb-customer-chat');
          chatbox.setAttribute("page_id", "102834201806066");
          chatbox.setAttribute("attribution", "biz_inbox");

          window.fbAsyncInit = function() {
              FB.init({
                  xfbml            : true,
                  version          : 'v11.0'
              });
          };

          (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
              fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
      </script>
