<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Inventaris (Posisi Barang Aset ada di mana)
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->foreignId('ruangan_id')->constrained('ruangan')->onDelete('cascade');
            $table->string('kode_inventaris')->nullable(); // Kode Label RS
            $table->date('tanggal_masuk');
            $table->string('kondisi'); // Baik, Rusak Ringan, Rusak Berat
            $table->timestamps();
        });

        // 2. Gudang Masuk (Penambah Stok)
        Schema::create('gudang_masuk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_gudang_id')->constrained('barang_gudang')->onDelete('cascade');
            $table->date('tanggal_masuk');
            $table->integer('jumlah_masuk');
            $table->timestamps();
        });

        // 3. Gudang Keluar (Pengurang Stok)
        Schema::create('gudang_keluar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_gudang_id')->constrained('barang_gudang')->onDelete('cascade');
            $table->foreignId('ruangan_id')->constrained('ruangan'); // Barang dikasih ke siapa
            $table->date('tanggal_keluar');
            $table->integer('jumlah_keluar');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gudang_keluar');
        Schema::dropIfExists('gudang_masuk');
        Schema::dropIfExists('inventaris');
    }
};
