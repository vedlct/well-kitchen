@extends('layouts.main')
@section('header.css')
<link rel="stylesheet" type="text/css" href="{{url('public/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/files/assets/pages/data-table/extensions/autofill/css/autoFill.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/files/assets/pages/data-table/extensions/autofill/css/select.dataTables.min.css')}}">
<link href="{{url('public/Datetime/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css">

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
                                    <h4 class="card-title" id="basic-layout-form">Create Promotion</h4>
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
                                 
                                            <form method="post" action="{{route('promotion.insert')}}" enctype="multipart/form-data">
                                         
                                                {{ csrf_field() }}
                                            <div class="form-body">
                                               <div class="form-group">
                                                    <label for="companyName"><b>Promotion Title</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Promotion Title" name="promotionTitle" id="promotionTitle">
                                                    <span class="text-danger promotionTitle"> <b>{{  $errors->first('promotionTitle') }}</b></span>
                                                </div>
                                               <div class="form-group">
                                                    <label for="companyName"><b>Promotion Image</b><span class="text-danger">*</span></label>
                                                    <input type="file" class="form-control"  name="imageLink" id="imageLink">
                                                    <span class="text-danger imageLink"> <b>{{  $errors->first('imageLink') }}</b></span>
                                                </div>
                                               <div class="form-group">
                                                    <label for="companyName"><b>Promotion Code</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Category Name" name="promotionCode" id="promotionCode">
                                                    <span class="text-danger promotionCode"> <b>{{  $errors->first('promotionCode') }}</b></span>
                                                </div>
                                               
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Deals Starts  At</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="input-group date" id="datetimepicker2">
                                                                <input type="text" name="startDate" id="startDate" class="form-control form_datetime">
                                                            </div>
                                                            <span class="text-danger startDate"> <b>{!!$errors->first('startDate',':message')!!}</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Deals End At</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="input-group date" id="datetimepicker2">
                                                                <input type="text" name="endDate" id="endDate" class="form-control form_datetime">
                                                            </div>
                                                            <span class="text-danger endDate"> <b>{{$errors->first('endDate' ,':message') }}</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Type</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <select class="form-control" name="type" id="type" onchange="typeChange(this)">
                                                                <option value="">Select</option>
                                                                <option value="%" {{ old('type') == "%" ? 'selected' : '' }}>%</option>
                                                                <option value="TK" {{ old('type') == "TK" ? 'selected' : '' }}>TK</option>
                                                            </select>
                                                            <span class="text-danger"> <b>{{$errors->first('type')}}</b></span>
                                                         </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group" id="percentValueDiv">
                                                    <label class="col-sm-2 col-form-label">Percent value<span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="text"  class="form-control" name="percentValue" value="{{old('percentValue')}}">
                                                        <span class="text-danger"> <b>{{$errors->first('percentValue')}}</b></span>
                                                    </div>
                                                </div> --}}
                                                <div class="form-group" id="percentValueDiv">
                                                    <label for="companyName"><b>Percent value</b><span class="text-danger">*</span></label>
                                                    <input type="text"  class="form-control" name="percentValue" id="percentValue" value="{{old('percentValue')}}">
                                                    <span class="text-danger"> <b>{{$errors->first('percentValue')}}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="companyName"><b>Maximum Amount</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Category Name" name="amount" id="amount">
                                                    <span class="text-danger amount"> <b>{{  $errors->first('amount') }}</b></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="companyName"><b>Limit / Customer</b><span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Category Name" name="limit" id="limit">
                                                    <span class="text-danger limit"> <b>{{  $errors->first('limit') }}</b></span>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label><b>Availability Status</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="">Select</option>
                                                            <option value="active">Available</option>
                                                            <option value="inactive">Not available</option>
                                                        </select>
                                                        <span class="text-danger status"> <b>{{  $errors->first('status') }}</b></span>
                                                    </div>
                                                </div>
                                             </div>

                                            <div class="form-actions">
                                                <a href="{{ route('promotion') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
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
    $(document).ready(function() {
        @if($errors->first('percentValue'))
            $('#percentValueDiv').show();
        @else
            $('#percentValueDiv').hide().find('input:text').val('').attr("disabled", true);
        @endif
    });
    $(".form_datetime").datetimepicker({
        format: 'yyyy-mm-dd hh:ii:ss',
        pickerPosition: "bottom-left"
    });

    function typeChange(data) {
        if(data.value != '' && data.value != 'TK'){
            $('#percentValueDiv').show().find('input:text').val('').removeAttr("disabled");
        }else{
            $('#percentValueDiv').hide().find('input:text').val('').attr("disabled", true);
        }
    }
</script>
@endsection
