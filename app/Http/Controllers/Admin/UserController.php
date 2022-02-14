<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserAdded;
use App\Notifications\UserDeleted;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

    /** Create Page */
    public function create(Request $request)
    {
        abort_if(!auth()->user()->can('add users'), 403);

        $roles = Role::latest()->get();
        $perms = Permission::latest()->get();
        return view('admin.users.create', compact('roles', 'perms'));
    }

    /** Store */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('add users'), 403);

        $data = $request->validate([
            'first_name'          => 'required|string|min:2',
            'last_name'           => 'required|string', 
            'email'               => 'required|string|email|unique:users', 
            'password'            => 'required|string|min:8|confirmed', 
            'role'                => 'nullable|string', 
            'permission_name'     => 'nullable|array', 
        ]);



        $user = User::create(array_merge([
            'first_name'          => $data['first_name'],
            'last_name'           => $data['last_name'],
            'email'               => $data['email'],
            'password'            => bcrypt($data['password'])
        ], 
            $coverArr ?? []
        ));

        //Give Role and permissons
        if($data['role']){
        	$user->roles()->attach([$data['role']]);
        }

        //Give Permision If given
        if($data['permission_name']){

            $user->permissions()->attach($data['permission_name']);

    	}
        //Send Login Credentials
		// Notification::route('mail', $user->email)->notify(new UserAdded($user->email, $data['password']));
		// Notification::send($user, new UserAdded($user->email, $data['password'], $data['role'], $permissons_arr));


        return redirect()->back()->with('success', 'User created.');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  numeric  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(!auth()->user()->can('update users'), 403);


        $user_role  = $user->roles->pluck('name')[0];
        $user_perms = $user->permissions;

        $roles = Role::latest()
                    ->where('name', '!=', 'super-admin')
                    ->get();
        $perms = Permission::latest()->get();
        // dd($user_perms->count());
        return view('admin.users.edit', compact('user', 'roles', 'perms', 'user_role', 'user_perms'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  numeric  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        abort_if(!auth()->user()->can('update users'), 403);

         $data = $request->validate([
            'first_name'          => 'required|string|min:2',
            'last_name'           => 'required|string', 
            'email'               => 'required|string|email', 
            'password'            => 'required|string|min:8|confirmed', 
            'role'                => 'nullable', 
            'permission_name'     => 'nullable|array', 
        ]);

        // dd($data);
        $user->update(array_merge([
            'first_name'          => $data['first_name'],
            'last_name'           => $data['last_name'],
            'email'               => $data['email'],
            'password'            => bcrypt($data['password'])
        ], 
            $coverArr ?? []
        ));

        //Give Role and permissons
        // dd($data['role']);
        if($data['role']){
            $user->roles()->sync([$data['role']]);
        }

        //Give Permiision If given
        if($data['permission_name']){
            $user->permissions()->sync($data['permission_name']);
        }

        //Send Login Credentials
        // Notification::route('mail', $user->email)->notify(new UserAdded($user->email, $data['password']));

        // $admin = User::where('email', 'admin@example.com')->get();

		// Notification::send($admin, new UserUpdated($user->email, $user->first_name, $user->last_name));

        return redirect()->back()->with('success', 'User updated.');
    }

}

