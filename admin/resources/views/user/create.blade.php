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
                                    <h4 class="card-title" id="basic-layout-form">Create User</h4>
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
                                        <form class="form" action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control input-text" type="text" name="firstName" id="firstName" placeholder="First Name" value="{{ old('firstName') }}" title="Your First Name">
                                                        <span class="text-danger"><b>{{  $errors->first('firstName') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control input-text" type="text" name="lastName" id="lastName" placeholder="Last Name" value="{{ old('lastName') }}" title="Your Last Name">
                                                        <span class="text-danger"><b>{{  $errors->first('lastName') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control input-text email-field" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }} "title="Your Email">
                                                        <span class="text-danger"><b>{{  $errors->first('email') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control input-text" type="text" name="phone" id="phone" placeholder="Phone Number" value="{{ old('phone') }}" title="Your Phone Number">
                                                        <span class="text-danger"><b>{{  $errors->first('phone') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">    
                                                    <div class="form-group">
                                                        <input class="form-control input-text" type="password" name="new_password" id="new_password" placeholder="Password" title="Password">
                                                        <span class="text-danger"><b>{{ $errors->first('new_password') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control input-text" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" title="Confirm Password">
                                                        <span class="text-danger"><b>{{  $errors->first('confirm_password') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select id="roles" class="form-control" name="role" >
                                                            <option value="">Select Roles</option>
                                                            @if(count($roles)>0)
                                                                @foreach($roles as $role)
                                                                    <option value="{{$role->userTypeId}}">{{$role->typeName}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> 

                                            <div class="form-actions">
                                                <a href="{{ route('index') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
                                                <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
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
