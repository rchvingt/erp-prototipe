<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->string('nomor_order')->unique()->nullable(false)->after('id_po'); // Kolom tidak boleh kosong dan harus unik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelian', function (Blueprint $table) {
            $table->dropUnique(['nomor_order']); // Menghapus index unik
            $table->dropColumn('nomor_order'); // Menghapus kolom
        });
    }
};
