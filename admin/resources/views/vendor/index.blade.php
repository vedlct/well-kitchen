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
                <!-- unit datatable began -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Vendor</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('vendor.add') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
{{--                                            <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table table-responsive">
                                            <table id="vendorTable"
                                                   class="table table-striped table-bordered nowrap">
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
    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>

    <script>
        $(document).ready(function () { 
             $('#vendorTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    "url": "{!!route('vendor.list')!!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },
                columns: [
                    {title:'Vendor ID', data: 'vendor_id', name: 'vendor_id', class: 'text-center'},
                    {title:'Vendor Name', data: 'vendor_firstName', name: 'vendorName', class: 'text-left'},
                    {title:'Vendor phone', data: 'vendor_phone', name: 'vendor_phone', class: 'text-center'},
                    {title:'Vendor shop', data: 'vendor_shop_name', name: 'vendor_shop_name', class: 'text-center'},
                    {title:'Status', data: 'status', name: 'status', class: 'text-center'},
                    {title:'Action', data:'action', class:'text-center', orderable: false, searchable:false}
                ]
            });
        })


            function editVendor(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("vendor.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }


        function deleteVendor(x) {
            vendor_id =  $(x).data('panel-id');
            if(!confirm("Delete This Vendor?")){
                return false;
            }

            $.ajax({
                type: 'POST',
                url: "{!! route('vendor.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'vendor_id': vendor_id},
                success: function (data) {
                    $('#vendorTable').DataTable().draw();
                }
            });
        }

    </script>
@endsection
