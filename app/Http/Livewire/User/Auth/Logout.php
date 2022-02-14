<?php

namespace App\Http\Livewire\User\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    protected $listeners = ['logout'];

    public function render()
    {
        return view('livewire.user.auth.logout')
            ->extends('layouts.user')
            ->section('content');
    }

    /*  Confirm Logout */
    public function confirm()
    {
        $this->dispatchBrowserEvent('swal-user-confirm', [
            'type'        => "warning",
            'message'     => "Are you sure?",
            'text'        => ""
        ]);
    }

    /* Logout  User */
    public function logout(){
    	Auth::guard()->logout();

       	session()->invalidate();

        session()->regenerateToken();

    	session()->flash('success', 'Logged out!');

        return redirect()->to('/login');
    }
}
