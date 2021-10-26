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
                                    <h4 class="card-title" id="basic-layout-form">Create Store</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('vendor.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @if(isset($vendor))
                                                <input type="hidden" name="vendorId" value="{{$vendor->vendor_id}}">
                                            @endif
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" placeholder="First Name" value="{{isset($vendor) ? $vendor->vendor_firstName : ''}}" name="vendor_firstName">
                                                     @error('vendor_firstName')
                                                        <span  class="error text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" placeholder="Last Name" value="{{isset($vendor) ? $vendor->vendor_lastName : ''}}" name="vendor_lastName">
                                                    @error('vendor_lastName')
                                                    <span  class="error text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div> 

                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control" placeholder="Phone" value="{{isset($vendor) ? $vendor->vendor_phone : ''}}" name="vendor_phone">
                                                    @error('vendor_phone')
                                                    <span  class="error text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Shop Name</label>
                                                    <input type="text" class="form-control" placeholder="vendor_shop_name" value="{{isset($vendor) ? $vendor->vendor_shop_name : ''}}" name="vendor_shop_name">
                                                    @error('vendor_shop_name')
                                                    <span  class="error text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                                
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('store.index') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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
