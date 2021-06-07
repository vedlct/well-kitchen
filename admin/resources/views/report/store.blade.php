@extends('layouts.main')

@section('header.css')
{{--    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">--}}
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
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Store Reports</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table table-responsive">
                                            <table id="storeReportTable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Store ID</th>
                                                    <th>Store Name</th>
                                                    <th>Purchase Quantity</th>
                                                    <th>Purchase Price</th>
                                                    <th>Sale Quantity</th>
                                                    <th>Sale Price</th>
                                                    <th>Total Available</th>
                                                    <th>Profit</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($stores as $store)
                                                <tr>
                                                    <td>{{ $store->storeId }}</td>
                                                    <td>{{ $store->name }}</td>
                                                    @foreach($purchaseInfo->where('storeId', $store->storeId) as $purchase)
                                                        <td>{{ $purchase->totalPurchase }}</td>
                                                        <td>{{ $purchase->totalPurchasePrice }}</td>
                                                    @endforeach
                                                    @foreach($saleInfo->where('storeId', $store->storeId) as $sale)
                                                        <td>{{ $sale->totalSale }}</td>
                                                        <td>{{ $sale->totalSalePrice }}</td>
                                                        <td>{{ $purchase->available }}</td>
                                                        <td>@if(($sale->totalSalePrice - $purchase->totalPurchasePrice) > 0) {{$sale->totalSalePrice - $purchase->totalPurchasePrice}} @else 0 @endif</td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
{{--    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>--}}
{{--    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>--}}

    <script>
        {{--$(document).ready(function () {--}}
        {{--    let temp = '';--}}
        {{--    dataTable = $('#storeReportTable').DataTable({--}}
        {{--        processing: true,--}}
        {{--        serverSide: true,--}}
        {{--        responsive: true,--}}
        {{--        stateSave: true,--}}
        {{--        "ajax":{--}}
        {{--            "url": "{!! route('report.storeReport') !!}",--}}
        {{--            "type": "POST",--}}
        {{--            data:function (d){--}}
        {{--                d._token="{{csrf_token()}}";--}}
        {{--                d.fromDate=$('#fromDate').val();--}}
        {{--                d.toDate=$('#toDate').val();--}}
        {{--            },--}}
        {{--        },--}}

        {{--        columns: [--}}
        {{--            {name: 'storeId', data: 'storeId', orderable: true, searchable: true},--}}
        {{--            {name: 'name', data: 'name', orderable: true, searchable: true},--}}
        {{--            {name: 'purchaseQuantity', data: 'purchaseQuantity', orderable: true, searchable: false},--}}
        {{--            {name: 'saleQuantity', data: 'saleQuantity', orderable: true, searchable: false},--}}
        {{--            {name: 'totalSaleAmount', data: 'totalSaleAmount', orderable: true, searchable: false},--}}
        {{--            {--}}
        {{--                "data": function (data) {--}}
        {{--                    temp = '<a title="print" class="btn btn-warning btn-sm" data-panel-id="' + '" onclick="printReport(this)"><i class="ft ft-printer"></i></a>';--}}
        {{--                    return temp;--}}
        {{--                },--}}
        {{--            },--}}
        {{--        ],--}}

        {{--    });--}}
        {{--});--}}
        // function dateChange(x) {
        //     dataTable.ajax.reload();
        // }
    </script>
@endsection
