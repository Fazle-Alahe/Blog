<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    function role_manage(){
        $permissions = Permission::all();
        $role = Role::all();
        $users = User::paginate(5);
        return view('dashboard.role.role_manage',[
            'permissions' => $permissions,
            'role' => $role,
            'users' => $users,
        ]);
    }

    function permission_store(Request $request){
        $request->validate([
            'name' => 'required|unique:permissions',
        ]);
        Permission::create(['name' => $request->name]);
        return back();
    }

    function role_store(Request $request){
        $request->validate([
            'role_name' => 'required',
            'permission' => 'required',
        ]);
        
        if(Role::where('name', $request->role_name)->exists()){
            return back()->with('exists', 'This role is already exists.');
        }
        else{
            $role = Role::create(['name' => $request->role_name]);
            $role->givePermissionTo($request->permission);
            return back()->with('success', 'Role added!');
        }
    }

    function delete_role($id){
        $role = Role::find($id);
        DB::table('role_has_permissions')->where('role_id', $id)->delete();
        $role->delete();
        return back()->with('delete', 'Role deleted!');
    }

    function edit_role($id){
        $permissions = Permission::all();
        $role = Role::find($id);
        return view('dashboard.role.edit_role',[
            'permissions' => $permissions,
            'role' => $role,
        ]);
    }

    function update_role(Request $request,$id){
        $role = Role::find($id);
        $role->update([
            'name' => $request->role_name,
        ]);
        $role->syncPermissions($request->permission);

        return back()->with('success', 'Role & Permission updated successfully');
    }

    function assign_role(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role);
        return back()->with('assign', 'Blogger role assigned');
    }

    function remove_role($id){
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        return back()->with('remove', 'Blogger role romoved!');
    }
}
