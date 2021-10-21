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
                                    <h4 class="card-title">All Slider</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('slider.add') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table table-responsive">
                                            <table id="sliderTable"
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
<script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
       $(document).ready(function () {
            table = $('#sliderTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": {
                    "url": "{!! route('slider.list') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },

                columns: [
                    {title:'Serial', data: 'serial', name: 'serial', class: 'text-center'},
                    {title:'Title Text', data: 'titletext', name: 'titletext', class: 'text-center'},
                    {title:'Main Text', data: 'mainText', name: 'mainText', class: 'text-center'},
                    {title:'Sub Text', data: 'subText', name: 'subText', class: 'text-center'},
                    {title:'Image', data: 'image', name: 'image', class: 'text-center'},
                    {title:'Status',data: 'status', name: 'status', class: 'text-center'},
                    {title:'Action', data: function (data) {
                        return '<a class="btn btn-info btn-sm" data-panel-id="' + data.sliderId + '" onclick="editSlider(this)"><i class="ft-edit"></i></a>'+
                        ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.sliderId + '" onclick="deleteSlider(this)"><i class="ft-trash-2"></i></a>'
                            ;
                    }
                    }
                    
                ],
            });
        });

        function editSlider(x)
        {
            var id = $(x).data('panel-id');
            var url = '{{route("slider.edit", ":id") }}';
            var newUrl = url.replace(':id', id);
            window.location.href = newUrl;
        }

        function deleteSlider(x) {
            sliderId = $(x).data('panel-id');
            if(!confirm("Delete This Category?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{!! route('slider.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'sliderId': sliderId},
                success: function (data) {
                    toastr.success('Slider deleted Successfully');
                    $('#sliderTable').DataTable().clear().draw();
                }
            });
        }

    </script>
@endsection
