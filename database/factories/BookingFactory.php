<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price    = $this->faker->randomNumber(2);
        $qty      = $this->faker->numberBetween(1, 4);
        $subTotal = $price * $qty;
        $taxes = (15/100) * $subTotal;
        $grand = $subTotal + $taxes;
        return [
            'user_id'       =>  function(){
                $users = User::role('user')->inRandomOrder()->pluck('id')->toArray();
                return  Arr::random($users);
            }  , 
            'event_id'      =>  function(){
                $events = Event::inRandomOrder()->pluck('id')->toArray();
                return  Arr::random($events);
            }  , 
            'first_name'         =>  $this->faker->firstName  , 
            'last_name'         =>  $this->faker->lastName  , 
            'email'         =>  $this->faker->email  , 
            'price'         =>  $price  , 
            'payment_type'  =>  function(){
                $methods = ['stripe', 'braintree', 'paypal'];
                return Arr::random($methods);
            }  , 
            'payment_id'    =>  $this->faker->bankAccountNumber  , 
            'sub_total'     =>  $subTotal  , 
            'taxes'         =>  $taxes  , 
            'grand_total'   =>  $grand 
        ];
    }
}
