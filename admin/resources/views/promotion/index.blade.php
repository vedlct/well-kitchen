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
                                    <h4 class="card-title">All Promotion</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{route('promotion.create')}}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        {{-- <div class="table table-responsive">
                                            <table id="hotDealsTable"
                                                   class="table table-striped table-bordered nowrap">
                                            </table>
                                        </div> --}}
                                        <div class="card-block">
                                            <div class="table table-responsive">
                                                <table  class="table table-striped table-bordered nowrap promotion"></table>
                                            </div>
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
<script src="{{url('public/files/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('.promotion').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('promotion.list') }}",
                columns: [
                    { data: 'promotionsId', title: 'ID',"className": "text-center", orderable: true, searchable:true},
                    { data: 'promotionstitle', title: 'Title',"className": "text-center", orderable: true, searchable:true},
                    { data: 'image', title: 'Image', name: 'image' , orderable: true, searchable:true},
                    { data: 'promotionCode', title: 'Code',"className": "text-center", orderable: true, searchable:true},
                    { data: 'startDate', title: 'Start Date',"className": "text-center", orderable: true, searchable:true},
                    { data: 'endDate', title: 'End Date',"className": "text-center", orderable: true, searchable:true},
                    { data: 'amount', title: 'Max Amount',"className": "text-center", orderable: true, searchable:true},
                    { data: 'percentage', title: 'Percentage',"className": "text-center", orderable: true, searchable:true},
                    { data: 'status', title: 'status',"className": "text-center", orderable: true, searchable:true},
                    { title: 'Action',"className": "text-center","data": function(data){
                            return  '<a class="btn btn-info btn-sm mr-1" data-panel-id="'+data.promotionsId+'" onclick="addProduct(this)"> <i class="ft ft-plus"></i></a>'+
                                    '<a class="btn btn-warning btn-sm mr-1" data-panel-id="'+data.promotionsId+'" onclick="promotionDetails(this)"> <i class="ft ft-eye"></i></a>'+
                                    '<a class="btn btn-info btn-sm" data-panel-id="' + data.promotionsId + '" onclick="editPromo(this)"><i class="ft-edit"></i></a>'
                                    // '<a class="btn btn-primary btn-sm mr-1" data-panel-id="'+data.promotionsId+'" onclick="editPromo(this)"><i class="ft-edit"></i></a>'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" }
                ]
            });
        });

        function addProduct(x){
            btn = $(x).data('panel-id');
            var url = '{{route("promotion.promoProduct", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }
        function promotionDetails(x){
            btn = $(x).data('panel-id');
            var url = '{{route("promotion.showProduct", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }

        function editPromo(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("promotion.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }
        </script>
@endsection
