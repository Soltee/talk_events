<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Event;
use App\Booking;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
    public function test_an_event_can_be_booked(){
        $role = Role::create(['name' => 'attender']);
        $user = factory(User::class, 1)->create();
        $user->assignRole('writer');
        $event = factory(Event::class, 1)->create();

        $response = $this->post('/events/'. $event->id .'book', [
            'user_id'     => $user->id,
            'event_id'    => $event->id,
            'first_name'  => $user->first_name,
            'last_name'   => $user->last_name,
            'email'       => $user->email
        ]);

        $response->assertOk();
        $this->assertCount(1, Booking::all());

    }

}
