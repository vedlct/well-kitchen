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
                                    <h4 class="card-title">Customer Reports</h4>
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
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="table table-responsive">
                                            <table id="customerReportTable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Customer ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Membership</th>
                                                    <th>Phone</th>
                                                    <th>Total Quantity</th>
                                                    <th>Total Ordered</th>
                                                    <th>Total Paid</th>
                                                    <th>Total Due</th>
                                                    <th>Action</th>
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
            dataTable = $('#customerReportTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('report.customerReport') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.fromDate=$('#fromDate').val();
                        d.toDate=$('#toDate').val();
                    },
                },

                columns: [
                    {name: 'customerId', data: 'customerId', orderable: true, searchable: true},
                    {name: 'firstName', data: 'firstName', orderable: true, searchable: true},
                    {name: 'membership', data: 'membership', orderable: true, searchable: true},
                    {name: 'phone', data: 'phone', orderable: true, searchable: true},
                    {name: 'total', data: 'total', orderable: true, searchable: true},
                    {name: 'customerTotal', data: 'customerTotal', orderable: true, searchable: true},
                    {name: 'totalPaid', data: 'totalPaid', orderable: true, searchable: true},
                    {name: 'totalDue', data: 'totalDue', orderable: true, searchable: true},
                    {className: "text-center", data: function (data) {
                            temp = '<a title="view" class="btn btn-info btn-sm" data-panel-id= "'+data.customerId+'" onclick="viewReport(this)"><i class="ft ft-eye"></i></a>';
                            return temp;
                        },
                        orderable: false, searchable: false
                    },
                ],

            });
        });
        function dateChange(x) {
            dataTable.ajax.reload();
        }

        function viewReport(x){
            btn = $(x).data('panel-id');
            var url = '{{route("report.customer.detail", ":id") }}';
            var newUrl = url.replace(':id', btn);
            window.location.href = newUrl;
        }

    </script>
@endsection
