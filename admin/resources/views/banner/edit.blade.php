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
                                    <h4 class="sub-title">Update Banner</h4>
                                    {{-- <p style="color: #24899c;">Preferred Image size <span style="color: red; font-weight: bold">580px * 190px</span></p> --}}
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
                                        <form class="form" action="{{ route('banner.update',$banner->bannerId) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="bannerId" value="{{$banner->bannerId}}">
                                            <div class="form-body">
                                                {{-- <div class="form-group">
                                                    <label for="companyName">Category Name</label>
                                                    <input type="text" class="form-control"  value="{{ $category->categoryName }}" name="categoryName">
                                                </div> --}}
                                                {{-- <div class="form-group">
                                                    <label for="companyName">Parent Category<small>(optional)</small></label>
                                                    <select name="parent" class="form-control">
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $cat)
                                                            <option @if($category->parent == $cat->categoryId) selected @endif value="{{ $cat->categoryId }}">{{ $cat->categoryName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                {{-- <div class="row">
                                                    <div @if($banner->imageLink) class="col-md-10" @else class="col-md-12" @endif>
                                                        <div class="form-group">
                                                            <label for="companyName">Banner Image</label>
                                                            <input type="file" class="form-control" name="imageLink">
                                                        </div>
                                                    </div>
                                                    @if($banner->imageLink)
                                                    <div class="col-md-1">
                                                        <img src="{{ url('public/bannerImage', $banner->imageLink) }}" class="img-fluid" alt="Banner Image">
                                                    </div>
                                                    @endif
                                                </div> --}}
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Banner Image<span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="file" class="form-control" name="imageLink" onchange="loadBanner(event)">
                                                        <p class="mt-1"><img id="output" width="100" /></p>
                                                        <span class="text-danger"> <b>{{  $errors->first('imageLink') }}</b></span>
                                                    </div>
                                                </div>
                                                @if(isset($banner->imageLink) && !empty($banner->imageLink))
                                                    <input type="hidden" name="previousImage" value="{{$banner->imageLink}}">
                                                <div class="form-group row ml-2">
                                                    <div class="col-sm-2 col-form-label">
                                                    </div>
                                                    <img height="100px" width="100px" src="{{url("public/bannerImage/".$banner->imageLink)}}">
                                                </div>
                                                @endif
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Page Link</label>
                                                    <div class="col-sm-10">
                                                    <input type="text" class="form-control" placeholder="Page Link" value="{{ $banner->pageLink }}" name="pageLink">
                                                    <span class="text-danger"> <b>{{  $errors->first('pageLink') }}</b></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">banner Type</label>
                                                    <div class="col-sm-10">
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="left" {{$banner->type == 'left' ? 'selected' : '' }} >Left</option>
                                                        <option value="right" {{$banner->type == 'right' ? 'selected' : '' }}>Right</option>
                                                    </select>
                                                    <span class="text-danger"> <b>{{  $errors->first('type') }}</b></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Availability Status<span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <select id="status" name="status" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Active" @if($banner->status == "Active") selected @endif>Active</option>
                                                            <option value="Inactive" @if($banner->status == "Inactive") selected @endif>Inactive</option>
                                                        </select>
                                                        <span class="text-danger"> <b>{{ $errors->first('status') }}</b></span>
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Select Promotion</label>
                                                    <div class="col-sm-10">
                                                    <select name="promotion" id="promotion" class="form-control">
                                                        <option value="">Select</option>
                                                        @if (count($promotion)>0)
                                                            @foreach ($promotion as $item)
                                                                <option value="{{$item->promotionsId}}" @if ($item->promotionsId == $banner->fkPromotionId) selected @endif >{{$item->promotionstitle}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span class="text-danger"> <b>{{ $errors->first('promotion') }}</b></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Availability Status<span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <select id="status" name="status" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Active" @if($banner->status == "Active") selected @endif>Active</option>
                                                            <option value="Inactive" @if($banner->status == "Inactive") selected @endif>Inactive</option>
                                                        </select>
                                                        <span class="text-danger"> <b>{{ $errors->first('status') }}</b></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('banner.show') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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

@section('footer.js')
    <script>
        const loadBanner = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
