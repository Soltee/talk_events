<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\User;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;


class Index extends Component
{	
	use WithPagination;
    // protected $listeners = ['deleteType'];

    protected $updatesQueryString = ['first_name', 'last_name', 'email', 'role', 'created_at'];
    public $first_name     = '';
    public $last_name      = '';
    public $email          = '';
    public $role           = '';
    public $created_at     = '';
    public $modal          = false;
    public $status         = false;

    public function render()
    {
        // echo (Auth::user()->hasRole('super-admin')) ? 'Yes' : 'Hah!';
        $role      = $this->role;
        $query     = User::latest()
        		   		->where('email', '!=' , 'admin@example.com');
        if($role){
        	$query = $query
        				->whereHas('roles', function ($query) use($role) {
						    return $query->where('name', $role);
						});
        }

        $paginate  =  $query
                        ->where('first_name' ,   'LIKE', '%'. $this->first_name .'%')
                        ->where('last_name' ,   'LIKE', '%'. $this->last_name .'%')
                        ->where('email' ,   'LIKE', '%'. $this->email .'%')
                        
                        ->where('created_at' ,   'LIKE', '%'. $this->created_at .'%')
                        ->paginate(10)
                        ->appends(request()->query());

        return view('livewire.admin.users.index', [
            'users'        => $paginate,
            'first'        => $paginate->firstItem(),
            'last'         => $paginate->lastItem(),
            'total'        => $paginate->total()
        ]);

    }

    /* Set Model Visiibility*/
    public function setVisibility(){
    	$this->modal  = !$this->modal;
        $this->status = !$this->status;
    }

    /* Remove the User */
    public function drop($user){
    	// dd($user);
    	$user = User::findOrfail($user);
    	$user->delete();
    	$this->status = true;
    }

}
