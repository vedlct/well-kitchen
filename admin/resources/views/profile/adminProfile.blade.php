@extends('layouts.main')
@section('header.css')
    <style>
        html body .content .content-wrapper {
            padding: 5px 20px 5px 20px;
        }
    </style>
@endsection
@section('main.content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="offset-md-1 col-md-10">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Edit Profile</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('profile.update', $user->userId) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control input-text" type="text" name="firstName" id="firstName" placeholder="First Name" value="{{ Auth::user()->firstName }}" title="Your First Name">
                                                        <span class="text-danger"><b>{{  $errors->first('firstName') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control input-text" type="text" name="lastName" id="lastName" placeholder="Last Name" value="{{ Auth::user()->lastName }}" title="Your Last Name">
                                                        <span class="text-danger"><b>{{  $errors->first('lastName') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control input-text email-field" type="email" name="email" id="email" placeholder="Email" value="{{ Auth::user()->email }} "title="Your Email">
                                                        <span class="text-danger"><b>{{  $errors->first('email') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control input-text" type="text" name="phone" id="phone" placeholder="Phone Number" value="{{ Auth::user()->phone }}" title="Your Phone Number">
                                                        <span class="text-danger"><b>{{  $errors->first('phone') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Profile Image</label>
                                                        <input type="file" class="form-control"  name="profile_image">
                                                        <span class="text-danger"> <b>{{  $errors->first('profile_image') }}</b></span>
                                                    </div>
                                                </div>
                                                @if(isset(Auth::user()->profile_image) && !empty(Auth::user()->profile_image))
                                                    <input type="hidden" name="profile_image" value="{{Auth::user()->profile_image}}">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            {{-- <div class="col-sm-2 col-form-label"></div> --}}
                                                            <img height="100px" width="100px" src="{{url("public/userImage/".Auth::user()->profile_image)}}">
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-12">
                                                    <h4 class="card-title">Change Password</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control input-text" id="current_password" name="current_password" placeholder="Current Password" type="password" title="Current Password">
                                                        <span class="text-danger"> <b>{{  $errors->first('current_password') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">    
                                                    <div class="form-group">
                                                        <input class="form-control input-text" type="password" name="new_password" id="new_password" placeholder="New Password" title="New Password">
                                                        <span class="text-danger"><b>{{ $errors->first('new_password') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control input-text" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" title="Confirm Password">
                                                        <span class="text-danger"><b>{{  $errors->first('confirm_password') }}</b></span>
                                                    </div>
                                                </div>
                                            </div> 

                                            <div class="form-actions">
                                                <a href="{{ route('index') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
                                                <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
