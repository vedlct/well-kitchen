@extends('layouts.main')

@section('header.css')
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
                                    <h4 class="card-title">All Delivery Service</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('deliveryService.add') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table table-responsive">
                                            <table id="menuTable"
                                                   class="table table-striped table-bordered nowrap">
                                                   <thead>
                                                    <tr>
                                                        <th class="text-center">Company Name</th>
                                                        <th class="text-center">Phone</th>
                                                        <th class="text-center">Location</th>
                                                        <th class="text-center">Delivery Type</th>
                                                        <th class="text-center">Action</th>
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
    <!--/ Zero configuration table -->
@endsection
@section('footer.js')
<script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
          $(document).ready( function () {
            table = $('#menuTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": {
                    "url": "{!! route('deliveryService.list') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },

                columns: [
                    { data: 'companyName'},
                    { data: 'phone'},
                    { data: 'location'},
                    { data: 'delivery_type'},

                    { "data": function(data){
                            return '<a class="btn btn-info btn-sm" data-panel-id="'+data.deliveryServiceId+'" onclick="editDeliveryService(this)"><i class="ft-edit"></i></a>'+
                                ' <button type="button" class="btn btn-danger btn-sm" data-panel-id="'+data.deliveryServiceId+'" onclick="deleteDeliveryService(this)"> <i class="ft-trash"></i> </button>'
                                ;},
                    }
                ],

            });
        });

        function editDeliveryService(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("deliveryService.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }
        function deleteDeliveryService(x) {
            deliveryServiceId = $(x).data('panel-id');
            if(!confirm("Delete This Delivery Service?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{!! route('deliveryService.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'deliveryServiceId': deliveryServiceId},
                success: function () {
                    $('#menuTable').DataTable().clear().draw();
                }
            });
        }
    </script>
@endsection
