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
                                    <h4 class="card-title" id="basic-layout-form">Edit Brand</h4>
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
                                        <form class="form" action="{{ route('brand.update', $brand->brandId) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>Brand Name</label>
                                                    <input type="text" class="form-control"  value="{{ $brand->brandName }}" name="brandName">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="" selected>Select Status</option>
                                                        <option value="active" @if($brand->status == "active") selected @endif>Active</option>
                                                        <option value="inactive" @if($brand->status == "inactive") selected @endif>Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div @if($brand->brandLogo) class="col-md-10" @else class="col-md-12" @endif>
                                                        <div class="form-group">
                                                            <label>Brand Logo</label>
                                                            <input type="file" class="form-control" name="brandLogo">
                                                        </div>
                                                    </div>
                                                    @if($brand->brandLogo)
                                                    <div class="col-md-1">
                                                        <img src="{{ url('public/brandLogo', $brand->brandLogo) }}" class="" alt="Brand Logo">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('brand.show') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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
