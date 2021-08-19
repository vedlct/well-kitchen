@extends('auth.authLayout')
@section('content')
    <section class="verify-with-otp-area py-5">
        <div class="container">
            <div class="main-row row justify-content-center align-items-center">
                <div class="col-lg-4 col-md-8 text-center text-md-left">
                    <img src="assets/images/verify-otp.png" alt="" class="img-fluid">
                    <h5 class="heading mb-1">Verify with OTP</h5>
                    <small class="light-ash-color">Sent to <b class="ash-color">{{$phone}}</b></small>
                    <form action="{{route('Register.otp.submit')}}" method="POST" class="my-4">
                        @csrf
                        <input class="otp-input" type="text" name="otp[]" id="" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                        <input class="otp-input" type="text" name="otp[]" id="" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                        <input class="otp-input" type="text" name="otp[]" id="" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                        <input class="otp-input" type="text" name="otp[]" id="" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                        <button type="submit" class="btn" style="background: #F15048; color: #fff;font-weight: 300;padding: 10px 12px;"><i class="fas fa-caret-right"></i></button>
                    </form>
                    <p class="light-ash-color mb-4">Resend OTP in: <b class="ash-color"><span id="one-countdown"></span></b></p>
                    <p class="ash-color mb-4">Log in using <a href="{{route('login')}}" class="red-color">Password</a></p>
                    <p class="ash-color mb-4">Having trouble logging in? <a href="#" class="red-color">Get help</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{url('/public/assets/js/otp-countdown.js')}}"></script>
    <script>
        function sendOtp() {
            $.ajax({
                type: "post",
                url: "{{route('Register.otp.resend')}}",
                data: {
                    _token:'{{csrf_token()}}',
                    phone:'{{$phone}}'
                },
                success: function (response) {
                    toastr.success('OTP sent successfully');                     
                }
            });
        }
    </script>
@endsection