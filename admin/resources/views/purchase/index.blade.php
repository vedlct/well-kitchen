@extends('layouts.main')
@section('header.css')
<link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/plugins/pickers/daterange/daterange.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/pickers/daterange/daterangepicker.css')}}">
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
                                <h4 class="card-title">Purchase List</h4><a href="{{route('export')}}">Export</a>
                                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file" class="form-control">
                                        <br>
                                        <button class="btn btn-success">Import User Data</button>

                                    </form>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                                <div class="form-row">
                                    <div class="col-3 mt-2"> 
                                                <input id="fromDate" type="date" class="form-control" onchange="dateChange(this)"  name="fromdate">
                                    
                                        </div>
                                        <div class="col-3 mt-2">
                                                <input id="toDate" type="date" class="form-control" onchange="dateChange(this)"  name="todate">
                                            
                                        </div>
                                    <div class="col-3 mt-2">
                                        <select class="form-control" id="vendorInfo" onchange="vendorChange()">
                                            <option value="">Select vendor</option>
                                            @foreach ($vendor as $item)
                                                <option value="{{$item->vendor_shop_name}}">{{$item->vendor_shop_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="table table-responsive">
                                    <table class="table table-striped table-bordered nowrap purchaseTable" id="purchaseTable"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div id="purchaseModal"></div>
@endsection
@section('footer.js')
<script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>
<script>
        function table() {
            $('#purchaseTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                Filter: true,
                bDestroy: true,
                type:"POST",
                "ajax":{
                    "url": "{!! route('purchase.list') !!}",
                    "type": "POST",
                    "data":function (d){
                            d._token="{{csrf_token()}}";
                            d.vendorInfo = $('#vendorInfo').val();
                            d.startDate = $('#fromDate').val();
                            
                             d.endDate = $('#toDate').val();
                            
                        },
                },
                columns: [
                        { title: 'Batch', data: 'batchId', name: 'batchId' ,className: "text-center", orderable: true, searchable:true},
                        { title: 'Product Name', data: 'productName', name: 'product.productName' ,className: "text-center", orderable: false, searchable:true},
                        { title: 'Variation', data: 'variation', name: 'variation' ,className: "text-center", orderable: false, searchable:false},
                        { title: 'Vendor', data: 'vendor_shop_name', name: 'vendor.vendor_shop_name' ,className: "text-center", orderable: false, searchable:true},
                        { title: 'Quantity', data: 'Quantity', name: 'stock.stock' ,className: "text-center", orderable: false, searchable:false},
                        { title: 'Created', data: 'created_at', name: 'created_at' ,className: "text-center", orderable: true, searchable:true,
                                render: (data)=> data.split('T')[0]
                            },
                        { title: 'Updated', data: 'updated_at', name: 'updated_at' ,className: "text-center", orderable: true, searchable:true,
                                render: (data) =>  data.split('T')[0]
                                
                        },
                        { title: 'Action', data: 'action', name: 'action',className: "text-center", orderable: false, searchable:false}
                    ],
            });
        };

        table()
        function vendorChange(){
            table();
        }

        function dateChange(x) {
            $('#purchaseTable').DataTable().draw();
        }

        function editBatch(batchId,newPurchase = false) {
            $.ajax({
                url: "{!! route('purchase.edit.modal') !!} ",
                method: 'post',
                data: {
                    '_token': '{{csrf_token()}}',
                    'batchId': batchId,
                    'newPurchase': newPurchase
                },
                success: function (data) {
                    $('#purchaseModal').html(data);
                    $('#purchase-Modal').modal('toggle');
                }
            });
        }
</script>
@endsection
