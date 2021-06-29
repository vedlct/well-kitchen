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
                                    <h4 class="card-title" id="basic-layout-form">Edit Setting</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
{{--                                            <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form method="post" action="{{route('setting.update',$setting->settingsID)}}" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            @method('PATCH')
                                            {{-- <input type="hidden" name="id" value="{{$menu->menuId}}"> --}}

                                            <div class="form-group row">
                                                <label for="example-search-input" class="col-sm-2 col-form-label">Company Name</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="companyName" placeholder="company Name" id="example-search-input" value="{{$setting->companyName}}">
                                                    @if ($errors->has('companyName'))
                                                        <span class="text-danger"><strong>{{ $errors->first('companyName') }}</strong> </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-search-input" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="email" placeholder="Email" id="example-search-input" value="{{$setting->email}}">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger"><strong>{{ $errors->first('email') }}</strong> </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-search-input" class="col-sm-2 col-form-label">Company Logo</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="file" name="imageLink">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-search-input" class="col-sm-2 col-form-label">Redeem(%)</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="redeem" placeholder="Redeem(%)" id="example-search-input" value="{{$setting->redeem}}">
                                                    @if ($errors->has('redeem'))
                                                        <span class="text-danger"><strong>{{ $errors->first('redeem') }}</strong> </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-search-input" class="col-sm-2 col-form-label">Free delivery on order over tk</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="free_delivery_on_order_over_tk" placeholder="free delivery on order over tk" id="example-search-input" value="{{$setting->free_delivery_on_order_over_tk}}">
                                                    @if ($errors->has('free_delivery_on_order_over_tk'))
                                                        <span class="text-danger"><strong>{{ $errors->first('free_delivery_on_order_over_tk') }}</strong> </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-search-input" class="col-sm-2 col-form-label">address</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="address" placeholder="address" id="example-search-input" value="{{$setting->address}}">
                                                    @if ($errors->has('address'))
                                                        <span class="text-danger"><strong>{{ $errors->first('address') }}</strong> </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-search-input" class="col-sm-2 col-form-label">phone</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="phone" placeholder="phone" id="example-search-input" value="{{$setting->phone}}">
                                                    @if ($errors->has('phone'))
                                                        <span class="text-danger"><strong>{{ $errors->first('phone') }}</strong> </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-search-input" class="col-sm-2 col-form-label">facebook</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="facebook" placeholder="facebook" id="example-search-input" value="{{$setting->facebook}}">
                                                    @if ($errors->has('facebook'))
                                                        <span class="text-danger"><strong>{{ $errors->first('facebook') }}</strong> </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-search-input" class="col-sm-2 col-form-label">twitter</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="twitter" placeholder="twitter" id="example-search-input" value="{{$setting->twitter}}">
                                                    @if ($errors->has('twitter'))
                                                        <span class="text-danger"><strong>{{ $errors->first('twitter') }}</strong> </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-search-input" class="col-sm-2 col-form-label">instagram</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="instagram" placeholder="instagram" id="example-search-input" value="{{$setting->instagram}}">
                                                    @if ($errors->has('instagram'))
                                                        <span class="text-danger"><strong>{{ $errors->first('instagram') }}</strong> </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div align="center" class="form-group center">
                                                <button class="btn btn-success  btn-sm" type="submit">Submit</button>
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
