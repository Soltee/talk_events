<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserAdded;
use App\Notifications\UserDeleted;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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

    /**
     * Show the company dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(auth()->user()->hasRole('user'), 403);

        $search = request()->keyw;

        $query = User::latest()->where('email', '!=' , 'admin@example.com');

        if($search){
            $query = $query->where('first_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%')
                            ->whereDate('created_at', '=', Carbon::today()->toDateString()); 
        }

        $paginate     = $query->paginate(9);
        $users        =   $paginate->items();
        $total        = $paginate->total();
        $first        = $paginate->firstItem();
        $last         = $paginate->lastItem();
        $previous     = $paginate->appends(request()->input())->previousPageUrl();
        $next         = $paginate->appends(request()->input())->nextPageUrl();
        return view('admin.users.index', compact('users', 'total', 'first', 'last', 'previous', 'next'));
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
        // dd($request->all());
        abort_if(!auth()->user()->can('add users'), 403);

        $data = $request->validate([
            'first_name'          => 'required|string|min:2',
            'last_name'           => 'required|string', 
            'email'               => 'required|string|email|unique:users', 
            'password'            => 'required|string|min:8|confirmed', 
            'role'                => 'nullable|string', 
            'permission_name'     => 'nullable|string', 
        ]);



        // dd($request->all());
        $user = User::create(array_merge([
            'first_name'          => $data['first_name'],
            'last_name'           => $data['last_name'],
            'email'               => $data['email'],
            'password'            => $data['password']
        ], 
            $coverArr ?? []
        ));

        //Give Role and permissons
        if($data['role']){
        	$user->assignRole($data['role']);
        }

        //Give Permiision If given
        if($data['permission_name']){
	        $permissons_arr = explode(',',  $data['permission_name']);

	        foreach($permissons_arr as $permission){
	        	$user->givePermissionTo($permission);
	        	// echo "<pre>";
	        	// print_r($permission);
	        	// echo "</pre>";
	        }
    	}
        //Send Login Credentials
		// Notification::route('mail', $user->email)->notify(new UserAdded($user->email, $data['password']));
		Notification::send($user, new UserAdded($user->email, $data['password'], $data['role'], $permissons_arr));


        return redirect()->back()->with('success', 'User created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  numeric  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_if(!auth()->user()->can('show users'), 403);
        // return view('admin.users.show', compact('user'));
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
        return view('admin.users.edit', compact('event'));
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
        // dd($request->all());
        abort_if(!auth()->user()->can('update users'), 403);

         $data = $request->validate([
            'first_name'          => 'required|string|min:2',
            'last_name'           => 'required|string', 
            'email'               => 'required|string|email|unique:users', 
            'password'            => 'required|string|min:8|confirmed', 
            'role'                => 'nullable|string', 
            'permission_name'     => 'nullable|string', 
        ]);

        // dd($request->all());
        $user = $user->update(array_merge([
            'first_name'          => $data['first_name'],
            'last_name'           => $data['last_name'],
            'email'               => $data['email'],
            'password'            => $data['password']
        ], 
            $coverArr ?? []
        ));

        //Give Role and permissons
        if($data['role']){
            $user->syncRoles([$data['role']]);
        }

        //Give Permiision If given
        if($data['permission_name']){
            $permissons_arr = explode(',',  $data['permission_name']);
            $user->syncPermissions($permissons_arr);

            // foreach($permissons_arr as $permission){
            //     $user->givePermissionTo($permission);
                
            // }
        }
        //Send Login Credentials
        // Notification::route('mail', $user->email)->notify(new UserAdded($user->email, $data['password']));

        $admin = User::where('email', 'admin@example.com')->get();

		Notification::send($admin, new UserUpdated($user->email, $user->first_name, $user->last_name));

        return redirect()->back()->with('success', 'User updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  numeric  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        abort_if(!auth()->user()->can('delete users'), 403);

        $deleted_user = $user; 
        //REmove role
        // dd($user->getRoleNames());
        if($user->getRoleNames()){
	        foreach($user->getRoleNames() as $role){
	        	$user->removeRole($role);
	        }
	    }

        if($user->cover){
            File::delete([
                public_path($user->cover)
            ]);
        };

        $user->delete();

        $admin = User::where('email', 'admin@example.com')->get();

		// Notification::send($admin, new UserDeleted($deleted_user->email, $deleted_user->first_name, $deleted_user->last_name));

        return redirect()->route('users')->with('success', 'User deleted.');
    }
}

