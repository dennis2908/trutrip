<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Trip;

class TrutripTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        Trip::create([
            'title' => 'trutrip',
            'origin' => 'jakarta',
            'destination' => 'medan', // publish
            'startDatetime' => '2022-02-02 17:22:05',
			'endDatetime' => '2022-02-02 17:22:05',
			'type' => 'pulang-pergi',
			'description' => 'make pesawat garuda',
        ]);
		
		$this->assertDatabaseHas('trips', [
            'title' => 'trutrip',
            'description' => 'make pesawat garuda'
        ]);
		
		Trip::destroy(1);
		
		$this->assertDatabaseMissing('trips', [
            'id' => 1
        ]);
		
    }
}
