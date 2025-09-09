<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Dealership;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DealershipTest extends TestCase {
    use RefreshDatabase;

    public function test_user_can_create_and_update_dealership(): void {
        // create
        $payload = Dealership::factory()->make()->toArray();
        $payload['phoneNumber'] = $payload['phone_number'];
        unset($payload['phone_number']);

        $this->post(route('dealerships.store'), $payload)
             ->assertRedirect(route('dealerships.index'));

        $this->assertDatabaseHas('dealerships', ['name' => $payload['name']]);

        $dealership = Dealership::first();

        // update
        $this->put(route('dealerships.update', $dealership), [
            'city' => 'New City',
        ])->assertRedirect(route('dealerships.index'));

        $this->assertDatabaseHas('dealerships', ['id' => $dealership->id, 'city' => 'New City']);
    }
}
