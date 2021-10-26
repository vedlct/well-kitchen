@extends('layouts.main')
@section('header.css')
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
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="offset-md-1 col-md-10">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">All permissions</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form action="{{route('role.permisson.submit')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="roleId" value="{{$roleId}}">
                                            <div class="content">
                                                <div class="table table-responsive">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <th>Header</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($permissions) > 0)
                                                            @foreach($permissions as $key => $permission)
                                                                <tr>
                                                                    <td>{{str_replace('_', ' ', Str::title($permission->header_name))}}</td>
                                                                    <td><input type="checkbox" name="{{$permission->header_id}}" value="{{$permission->header_id}}" @if(in_array($permission->header_id,$rolePermission->pluck('permission_id')->toArray())) checked @endif></td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
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
