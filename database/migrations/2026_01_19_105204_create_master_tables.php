<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Master Ruangan
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruangan'); // Cth: IGD, Poli Anak
            $table->string('kepala_ruangan')->nullable();
            $table->timestamps();
        });

        // 2. Master Barang Aset (Laptop, Printer, Meja)
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('sn')->nullable()->unique(); // REQUEST ANGRI: Serial Number
            $table->string('jenis_barang'); // Elektronik, Medis, Mebel
            $table->string('kategori_barang'); // Kategori tambahan
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 3. Master Barang Gudang (Kertas, Tinta, Spidol) - REQUEST DOSPEM
        Schema::create('barang_gudang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('satuan'); // Rim, Box, Pcs
            $table->integer('stok_saat_ini')->default(0); // Update otomatis via Observer
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_gudang');
        Schema::dropIfExists('barang');
        Schema::dropIfExists('ruangan');
    }
};
