<?php

namespace Database\Factories;

use App\Models\Dealership;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Dealership>
 */
class DealershipFactory extends Factory {
    protected $model = Dealership::class;

    public function definition(): array {
        return [
            'name'        => $this->faker->unique()->company . ' Classics',
            'city'        => $this->faker->city(),
            // encryption cast
            'phoneNumber' => $this->faker->unique()->numerify('+1-###-###-####'),
        ];
    }
}
