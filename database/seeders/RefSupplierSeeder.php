<?php

namespace Database\Seeders;

use App\Models\RefSupplier;
use Illuminate\Database\Seeder;

class RefSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RefSupplier::factory()->count(18)->create();
    }
}
