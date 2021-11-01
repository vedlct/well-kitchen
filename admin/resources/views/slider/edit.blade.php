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
                                    <h4 class="card-title" id="basic-layout-form">Create Slider</h4>
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
                                        <form class="form" action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="sliderId" value="{{$slider->sliderId}}">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>Title Text</label>
                                                    <input type="text" class="form-control" placeholder="Main Text" value="{{ $slider->titletext }}" name="titletext">
                                                    <span class="text-danger"> <b>{{  $errors->first('titletext') }}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Page Link</label>
                                                    <input type="text" class="form-control" placeholder="Page Link" value="{{ $slider->pageLink }}" name="pageLink">
                                                    <span class="text-danger"> <b>{{  $errors->first('pageLink') }}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Main Text</label>
                                                    <input type="text" class="form-control" placeholder="Main Text" value="{{ $slider->mainText }}" name="mainText">
                                                    <span class="text-danger"> <b>{{  $errors->first('mainText') }}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sub Text</label>
                                                    <input type="text" class="form-control" placeholder="Sub Text" value="{{ $slider->subText }}" name="subText">
                                                    <span class="text-danger"> <b>{{  $errors->first('subText') }}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Slider Iamge<small style="color: red; font-weight: bold">(Image Size:1920x578)</small></label>
                                                    <input type="file" class="form-control" name="sliderImage">
                                                    <span class="text-danger"> <b>{{  $errors->first('sliderImage') }}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label> Serial No</label>
                                                    <input type="number" class="form-control" name="serial" value="{{ $slider->serial }}">
                                                    <span class="text-danger"> <b>{{  $errors->first('serial') }}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="" selected>Select Status</option>
                                                        <option value="active" @if ($slider->status=='active') selected @endif>Active</option>
                                                        <option value="inactive"  @if ($slider->status=='inactive') selected @endif>Inactive</option>
                                                    </select>
                                                    <span class="text-danger"> <b>{{  $errors->first('status') }}</b></span>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('brand.show') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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
