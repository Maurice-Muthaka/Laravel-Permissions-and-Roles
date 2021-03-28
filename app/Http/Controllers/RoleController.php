<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $roles = Role::with('permissions')->orderBy('created_at', 'desc')->get();
        $permissions = Permission::with('roles')->orderBy('created_at', 'desc')->get();
 
        return view('roles.index')->with('roles', $roles)->with('permissions', $permissions);

        // return $roles;
    }

    public function create_role(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|min:3|unique:roles',
        ]);

        $permissions = $request->input('permissions');

        $role = Role::create(['name' => $request->input('name')]);

        $role->givePermissionTo($permissions);

        return redirect('/roles')->with('success', 'Role created successfully');
    }

    public function edit_role($id) {
        $role = Role::findById($id);
        
        $permissions = Permission::orderBy('created_at', 'desc')->get();
        foreach ($permissions as $permission) {

            if($role->hasPermissionTo($permission->name)){
                $permission->name = "";
            }
        }
        
        return view('roles.edit_role')->with('role', $role)->with('permissions', $permissions);
    }
    public function store_role(Request $request, $id) {
        $role = Role::findById($id);
        $permissions = $request->input('permissions');
        
        $role->givePermissionTo($permissions);
        
        return redirect('/roles')->with('success', 'Role updated successfully');
    }

    public function restrict(Request $request, $permission_id, $role_id) {
        $role = Role::findById($role_id);
        $permission = Permission::findById($permission_id);
        $role->revokePermissionTo($permission);
        
        return redirect('/roles/' . $role_id)->with('success', 'Permission removed successfully');
    }

    public function remove_role(Request $request, $user_id, $role_id) {
        $user = User::find($user_id);
        $role = Role::findById($role_id);

        $user->removeRole($role);
        
        return redirect('/users/'.$user_id.'/edit')->with('success', 'Role removed successfully');
    }

    public function destroy($id)
    {
        $role = Role::findById($id);
        $role->delete();

        return redirect('/roles')->with('success', 'Role deleted successfully');
    }
}
