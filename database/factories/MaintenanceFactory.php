<?php

namespace Database\Factories;

use App\Models\Maintenance;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Maintenance>
 */
class MaintenanceFactory extends Factory {
    protected $model = Maintenance::class;

    public function definition(): array {
        return [
            'car_id'        => Car::inRandomOrder()->value('id'),
            'mileage'       => $this->faker->numberBetween(1000, 200000),
            'performed_at'  => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'cost'          => $this->faker->randomFloat(2, 50, 3000),
            'description'   => $this->faker->sentence(),
        ];
    }
}
