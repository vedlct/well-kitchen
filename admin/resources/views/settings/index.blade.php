@extends('layouts.main')
@section('header.css')
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/plugins/pickers/daterange/daterange.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/pickers/daterange/daterangepicker.css')}}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
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
                                    <h4 class="card-title">Settings</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content p-2 collapse show">
                                    <div class="table table-responsive table-striped table-bordered">
                                        <table class="table mb-0" id="example-2">
                                            <thead>
                                                <tr>
                                                    <th class='text-center'>Company Name</th>
                                                    <th class='text-center'>Email</th>
                                                    <th class='text-center'>Company Logo</th>
                                                    <th class='text-center'>Redeem</th>
                                                    <th class='text-center'>Contact US</th>
                                                    <th class='text-center'>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class='text-center'><span
                                                            class="tabledit-span">{{ $setting->companyName }}</span>
                                                    </td>
                                                    <td class='text-center'><span
                                                            class="tabledit-span">{{ $setting->email }}</span></td>
                                                    <td class='text-center'><span class="tabledit-span"><img border="0"
                                                                width="50" class="img-rounded"
                                                                src="{{ url("public/settingImage/".$setting->imageLink) }}"></span>
                                                    </td>
                                                    <td class='text-center'>{{ $setting->redeem }}%</td>
                                                    <td class='text-center'> <input
                                                            data-id="{{ $setting->settingsID }}"
                                                            id="{{ $setting->settingsID }}" class="toggle-class"
                                                            type="checkbox" data-onstyle="success"
                                                            data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                            data-off="InActive"
                                                            {{ $setting->contactUS ? 'checked' : '' }}
                                                            onchange="con(this)"> </td>
                                                    <td class='text-center'><a class="btn btn-warning btn-sm" href="{{route('setting.edit',$setting->settingsID)}}"><i
                                                                class="ft-edit" ></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
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
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
         function con(){
            var status = $(".toggle-class").prop('checked') == true ? 1 : 0;
            var setting_id = $(".toggle-class").data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{route('setting.changeStatus')}}',
                data: {'status': status, 'setting_id': setting_id},
                success: function(data){
                }
            })
         }
    </script>

@endsection
