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
                                    <h4 class="card-title" id="basic-layout-form">Edit Category</h4>
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
                                        <form class="form" action="{{ route('category.update', $category->categoryId) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="companyName">Category Name</label>
                                                    <input type="text" class="form-control"  value="{{ $category->categoryName }}" name="categoryName">
                                                </div>
                                                <div class="form-group">
                                                    <label for="companyName">Parent Category<small>(optional)</small></label>
                                                    <select name="parent" class="form-control">
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $cat)
                                                            <option @if($category->parent == $cat->categoryId) selected @endif value="{{ $cat->categoryId }}">{{ $cat->categoryName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div id="subCategory" class="form-group">
                                                    <label>Home show</label>
                                                    <select name="homeShow" id="parentCategory" class="form-control">
                                                        <option value="1" {{$category->homeShow == 1? 'selected' : ''}}> Active</option>
                                                        <option value="0" {{$category->homeShow == 0? 'selected' : ''}}> Inactive</option>
                                                       
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div @if($category->imageLink) class="col-md-10" @else class="col-md-12" @endif>
                                                        <div class="form-group">
                                                            <label for="companyName">Category Image</label>
                                                            <input type="file" class="form-control" name="imageLink">
                                                        </div>
                                                    </div>
                                                    @if($category->imageLink)
                                                    <div class="col-md-1">
                                                        <img src="{{ url('public/categoryImage', $category->imageLink) }}" class="img-fluid" alt="Category Image">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('category.show') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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
