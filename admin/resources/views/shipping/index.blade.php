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
                                    <h4 class="card-title">All SHIPPING</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('shipping.add') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
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
                                                   class="table table-striped table-bordered nowrap shipping">
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
        $('.shipping').DataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                    "url": "{{ route('shipping.list') }}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },
            columns: [
                // { title: 'ZoneId', data: 'shipment_zoneId', name:'shipment_zoneId', className: "text-center", orderable: true, searchable:true},
                { title: 'Shipping Name', data: 'shipment_zoneName', name:'shipment_zoneName', className: "text-center", orderable: true, searchable:true},
                { title: 'Charge', data: 'ChargesDeliveryFee', name:'ChargesDeliveryFee', className: "text-center", orderable: true, searchable:true},
                // { title: 'Custom Shipping Charge', data: 'CustomShippingDeliveryFee', name:'CustomShippingDeliveryFee', className: "text-center", orderable: true, searchable:true},
                { title: 'Status', data: 'statusField', className: "text-center", orderable: true, searchable:true},
                { title: 'Action', className: "text-center","data": function(data){
                        return '<a class="btn btn-info btn-sm" data-panel-id="'+data.shipment_zoneId+'" onclick="editShipping(this)" title="Edit"><i class="ft-edit"></i></a>'+
                            '<a class="btn btn-warning btn-sm" data-panel-id="'+data.shipment_zoneId+'" onclick="changeStatus(this)" title="Change status"><i class="ft-trash-2"></i></a>'
                            ;},
                    orderable: false, searchable:false}
            ]
        });
    });

    function editShipping(x) {
        btn = $(x).data('panel-id');
        var url = '{{route("shipping.edit", ":id") }}';
        var newUrl=url.replace(':id', btn);
        window.location.href = newUrl;
    }

    function changeStatus(x) {
            shippingId = $(x).data('panel-id');
            var confirmCheck = confirm("Are you sure to change status..!!");
            if (confirmCheck != false) {
                $.ajax({
                    type: 'post',
                    url: "{!! route('shipping.change.status') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}",'shippingId': shippingId},
                    success: function (data) {
                        $('.shipping').DataTable().clear().draw();
                    }
                });
            }
        }

    
</script>
@endsection
