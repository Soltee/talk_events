<?php

namespace App\Http\Livewire\User;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{

	public $email      = '';
	public $password   = '';
	public $remember   = false;
	public $attempts   = 0;

    public function render()
    {
        return view('livewire.user.login');
    }

    public function login()
    {
    	$data = $this->validate([
            'email'       => 'required|email',
            'password'    => 'required|min:8'
        ]);


    	$user = Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $this->remember);
    	// dd($user);
    	if($user){

			// Auth::login($user);
	        session()->flash('success', 'Logged in.');
	        return redirect()->route('home');
    	}
    }

}
