@extends('layouts.layout')
@section('container')
<div class="login-register-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-form-container">
                        <div class="login-register-form">
                            <h5 class="mb-3">Enter your registered phone no :</h5>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{route('Login.forgotPasswordSubmit')}}">
                                @csrf
                                <input type="text" name="phone" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Mobile Number*">
                                <div class="button-box">
                                    <button class="w-100" type="submit"><span>Get OTP</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection