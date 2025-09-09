<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dealership;

class DealershipSeeder extends Seeder {
    public function run(): void {
        Dealership::factory(5)->create();
    }
}
