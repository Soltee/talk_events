<?php

namespace App\Http\Livewire\User;

use App\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use Illuminate\Support\Str;
use App\User;
use App\Booking as EventBook;

class Booking extends Component
{
	public $event;
	public $auth;

    public $intent;
	public $first_name    = '';
	public $last_name     = '';
	public $email         = '';
    public $stripeToken   = '';

    public $price;
    public $tax;
    public $total;

    public $step;

	public function mount(Event $event)
    {

        $this->step  = false;
        $this->event = $event;
        $this->auth  = Auth::guard()->user();

        $this->price  = $event->price;
        $this->tax    = (12/100) * $this->price;
        $this->total  = $this->price + $this->tax;
    }

    public function render()
    {
        return view('livewire.user.booking');
    }

    public function changeStep(){
        $this->step = true;
    }

    public function book()
    {
        
        if($this->price > 0){
        	
            $this->validate([
                'first_name'    =>  'required|string|min:2',
                'last_name'     =>  'required|string|min:2',
                'email'         =>  'required|email',
                'stripeToken'   =>  'required|string'
            ]);

            if($this->step){
                try {
                    // dd($data);
                    $gateway = Omnipay::create('Stripe');               
                    $gateway->setApiKey(env('STRIPE_SECRET_KEY'));
                                
                    $response = $gateway->purchase([
                        'amount'    => $this->price,
                        'currency'  => 'usd',
                        'token'     => $this->stripeToken,
                    ])->send();
                    
                    // dd($response);
                    if ($response->isSuccessful()) {
                        // dd($response);
                        
                        
                        $booking = $this->store();

                        session()->flash('success', $this->event->title.' is booked.');
                        $this->first_name  = '';
                        $this->last_name   = '';
                        $this->email       = '';
                        $this->stripeToken = '';

                    } else {
                        session()->flash('error', 'Sorry! Your booking was cancelled.');
                    }
                   
                    
                } catch (CardErrorException $e) {
                    session()->flash('error', $e->getMessage());
                }
                
            }

        } else {
            $this->validate([
                'first_name'    =>  'required|string|min:2',
                'last_name'     =>  'required|string|min:2',
                'email'         =>  'required|email'
            ]);

            if($this->step){
                $booking = $this->store();

                session()->flash('success', $this->event->title.' is booked.');
                $this->first_name  = '';
                $this->last_name   = '';
                $this->email       = '';
                $this->stripeToken = '';
            }
        }


    }

    /**
        * Store Booking Data 
    */
    protected function store()
    {
        
        $Authenticated = ($this->guard()) ? $this->guard()->id : null;

        return EventBook::create([
            'user_id'       => $Authenticated,
            'event_id'      => $this->event->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'price'         => $this->price,
            'payment_type'  => 'stripe',
            'payment_id'    => Str::random(10),
            'sub_total'     => $this->price,
            'taxes'         => $this->tax,
            'grand_total'   => $this->total
        ]);       
    }

    public function guard()
    {
        return auth()->user();
    }

}
