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

    protected $updatesQueryString = ['name', 'email', 'role', 'created_at'];
    public $name           = '';
    public $email          = '';
    public $role           = '';
    public $created_at     = '';
    public $message      = '';
    public $status       = false;

    public function render()
    {
        if($this->name){

            $paginate  = User::latest()
        		   	    ->where('email', '!=' , 'admin@example.com')
                        ->where('first_name' ,   'LIKE', '%'. $this->name .'%')
                        ->orWhere('last_name' ,   'LIKE', '%'. $this->name .'%')
                        ->paginate(10)
                        ->appends(request()->query());
        
        } elseif ($this->email) {
            
            $paginate  = User::latest()
                        ->where('email', '!=' , 'admin@example.com')
                        ->where('email' ,   'LIKE', '%'. $this->email .'%')                        
                        ->paginate(10)
                        ->appends(request()->query());

        } elseif ($this->role) {

            $role     = $this->role;
        	$paginate = User::latest()
                        ->where('email', '!=' , 'admin@example.com')
        				->whereHas('roles', function ($query) use($role) {
						    return $query->where('name', $role);
						})
                        ->paginate(10)
                        ->appends(request()->query());

        } elseif ($this->created_at) {
            
            $paginate  =  User::latest()
                        ->where('email', '!=' , 'admin@example.com')  
                        ->where('created_at' ,   'LIKE', '%'. $this->created_at .'%')
                        ->paginate(10)
                        ->appends(request()->query());
        } else {

            $paginate  =  User::latest()
                            ->where('email', '!=' , 'admin@example.com')  
                            ->paginate(10)
                            ->appends(request()->query());

        }

        return view('livewire.admin.users.index', [
            'users'        => $paginate
        ]);

    }

    public function updatedName()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->name) {
            $this->name = null;
        }

        $this->gotoPage(1);
    }


    public function updatedRole()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->role) {
            $this->role = null;
        }

        $this->gotoPage(1);
    }

    public function updatedEmail()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->email) {
            $this->email = null;
        }

        $this->gotoPage(1);
    }

    public function updatedCreated_at()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->created_at) {
            $this->created_at = null;
        }

        $this->gotoPage(1);
    }

    /**Close*/
    public function close(){
        $this->status  = false;
        $this->message = '';
    }

    /* Remove the User */
    public function drop($user){
    	// dd($user);
    	$user = User::findOrfail($user);
    	$user->delete();
        $this->status = true;
        $this->message = $user->first_name .' deleted.';
    }

}
