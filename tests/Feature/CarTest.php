<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{Car, Dealership};
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarTest extends TestCase {
    use RefreshDatabase;

    public function test_user_can_create_car(): void {
        $dealership = Dealership::factory()->create();

        $payload = Car::factory()->make()->toArray() + ['dealership_id'=>$dealership->id];

        $this->post(route('dealerships.cars.store', $dealership), $payload)
             ->assertRedirect(route('dealerships.cars.index', $dealership));

        $this->assertDatabaseHas('cars', ['make'=>$payload['make']]);
    }

    public function test_user_can_update_car(): void {
        $car = Car::factory()->create();
        $payload = Car::factory()->make()->toArray() + [
            'updated_at' => $car->updated_at->toISOString()
        ];

        $this->put(route('cars.update', $car), $payload)->assertRedirect(route('dealerships.index'));

        $this->assertDatabaseHas('cars', ['id' => $car->id, 'make' => $payload['make']]);
    }

    public function test_user_can_soft_delete_car(): void {
        $car = Car::factory()->create();

        $this->delete(route('cars.destroy', $car))->assertRedirect(route('dealerships.index'));

        $this->assertSoftDeleted('cars', ['id' => $car->id]);
    }

    public function test_conflict_on_old_form(): void {
        $car = Car::factory()->create();

        $this->put(route('cars.update',$car),
            ['updated_at'=>'2000-01-01T00:00:00Z'] + $car->toArray()
        )->assertStatus(409);
    }
}