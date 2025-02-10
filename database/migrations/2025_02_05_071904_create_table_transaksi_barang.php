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
        Schema::create('table_transaksi_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')->constrained('table_master_barang');
            $table->foreignId('id_satuan')->constrained('table_satuan_barang');
            $table->integer('qty');
            $table->decimal('total_harga', 15, 2); // Menambahkan precision dan scale
            $table->foreignId('id_customer')->constrained('table_customer'); // Asumsikan ada tabel customer
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_transaksi_barang');
    }
};