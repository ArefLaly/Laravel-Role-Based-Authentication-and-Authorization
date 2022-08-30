<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('auth.roles.index')->with('roles', Role::all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('auth.roles.create')->with('permissions', Permission::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = new Role;
        $role->roleName = $request->roleName;
        $role->created_by =  Auth::user()->id;
        $role->save();
        $permissions = $request->permissionId;
        // dd($permissions);
        if (in_array("1", $permissions)) {
            $rolePermission = new RolePermission;
            $rolePermission->role_id = $role->id;
            $rolePermission->permission_id = 1;
            $rolePermission->created_by = Auth::user()->id;
            $rolePermission->save();
        } else {
            foreach ($permissions as $permission) {
                $rolePermission = new RolePermission;
                $rolePermission->role_id = $role->id;
                $rolePermission->created_by = Auth::user()->id;
                $rolePermission->permission_id = intval($permission);
                $rolePermission->save();
            }
        }
        return response("success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return View('auth.roles.details')->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return View('auth.roles.edit')->with('role', $role)->with('permissions', Permission::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->roleName = $request->roleName;
        $role->update_by =  Auth::user()->id;
        $role->save();
        $permissions = $request->permissionId;
        // dd($permissions);
        RolePermission::where('role_id', $role->id)->delete();
        if (in_array("1", $permissions)) {
            $rolePermission = new RolePermission;
            $rolePermission->role_id = $role->id;
            $rolePermission->permission_id = 1;
            $rolePermission->created_by = Auth::user()->id;
            $rolePermission->save();
        } else {
            foreach ($permissions as $permission) {
                $rolePermission = new RolePermission;
                $rolePermission->role_id = $role->id;
                $rolePermission->created_by = Auth::user()->id;
                $rolePermission->permission_id = intval($permission);
                $rolePermission->save();
            }
        }
        return response("success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->deleteOrFail();
        return response("success");
    }
}
