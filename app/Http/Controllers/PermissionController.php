<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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
        $permissions = Permission::with('roles')->orderBy('created_at', 'desc')->get();
        $roles = Role::with('permissions')->orderBy('created_at', 'desc')->get();

        return view('roles.permission')->with('permissions', $permissions)->with('roles', $roles);

        // return $roles;
    }

    public function create_permission(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|min:3|unique:permissions',
        ]);

        $roles = $request->input('roles');

        $permission = Permission::create(['name' => $request->input('name')]);
        $permission->assignRole($roles);

        return redirect('/permissions')->with('success', 'Permission created successfully');
    }

    public function destroy($id)
    {
        $permission = Permission::findById($id);
        $permission->delete();

        return redirect('/permissions')->with('success', 'Permission deleted successfully');
    }
}
