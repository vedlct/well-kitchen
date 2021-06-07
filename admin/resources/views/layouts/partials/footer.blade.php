<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2021 Developed By
            <a class="text-bold-800 grey darken-2" href="https://techcloudltd.com/" target="_blank">Tech Cloud Ltd</a></span>
    </div>
</footer>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->

<script src="{{url('public/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/js/scripts/forms/switch.min.js')}}" type="text/javascript"></script>
<!-- BEGIN Vendor JS-->

<script src="{{url('public/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>


<!-- BEGIN: Theme JS-->
<script src="{{url('public/app-assets/js/core/app-menu.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/js/core/app.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/js/scripts/customizer.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/vendors/js/jquery.sharrre.js')}}" type="text/javascript"></script>
<!-- END: Theme JS-->

<!-- slick js -->

<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- slick slider js -->
<script>
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true
    });
</script>


<!-- BEGIN: Page JS-->
{{-- <script src="{{url('public/app-assets/js/scripts/pages/dashboard-analytics.min.js')}}" type="text/javascript"></script> --}}


    <script src="{{url('public/app-assets/js/scripts/forms/checkbox-radio.min.js')}}" type="text/javascript"></script>
<!-- END: Page JS-->
    <script src="{{url('public/app-assets/js/scripts/feather-icon/feather.js')}}"></script>
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.12.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js" integrity="sha512-3oappXMVVac3Ge3OndW0WqpGTWx9jjRJA8SXin8RxmPfc8rg87b31FGy14WHG/ZMRISo9pBjezW9y00RYAEONA==" crossorigin="anonymous"></script>

<!--toastr-->
    <script src="{{url('public/js/toastr.min.js')}}"></script>
    <script>
        @if(session('message'))
        toastr.info('{{session('message')}}')
        @endif
        @if(session('warning'))
        toastr.warning('{{session('warning')}}')
        @endif
        @if(session('success'))
        toastr.success('{{session('success')}}')
        @endif
        @if(session('danger'))
        toastr.error('{{session('danger')}}')
        @endif

        //Jquery On ecnyer event bonding
        (function($) {
            $.fn.onEnter = function(func) {
                this.bind('keypress', function(e) {
                    if (e.keyCode == 13) func.apply(this, [e]);    
                });               
                return this; 
            };
            })(jQuery);
    </script>
<!--toastr-->

<script src="{{url('public/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>


    @yield('footer.js');

</body>

