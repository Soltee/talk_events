<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Booking;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;

class BookingController extends Controller
{


    /** Shows the Booking Form page */
    public function index(Event $event, $slug)
    {
        

        $venue = $event->location;
        $cat   = $event->category;

        $speakers = $event->speakers;
        $auth     = Auth::user() ?? null;


        return view('booking', compact( 'venue', 'cat', 'event', 'speakers', 'auth'));
    }


    /**
		* Payment Operation
    **/

    public function checkout(Request $request, $event)
    {
        $data = $request->validate([
            'eventId'    =>  'required|string',
            'eventPrice'    =>  'required|int',
            'first_name'    =>  'required|string',
            'last_name'     =>  'required|string',
            'email'         =>  'required|email',
            'payment_type'  =>   'required|string',
        ]);

        $price         = $data['eventPrice'];
        $tax           = (12/100) * $price;
        $total         = $price + $tax;
        $paymentType   = $data['payment_type'];


        $event  = Event::findOrfail($data['eventId']);

        if($paymentType === 'braintree' || $paymentType === 'paypal'){

            $gateway = new \Braintree\Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchantId'),
                'publicKey' => config('services.braintree.publicKey'),
                'privateKey' => config('services.braintree.privateKey')
            ]);

            $nonce = $request->payment_method_nonce;

            $result = $gateway->transaction()->sale([
                'amount'             => $total,
                'paymentMethodNonce' => $nonce,
                'customer'           => [
                        'firstName'  => $data['first_name'],
                        'lastName'   => $data['last_name'],
                        'email'      => $data['email'],
                ],
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);


            if ($result->success) {
                //Store data
                $booking = $this->store($event->id, $data['first_name'], $data['last_name'], $data['email'], $data['payment_type'], $result->transaction->id, $price, $tax, $total);

                return redirect()->route('thank-you', ['id' => $booking->id])->with('success', 'Bravo! Your payment is successful.');
            } else if ($result->transaction) {
                return back()->with('error', 'Oops! Transaction processing error. Please try again.');

            } else {
                $errorString = "";
                foreach ($result->errors->deepAll() as $error) {
                    $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                }
                return back()->with('error', 'An error occurred with the message: '.$result->message);
            }

            
        }  elseif($paymentType === 'stripe') {
            try {
                // dd($data);
                $gateway = Omnipay::create('Stripe');               
                $gateway->setApiKey(env('STRIPE_SECRET_KEY'));
                            
                $response = $gateway->purchase([
                    'amount'    => $total,
                    'currency'  => 'usd',
                    'token'     => request()->stripeToken,
                ])->send();
                
                // dd($response);
                if ($response->isSuccessful()) {
                    // dd($response);
                    $transaction = Str::random(10);
                    
                    $booking = $this->store($event->id, $data['first_name'], $data['last_name'], $data['email'], $data['payment_type'], $transaction, $price, $tax, $total);

                    return redirect()->route('booking.thankyou', ['id' => $booking->id])->with('success', 'Bravo! Your payment is successful.');
                } else {
                    return back()->with('error', 'Erro!');
                }
               
                
            } catch (CardErrorException $e) {
                return back()->with('error', $e->getMessage());
            }

        }  elseif($paymentType === 'khalti') {

            $args = http_build_query(array(
                'token' => request()->khalti_token,
                'amount'  => $total * 100
            ));

            $url = "https://khalti.com/api/v2/payment/verify/";

            # Make the call using API.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $headers = ['Authorization: Key '. env('KHALTI_SECRET_KEY') . ''];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // Response
            $response = json_decode(curl_exec($ch));

            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            dd($response);
            if ($status_code === 200) {
                $transaction = Str::random(10);

                $booking = $this->store($event->id, $data['first_name'], $data['last_name'], $data['email'], $data['payment_type'], $transaction, $price, $tax, $total);

                    return redirect()->route('booking.thankyou', ['id' => $booking->id])->with('success', 'Bravo! Your payment is successful.');
            } else {
                return back()->with('error', 'An error occurred Please try again. ');
            }
        }
        
    }


    /**
        * Store Booking Data 
    */
    protected function store($event, $firstName, $lastName, $email, $paymentType, $transaction, $price, $tax, $total)
    {
        
        $Authenticated = ($this->guard()) ? $this->guard()->id : null;

        $booking = Booking::create([
            'user_id'       => $Authenticated,
            'event_id'      => $event,
            'first_name'    => $firstName,
            'last_name'     => $lastName,
            'email'         => $email,
            'price'         => $price,
            'payment_type'  => $paymentType,
            'payment_id'    => $transaction,
            'sub_total'     => $price,
            'taxes'         => $tax,
            'grand_total'   => $total
        ]);       

        return $booking;  
    }


    /**
        * Thank you page aftr Booiking
    */
    public function show(Booking $booking){
        return view('thankyou', compact('booking'));
    }


    public function guard()
    {
        return auth()->user();
    }

}
