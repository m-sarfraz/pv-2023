<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Helper;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view-team', ['only' => ['index', 'store']]);
        $this->middleware('permission:add-team', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-team', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        // return $roles;
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::orderBy('id', 'DESC')->get();
        return view('role.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            // 'permission' => 'required',
        ]);
        $permissionArr = [];
        if (isset($request->dataEntryPermission)) {
            foreach ($request->dataEntryPermission as $arr) {
                array_push($permissionArr, $arr);
            }
        }
        if (isset($request->jdlPermission)) {
            foreach ($request->jdlPermission as $arr) {
                array_push($permissionArr, $arr);
            }
        }
        // return $permissionArr;
        if (isset($request->revenue)) {
            $role = Role::create(['name' => $request->input('name'),
                'team_revenue' => '1']);
            $role->syncPermissions($permissionArr);
        } else {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($permissionArr);
        }
        if ($role) {

            //save ROLE addeed log to table starts
            Helper::save_log('ROLE_CREATED');
            // save ROLE added to log table ends

            return response()->json(['success' => true, 'message' => 'Role Created successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Error while creating Role']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::orderBy('id', 'DESC')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('role.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'permission' => 'required',
        ]);
        $permissionArr = [];
        if (isset($request->dataEntryPermission)) {
            foreach ($request->dataEntryPermission as $arr) {
                array_push($permissionArr, $arr);
            }
        }
        if (isset($request->jdlPermission)) {
            foreach ($request->jdlPermission as $arr) {
                array_push($permissionArr, $arr);
            }
        }
        if (isset($request->recordPermission)) {
            foreach ($request->recordPermission as $arr) {
                array_push($permissionArr, $arr);
            }
        }
        if (isset($request->financePermission)) {
            foreach ($request->financePermission as $arr) {
                array_push($permissionArr, $arr);
            }
        }
        $role = Role::find($id);
        $role->name = $request->input('name');
        if (isset($request->revenue)) {
            $role->team_revenue = '1';
        } else {
            $role->team_revenue = '0';
        }
        $role->save();

        $role->syncPermissions($permissionArr);
        if ($role) {
            //save domain addeed log to table starts
            Helper::save_log('ROLE_UPDATED');
            // save domain added to log table ends
            return response()->json(['success' => true, 'message' => 'Role updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Error while updating Role']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
