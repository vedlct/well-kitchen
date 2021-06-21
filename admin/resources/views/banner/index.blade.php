@extends('layouts.main')

@section('header.css')
    <link rel="stylesheet" type="text/css"
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
                <!-- category datatable began -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Banner</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('banner.create') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
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
                                            <table id="bannerTable"
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
{{--    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>--}}
{{--    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>--}}

<script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#bannerTable').DataTable({
                processing: true,
                serverSide: true,
                // ajax: "{{ url('banner/list') }}",
                "ajax": {
                    "url": "{!! route('banner.list') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },
                columns: [
                    // {title: 'Banner ID', data: 'bannerId', name: 'bannerId', className: "text-center", orderable: true, searchable: true},
                    {title: 'Image', data: 'image', name: 'imageLink', className: "text-center", orderable: false, searchable: false},
                    // {title: 'Status', data: 'status', name: 'status', className: "text-center", orderable: true, searchable: true},
                    { data: 'status', name: 'status', orderable: true, searchable: true},
                    {title: 'Type', data: 'type', name: 'type', className: "text-center", orderable: true, searchable: true},
                    // { title:'Parent', data: 'parentName', name: 'parent',className: "text-center", orderable: true, searchable:true},
                    // {title: 'Created', data: 'created_at', name: 'created_at', className: "text-center", orderable: true, searchable: true},
                    // {title: 'Updated', data: 'updated_at', name: 'updated_at', className: "text-center", orderable: true, searchable: true},
                    {title: 'Action', className: "text-center", data: function (data) {
                            return '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.bannerId + '" onclick="editBanner(this)"><i class="ft-edit"></i></a>'+
                                ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.bannerId + '" onclick="deleteBanner(this)"><i class="ft-trash-2"></i></a>'
                                ;
                        },
                        orderable: false, searchable: false
                    }

                 ]
            });
        });

        function editBanner(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("banner.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }
        function deleteBanner(x) {
            bannerId = $(x).data('panel-id');
            if(!confirm("Delete This Image?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{!! route('banner.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'bannerId': bannerId},
                success: function () {
                    $('#bannerTable').DataTable().clear().draw();
                }
            });
        }
    </script>
@endsection
