<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RefSupplier>
 */
class RefSupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker = \Faker\Factory::create('id_ID');

        return [
            'nama_supplier' => $this->faker->company.' Elektronik',
            'alamat' => $this->faker->address,
            'telepon' => $this->faker->phoneNumber,
            'created_at' => now(),
        ];
    }
}
