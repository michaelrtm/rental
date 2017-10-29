<?php

namespace Tests\Feature;

use App\Billing\FakePaymentGateway;
use App\Booking;
use App\Pump;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateABookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_can_see_a_booking()
    {

        $pump = factory(Pump::class)->create([
            'serial' => 'uberPump',
            'weekly_price' => 1500,
        ]);

        $booking = Booking::create([
            'email' => 'test@test.com',
            'pump_id' => $pump->id,
            'start_date' => Carbon::parse('December 15th, 2017'),
            'end_date' => Carbon::parse('Jan 12th, 2018'),
        ]);

        $response = $this->get('/bookings/' . $booking->id);

        $response->assertSee('John Smith');
        $response->assertSee('uberPump');
        $response->assertSee('15/12/17');
        $response->assertSee('12/01/18');
    }

    /** @test */
    function user_can_create_a_booking()
    {
        $paymentGateway = new FakePaymentGateway;
        
        $pump = factory(Pump::class)->create([
            'serial' => 'abc432',
            'weekly_price' => 1500,
        ]);
        $user = factory(User::class)->create();

        $response = $this->json('POST', '/pumps/' . $pump->id . '/bookings',[
            'email' => 'test@test.com',
            'startDate' => Carbon::now(),
            'weeks' => 4,
            'payment_token' => $paymentGateway->getValidTestToken(),
        ]);

        $this->assertEquals(6000, $paymentGateway->totalCharges());
        $this->assertTrue($pumps->bookings->contains(function ($booking) {
            return $booking->email == 'test@test.com';
        }));
    }
}
