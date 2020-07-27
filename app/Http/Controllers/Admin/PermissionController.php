<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    /* Store */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->hasRole('super-admin'), 403);
        // dd($request->all());
    	$data = $request->validate([
    		'name' => 'required|string'
    	]);

    	$permission = Permission::create([
    		'name' => $data['name']
    	]);

    	return response()->json(['success' => 'Ok', 'permission' => $permission], 201);
    }


    /*
		* Destroy Role
    */
	public function destroy(Permission $permission)
	{	
        abort_if(!auth()->user()->hasRole('super-admin'), 403);
		$permission->delete();
    	return response()->json(['success' => 'Ok', 'permission' => $permission], 204);		
	}
}
