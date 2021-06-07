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
                                    <h4 class="card-title">All Store</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('store.add') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
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
                                            <table id="storeTable"
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
            $('#storeTable').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{!! route('store.list') !!}",
                type: "POST",
                data: function (d) {
                    d._token = "{{csrf_token()}}";
                },
            },
            columns: [
                {title: 'ID', data: 'storeId', name: 'storeId',className: "text-center", orderable: true, searchable:true},
                {title: 'Name', data: 'name', name: 'name',className: "text-center", orderable: true, searchable:true},
                {title: 'Location', data: 'location', name: 'location',className: "text-center", orderable: false, searchable:true},
                {title: 'Added By', data: 'added.firstName', name: 'added.firstName',className: "text-center", orderable: true, searchable:true},
                {title: 'Created', data: 'created_at', name: 'created_at',className: "text-center", orderable: true, searchable:true},
                {title: 'Updated', data: 'updated_at', name: 'updated_at',className: "text-center", orderable: true, searchable:true},
                {title: 'Action', data: 'action',className: "text-center", orderable: false, searchable:false}
            ],
        });
        });

        function editStore(x){
            var url = '{{route("store.edit", ":id") }}';
            var newUrl = url.replace(':id', x);
            window.location.href = newUrl;
        }

        function deleteUnit(x) {
            idproduct_unit = $(x).data('panel-id');
            if(!confirm("Delete This Unit?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{!! route('unit.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'idproduct_unit': idproduct_unit},
                success: function (data) {
                    toastr.success('unit deleted Successfully');
                    $('#unitTable').DataTable().clear().draw();
                },
            });
        }
    </script>
@endsection
