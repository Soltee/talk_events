<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\User;

class Show extends Component
{
	public $user;
	public function mount(User $user){

		$this->user = $user;
	}

    public function render()
    {
        return view('livewire.admin.users.show', [
        	'user' => $this->user
        ]);
    }
}
