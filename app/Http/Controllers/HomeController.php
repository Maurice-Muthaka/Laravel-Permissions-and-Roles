<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
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
    public function index()
    {
        // Create role or permission
        // Role::create(['name' => 'admin']);
        // Permission::create(['name' => 'edit staff']);
        
        // Assign permission or role to a user
        // auth()->user()->givePermissionTo('view users');
        // auth()->user()->assignRole('admin');

        // Remove a permission to a role or remove a role to a permission
        // $role->revokePermissionTo($permission);
        // $permission->removeRole($role);

        // Add permission to role
        // $permission = Permission::findById(2);
        // $role = Role::findById(2);
        // $role->givePermissionTo($permission);


        // return auth()->user()->permissions;
        // return auth()->user()->getAllPermissions();
        return view('home');
    }
}
