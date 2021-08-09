@extends('layouts.main')
@section('header.css')
    <link rel="stylesheet" type="text/css" href="{{url('public/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/files/assets/pages/data-table/extensions/autofill/css/select.dataTables.min.css')}}">
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: grid;
            justify-content: end;
        }
    </style>
@endsection
@section('main.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <!-- category datatable began -->
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Promotion</h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a href="{{ route('hotdeals.add') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table table-responsive">
                                        <input type="hidden" class="form-control" name="promoid" value="{{$promoid}}">
                                        <table id="productTable"
                                               class="table table-striped table-bordered nowrap">
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button id="button" type="button" class="btn btn-success mb-3 btn-sm">Add Product</button>
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

    <script>
        $(document).ready(function() {
            var productTable = $('#productTable').DataTable({
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0,
                    {{--  preSelect:['22']  --}}
                }],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                ajax:{
                    "url": "{!! route('product.list') !!}",
                    "type": "GET",
                    data:function (d){
                        d._token = "{{csrf_token()}}";
                        d.promotion = true;
                    }
                },
                columns: [
                    { data : null, defaultContent: "",orderable :false, searchable:false},
                    { title: 'Product ID', data: 'productId', name: 'productId' ,"className": "text-center", orderable: true, searchable:true},
                    { title: 'Product Name', data: 'productName', name: 'productName' ,"className": "text-center", orderable: true, searchable:true},
                    {{--  { title: 'Brand', data: 'brand', name: 'brand.brandName',"className": "text-center", orderable: true, searchable:true},  --}}
                    { title: 'Category Name', data: 'category', name: 'categoryName' ,"className": "text-center", orderable: false, searchable:false},
                    { title: 'Type', data: 'type', name: 'type' ,"className": "text-center", orderable: true, searchable:true},
                ],
                rowId: 'extn',
                select: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Reload table',
                        action: function () {
                            table.ajax.reload();
                        }
                    }
                ]
            });


            $('#button').click(function () {
                var ids = $.map(productTable.rows('.selected').data(), function (item) {
                    return item['productId'];
                 });
                 {{--  console.log(ids);
                    console.log(promoId);  --}}
                 var promoId = $("[name='promoid']").val();
                $.ajax({
                    url: "{{ route('promotion.productInsert') }}",
                    method: "POST",
                    data: {
                        '_token': '{{csrf_token()}}',
                        'value': ids,
                        'id': promoId
                    },
                    success: function (data) {
                        var url = '{{route("promotion") }}';
                         window.location.href = url;
                      }
                });
             });
        });
    </script>
@endsection


{{--  old  --}}
{{--  select: true,
                processing: true,
                serverSide: true,
                bDestroy: true,
                responsive: true,
                stateSave: true,
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                ajax:{
                    "url": "{!! route('product.list') !!}",
                    "type": "GET",
                    data:function (d){
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

            productTable.on("click", "th.select-checkbox", function() {
                if ($("th.select-checkbox").hasClass("selected")) {
                    productTable.rows().deselect();
                    $("th.select-checkbox").removeClass("selected");
                } else {
                    productTable.rows().select();
                    $("th.select-checkbox").addClass("selected");
                }
            });  --}}