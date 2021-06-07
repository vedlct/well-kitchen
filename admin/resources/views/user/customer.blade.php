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
                                    <h4 class="card-title">All Customers</h4>
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
                                            <table id="customerTable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Customer ID</th>
                                                    <th>User ID</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Membership</th>
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
    {{--    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>--}}
    {{--    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>--}}

    <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            dataTable = $('#customerTable').DataTable({
                processing: true,
                serverSide: true,

                "ajax":{
                    "url": "{!! route('user.customer.list') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },

                columns: [
                    {name: 'customerId', data: 'customerId', orderable: true, searchable: false},
                    {name: 'userId', data: 'user.userId', orderable: true, searchable: true},
                    {name: 'Name', data: 'user.firstName', orderable: false, searchable: false},
                    {name: 'phone', data: 'phone', orderable: true, searchable: true},
                    {name: 'membership', data: 'membership', orderable: true, searchable: true},
                    {className: "text-center", data: function (data) {
                            return `<a title="membership" style="color: #fff" class="btn btn-primary btn-sm membershipIcon${data.fkuserId}" data-panel-id="${data.fkuserId}"
                                       onclick="membershipStatus(this)"><i class="ft ft-user-check"></i></a>`;
                        },
                        orderable: false, searchable: false
                    }

                ],

            });
        });

        // Membership status change
        function membershipStatus(x){
            userId = $(x).data('panel-id');
            $.ajax({
                type: "POST",
                url: "{{route('user.customer.membershipStatus')}}",
                data: {_token: "{{ csrf_token() }}", 'userId': userId,},
                success: function (data){
                    console.log(data);
                    dataTable.ajax.reload();
                }
            });
        }

    </script>
@endsection
