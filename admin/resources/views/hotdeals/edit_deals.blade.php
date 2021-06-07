@extends('layouts.main')
@section('header.css')
<link href="{{url('public/Datetime/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{url('public/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/files/assets/pages/data-table/extensions/autofill/css/autoFill.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/files/assets/pages/data-table/extensions/autofill/css/select.dataTables.min.css')}}">
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
                                    <h4 class="card-title" id="basic-layout-form">Edit Hot Deals</h4>
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
                                        <form class="form"  action="{{route('hotdeals.update',$deals->hotDealsId)}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Hotdeals Name</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <input type='hidden' name="hotdeals_name" class="form-control" value="{{$deals->hotDealsId}}"/>
                                                        <input type='text' name="hotdeals_name" class="form-control" value="{{$deals->hotDeals_name}}"/>
                                                            <span class="text-danger hotdeals_name"> <b>{{  $errors->first('hotdeals_name') }}</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Deals Starts At</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="input-group date" id="datetimepicker2">
                                                                <input type="text" name="startDate" class="form-control form_datetime" value="{{$deals->startDate}}" >
                                                            </div>
                                                            <span class="text-danger"> <b>{{$errors->first('startDate') }}</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Deals End At</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="input-group date" id="datetimepicker2">
                                                                <input type="text" name="endDate" class="form-control form_datetime" value="{{$deals->endDate}}" >
                                                            </div>
                                                            <span class="text-danger"> <b>{{$errors->first('endDate')}}</b></span>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Deals Starts  At</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="input-group date" id="datetimepicker2">
                                                                <input type="text" name="startDate" id="startDate" class="form-control form_datetime" value="{{$deals->startDate}}">
                                                            </div>
                                                            <span class="text-danger startDate"> {!!$errors->first('startDate',':message')!!}</span>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Deals End At</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="input-group date" id="datetimepicker2">
                                                                <input type="text" name="endDate" id="endDate" class="form-control form_datetime" value="{{$deals->endDate}}">
                                                            </div>
                                                            <span class="text-danger endDate"> <b>{{$errors->first('endDate' ,':message') }}</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Ammount</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <input type='text' name="amount" class="form-control" value="{{$deals->amount}}"/>
                                                            <span class="text-danger"> <b>{{  $errors->first('amount') }}</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Percentage</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            {{-- <div class="spinner" data-trigger="spinner" id="spinner"> --}}
                                                                <input type="number" class="form-control" value="{{$deals->percentage}}" min="0"
                                                                       max="100" name="percentage" data-rule="quantity">
                                                                <span class="text-danger"> <b>{{  $errors->first('percentage') }}</b></span>
                                                                <div class="spinner-controls">
                                                                </div>
                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>
                                               </div>
                                               <div class="row">
                                                <div class="col-sm-12">
                                                    <label><b>Availability Status</b><span class="text-danger">*</span></label>
                                                    <br>
                                                    <select class="form-control" name="status">
                                                        <option value="">Select</option>
                                                        <option value="Available" @if($deals->status == "Available") selected @endif>Available</option>
                                                        <option value="Not Available" @if($deals->status == "Not Available") selected @endif>Not available</option>
                                                    </select>
                                                    <span class="text-danger"> <b>{{  $errors->first('status') }}</b></span>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('hotdeals.show') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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
<script type="text/javascript" src="{{url('public/files/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('public/files/assets/pages/data-table/extensions/autofill/js/dataTables.select.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/files/assets/pages/advance-elements/moment-with-locales.min.js')}}"></script>
<script src="{{url('public/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('public/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/Datetime/bootstrap-datetimepicker.min.js')}}"></script>

@endsection
