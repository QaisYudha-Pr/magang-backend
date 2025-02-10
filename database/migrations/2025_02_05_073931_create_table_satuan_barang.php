<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_satuan_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_satuan', 255);
            $table->foreignId('id_barang')->constrained('table_master_barang');
            $table->decimal('harga', 15, 2); // Menambahkan precision dan scale untuk harga
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_satuan_barang');
    }
};