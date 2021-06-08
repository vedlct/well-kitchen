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
                                    <h4 class="card-title">All Testimonial</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('testimonial.create') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
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
                                            <table id="testimonialTable"
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
            $('#testimonialTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('testimonial/list') }}",
                columns: [
                    // {title: 'testimonial ID', data: 'testimonial_id', name: 'testimonial_id', className: "text-center", orderable: true, searchable: true},
                    {title: 'Name', data: 'name', name: 'name', className: "text-center", orderable: true, searchable: true},
                    {title: 'Designation', data: 'designation', name: 'designation', className: "text-center", orderable: true, searchable: true},
                    {title: 'Status', data: 'status', name: 'status', className: "text-center", orderable: true, searchable: true},
                    {title: 'Home', data: 'home', name: 'home', className: "text-center", orderable: true, searchable: true},
                    {title: 'Action', className: "text-center", data: function (data) {
                            return '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.testimonial_id + '" onclick="editTestimonial(this)"><i class="ft-edit"></i></a>'+
                                ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.testimonial_id + '" onclick="deleteTestimonial(this)"><i class="ft-trash-2"></i></a>'
                                ;
                        },
                        orderable: false, searchable: false
                    }
                ]
            });
        });

        function editTestimonial(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("testimonial.edit", ":id") }}';
            var newUrl = url.replace(':id', btn);
            window.location.href = newUrl;
        }

        function deleteTestimonial(x) {
            testimonial_id = $(x).data('panel-id');
            if(!confirm("Delete This Testimonial?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{!! route('testimonial.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'testimonial_id': testimonial_id},
                success: function (data) {
                    toastr.success('testimonial deleted Successfully');
                    $('#testimonialTable').DataTable().clear().draw();
                },
            });
        }
    </script>
@endsection
