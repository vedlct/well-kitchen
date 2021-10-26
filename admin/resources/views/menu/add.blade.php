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
                                    <h4 class="card-title" id="basic-layout-form">Create Menu</h4>
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
                                        @if($errors->any())
                                            {!! implode('', $errors->all('<span class="text text-danger">:message</span>')) !!}
                                        @endif
                                        <form class="form" action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>Menu Name</label>
                                                    <input class="form-control" type="text" name="MenuName" placeholder="Menu Name" id="example-search-input">
                                                    <span class="text-danger"> <b>{{  $errors->first('MenuName') }}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>MenuType</label>
                                                    <select class="form-control" name="MenuType" >
                                                        <option value="">Select</option>
                                                        <option value="Header">Header</option>
                                                        <option value="Footer">Footer</option>
                                                    </select>
                                                    @if($errors->has('MenuType'))
                                                        <div class="text-danger">{{ $errors->first('MenuType') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Menu Order</label>
                                                    <input class="form-control" type="number" name="MenuOrder" placeholder="Menu Order" id="example-search-input">
                                                    @if($errors->has('MenuOrder'))
                                                        <div class="text-danger">{{ $errors->first('MenuOrder') }}</div>
                                                    @endif
                                                </div>

                                                {{-- <div class="form-group">
                                                    <label>Parent</label>
                                                    <input class="form-control" type="number" name="parent" id="example-search-input">
                                                    @if($errors->has('parent'))
                                                        <div class="text-danger">{{ $errors->first('parent') }}</div>
                                                    @endif
                                                </div> --}}

                                                <div class="form-group">
                                                    <label>Menu Image</label>
                                                    <input class="form-control" type="file" name="imageLink">
                                                    @if($errors->has('imageLink'))
                                                        <div class="text-danger">{{ $errors->first('imageLink') }}</div>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Select Page </label>
                                                    <select id="fkpageId" name="fkpageId" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach($page as $page)
                                                            <option value="{{$page->pageId}}">{{$page->pageTitle}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('fkpageId'))
                                                        <div class="text-danger">{{ $errors->first('fkpageId') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('menu.index') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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
