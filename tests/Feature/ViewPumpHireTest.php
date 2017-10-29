<?php

namespace Tests\Feature;

use App\Pump;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewPumpHireTest extends TestCase
{
    
    /** @test */
    function user_can_see_pump()
    {
        $pump = Pump::create([
            'brand' => 'Spectra',
            'model' => 'S2',
            'serial' => 'abc123',
        ]);

        $response = $this->get('/pumps/' . $pump->id);

        $response->assertSee('Spectra');
        $response->assertSee('S2');
        $response->assertSee('abc123');
    }
}
