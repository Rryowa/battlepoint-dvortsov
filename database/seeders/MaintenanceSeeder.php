<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintenance;

class MaintenanceSeeder extends Seeder {
    public function run(): void {
        // Create maintenance records for roughly one third of cars
        Maintenance::factory(20)->create();
    }
}
