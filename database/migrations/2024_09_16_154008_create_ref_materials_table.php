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
        Schema::create('ref_material', function (Blueprint $table) {
            $table->id('id_material');
            $table->string('material'); // Nama material
            $table->string('kode')->unique(); // Kode unik material
            $table->timestamp('created_at')->useCurrent(); // Set default to current timestamp
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate(); // Update when modified
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_material');
    }
};
