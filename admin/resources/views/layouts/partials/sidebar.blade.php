<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse navbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>

                </ul>
                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="avatar avatar-online">
                                @if(Auth::user()->profile_image == NULL)
                                    <img src="{{ url('public/app-assets/images/portrait/small/user_avater.png') }}" alt="Avatar"/>
                                @else
                                    <img src="{{url('public/userImage/'.Auth::user()->profile_image)}}" alt="">
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right">
                                <a class="dropdown-item" href="#">
                                    <span class="avatar avatar-online">
                                        @if(Auth::user()->profile_image == NULL)
                                            <img src="{{ url('public/app-assets/images/portrait/small/user_avater.png') }}" alt=""/>
                                        @else
                                            <img src="{{url('public/userImage/'.Auth::user()->profile_image)}}" alt="">
                                        @endif
                                        <span class="user-name text-bold-700 ml-1">{{ Auth::user()->firstName }}</span>
                                    </span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->userId) }}"><i class="ft-user"></i> Edit Profile</a>
                                {{-- <a class="dropdown-item" href="email-application.php"><i class="ft-mail"></i> My Inbox</a>
                                <a class="dropdown-item" href="project-summary.php"><i class="ft-check-square"></i> Task</a>
                                <a class="dropdown-item" href="chat-application.php"><i class="ft-message-square"></i> Chats</a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="{{url('public/app-assets/images/backgrounds/02.jpg')}}">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{url('/')}}"><img class="brand-logo" alt="Wellkitchen admin logo" src="{{url('public/settingImage/',$setting->imageLink)}}"/>
                    <img style="margin-left: -5px" class="brand-text" alt="Suvastu" src="{{url('public/settingImage/',$setting->imageLink)}}"/></a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="navigation-background"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item dashboard-li"><a href="{{ url('/') }}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a></li>

            <li class="nav-item product-li"><a href="#"><i class="ft-package"></i><span class="menu-title" data-i18n="">Product</span></a>
                <ul class="menu-content">
                    <li class="pr-list">
                        <a class="menu-item" href="{{ route('product.show') }}">List</a>
                    </li>
                    <li class="pr-add">
                        <a class="menu-item" href="{{ route('product.create') }}">Add</a>
                    </li>
                    <li class="pr-variation">
                        <a class="menu-item" href="{{route('variation.show')}}">Variation</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item purchase-li"><a href="#"><i class="ft-anchor"></i><span class="menu-title" data-i18n="">Purchase</span></a>
                <ul class="menu-content">
                     <li class="purc-add">
                        <a class="menu-item" href="{{ route('purchase.add') }}">Add</a>
                    </li>

                    <li class="purc-list">
                        <a class="menu-item" href="{{ route('purchase.show') }}">List</a>
                    </li>
                </ul>
            </li>

            {{-- <li class="nav-item order-li"><a href="#"><i class="ft-wind"></i><span class="menu-title" data-i18n="">Order</span></a>
                <ul class="menu-content">
                     <li class="order-list">
                        <a class="menu-item" href="{{ route('order.index') }}">List</a>
                    </li>
                    <li class="order-add">
                        <a class="menu-item" href="{{ route('order.add') }}">Add</a>
                    </li>
                    <li class="order-add">
                        <a class="menu-item" href="{{ route('due.index') }}">Due</a>
                    </li>
                </ul>
            </li> --}}

            <li class="nav-item collection-li"><a href="{{ route('order.index') }}"><i class="ft ft-help-circle"></i><span class="menu-title" data-i18n="">Order</span></a></li>
            <li class="nav-item collection-li"><a href="{{ route('order.add') }}"><i class="ft ft-help-circle"></i><span class="menu-title" data-i18n="">Order Add</span></a></li>
            <li class="nav-item collection-li"><a href="{{ route('due.index') }}"><i class="ft ft-help-circle"></i><span class="menu-title" data-i18n="">Due</span></a></li>
            <li class="nav-item collection-li"><a href="{{ route('hotdeals') }}"><i class="ft ft-help-circle"></i><span class="menu-title" data-i18n="">Hot Deals</span></a></li>
            <li class="nav-item collection-li"><a href="{{ route('promo') }}"><i class="ft ft-help-circle"></i><span class="menu-title" data-i18n="">Promo</span></a></li>
            <li class="nav-item collection-li"><a href="{{ route('promotion') }}"><i class="ft ft-help-circle"></i><span class="menu-title" data-i18n="">Promotion</span></a></li>
            <li class="nav-item collection-li"><a href="{{ route('banner.show') }}"><i class="ft ft-help-circle"></i><span class="menu-title" data-i18n="">Banner</span></a></li>
            <li class="nav-item collection-li"><a href="{{ route('report.collection') }}"><i class="ft ft-help-circle"></i><span class="menu-title" data-i18n="">Collection</span></a></li>


            <li class="nav-item report-li"><a href="#"><i class="ft-zap"></i><span class="menu-title" data-i18n="">Report</span></a>
                <ul class="menu-content">
                    <li class="reprt-sale">
                        <a class="menu-item" href="{{ route('report.sale') }}">sale</a>
                    </li>
                    <li class="reprt-stock">
                        <a class="menu-item" href="{{ route('report.stock') }}">stock</a>
                    </li>
                    <li class="reprt-product">
                        <a class="menu-item" href="{{ route('report.product') }}">product</a>
                    </li>
                    <li class="reprt-customer">
                        <a class="menu-item" href="{{ route('report.customer') }}">customer</a>
                    </li>
                    <li class="reprt-category">
                        <a class="menu-item" href="{{ route('report.category') }}">category</a>
                    </li>
                    <li class="reprt-store">
                        <a class="menu-item" href="{{ route('report.store') }}">store</a>
                    </li>
                    <li class="reprt-vendor">
                        <a class="menu-item" href="{{ route('report.vendor') }}">vendor</a>
                    </li>
                    <li class="reprt-transaction">
                        <a class="menu-item" href="{{ route('report.transaction') }}">transaction</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item settings-li"><a href="#"><i class="ft-wind"></i><span class="menu-title" data-i18n="">Settings</span></a>
                <ul class="menu-content">
                     <li class="set-info">
                        <a class="menu-item" href="{{ route('setting.index') }}">Info</a>
                        {{-- <a class="menu-item" href="{{ route('order.add') }}">Add</a> --}}
                    </li>
                    <li class="nav-item set-category">
                        <a href="{{ route('category.show') }}"><span class="menu-title" data-i18n="">Category</span></a>
                    </li>
                    <li class="nav-item set-brand">
                        <a href="{{ route('brand.show') }}"><span class="menu-title" data-i18n="">Brand</span></a>
                    </li>
                    <li class="nav-item set-unit">
                        <a href="{{ route('unit.show') }}"><span class="menu-title" data-i18n="">Unit</span></a>
                    </li>
                    <li class="nav-item set-unit">
                        <a href="{{ route('slider.index') }}"><span class="menu-title" data-i18n="">Slider</span></a>
                    </li>
                    <li class="nav-item set-unit">
                        <a href="{{ route('page.index') }}"><span class="menu-title" data-i18n="">Page</span></a>
                    </li>
                    <li class="nav-item set-unit">
                        <a href="{{ route('menu.index') }}"><span class="menu-title" data-i18n="">Menu</span></a>
                    </li>
                    <li class="nav-item set-unit">
                        <a href="{{ route('shipping.index') }}"><span class="menu-title" data-i18n="">Shipping details</span></a>
                    </li>
                    <li class="nav-item set-store">
                        <a href="{{ route('store.index') }}"><span class="menu-title" data-i18n="">Store</span></a>
                    </li>

                    <li class="nav-item set-vendor">
                        <a href="{{ route('vendor.index') }}"><span class="menu-title" data-i18n="">Vendor</span></a>
                    </li>

                    <li class="nav-item set-meta">
                        <a href="{{ route('meta.show') }}"><span class="menu-title" data-i18n="">Meta</span></a>
                    </li>

                    <li class="nav-item set-testimonial">
                        <a href="{{ route('testimonial.show') }}"><span class="menu-title" data-i18n="">Testimonial</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item barcode-li"><a href="#"><i class="ft-wind"></i><span class="menu-title" data-i18n="">Barcode</span></a>

            </li>
            <li class="nav-item membership-li"><a href="{{ route('membership.membership') }}"><i class="ft-wind"></i><span class="menu-title" data-i18n="">Membership</span></a>

            </li>
            <li class="nav-item user-li"><a href="#"><i class="ft-wind"></i><span class="menu-title" data-i18n="">User</span></a>
                <ul class="menu-content">
                     <li class="user-all">
                        <a class="menu-item" href="{{ route('user.index') }}">All user</a>
                        {{-- <a class="menu-item" href="{{ route('order.add') }}">Add</a> --}}
                    </li>
                    <li class="customer-all">
                        <a class="menu-item" href="{{ route('user.customer') }}">Customer</a>
                        {{-- <a class="menu-item" href="{{ route('order.add') }}">Add</a> --}}
                    </li>
                </ul>
            </li>
            <li class="nav-item role-li"><a href="#"><i class="ft-wind"></i><span class="menu-title" data-i18n="">Role permission</span></a>
                <ul class="menu-content">
                     <li class="role-perm">
                        <a class="menu-item" href="{{ route('role.show') }}">Role</a>
                        {{-- <a class="menu-item" href="{{ route('order.add') }}">Add</a> --}}
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(){
    $(function() {
        // take current location
        var current_location = window.location.href.split('/');
        // take last two of current location
        var page1 = current_location[current_location.length - 1];
        var page2 = current_location[current_location.length - 2];
        var page_link = page2 + "/" + page1;

        // dashboard check
        switch (page1) {
            case '':
                $('.dashboard-li').addClass('open');
                break;
        }

        switch (page_link) {
            // case for main items
            case 'product/show':
            case 'product/create':
            case 'variation/show':
                $('.product-li').addClass('open');
                break;
            case 'purchase/add':
            case 'purchase/show':
                $('.purchase-li').addClass('open');
                break;
            case 'order/show':
            case 'order/add':
                $('.order-li').addClass('open');
                break;
            case 'report/sale':
            case 'report/product':
            case 'report/customer':
            case 'report/category':
            case 'report/store':
            case 'report/vendor':
            case 'report/transaction':
            case 'report/stock':
                $('.report-li').addClass('open');
                break;
            case 'setting/setting':
            case 'category/show':
            case 'brand/show':
            case 'unit/show':
                $('.settings-li').addClass('open');
                break;
            case 'user/user':
                $('.user-li').addClass('open');
                break;
            case 'role/show':
                $('.role-li').addClass('open');
                break;
        }

        // case for sub items
        switch (page_link) {
            case 'product/show':
                $('.pr-list').addClass('active');
                break;
            case 'product/create':
                $('.pr-add').addClass('active');
                break;
            case 'variation/show':
                $('.pr-variation').addClass('active');
                break;
            case 'purchase/add':
                $('.purc-add').addClass('active');
                break;
            case 'purchase/show':
                $('.purc-list').addClass('active');
                break;
            case 'order/show':
                $('.order-list').addClass('active');
                break;
            case 'order/add':
                $('.order-add').addClass('active');
                break;
            case 'report/sale':
                $('.reprt-sale').addClass('active');
                break;
            case 'report/product':
                $('.reprt-product').addClass('active');
                break;
            case 'report/customer':
                $('.reprt-customer').addClass('active');
                break;
            case 'report/category':
                $('.reprt-category').addClass('active');
                break;
            case 'report/store':
                $('.reprt-store').addClass('active');
                break;
            case 'report/vendor':
                $('.reprt-vendor').addClass('active');
                break;
            case 'report/transaction':
                $('.reprt-transaction').addClass('active');
                break;
            case 'report/stock':
                $('.reprt-stock').addClass('active');
                break;
            case 'setting/setting':
                $('.set-info').addClass('active');
                break;
            case 'category/show':
                $('.set-category').addClass('active');
                break;
            case 'brand/show':
                $('.set-brand').addClass('active');
                break;
            case 'unit/show':
                $('.set-unit').addClass('active');
                break;
            case 'user/user':
                $('.user-all').addClass('active');
                break;
            case 'role/show':
                $('.role-perm').addClass('active');
                break;
        }

        // sidebar hide
        setTimeout(function(){
            if(page_link == "order/add") {
                $("body").addClass("menu-collapsed");
                $("body").removeClass("menu-expanded");
                console.log("test");
            }
        }, 500);
    });
});


</script>
<!-- END: Main Menu-->
