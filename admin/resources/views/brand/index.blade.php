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
                <!-- brand datatable began -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Brands</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('brand.create') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table table-responsive">
                                            <table id="brandTable"
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
{{--    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>--}}
{{--    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>--}}

<script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#brandTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('brand/list') }}",
                columns: [
                    {title: 'Brand ID', data: 'brandId', name: 'brandId', className: "text-center", orderable: true, searchable: true},
                    {title: 'Brand Logo', data: 'brandLogo', name: 'brandLogo', className: "text-center", orderable: false, searchable: false},
                    {title: 'Brand Name', data: 'brandName', name: 'brandName', className: "text-center", orderable: true, searchable: true},
                    {title: 'Status', data: 'status', name: 'status',"className": "text-center", orderable: true, searchable:true},
                    {title: 'Action', className: "text-center", data: function (data) {
                            return '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.brandId + '" onclick="editBrand(this)"><i class="ft-edit"></i></a>'+
                                ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.brandId + '" onclick="deleteBrand(this)"><i class="ft-trash-2"></i></a>'
                                ;
                        },
                        orderable: false, searchable: false
                    }
                ]
            });
        });

        function editBrand(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("brand.edit", ":id") }}';
            var newUrl = url.replace(':id', btn);
            window.location.href = newUrl;
        }

        function deleteBrand(x) {
            brandId = $(x).data('panel-id');
            if(!confirm("Delete This Brand?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{!! route('brand.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'brandId': brandId},
                success: function (data) {
                    toastr.success('brand deleted Successfully');
                    $('#brandTable').DataTable().clear().draw();
                },
                error: function (data){
                    toastr.warning('brand has product');
                    $('#brandTable').DataTable().clear().draw();
                }
            });
        }
    </script>
@endsection
