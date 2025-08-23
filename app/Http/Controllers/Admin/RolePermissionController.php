<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();
        ds($roles);
        return view('admin.role-permission.index')->with([
            'roles' => $roles,
            'title' => 'Role List'
        ]);
    }

    public function access($id)
    {
        $role = Role::where('id',$id)->first();
        if (empty($role)) {
            return redirect()->route('role.index')->with(
                'error' , 'Role not found!'
            );
        }
        $permissions = Permission::all();
        $permissionGroups = $this->getAdminPermissionGroupBy();
        return  view('admin.role-permission.access')->with([
            'role'=>$role,
            'permissions'=>$permissions,
            'permissionGroups'=>$permissionGroups,
            'title' => 'Permission List'
        ]);
    }
    private  function getAdminPermissionGroupBy()
    {
        $permissionGroup  = Permission::select('group','created_at')
            ->orderBy('created_at','ASC')
            ->pluck('group')->toArray();
        return array_unique($permissionGroup);
    }

    public function accessUpdate($id,Request $request)
    {
        $role =  Role::findOrFail($id);
        if (!empty($request->permission)){
            $permissions = Permission::whereIn('id',$request->permission)->get();
            $role->syncPermissions($permissions);
        }else{
            $role->syncPermissions([]);
        }
        return redirect()->back()->with('success', 'Permission assign successfully');
    }
}
