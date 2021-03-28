<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::orderBy('created_at', 'desc')->get();

        return view('users.index')->with('users', $users)->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|string|min:3|unique:users',
            'email' => 'required|email|string|min:3|unique:users',
            'phone' => 'required|string|min:10|max:14|unique:users',
            'gender' => 'required|string',
            'password' => 'required|string|min:6',
            // 'image' => 'image | nullable | max: 999'
        ]);

        // if ($request->input('roles')) {
        //     $user->assignRole($request->input('roles'));
        // }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole($request->input('roles'));

        return redirect('/users')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user->delete();
        
        return redirect('/users')->with('success', 'User deleted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::orderBy('created_at', 'desc')->get();

        foreach ($roles as $role) {

            foreach ($user->roles as $rol) {
                if($rol->name == $role->name){
                    $role->name = "";
                }
            }
        }
        
        return view('users.edit')->with('user', $user)->with('roles', $roles);
    }

    public function edit_profile(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'email' => 'required|string|min:3',
            'phone' => 'required|string|min:10|max:14',
            'gender' => 'required|string',
            // 'image' => 'image | nullable | max: 999'
        ]);

        // Handle file Upload
        if($request->hasFile('image')) {
            // Get filename with extention
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = str_replace(' ', '', pathinfo($fileNameWithExt, PATHINFO_FILENAME));
            // Get just extension
            $extention = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extention;
            // Upload Image
            $path = $request->file('image')->storeAs('public/profile_images', $fileNameToStore);
        }

        $user = User::find($id);

        if ($request->hasFile('image')) {
            if ($user->picture != 'noimage.jpg') {
                Storage::delete('public/profile_images/'.$user->picture);
            }
            $user->picture = $fileNameToStore;
            $user->save();
        }

        if($request->input('old')) {
            $this->validate($request, [
                'old' => ['required'],
                'password' => ['required', 'min:6', 'confirmed'],
            ]);

            if (Hash::check($request->input('old'), $user->password)) {

                $user->password = Hash::make($request->input('password'));
                $user->save();
            }
            else {
                return redirect('/profile')->with('error', 'Current password incorrect');
            }
        }

        if ($user->name != $request->input('name') OR $user->email != $request->input('email') OR $user->phone != $request->input('phone') OR $user->gender != $request->input('gender') OR $request->hasFile('image')) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->gender = $request->input('gender');

            $user->save();
            return redirect('/profile')->with('success', 'Profile updated successfully');
        }
        else {
            return redirect('/profile')->with('error', 'No changes made');
        }

        return redirect('/profile')->with('success', 'Profile updated successfully');
        
    }

    public function profile()
    {
        $profile = auth()->user();
        
        return view('users.profile')->with('profile', $profile);
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
            'name' => 'required|string|min:3',
            'email' => 'required|email|string|min:3',
            'phone' => 'required|string|min:10|max:14',
            // 'image' => 'image | nullable | max: 999'
        ]);

        $user = User::find($id);

        if ($request->input('roles')) {
            $user->assignRole($request->input('roles'));
        }

        if ($user->name != $request->input('name') OR $user->email != $request->input('email') OR $user->phone != $request->input('phone') OR $request->input('roles')) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');

            $user->save();
            return redirect('/users/'.$id.'/edit')->with('success', 'User updated successfully');
        }
        else {
            return redirect('/users/'.$id.'/edit')->with('error', 'No changes made');
        }

        return redirect('/users/'.$id.'/edit')->with('success', 'User updated successfully');
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
