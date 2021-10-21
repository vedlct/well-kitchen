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
                                    <h4 class="card-title" id="basic-layout-form">Create testimonial</h4>
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
                                        <form class="form" action="{{ route('testimonial.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label> Name</label>
                                                    <input type="text" class="form-control" placeholder="Testimonial Name" value="{{ old('name') }}" name="name">
                                                </div>
                                                <div class="form-group">
                                                    <label> Designation</label>
                                                    <input type="text" class="form-control" placeholder="Designation Name" value="{{ old('designation') }}" name="designation">
                                                </div>
                                                <div class="form-group">
                                                    <label> Details</label>
                                                   
                                                    <textarea class="form-control"  placeholder="Testimonial Name" value="{{ old('details') }}" name="details"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label> Image</label>
                                                    <input type="file" class="form-control"  name="imageLink">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select id="categoryType" class="form-control" name="status">
                                                        <option value="" selected>Select Type</option>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Home</label>
                                                    <select id="categoryType" class="form-control" name="home">
                                                        <option value="" selected>Select Type</option>
                                                        <option value="1">Show</option>
                                                        <option value="0">Hide</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('testimonial.show') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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
