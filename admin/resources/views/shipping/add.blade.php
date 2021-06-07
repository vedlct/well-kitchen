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
                                    <h4 class="card-title" id="basic-layout-form">Create Shipping</h4>
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
                                        <form class="form" action="{{ route('shipping.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @if(isset($shippingData))
                                                <input type="hidden" name="zoneID" value="{{$shippingData->shipment_zoneId}}">
                                            @endif

                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input class="form-control" type="text" name="ShippingName" placeholder="Enter Name" value="{{old('ShippingName', $shippingData->shipment_zoneName ?? null)}}">
                                                    @if($errors->has('ShippingName'))
                                                        <span class="text-danger"><b>{{$errors->first('ShippingName')}}</b></span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Fee</label>
                                                    <input class="form-control" type="text" name="shippingFee" value="{{old('shippingFee', $shippingData->charges->deliveryFee ?? null)}}">
                                                    @if($errors->has('shippingFee'))
                                                        <span class="text-danger"><b>{{$errors->first('shippingFee')}}</b></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <a href="{{ route('shipping.index') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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
