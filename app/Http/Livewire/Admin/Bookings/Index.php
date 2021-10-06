<?php

namespace App\Http\Livewire\Admin\Bookings;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $queryString = ['name',  'payment_type', 'created_at'];
    public $name           = '';
    public $last_name      = '';
    public $payment_type   = '';
    public $created_at     = '';
    public $message      = '';
    public $status       = false;

    public function render()
    {

        if($this->name) {

            $paginate = Booking::latest()
                        ->where('first_name' ,   'LIKE', '%'. $this->name .'%')
                        ->orWhere('last_name' ,   'LIKE', '%'. $this->name .'%')
                        ->with(['user', 'event'])
                        ->paginate(10);

        } 
        elseif($this->payment_type){

            $paginate   = Booking::latest()
                            ->where('payment_type' ,   'LIKE', '%'. $this->payment_type .'%')
                            ->with(['user', 'event'])
                            ->paginate(10);

        } elseif($this->created_at){

            $paginate   = Booking::latest()
                            ->where('created_at' ,   'LIKE', '%'. $this->created_at .'%')
                            ->with(['user', 'event'])
                            ->paginate(10);
        } 
        else {

            $paginate   = Booking::latest()
                            ->with(['user', 'event'])
                            ->paginate(10)
                            ->appends(request()->query());

       }

        return view('livewire.admin.bookings.index', [
            'bookings'     => $paginate
        ])->extends('layouts.admin')
        ->section('content');

    }


    public function updatedName()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->name) {
            $this->name = null;
        }

        $this->gotoPage(1);
    }

    public function updatedPayment_type()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->payment_type) {
            $this->payment_type = null;
        }

        $this->gotoPage(1);
    }

    public function updatedCreated_at()
    {
        // Prefer null over empty string to remove from query string
        if (! $this->created_at) {
            $this->created_at = null;
        }

        $this->gotoPage(1);
    }
    
    /* Fix nextPage/previousPage to disallow overflows */
    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page = $this->page - 1;
        }
    }

    public function nextPage()
    {
        if ($this->page < $this->totalPages) {
            $this->page = $this->page + 1;
        }
    }

    /**Close*/
    public function close(){
        $this->status  = false;
        $this->message = '';
    }

    /* Remove the Booking */
    public function drop($booking){
        $booking = Booking::findOrfail($booking);
        $booking->delete();
        $this->status = true;
        $this->message = $booking->first_name .' booking deleted.';;
    }
}
