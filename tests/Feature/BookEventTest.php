<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Company;
use App\Event;
use App\Booking;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class BookEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    } 

     /** @test */
    public function test_guest_can_book_an_event(){
        // factory(Company::class, 1)->create();
        // factory(Event::class)->create();
        // $event = Event::inRandomOrder()->first();
        $this->withoutExceptionHandling();
        $price = 9.99;
        $qty  = 2;
        $sub_total = $price * $qty;
        $taxes     = (12/100) * $sub_total;
        $g         = $sub_total + $taxes;

        $response = $this->post('/events/'. Str::random() .'/book', [
            'event_id'    => Str::random(),
            'first_name'  => 'First_name',
            'last_name'   => 'Last_name',
            'email'       => 'testingemail@gmail.com',
            'price'       =>  $price,
            'quantity'    =>  $qty,
            'payment_type'=>  'paypal',
            'payment_id'  =>  Str::random(),
            'sub_total'   =>  $sub_total,
            'taxes'       =>  $taxes,
            'grand_total' => $g
        ]);

        //A record in Booking::class
        //Response is 201
        //Assert Count to 1;
        // $response->assertOk();
        $booking = Booking::first();
        dd($booking);
        $this->assertCount(1, Booking::all());
        $this->assertEquals('First_name', $booking->first_name);
        // $this->assertDatabaseHas(Booking::class, $response);

    }

     /** @test */
    // public function test_an_registered_user_can_book_an_event(){
    //     //Get a user or not
    //     $user = factory(User::class, 1)->create();
    //     $event = factory(Event::class, 1)->create();

    //     $price = 9.99;
    //     $qty  = 2;
    //     $sub_total = $price * $qty;
    //     $taxes     = (12/100) * $sub_total;
    //     $g         = $sub_total + $taxes;

    //     $response = $this->post('/events/'. $event->id .'/book', [
    //         'user_id'     => $user->id,
    //         'event_id'    => $event->id,
    //         'first_name'  => $user->first_name,
    //         'last_name'   => $user->last_name,
    //         'email'       => $user->email,
    //         'price'       =>  $price,
    //         'quantity'    =>  $qty,
    //         'payment_type'=>  'paypal',
    //         'payment_id'  =>  Str::random(),
    //         'sub_total'   =>  $sub_total,
    //         'taxes'       =>  $taxes,
    //         'grand_total' => $g
    //     ]);

    //     $response->assertStatus(201);
    //     $this->assertCount(1, Booking::all());

    // }

}
