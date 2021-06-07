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
                                    <h4 class="card-title">All Menu</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('menu.add') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
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
                                                        <th class="text-center">Serial</th>
                                                        <th class="text-center">Menu Name</th>
                                                        <th class="text-center">Menu Order</th>
                                                        <th class="text-center">Menu Type</th>
                                                        {{-- <th class="text-center">Picture</th> --}}
                                                        <th class="text-center">Last Modified</th>
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
                    "url": "{!! route('menu.list') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },

                columns: [
                    { data: 'menuId', },
                    { data: 'menuName', },
                    { data: 'menuOrder', },
                    { data: 'menuType', },
                    // {
                    //     "name": "imageLink",
                    //     "data": "imageLink",
                    //     "render": function (data, type, full, meta) {
                    //         return "<img src=\"public/menuImage/" + data + "\" height=\"50\"/>";}
                    // },
                    { data: 'updated_at', name: 'updated_at' },
                    { "data": function(data){

                            return '<a class="btn btn-info btn-sm" data-panel-id="'+data.menuId+'" onclick="editMenu(this)"><i class="ft-edit"></i></a>'+
                                ' <button type="button" class="btn btn-danger btn-sm" data-panel-id="'+data.menuId+'" onclick="deleteMenu(this)"> <i class="ft-trash"></i> </button>'
                                ;},
                    }
                ],

            });
        });

        function editMenu(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("menu.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }
        function deleteMenu(x) {
            menuId = $(x).data('panel-id');
            if(!confirm("Delete This Menu?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{!! route('menu.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'menuId': menuId},
                success: function () {
                    $('#menuTable').DataTable().clear().draw();
                }
            });
        }
    </script>
@endsection
