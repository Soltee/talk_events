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

    protected $updatesQueryString = ['name',  'payment_type', 'created_at'];
    public $name           = '';
    public $last_name      = '';
    public $payment_type   = '';
    public $created_at     = '';
    public $message      = '';
    public $status       = false;

    public function render()
    {

        $query       = Booking::latest();

        if($this->name || $this->payment_type || $this->created_at){
            $this->goToPage(1);
        }

        if($this->name) {
            $query = $query
                        ->where('first_name' ,   'LIKE', '%'. $this->name .'%')
                        ->orWhere('last_name' ,   'LIKE', '%'. $this->name .'%');
        }


        $paginate       = $query
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
