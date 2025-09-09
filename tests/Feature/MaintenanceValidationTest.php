<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{Car, Maintenance};
use Illuminate\Foundation\Testing\RefreshDatabase;

class MaintenanceValidationTest extends TestCase {
    use RefreshDatabase;

    public function test_negative_mileage_fails_and_rolls_back(): void {
        $car = Car::factory()->create();

        $response = $this->postJson(route('cars.maintenances.store',$car),[
            'mileage' => -10,
            'performed_at' => now()->toDateString(),
            'cost' => 100,
        ]);
        $response->assertStatus(422)->assertJsonValidationErrors('mileage');

        $this->assertDatabaseCount('maintenances',0);
    }
}