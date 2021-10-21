@extends('layouts.main')

@section('header.css')
    <link rel="stylesheet" type="text/css"
          href="{{url('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
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
                                    <h4 class="card-title">Stock Reports</h4>
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
                                        <div class="dateFiler">
                                                <div class="form-body">
                                        {{--<div class="row">--}}
                                        {{--    <div class="col-md-2">--}}
                                        {{--        <div class="form-group">--}}
                                        {{--            <input id="fromDate" type="date" class="form-control" onchange="dateChange(this)"  name="fromdate">--}}
                                        {{--        </div>--}}
                                        {{--    </div>--}}
                                        {{--    <div class="col-md-2">--}}
                                        {{--        <div class="form-group">--}}
                                        {{--            <input id="toDate" type="date" class="form-control" onchange="dateChange(this)"  name="todate">--}}
                                        {{--        </div>--}}
                                        {{--    </div>--}}
                                        {{--</div>--}}
                                                </div>
                                        </div>
                                        <div class="table table-responsive">
                                            <table id="categoryReportTable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Product ID</th>
                                                    <th>Product Name</th>
                                                    <th>Variation</th>
                                                    <th>Available</th>
                                                    <th>Total Purchase</th>
                                                    <th>Total Sale</th>
                                                    <th>Return Stock</th>
                                                </tr>
                                                </thead>
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
    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            let temp = '';
            dataTable = $('#categoryReportTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('report.stockReport') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.fromDate=$('#fromDate').val();
                        d.toDate=$('#toDate').val();
                    },
                },

                columns: [
                    {name: 'fkproductId', data: 'fkproductId', orderable: true, searchable: true},
                    {name: 'productName', data: 'productName', orderable: true, searchable: true},
                    {name: 'variation', data: 'variation', orderable: true, searchable: true},
                    {name: 'available', data: 'available', orderable: true, searchable: true},
                    {name: 'totalPurchase', data: 'totalPurchase', orderable: true, searchable: true},
                    {name: 'totalSale', data: 'totalSale', orderable: true, searchable: true},
                    {name: 'returnStock', data: 'returnStock', orderable: true, searchable: true},
                ],

            });
        });
        function dateChange(x) {
            dataTable.ajax.reload();
        }
    </script>
@endsection
