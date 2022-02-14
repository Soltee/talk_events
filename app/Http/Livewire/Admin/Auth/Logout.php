<?php

namespace App\Http\Livewire\Admin\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    protected $listeners = ['sessionInvalidate'];

    public function render()
    {
        return view('livewire.admin.auth.logout')
                ->extends('layouts.admin');
    }

    /*  Confirm Logout */
    public function confirmLogout()
    {
        $this->dispatchBrowserEvent('admin-logout', [
            'type'        => "warning",
            'message'     => "Are you sure?",
            'text'        => ""
        ]);
    }

    /* Logout Admin User */
    public function sessionInvalidate(){
    	Auth::guard()->logout();

       	session()->invalidate();

        session()->regenerateToken();

    	session()->flash('success', 'Logged out!');

        return redirect()->to('/admin/login');
    }
}
