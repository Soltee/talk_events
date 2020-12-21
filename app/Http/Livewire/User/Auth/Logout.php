<?php

namespace App\Http\Livewire\User\Auth;

use Livewire\Component;
use App\User;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function render()
    {
        return view('livewire.user.auth.logout')
            ->extends('layouts.user')
            ->section('content');
    }

    /* Logout  User */
    public function invalidate(){
    	Auth::guard()->logout();

       	session()->invalidate();

        session()->regenerateToken();

    	session()->flash('success', 'Logged out!');

        return redirect()->to('/');
    }
}
