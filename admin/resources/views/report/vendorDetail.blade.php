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
                                    <h4 class="card-title">Vendor Reports Detail</h4>
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

                                        </div>
                                        <div class="table table-responsive">
                                            <table id="productTable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Vendor Shop</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Purchase Date</th>
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
            dataTable = $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                stateSave: true,
                    "ajax": {
                        "url" : "{!! route('report.vendorReportDetail') !!}",
                        "type" : "POST",
                        data :function (d){
                            d._token="{{csrf_token()}}";
                            d.vendorId = {{$vendorId}}
                        },
                    },

                    columns: [
                        {name: 'vendor_shop_name', data: 'vendor_shop_name', className: "text-center", orderable: true, searchable: true},
                        {name: 'totalQuantity', data: 'totalQuantity', className: "text-center", orderable: true, searchable: true},
                        {name: 'totalPurchasePrice', data: 'totalPurchasePrice', className: "text-center", orderable: true, searchable: true},
                        {name: 'purchaseDate', data: 'purchaseDate', className: "text-center", orderable: true, searchable: true},
                    ],
                });
        });
        function dateChange(x) {
            dataTable.ajax.reload();
        }



    </script>
@endsection
