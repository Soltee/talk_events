<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\User;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email      = 'admin@example.com';
	public $password   = 'password';
	public $remember   = false;
	public $attempts   = 0;
	public $error      = false;
	public $message    = '';

    public function render()
    {
        return view('livewire.admin.login');
    }

    public function login()
    {
    	$data = $this->validate([
            'email'       => 'required|email',
            'password'    => 'required|min:8'
        ]);

    	if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $this->remember)){
    	   // dd($user);
    		$auth = $this->guard()->user();

    		if(!$auth->hasRole('user')){

		        session()->flash('success', 'Logged in.');
		        return redirect()->route('admin.dashboard');
	        } 

            $this->guard()->logout();
            $this->error     = true;
            $this->message   = 'Unauthorized!!';
 
    	} else {
            session()->flash('error', 'Credentials doesnot match.');
        }
    }


    /*Admin Guard*/
    protected function guard()
    {
        return Auth::guard();
    }
}
