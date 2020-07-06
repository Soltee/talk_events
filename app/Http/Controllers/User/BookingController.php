<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Booking;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    /** Shows the Booking Form page */
    public function index(Event $event, $slug)
    {
        $venue = $event->location;
        $cat = $event->category;

        $speakers = $event->speakers;
        $auth = Auth::user() ?? null;

        return view('checkout', compact('venue', 'cat', 'event', 'speakers', 'auth'));
    }


    /**
		* Store booking record made by user or guest
    **/
	public function store(Request $request, Event $event)
	{
		$data = $request->validate([
            'first_name'    =>  'required|string',
            'last_name'     =>  'required|string',
            'email'         =>  'required|email',
            'price'         =>  'required|int',
            'quantity'      =>   'nullable|int',
            'payment_id'    =>   'required|string',
            'payment_type'  =>   'required|string',
            'sub_total'     =>   'required|int',
            'taxes'         =>   'required|int',
            'grand_total'   =>  'required|int'
		]);


		$booking = $event->bookings->create(array_merge([
			'event_id'    => $event->id,
			'first_name'  => $data['first_name'],
            'last_name'   => $data['last_name'],
            'email'       => $data['email'],
            'price'       => $data['price'],
            'payment_type' => $data['payment_type'],
            'payment_id'  => $data['payment_id'],
            'sub_total'   => $data['sub_total'],
            'taxes'       => $data['taxes'],
            'grand_total' => $data['grand_total']
		], [     
			'quantity'    => $data['quantity'] ?? 0,
		]));

        return view('thankyou', compact('booking'));
	}
}
