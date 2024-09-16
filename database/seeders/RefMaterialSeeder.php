<?php

namespace Database\Seeders;

use App\Models\RefMaterial;
use Illuminate\Database\Seeder;

class RefMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RefMaterial::factory()->count(50)->create(); // Generate 50 data dummy
    }
}
