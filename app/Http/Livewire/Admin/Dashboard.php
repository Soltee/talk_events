<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Booking;
use App\User;
use App\Event;
use App\Sponser;
use App\Speaker;
use Carbon\Carbon;
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
        $events_query      = Event::latest();
        $users_query       = User::latest();
        $bookings_query    = Booking::latest();
        $speakers_query    = Speaker::latest();
        $sponsers_query    = Sponser::latest();

        $latest_5_events      = $events_query->take(5)->get();
        $latest_5_users       = $users_query->take(5)->get();
        $latest_5_bookings    = $bookings_query->take(5)->get();
        $latest_5_speakers    = $speakers_query->take(5)->get();
        $latest_5_sponsers    = $sponsers_query->take(5)->get();

        $latest_events        = $events_query->count();
        $latest_users         = $users_query->count();
        $latest_bookings      = $bookings_query->count();
        $latest_speakers      = $speakers_query->count();
        $latest_sponsers      = $sponsers_query->count();

            // collect([])
        $eve = $events_query
                ->select(['id', 'created_at'])
                ->where('created_at', '<', now()->addDays(10))
                ->get();
        $use = $users_query
                ->select(['id', 'created_at'])
                ->where('created_at', '<', now()->addDays(10))
                ->get();
        $spe = $speakers_query
                ->select(['id', 'created_at'])
                ->where('created_at', '<', now()->addDays(10))
                ->get();
        $spo = $sponsers_query
                ->select(['id', 'created_at'])
                ->where('created_at', '<', now()->addDays(10))
                ->get();

        $boo = $bookings_query
                ->select(['id', 'created_at'])
                ->where('created_at', '<', now()->addDays(10))
                ->get();

        return view('livewire.admin.dashboard', [
            'events'               => $latest_events,
            'users'                => $latest_users,
            'bookings'             => $latest_bookings,
            'speakers'             => $latest_speakers,
            'sponsers'             => $latest_sponsers,
            'latest_5_events'      => $latest_5_events,
            'latest_5_users'       => $latest_5_users,
            'latest_5_bookings'    => $latest_5_bookings,
            'latest_5_speakers'    => $latest_5_speakers,
            'latest_5_sponsers'    => $latest_5_sponsers,
            'eve'    => $eve,
            'use'    => $use,
            'spe'    => $spe,
            'spe'    => $spe,
            'boo'    => $boo,
        ]);

    }
}
