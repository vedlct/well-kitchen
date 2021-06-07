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
                                    <h4 class="card-title" id="basic-layout-form">Create Hot Deals</h4>
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
                                        {{-- <form class="form" action="" method="post" > --}}
                                            <form class="form" action="" enctype="multipart/form-data" method="POST">
                                                {{ csrf_field() }}
                                            <div class="form-body">
                                               <div class="form-group">
                                                    <label for="companyName">Hot Deals Name</label>
                                                    <input type="text" class="form-control" placeholder="Category Name" name="hotDeals_name" id="hotDeals_name">
                                                    <span class="text-danger hotdeals_name"> <b>{{  $errors->first('hotDeals_name') }}</b></span>
                                                </div>
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Deals Starts  At</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="input-group date" id="datetimepicker2">
                                                                <input type="text" name="startDate" id="startDate" class="form-control form_datetime">
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
                                                                <input type="text" name="endDate" id="endDate" class="form-control form_datetime">
                                                            </div>
                                                            <span class="text-danger endDate"> <b>{{$errors->first('endDate' ,':message') }}</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                                               <div class="form-group">
                                                    <label for="companyName">Percentage</label>
                                                    <input type="text" class="form-control" placeholder="Category Name" name="percentage" id="percentage">
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label><b>Availability Status</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="">Select</option>
                                                            <option value="Available">Available</option>
                                                            <option value="Not Available">Not available</option>
                                                        </select>
                                                        <span class="text-danger status"> <b>{{  $errors->first('status') }}</b></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label class="mt-3"><b>Select Product</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <table id="productTable" class="table table-striped table-bordered nowrap"></table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class='col-sm-12'>
                                                        <label><b>Ammount</b><span class="text-danger">*</span></label>
                                                        <br>
                                                        <div class="form-group">
                                                            <input type='text' name="amount" id="amount" class="form-control"/>
                                                            <span class="text-danger amount"> <b>{{  $errors->first('amount') }}</b></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('hotdeals.show') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
                                                <button id="submit" type="button" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
                                                {{-- <button id="submit" type="button" class="btn btn-success mb-3">Save Offer</button> --}}
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

<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'

        });
    });

    $(document).ready(function() {
        var productTable = $('#productTable').DataTable({
            select: true,
            processing: true,
            serverSide: true,
            bDestroy: true,
            responsive: true,
            stateSave: true,
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0,
                preSelect:['22']
            }],
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
            ajax: {
                "url": "{!! route('product.list') !!}",
                "type": "GET",
                data: function (d) {
                    d._token = "{{csrf_token()}}";
                    d.promotion = true;
                }
            },
            columns: [
                { data : null, defaultContent: "",orderable :false, searchable:false},
                { title: 'Product ID', data: 'productId', name: 'productId' ,"className": "text-center", orderable: true, searchable:true},
                { title: 'Product Name', data: 'productName', name: 'productName' ,"className": "text-center", orderable: true, searchable:true},
                { title: 'Brand', data: 'brand', name: 'brand.brandName',"className": "text-center", orderable: true, searchable:true},
                { title: 'Category Name', data: 'category', name: 'categoryName' ,"className": "text-center", orderable: false, searchable:false},
                { title: 'Type', data: 'type', name: 'type' ,"className": "text-center", orderable: true, searchable:true},
            ]
        });

        productTable.on("click", "th.select-checkbox", function () {
            if ($("th.select-checkbox").hasClass("selected")) {
                productTable.rows().deselect();
                $("th.select-checkbox").removeClass("selected");
            } else {
                productTable.rows().select();
                $("th.select-checkbox").addClass("selected");
            }
        });
        

        $('#submit').click(function () {
            var ids = $.map(productTable.rows('.selected').data(), function (item) {
                return item['productId'];
            });
                    console.log('ids')
            // });
            $.ajax({
                url: "{{ route('deal.insert') }}",
                method: "POST",
                data: {
                    '_token': '{{csrf_token()}}',
                    'value': ids,
                    'startDate': $('#startDate').val(),
                    'endDate': $('#endDate').val(),
                    'percentage': $('#percentage').val(),
                    'status': $('#status').val(),
                    'amount': $('#amount').val(),
                    // 'endDate': $("[name='endDate']").val(),
                    // 'percentage': $("[name='percentage']").val(),
                    // 'status': $("[name='status'] option:selected").val(),
                    // 'amount': $("[name='amount']").val(),
                    'hotDeals_name': $("[name='hotDeals_name']").val()
                },
                success: function (data) {
                    // console.log('ok');
                    var url = '{{route("hotdeals") }}';
                    window.location.href = url;
                },
                error: function (request, status, error) {
                       $.each(request.responseJSON.errors, function (key, item) 
                        {
                            $("."+key).html(item);
                        });
          
                }
                });
        });


    });

    $(".form_datetime").datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            pickerPosition: "bottom-left"
        });
</script>
@endsection
