<?php

namespace App\Http\Livewire\User\Auth;

use Livewire\Component;
use App\Booking;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Dashboard extends Component
{
	use WithPagination;

    public function render()
    {
    	$bookings = Auth::guard()->user()->bookings()->with([
                                    'event' => function($query)
                                        {
                                            $query->select('id', 'title');
                                         }
                                    ])->paginate(2);

        $first    = $bookings->firstItem();
        $last     = $bookings->lastItem();
        $total    = $bookings->total();

        $has_previous  = $bookings->previousPageUrl();
        $has_next      = $bookings->nextPageUrl();

        return view('livewire.user.auth.dashboard', [
        		'bookings'     => $bookings,
        		'first'        => $first,
        		'last'         => $last,
        		'total'        => $total,
        		'has_previous' => $has_previous,
        		'has_next'     => $has_next
        	]);
    }
}
