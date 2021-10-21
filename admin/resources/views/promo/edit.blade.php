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
                                    <h4 class="card-title" id="basic-layout-form">Edit Promo</h4>
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
                                        <form class="form"  action="{{route('promo.update')}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" class="form-control" name="promo_id" value="{{$promo->promo_id}}">
                                            <div class="form-body">


                                               <div class="form-group">
                                                    <label for="companyName"><b>Promo Code</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" value="{{$promo->promo_code}}" name="promo_code" id="promo_code">
                                                    <span class="text-danger promo_code"> <b>{{  $errors->first('promo_code') }}</b></span>
                                                </div>

                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Deals Starts  At</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="input-group date" id="datetimepicker2">
                                                                <input type="text" name="start_date" id="start_date" class="form-control form_datetime" value="{{$promo->start_date}}">
                                                            </div>
                                                            <span class="text-danger start_date"> <b>{!!$errors->first('start_date',':message')!!}</b></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Deals End At</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="input-group date" id="datetimepicker2">
                                                                <input type="text" name="end_date" id="end_date" class="form-control form_datetime" value="{{$promo->end_date}}">
                                                            </div>
                                                            <span class="text-danger end_date"> <b>{{$errors->first('end_date' ,':message') }}</b></span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label><b>Discount</b><span class="text-danger">*</span></label>
                                                    <input type="text"  class="form-control" name="discount" id="discount" value="{{ $promo->discount }}">
                                                    <span class="text-danger"> <b>{{$errors->first('discount')}}</b></span>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label><b>Status</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="">Select</option>
                                                        <option value="active" {{ old('status', $promo->status ?? null) == "active" ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ old('status', $promo->status ?? null) == "inactive" ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                        <span class="text-danger status"> <b>{{  $errors->first('status') }}</b></span>
                                                    </div>
                                                </div>
                                             </div>

                                            <div class="form-actions">
                                                <a href="{{ route('promo') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
                                                <button  type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
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
<script type="text/javascript" src="{{url('public/Datetime/bootstrap-datetimepicker.min.js')}}"></script>

<script type="text/javascript">

    $(".form_datetime").datetimepicker({
        format: 'yyyy-mm-dd hh:ii:ss',
        pickerPosition: "bottom-left"
    });


</script>

@endsection
