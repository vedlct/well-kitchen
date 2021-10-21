@extends('layouts.main')

@section('header.css')
{{--    <link rel="stylesheet" type="text/css"--}}
{{--          href="{{url('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">--}}
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
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Collection Reports</h4>
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
                                                        <div class="col-md-3">
                                                            <h3 id="totalCollection"></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="table table-responsive">
                                            <table id="collectionReportTable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Phone</th>
                                                    <th>Order ID</th>
                                                    <th>Amount</th>
                                                    <th>Collection Date</th>
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
{{--    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>--}}
{{--    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>--}}

<script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            dataTable = $('#collectionReportTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('report.collectionReport') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.fromDate=$('#fromDate').val();
                        d.toDate=$('#toDate').val();
                    },
                },

                fnDrawCallback: function(data) {
                    $('#totalCollection').html('Total Collection: '+data.json.totalCollection+'tk');
                },

                columns: [
                    {name: 'firstName', data: 'firstName', orderable: true, searchable: true},
                    {name: 'phone', data: 'phone', orderable: true, searchable: true},
                    {name: 'fkorderId', data: 'fkorderId', orderable: true, searchable: true},
                    {name: 'totalAmount', data: 'totalAmount', orderable: true, searchable: true},
                    {name: 'collectionDate', data: 'collectionDate', orderable: true, searchable: true},

                ],

            });
        });
        function dateChange(x) {
            dataTable.ajax.reload();
        }
    </script>
@endsection
