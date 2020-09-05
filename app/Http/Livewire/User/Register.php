<?php

namespace App\Http\Livewire\User;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class Register extends Component
{
	public $first_name = 'Test';
	public $last_name  = 'test';
	public $email      = 'test@example.com';
	public $password   = 'test3456';
	public $password_confirmation = 'test3456';

    public function render()
    {
        return view('livewire.user.register');
    }

    public function register()
    {
    	$data = $this->validate([
            'first_name'  => 'required|min:2',
            'last_name'   => 'required|min:2',
            'email'       => 'required|email|unique:users',
            'password'    => 'required|min:8|confirmed'
        ]);


    	$user = User::create([
            'first_name'   => $data['first_name'],
            'last_name'    => $data['last_name'],
            'email'        => $data['email'],
            'password'     => Hash::make($data['password']),
        ]);

        $this->guard()->login($user);
        $this->guard()->user()->assignRole('user');

        session()->flash('success', 'Your account has been created.');
        return redirect()->route('home');
    	// dd($this->name);
    }

     protected function guard()
    {
        return Auth::guard();
    }
}
