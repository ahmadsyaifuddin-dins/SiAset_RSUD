<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Kerusakan (Menu: Permintaan Perbaikan)
        Schema::create('kerusakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventaris_id')->constrained('inventaris')->onDelete('cascade');
            $table->date('tanggal_laporan');
            $table->text('deskripsi_kerusakan'); // "Printer macet", "Layar mati"
            $table->string('pelapor')->nullable();
            $table->string('status')->default('Pending'); // Pending, Proses, Selesai, Tidak Bisa Diperbaiki
            $table->timestamps();
        });

        // 2. Perbaikan (Menu: Perbaikan Barang)
        Schema::create('perbaikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kerusakan_id')->constrained('kerusakan')->onDelete('cascade');
            $table->date('tanggal_perbaikan');
            $table->text('tindakan'); // "Ganti Cartridge"
            $table->decimal('biaya', 15, 2)->default(0); // REQUEST DOSPEM: Biaya
            $table->string('teknisi')->nullable();
            $table->timestamps();
        });

        // 3. Barang Rusak Berat / Penghapusan Aset
        Schema::create('barang_rusak', function (Blueprint $table) {
            $table->id();
            // Mengambil data dari inventaris yang sudah divonis rusak berat
            $table->foreignId('inventaris_id')->constrained('inventaris')->onDelete('cascade');
            $table->date('tanggal_penghapusan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_rusak');
        Schema::dropIfExists('perbaikan');
        Schema::dropIfExists('kerusakan');
    }
};
