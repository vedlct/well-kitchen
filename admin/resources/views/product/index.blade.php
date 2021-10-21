@extends('layouts.main')

@section('header.css')

{{--    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">--}}
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
                                    <h4 class="card-title">All Products</h4>
                                    {{-- <a href="{{route('export')}}">Export</a> --}}
                                    {{-- <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file" class="form-control">
                                        <br>
                                        <button class="btn btn-success">Import User Data</button>

                                    </form> --}}
{{--                                    <a href="{{route('import')}}">Import</a>--}}
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('product.create') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table table-responsive">
                                            <table id="productTable"
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
{{--    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>--}}

{{--    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>--}}
{{--    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>--}}

    <script>
        $(document).ready(function () {
            $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: "{{ url('product/list') }}",
                columns: [
                    {title: 'Product ID', data: 'productId', name: 'productId', className: "text-center", orderable: true, searchable: true},
                    {title: 'Product Name', data: 'productName', name: 'productName', className: "text-center", orderable: true, searchable: true},
                    {title: 'Product Image', data: 'featureImage', name: 'featureImage', className: "text-center", orderable: false, searchable: false},
                    {title: 'Category', data: 'category', name: 'categoryName', className: "text-center", orderable: false, searchable: false},
                    {title: 'Brand', data: 'brand', name: 'brandName', className: "text-center", orderable: false, searchable: false},
                    {title: 'Product Type', data: 'type', name: 'type', className: "text-center", orderable: false, searchable: false},
                    {title: 'Status', data: 'status', name: 'status', className: "text-center", orderable: false, searchable: false},
                    {title: 'Action', className: "text-center", data: function (data) {
                            return '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.productId + '" onclick="editProduct(this)"><i class="ft-edit"></i></a>'+
                                ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.productId + '" onclick="deleteProduct(this)"><i class="ft-trash-2"></i></a>'
                                ;
                        },
                        orderable: false, searchable: false
                    }
                ]
            });
        });

        function editProduct(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("product.edit", ":id") }}';
            var newUrl = url.replace(':id', btn);
            window.location.href = newUrl;
        }



        function deleteProduct(x) {
            productId = $(x).data('panel-id');
            if(!confirm("Delete This Product?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{!! route('product.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'productId': productId},
                success: function (data) {
                    toastr.success('product deleted Successfully');
                    $('#productTable').DataTable().clear().draw();
                }
            });
        }
    </script>
@endsection
