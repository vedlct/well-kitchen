@extends('layouts.layout')
@section('container')
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default single-my-account">
                            <div class="panel-heading my-account-title">
                                <h3 class="panel-title"><span>1 .</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information & Address </a></h3>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse show">
                                <div class="panel-body">
                                <form action="{{route('userinfo.update')}}" method="post"> 
                                    @csrf
                                    <input type="hidden" name="userId" value="{{$user->userId}}">
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h5>Your Personal Details</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <label>First Name</label>
                                                    <input type="text" name="firstName" value=" {{$user->firstName}} ">
                                                    <span class="text-danger"><b>{{  $errors->first('firstName') }}</b></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <label>Last Name</label>
                                                    <input type="text" name="lastName" value=" {{$user->lastName}}">
                                                    <span class="text-danger"><b>{{  $errors->first('lastName') }}</b></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="billing-info">
                                                    <label>Email Address</label>
                                                    <input type="email" name="email" value=" {{$user->email}}" readonly>
                                                    <span class="text-danger"><b>{{  $errors->first('email') }}</b></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <label>Phone</label>
                                                    {{-- <input type="text" name="phone" value="{{$customer?$customer->phone:''}}"> --}}
                                                    <input type="text" name="phone" value="{{$user->phone}}" readonly>
                                                    <span class="text-danger"><b>{{  $errors->first('phone') }}</b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-btn">
                                                <button type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form method="POST" action=" {{route('address.update')}} ">
                                    @csrf
                                    <input type="hidden" name="userId" value="{{$user->userId}}">
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h5>Your Shipping & Billing Address</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="billing-info mb-20">
                                                    <label>Shipping Address</label>
                                                    <input class="billing-address mb-3" placeholder="House number and street name" type="text" name="shippingAddress" value=" {{$getCustomerAddress? $getCustomerAddress->shippingAddress : ''}}">
                                                    {{-- <input placeholder="Apartment, suite, unit etc." type="text"> --}}
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="billing-info mb-20">
                                                    <label>Billing Address</label>
                                                    <input type="text" name="billingAddress" value=" {{$getCustomerAddress?$getCustomerAddress->billingAddress:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-btn">
                                                <button type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>   
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default single-my-account">
                            <div class="panel-heading my-account-title">
                                <h3 class="panel-title"><span>2 .</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h3>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse">
                                <div class="panel-body">
                                 <form method="post" action=" {{route('profile.password.update')}} ">
                                    @csrf
                                    <input type="hidden" name="email" value="{{$user->email}}">
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Password</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Old Password</label>
                                                    <input type="password" name="oldPassword">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label for="newPassword" >New Password</label>
                                                    <input id="password" type="password" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword" required autocomplete="new-password" >
                                                    @error('newPassword')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label for="password-confirm">Confirm New Password</label>
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                    @error('newPassword')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-btn">
                                                <button type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                 </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default single-my-account">
                            <div class="panel-heading my-account-title">
                                <h3 class="panel-title"><span>3 .</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Your address book entries   </a></h3>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Address Book Entries</h4>
                                        </div>
                                        <div class="entries-wrapper">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-info text-center">
                                                        <h4>Shipping Address:</h4>
                                                        <p>{{$getCustomerAddress?$getCustomerAddress->shippingAddress:''}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-info text-center">
                                                        <h4>Billing Address:</h4>
                                                        <p>{{$getCustomerAddress?$getCustomerAddress->billingAddress:''}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

@endsection