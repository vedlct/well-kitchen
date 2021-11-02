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
                <!-- brand datatable began -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All USers</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ route('user.create') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table table-responsive">
                                            <table id="userTable"
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

    {{-- Role Change Model --}}
    <div class="modal fade" id="changeRoleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="changeRoleForm">
                        @csrf
                        <input type="hidden" id="userId" name="userId">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="roles">Roles</label>
                            <div class="col-sm-10">
                                <select id="roles" class="form-control" name="role" >
                                    <option value="">Select</option>
                                    @if(count($roles)>0)
                                        @foreach($roles as $role)
                                            <option value="{{$role->userTypeId}}">{{$role->typeName}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="roleChangeSubmit()">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Password Change Model --}}
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change User Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm">
                        @csrf
                        <input type="hidden" id="user_id" name="userId">
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input class="form-control" type="password" name="new_password" id="new_password" placeholder="New Password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="passwordChangeSubmit()">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer.js')
    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                type:"POST",
                ajax:{
                    "url": "{{ route('user.list') }}",
                    "type": "POST",
                    "data":function (d){
                            d._token="{{csrf_token()}}";
                        },
                },
                columns: [
                    {"title": "Serial",
                        render:  (data, type, row, meta)=> ++ meta.row
                    },
                    {title: 'User ID', data: 'userId', name: 'userId', className: "text-center", orderable: true, searchable: true},
                    {title: 'First Name', name: 'firstName', className: "text-center", orderable: false, searchable: false,data:(data) => `${data.firstName} ${data.lastName}`},
                    {title: 'Email', data: 'email', name: 'email', className: "text-center", orderable: true, searchable: true},
                    {title: 'Role', name: 'userType.typeName',className: "text-center", orderable: true, searchable:true,data:(data)=> {
                        return `${data.user_type.typeName.charAt(0).toUpperCase()}${data.user_type.typeName.slice(1)}`
                        }
                    },

                    {title: 'Action', className: "text-center", data: function (data) {
                            return `<a title="edit" class="btn btn-info btn-sm" data-panel-id="${data.userId}" onclick="changeRole(${data.userId},${data.userId})"><i class="ft-edit"></i></a>
                                    <a title="delete" class="btn btn-danger btn-sm" data-panel-id="${data.userId}" onclick="deleteBrand(this)"><i class="ft-trash-2"></i></a>
                                    <a title="change password" class="btn btn-info btn-sm" data-panel-id="${data.userId}" onclick="changePassword(this)"><i class="ft-lock"></i></a>`;
                        },
                        orderable: false, searchable: false
                    }
                ]
            });
        });


        function changeRole(userRole,userId) {
            $('#userId').val(userId);
            $('#roles').val(userRole);
            $('#changeRoleModal').modal('toggle');
        }

        function roleChangeSubmit() {
            $.ajax({
                url: "{{ route('user.roleChange') }}",
                method: 'post',
                cache: false,
                processData: false,
                contentType: false,
                data: new FormData($("#changeRoleForm")[0]),
                success: function (data) {
                    $('#userTable').DataTable().ajax.reload();
                    $('#changeRoleModal').modal('toggle');
                },
                error: function (err) {
                    if (err.status == 422) {
                        $("#addProductFrom").find("small").remove();
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            var errorMSG = error[0].replace('[]', '');
                            el.after($('<small style="color: #ff0000;font-weight: bold;">' + errorMSG + '</small>'));
                        });
                    }
                }
            });
        }

        function changePassword(userId) {
            data = $(userId).data('panel-id');
            $('#changePasswordModal').on('hidden.bs.modal', function (e) {
                $('#changePasswordForm').find("input[type=password], textarea").val("");
            })
            $('#user_id').val(data);
            $('#changePasswordModal').modal('toggle');
        }

        function passwordChangeSubmit() {
            $.ajax({
                url: "{{ route('user.passwordChange') }}",
                method: 'post',
                cache: false,
                processData: false,
                contentType: false,
                data: new FormData($("#changePasswordForm")[0]),
                success: function (data) {
                    $('#userTable').DataTable().ajax.reload();
                    $('#changePasswordModal').modal('toggle');
                    if(data=='success'){
                        toastr.success('User Password Changed Successfully!');
                    }else{
                        toastr.error('Password did not match!')
                    }
                },
                error: function (err) {
                    if (err.status == 422) {
                        $("#addProductFrom").find("small").remove();
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            var errorMSG = error[0].replace('[]', '');
                            el.after($('<small style="color: #ff0000;font-weight: bold;">' + errorMSG + '</small>'));
                        });
                    }
                }
            });
        }
    </script>
@endsection
