<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\User;

class Show extends Component
{
	public $user;
	public $roles;
	public $permissions;
	public $modal          = false;
    public $status         = '';

	public function mount(User $user){

		$this->user        = $user;
		$this->roles       = $user->roles->pluck('name')[0];
		$this->permissions = $user->permissions->pluck('name')->toArray();
	}

    public function render()
    {
        return view('livewire.admin.users.show', [
        	'user'        => $this->user,
        	'roles'       => $this->roles,
        	'permissions' => $this->permissions
        ]);
    }


    /* Set Model Visiibility*/
    public function setVisibility(){
    	$this->modal  = !$this->modal;
    	$this->status = '';
    }

    /* Remove the User */
    public function drop($user){
    	// $user = User::findOrfail($user);
    	// $user->delete();
    	
    	session()->flash('success', 'User dropped');
    	return redirect()->to('/admin/users');
    }
}
