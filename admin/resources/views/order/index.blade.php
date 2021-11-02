@extends('layouts.main')
@section('header.css')
{{--    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/plugins/pickers/daterange/daterange.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/pickers/daterange/daterangepicker.css')}}">
<link href="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{url('public/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
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
                <!-- category datatable began -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Order List</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input id="fromDate" type="date" class="form-control" onchange="dateChange(this)"  name="fromdate">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input id="toDate" type="date" class="form-control" onchange="dateChange(this)"  name="todate">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select id="status" name="status" onchange="dateChange(this)"  class="form-control">
                                                        <option value="" selected>Select Status</option>
                                                        <option value="Created">Created</option>
                                                        <option value="Processing">Processing</option>
                                                        <option value="OnDelivery">OnDelivery</option>
                                                        <option value="Delivered">Delivered</option>
                                                        <option value="Return">Return</option>
                                                        <option value="Complete">Complete</option>
                                                        <option value="Cancel">Cancel</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
{{--                                    <div class="form-row">--}}
{{--                                        <div class="col-4 mt-2">--}}
{{--                                            <label for="">Date</label>--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-2">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <input id="fromDate" type="date" class="form-control" onchange="dateChange(this)"  name="fromdate">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-2">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <input id="toDate" type="date" class="form-control" onchange="dateChange(this)"  name="todate">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-4 mt-2">--}}
{{--                                            <label for="">Order Status</label>--}}
{{--                                            <div class="input-group">--}}
{{--                                                <select id="status" name="status" onchange="statusChange(this)"  class="form-control">--}}
{{--                                                    <option value="" selected>Select</option>--}}
{{--                                                    <option value="Created">Created</option>--}}
{{--                                                    <option value="Processing">Processing</option>--}}
{{--                                                    <option value="OnDelivery">OnDelivery</option>--}}
{{--                                                    <option value="Delivered">Delivered</option>--}}
{{--                                                    <option value="Return">Return</option>--}}
{{--                                                    <option value="Complete">Complete</option>--}}
{{--                                                    <option value="Cancel">Cancel</option>--}}
{{--                                                </select>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="card-content collapse show">
                                    <div class="table table-responsive">
                                        <table class="table table-striped table-bordered nowrap purchaseTable" id="orderTable"></table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div id="statusModal"></div>
@endsection
@section('footer.js')
{{--    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>--}}
{{--    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>--}}
<script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('public/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            table()
        });
        function table() {
            dataTable = $('#orderTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                Filter: true,
                bDestroy: true,
                type:"POST",
                "ajax":{

                    "url": "{!! route('order.list') !!}",
                    "type": "POST",
                    "data":function (d){
                        d._token="{{csrf_token()}}";
                        d.vendorInfo = $('#vendorInfo').val();
                        d.orderStatus=$('#status').val();
                        d.fromDate=$('#fromDate').val();
                        d.toDate=$('#toDate').val();

                    },
                },
                columns: [
                    { title: 'Action', name: 'action',className: "text-center", orderable: false, searchable:false,
                        data:(data)=>{
                            return `<a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="showOrder(${data.orderId})" title="Order show"><i class="ft-eye"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="orderStatus(${data.orderId})" title="Status change"><i class="ft-refresh-cw"></i></a>`
                        }
                    },
                    { title: 'OrderID', data: 'orderId', name: 'orderId' ,className: "text-center", orderable: true, searchable:true},
                    { title: 'Phone', data: 'phone', name: 'customer.phone' ,className: "text-center", orderable: true, searchable:true},
                    { title: 'Order Total', data: 'orderTotal', name: 'orderTotal' ,className: "text-center", orderable: true, searchable:false},
                    { title: 'Total paid', data: 'totalpaid', name: 'totalpaid' ,className: "text-center", orderable: true, searchable:false},
                    { title: 'Remark', data: 'remark', name: 'remark' ,className: "text-center", orderable: true, searchable:false},
                    { title: 'Print', name: 'print' ,className: "text-center", orderable: true, searchable:false,
                        data:(data)=>{
                            if(data.print==1){
                                return `<i class="ft ft-printer"></i>`
                            }
                            else{
                                return 'NO'
                            }
                        }
                    },
                    { title: 'Status', data: 'last_status', name: 'last_status' ,className: "text-center", orderable: true, searchable:false},
                    { title: 'Created', data: 'created_at', name: 'order_info.created_at' ,className: "text-center", orderable: true, searchable:true,
                        render: (data)=> data.split('T')[0]
                    },
                    { title: 'Updated', data: 'updated_at', name: 'updated_at' ,className: "text-center", orderable: true, searchable:true,
                        render: (data) =>  data.split('T')[0]

                    }

                ],
            });
        };

        function showOrder(data){
            window.location.href=`{{route('order.details','')}}/${data}`
        }

        

        function orderStatus(data){
            $.ajax({
                type: "POST",
                url: '{{route('order.orderStatus')}}',
                data:{
                    'id':data,
                    '_token':"{{csrf_token()}}",
                    },
                success: function (response) {
                    $('#statusModal').html(response)
                    $('#statusChangeModal').modal('toggle');
                }
            });
        }

        $('#statusChangeModal').on('hide.bs.modal', function (e) {
            // $('#orderTable').dataTable().draw()
            alert('hi')
        })

        function tableReload(){
            alert('hi')
            $('#orderTable').dataTable().draw()
        }

        // function statusChange(x) {
        //     dataTable.ajax.reload();
        // }

        function dateChange(x) {
            dataTable.ajax.reload();
        }
    </script>
@endsection
