<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;
use App\Models\RolePermission;
use App\Models\PermissionHeader;

class RoleController extends Controller
{
    public function index(){
        $roles=UserType::all();
        return view('role.index',compact('roles'));
    }

    public function permissonDetails($roleId){
        $rolePermission = RolePermission::where('role_id',$roleId)->get();
        $permissions = PermissionHeader::get();
        return view('user.permisson',compact('rolePermission','permissions','roleId'));
    }

    public function permissionSubmit(Request $request){
        RolePermission::where('role_id',$request->roleId)->delete();
        foreach (array_slice($request->all(), 2) as $permission){
            RolePermission::create(
                [
                    'role_id'   => $request->roleId,
                    'permission_id'   => $permission,
                ]
            );
        }

        return redirect()->route('role.show')->with('success','Permission updated successfully');
    }

    public function roleAdd(){
        return view('role.add');
    }

    public function roleInsert(Request $request)
    {
        UserType::create(['typeName' => $request->roleName]);
        return redirect()->route('role.show')->with('success','Role added successfully');
    }
}
