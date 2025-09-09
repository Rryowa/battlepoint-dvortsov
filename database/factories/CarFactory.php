<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Dealership;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory {
    protected $model = Car::class;

    public function definition(): array {
        $makes = ['Ford', 'Chevrolet', 'BMW', 'Porsche', 'Mercedes'];
        return [
            'make'          => $this->faker->randomElement($makes),
            'model'         => Str::limit($this->faker->word(), 100, ''),
            'year'          => $this->faker->numberBetween(1965, (int) date('Y')),
            'price'         => $this->faker->randomFloat(2, 10000, 150000),
            'status'        => 'in_stock',
            'dealership_id' => Dealership::inRandomOrder()->value('id'),
        ];
    }
}
