<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Booking;
use App\User;
use App\Event;
use App\Sponser;
use App\Speaker;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Dashboard extends Component
{

	use WithPagination;
    protected $updatesQueryString = ['first_name', 'last_name', 'email', 'role', 'created_at'];
    
    public $modal          = false;
    public $status         = false;

    public function render()
    {
        $latest_events     = Event::latest()->count();
        $latest_users      = User::latest()->count();

        return view('livewire.admin.dashboard', [
            'events'        => $latest_events,
            'users'         => $latest_users
        ]);

    }
}
