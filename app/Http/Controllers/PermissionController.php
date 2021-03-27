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

        return view('roles.permission')->with('permissions', $permissions);

        // return $roles;
    }

    public function create_permission(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|min:3|unique:permissions',
        ]);

        Permission::create(['name' => $request->input('name')]);

        return redirect('/permissions')->with('success', 'Permission created successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();
        return redirect('/categories')->with('success', 'Category deleted');
    }
}
