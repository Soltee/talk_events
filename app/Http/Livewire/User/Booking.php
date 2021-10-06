<?php

namespace App\Http\Livewire\User;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Booking as EventBook;

class Booking extends Component
{
	public $event;
	public $auth;
    protected $listeners = ['setNextStep' => 'validate_and_next_step'];

    public $intent;
	public $first_name    = '';
	public $last_name     = '';
	public $email         = '';
    public $stripeToken   = '';

    public $price;
    public $tax;
    public $total;

    public $step = false;

	public function mount(Event $event)
    {

        $this->step  = false;
        $this->event = $event;
        $this->auth  = Auth::guard()->user();
        if($this->auth){

            $this->first_name = $this->auth['first_name'];
            $this->last_name  = $this->auth['last_name'];
            $this->email      = $this->auth['email'];
        }
        $this->price  = $event->price;
        $this->tax    = (12/100) * $this->price;
        $this->total  = $this->price + $this->tax;
    }

    public function render()
    {
        return view('livewire.user.booking')
                    ->extends('layouts.user')
                    ->section('content');

    }

    public function validate_and_next_step(){
        $this->validateData();

        $this->step = true;
    }

    //*Validate*/
    public function validateData(){

        $this->validate([
            'first_name'    =>  'required|string|min:2',
            'last_name'     =>  'required|string|min:2',
            'email'         =>  'required|email'
        ]);

        if($this->price > 0){
            $this->validate([
                'stripeToken'   =>  'required|string'
            ]);
        }
    }

    //*Book Event*/
    public function book()
    {
        
        if($this->price > 0){

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
                        session()->flash('error', 'Oops! Your booking was cancelled.');
                        $this->step    = false;
                        $this->first_name    = '';
                        $this->last_name     = '';
                        $this->email         = '';
                        $this->stripeToken   = '';
                    }
                   
                    
                } catch (CardErrorException $e) {
                    $this->step    = false;
                    $this->first_name    = '';
                    $this->last_name     = '';
                    $this->email         = '';
                    $this->stripeToken   = '';
                    session()->flash('error', $e->getMessage());
                }
                

        } else {
                $this->validateData();
                $booking = $this->store();

                session()->flash('success', $this->event->title.' is booked.');
                $this->first_name  = '';
                $this->last_name   = '';
                $this->email       = '';
                $this->stripeToken = '';
            // }
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
