<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use App\Models\RefSupplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker = \Faker\Factory::create('id_ID');

        return [
            'id_supplier' => RefSupplier::inRandomOrder()->first()->id_supplier, // Acak supplier
            'nomor_order' => 'ORD-'.Str::random(8),
            'tgl_po' => $this->faker->date(), // Tanggal PO
            'status' => $this->faker->randomElement(['pending', 'disetujui', 'ditolak']), // Status PO
            'id_pegawai' => User::inRandomOrder()->first()->id, // ID pegawai pembuat PO
            'disetujui_oleh' => $this->faker->optional()->randomElement([null, User::inRandomOrder()->first()->id]), // ID pegawai yang menyetujui (nullable)
            'disetujui_tgl' => $this->faker->optional()->date(), // Tanggal disetujui (nullable)
            'tgl_kirim' => $this->faker->optional()->date(), // Tanggal pengiriman (nullable)
            'created_at' => now(),
        ];
    }
}
