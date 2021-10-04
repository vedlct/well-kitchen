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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Create Banner</h4>
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
                                        <form class="form" action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>banner Image</label>
                                                    <input type="file" class="form-control" name="imageLink" onchange="loadBanner(event)">
                                                    <p class="mt-1"><img id="output" width="100" /></p>
                                                    <span class="text-danger"> <b>{{  $errors->first('imageLink') }}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Page Link</label>
                                                    <input type="text" class="form-control" placeholder="Page Link" value="{{ old('pageLink') }}" name="pageLink">
                                                    <span class="text-danger"> <b>{{  $errors->first('pageLink') }}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>banner Type</label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="left">Left</option>
                                                        <option value="right">Right</option>
                                                    </select>
                                                    <span class="text-danger"> <b>{{  $errors->first('type') }}</b></span>
                                                </div>

                                                <div class="form-group" >
                                                    <label>Select Promotion</label>
                                                    <select name="promotion" id="promotion" class="form-control">
                                                        <option value="">Select</option>
                                                        @if (count($promotion)>0)
                                                            @foreach ($promotion as $item)
                                                                <option value="{{$item->promotionsId}}">{{$item->promotionstitle}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span class="text-danger"> <b>{{ $errors->first('promotion') }}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Availability Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Active">Available</option>
                                                        <option value="Inactive">Not available</option>
                                                    </select>
                                                    <span class="text-danger"> <b>{{ $errors->first('status') }}</b></span>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('banner.show') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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

@section('footer.js')
<script>
    const loadBanner = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endsection
