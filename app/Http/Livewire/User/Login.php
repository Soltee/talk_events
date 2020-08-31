<?php

namespace App\Http\Livewire\User;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{

	public $email      = 'user@example.com';
	public $password   = 'user1234';
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


    	if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $this->remember)){
    	   // dd($user);

	        session()->flash('success', 'Logged in.');
	        return redirect()->route('home');
    	} else {
            session()->flash('error', 'Credentials doesnot match.');
        }
    }

}
