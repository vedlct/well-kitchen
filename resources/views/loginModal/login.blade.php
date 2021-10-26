<style>
    .signin-signup-tab-btn .btn {
        background-color: #eee;
        color: #282C3E;
    }
    .signin-signup-tab-btn .btn.active {
        background: #F15048;
        color: #fff;
    }
</style>
<!-- login area start -->
<section class="login-with-phn py-5">
<div class="container">
    <div class="main-row row justify-content-center align-items-center">
        <div class="col-lg-12 col-md-8 col-12">
            <!-- tab button -->
            <ul class="row nav nav-pills signin-signup-tab-btn mb-3" id="pills-tab" role="tablist">
                <li class="col-lg-6 mb-3 nav-item">
                    <a class="btn nav-link w-100   {{( ($errors->has('password')) || ($errors->has('phone')) ) ? '' : 'active'}}" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="{{( ($errors->has('password')) || ($errors->has('phone')) ) ? 'false' : 'true'}}">Login with OTP</a>
                </li>
                <li class="col-lg-6 mb-3 nav-item">
                    <a class="btn nav-link w-100 {{( ($errors->has('password')) || ($errors->has('phone')) ) ? 'active' : ''}} " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="{{( ($errors->has('password')) || ($errors->has('phone')) ) ? 'true' : 'false'}}">Login with Password</a>
                </li>
            </ul>

            <hr class="my-4">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $error }}</li>
                        </ul>
                    </div>
                @endforeach
            @endif
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show {{( ($errors->has('password')) || ($errors->has('phone')) ) ? '' : 'show active'}}" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="wrapper">
                        <h5 class="heading">Login</h5>
                        <form action="{{route('Login.otp')}}" method="POST">
                            @csrf
                            <div class="mobile-no-field input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+88</div>
                                </div>
                                <input type="text" class="form-control" id="otp-phone" placeholder="Mobile Number*" name="phone" >
                                @if ($errors->has('otp-phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('otp-phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input type="submit" class="btn text-uppercase w-100" value="Log in">
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade {{( ($errors->has('password')) || ($errors->has('phone')) ) ? 'show active' : ''}}" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="wrapper">
                        <h5 class="heading">Login with Password</h5>
                        <form action="{{route('Login.normal')}}" method="POST">
                            @csrf
                            <div class="mobile-no-field input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+88</div>
                                </div>
                                <input type="text" class="form-control" id="phone" placeholder="Mobile Number*" name="phone">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mobile-no-field input-group mb-4">
                                <input type="password" class="form-control" id="password" placeholder="password*" name="password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input type="submit" class="btn text-uppercase w-100" value="Log in">
                        </form>
                        <p class="mt-2">Forgot Password? <a href="{{route('Login.forgotPassword')}}" class="text-danger">Click here!</a> </p>
                    </div>
                </div>
                </div>
        </div>
    </div>
</div>
</section>
<!-- login area end -->