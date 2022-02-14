<?php

namespace App\Http\Livewire\User;

use App\Models\User;
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
        return view('livewire.user.login')
            ->extends('layouts.user')
            ->section('authentication');
    }

    public function login()
    {
    	$data = $this->validate([
            'email'       => 'required|email',
            'password'    => 'required|min:8'
        ]);


    	if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $this->remember)){

	        session()->flash('success', 'Logged in.');
	        return redirect()->route('home');
    	} else {
            session()->flash('error', 'Credentials doesnot match.');
        }
    }

}
