<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Register | Zeroes</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" type="image/x-icon" href="">

		<!-- CSS here -->
        <link rel="stylesheet" href="{{url('/public/assets/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{url('/public/assets/css/fontawesome-all.min.css')}}">
        <link rel="stylesheet" href="{{url('/public/assets/css/slick.css')}}">
        <link rel="stylesheet" href="{{url('/public/assets/css/slick.theme.css')}}">
        <link rel="stylesheet" href="{{url('/public/assets/css/utilities.css')}}">
        <link rel="stylesheet" href="{{url('/public/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{url('/public/assets/css/responsive.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        @yield('css')
    </head>
    <body>
        <!-- bottom to top arrow start -->
        <div class="bottom-to-top-arrow position-fixed" id="goToTopArrow">
            <a href="#header"><i class="fas fa-arrow-alt-circle-up"></i></a>
        </div>
        <!-- bottom to top arrow end -->

        <main>
            <!-- login area start -->
            @yield('content')
            <!-- login area end -->
        </main>
		
		
		<!-- JS here -->
        <script src="{{url('/public/assets/js/vendor/modernizr-3.5.0.min.js')}}"></script>
        <script src="{{url('/public/assets/js/vendor/jquery-3.2.1.min.js')}}"></script>
        <script src="{{url('/public/assets/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{url('/public/assets/js/vendor/slick.js')}}"></script>
        <script src="{{url('/public/assets/js/all.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
        </script>
        @yield('js')
    </body>
</html>
