<?php

namespace App\Http\Livewire\Admin\Bookings;

use Livewire\Component;
use App\Booking;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class Index extends Component
{
    use WithPagination;

    public function render()
    {

    	$bookings = QueryBuilder::for(Booking::class)
                ->latest()
                ->allowedFilters(
                    [
                        'first_name',
                        'last_name', 
                        'email',
                        'price',
                        // AllowedFilter::exact('title'),  
                        AllowedFilter::scope('starts_at')
                    ])
                ->allowedSorts(['title', 'created_at'])
                ->paginate(10)
                ->appends(request()->query());
     

        $first    = $bookings->firstItem();
        $last     = $bookings->lastItem();
        $total    = $bookings->total();

        $has_previous  = $bookings->previousPageUrl();
        $has_next      = $bookings->nextPageUrl();

        return view('livewire.admin.bookings.index', [
        		'bookings'     => $bookings,
        		'first'        => $first,
        		'last'         => $last,
        		'total'        => $total,
        		'has_previous' => $has_previous,
        		'has_next'     => $has_next
        	]);
    }
}
