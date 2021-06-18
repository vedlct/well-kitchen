@section('front.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endsection



@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{url('public/assets/js/plugins.js')}}"></script>
    <script>

    /*--- Quickview-slide-active ---*/
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

    </script>
@endsection
