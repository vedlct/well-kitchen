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
                                    <h4 class="card-title">All Membership</h4>
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
                                            <table id="membershipTable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Membership ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Total Point</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

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
    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            let temp = '';
            dataTable = $('#membershipTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('membership.list') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },

                columns: [
                    {name: 'membershipId', data: 'membershipId', orderable: true, searchable: true},
                    {name: 'firstName', data: 'firstName', orderable: true, searchable: true},
                    {name: 'total', data: 'total', orderable: true, searchable: true},
                    {
                        "data": function (data) {
                            temp = '<a title="view" class="btn btn-info btn-sm" data-panel-id= "'+data.fkcustomerId+'" onclick="viewDetail(this)"><i class="ft ft-eye"></i></a>';
                            return temp;
                        },
                    },
                ],

            });
        });
        function dateChange(x) {
            dataTable.ajax.reload();
        }

        function viewDetail(x){
            btn = $(x).data('panel-id');
            var url = '{{route("membership.detail", ":id") }}';
            var newUrl = url.replace(':id', btn);
            window.location.href = newUrl;
        }

    </script>
@endsection
