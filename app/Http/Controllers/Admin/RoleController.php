<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;

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
        abort_if(auth()->user()->hasRole('user'), 403);
    }


    /* Store */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->hasRole('super-admin'), 403);
        // dd($request->all());
    	$data = $request->validate([
    		'role_name' => 'required|string'
    	]);

    	$role = Role::create([
    		'name' => $data['role_name']
    	]);

    	return response()->json(['success' => 'Ok', 'role' => $role], 201);
    }


    /*
		* Destroy Role
    */
	public function destroy(Role $role)
	{	
        abort_if(!auth()->user()->hasRole('super-admin'), 403);
		$role->delete();
    	return response()->json(['success' => 'Ok', 'role' => $role], 204);		
	}
}
