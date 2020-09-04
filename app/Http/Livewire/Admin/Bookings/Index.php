<?php

namespace App\Http\Livewire\Admin\Bookings;

use Livewire\Component;
use App\Booking;
use Illuminate\Support\Facades\Auth;
use Cache;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $updatesQueryString = ['first_name', 'last_name', 'payment_type', 'created_at'];
    public $first_name     = '';
    public $last_name      = '';
    public $payment_type   = '';
    public $created_at     = '';
    public $modal          = false;
    public $status         = false;

    public function render()
    {

        if($this->first_name || $this->last_name || $this->payment_type || $this->created_at){
            $this->goToPage(1);
        }


        $paginate            = Booking::latest()
                                ->where('first_name' ,   'LIKE', '%'. $this->first_name .'%')
                                ->orWhere('last_name' ,   'LIKE', '%'. $this->last_name .'%')
                                ->where('payment_type' ,   'LIKE', '%'. $this->payment_type .'%')
                                ->where('created_at' ,   'LIKE', '%'. $this->created_at .'%')
                                ->with(['user', 'event'])
                                ->paginate(10)
                                ->appends(request()->query());

        return view('livewire.admin.bookings.index', [
            'bookings'     => $paginate,
            'first'        => $paginate->firstItem(),
            'last'         => $paginate->lastItem(),
            'total'        => $paginate->total()
        ]);

    }

    /* Set Model Visiibility*/
    public function setVisibility(){
        $this->modal  = !$this->modal;
        $this->status = '';
    }

    /* Remove the Booking */
    public function drop($booking){
        // $booking = Booking::findOrfail($booking);
        // $booking->delete();
        $this->status = 'Success';
    }
}
