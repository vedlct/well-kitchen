@extends('layouts.main')
@section('header.css')
<link href="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('public/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
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
                                    <h4 class="card-title">All Page</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('page.add') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
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
                                            <table id="pageTable"
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
@endsection
@section('footer.js')
        <script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            table = $('#pageTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": {
                    "url": "{!! route('page.list') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },
                columns: [
                    { title: 'Page Id', data: 'pageId', name: 'pageId', className: "text-center", orderable: true, searchable:true},
                    { title: 'Page Name', data: 'pageTitle', name: 'pageTitle', className: "text-center", orderable: true, searchable:true},
                    { title: 'Image', data: 'imageData', className: "text-center", orderable: false, searchable:false},
                    { title: 'Created', data: 'created_at', name: 'created_at', className: "text-center", orderable: true, searchable:true},
                    { title: 'Updated', data: 'updated_at', name: 'updated_at', className: "text-center", orderable: true, searchable:true},
                    { title: 'Status',data: 'statusField', name: 'status', className: "text-center", orderable: true, searchable:true },
                    { title: 'Action', data : function(data){
                            return '<a class="btn btn-info btn-sm" data-panel-id="'+data.pageId+'" onclick="editPage(this)" title="Edit"><i class="ft-edit"></i></a>';}, orderable: false, searchable:false, className: "text-center"}
                ]
            });
        });

        function editPage(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("page.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;

        }
    </script>
@endsection