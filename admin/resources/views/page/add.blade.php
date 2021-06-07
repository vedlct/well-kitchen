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
                                    <h4 class="card-title" id="basic-layout-form">Create Page</h4>
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
                                        <form class="form" action="{{ route('page.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <div class="form-body">
                                                
                                                <div class="form-group">
                                                    <label>Page Title</label>
                                                    <input class="form-control" type="text" name="pageTitle" placeholder="Page Name" value="{{old('pageTitle', $pageInfo->pageTitle ?? null)}}">
                                                    @if($errors->has('pageTitle'))
                                                        <span class="text-danger"><b>{{$errors->first('pageTitle')}}</b></span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Details</label>
                                                    <textarea class="form-control" id='details' name="details">{!! old('details', $pageInfo->details ?? null) !!}</textarea>
                                                    @if($errors->has('details'))
                                                        <span class="text-danger"><b>{{$errors->first('details')}}</b></span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Page Iamge</label>
                                                    <input class="form-control" type="file" name="image">
                                                    @if($errors->has('image'))
                                                        <span class="text-danger"><b>{{$errors->first('image')}}</b></span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="" selected>Select Status</option>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                    <span class="text-danger"> <b>{{  $errors->first('status') }}</b></span>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('page.index') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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

        $(document).ready( function () {
            CKEDITOR.replace('details');
        });
        </script>
@endsection        