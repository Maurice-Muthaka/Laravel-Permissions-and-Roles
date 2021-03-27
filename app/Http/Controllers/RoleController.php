<?php

namespace App\Http\Controllers;

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
 
        return view('roles.index')->with('roles', $roles);

        // return $roles;
    }

    public function create_role(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|min:3|unique:roles',
        ]);

        Role::create(['name' => $request->input('name')]);

        return redirect('/roles')->with('success', 'Role created successfully');
    }

    public function edit_role($id) {
        $role = Role::findById($id);
        
        $permissions = Permission::orderBy('created_at', 'desc')->get();
        foreach ($permissions as $permission) {
            if($role->hasPermissionTo($permission->name)){
                $permission['ckecked'] = 'checked';
            }
            else {
                $permission['ckecked'] = 'none';
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

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();
        return redirect('/categories')->with('success', 'Category deleted');
    }
}
