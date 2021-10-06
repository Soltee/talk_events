<?php

namespace App\Http\Livewire\Admin\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{

    public function render()
    {
        return view('livewire.admin.auth.logout')
                ->extends('layouts.admin');
    }

    /* Logout Admin User */
    public function invalidate(){
    	Auth::guard()->logout();

       	session()->invalidate();

        session()->regenerateToken();

    	session()->flash('success', 'Logged out!');

        return redirect()->to('/admin/login');
    }
}
