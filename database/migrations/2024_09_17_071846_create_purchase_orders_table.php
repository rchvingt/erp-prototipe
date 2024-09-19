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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id('id_po'); // primary key, auto increment
            $table->unsignedBigInteger('id_supplier'); // foreign key to supplier
            $table->date('tgl_po'); // tanggal purchase order
            $table->enum('status', ['pending', 'disetujui', 'ditolak']); // status
            $table->unsignedBigInteger('id_pegawai'); // foreign key to users
            $table->unsignedBigInteger('disetujui_oleh')->nullable(); // nullable if not approved
            $table->date('disetujui_tgl')->nullable(); // approval date
            $table->date('tgl_kirim')->nullable(); // shipping date
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            // Foreign key constraints (without cascade)
            $table->index('id_supplier'); // create index for id_supplier
            $table->foreign('id_supplier')->references('id_supplier')->on('ref_supplier');

            $table->index('id_pegawai'); // create index for id_pegawai
            $table->foreign('id_pegawai')->references('id')->on('users');

            $table->index('disetujui_oleh');
            $table->foreign('disetujui_oleh')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            // Menghapus foreign key constraints sebelum menghapus tabel
            $table->dropForeign(['id_supplier']);
            $table->dropForeign(['id_pegawai']);
            $table->dropForeign(['disetujui_oleh']);
        });
        Schema::dropIfExists('purchase_orders');
    }
};
