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
                                    <h4 class="card-title">All Hot deals</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('hotdeals.add') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table table-responsive">
                                            <table id="hotDealsTable"
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
            table = $('#hotDealsTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": {
                    "url": "{!! route('hotdeals.show') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },

                columns: [
                    {title:'ID', data: 'hotDealsId', name: 'hotDealsId', class: 'text-center'},
                    {title:'Hot Deals Name', data: 'hotDeals_name', name: 'hotDeals_name', class: 'text-center'},
                    {title:'Start Form',data: 'startDate', name: 'startDate', class: 'text-center'},
                    {title:'Ends At',data: 'endDate', name: 'endDate', class: 'text-center'},
                    {title:'Amount',data: 'amount', name: 'amount', class: 'text-center'},
                    {title:'Discount Rate',data: 'percentage', name: 'percentage', class: 'text-center'},
                    {title:'Status',data: 'status', name: 'status', class: 'text-center'},
                    {title:'Action', data: function (data) {
                        return '<a class="btn btn-info btn-sm" data-panel-id="' + data.hotDealsId + '" onclick="editDeals(this)"><i class="ft-edit"></i></a>' +
                            '<a class="btn btn-warning btn-sm mr-1 ml-1" data-panel-id="'+data.hotDealsId+'" onclick="HotproductDetails(this)"> <i class="ft ft-eye"></i></a>'
                            // '<button type="button" class="btn btn-danger btn-sm" data-panel-id2="' + data.hotDealsId + '" onclick="deleteDeals(this)"> <i class="fa fa-trash "></i> </button>'
                            ;
                    },
                    orderable: false, searchable: false, class: 'text-center'
                    },
                ],
            });
        });

        function editDeals(x)
        {
            var id = $(x).data('panel-id');
            var url = '{{route("hotdeals.edit", ":id") }}';
            var newUrl = url.replace(':id', id);
            window.location.href = newUrl;
        }

        // function deleteCategory(x) {
        //     categoryId = $(x).data('panel-id');
        //     if(!confirm("Delete This Category?")){
        //         return false;
        //     }
        //     $.ajax({
        //         type: 'POST',
        //         url: "{!! route('category.delete') !!}",
        //         cache: false,
        //         data: {_token: "{{csrf_token()}}",'categoryId': categoryId},
        //         success: function (data) {
        //             toastr.success('category deleted Successfully');
        //             $('#hotDealsTable').DataTable().clear().draw();
        //         }
        //     });
        // }

        function HotproductDetails(x){
            btn = $(x).data('panel-id');
            var url = '{{route("hotdeals.showProduct", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;

        }
    </script>
@endsection
