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
                                    <h4 class="sub-title">Update Delivery Service</h4>
{{--                                    <p style="color: #24899c;">Preferred Image size <span style="color: red; font-weight: bold">580px * 190px</span></p>--}}
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
                                        <form class="form" action="{{ route('deliveryService.update', $deliveryService->deliveryServiceId) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="menuId" value="{{$deliveryService->deliveryServiceId}}">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>Company Name</label>
                                                    <input class="form-control" type="text" name="companyName" value=" {{$deliveryService->companyName}} " id="example-search-input">
                                                    <span class="text-danger"> <b>{{  $errors->first('companyName') }}</b></span>
                                                </div>

                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input class="form-control" type="number" name="phone" value="{{$deliveryService->phone}}" id="example-search-input">
                                                    @if($errors->has('phone'))
                                                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Location</label>
                                                    <input class="form-control" type="text" name="location" value="{{$deliveryService->location}}" id="example-search-input">
                                                    @if($errors->has('location'))
                                                        <div class="text-danger">{{ $errors->first('location') }}</div>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Delivery Type</label>
                                                    <input class="form-control" type="text" name="delivery_type" value="{{$deliveryService->delivery_type}}" id="example-search-input">
                                                    @if($errors->has('delivery_type'))
                                                        <div class="text-danger">{{ $errors->first('delivery_type') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('deliveryService.index') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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
