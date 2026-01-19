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
        Schema::table('barang_gudang', function (Blueprint $table) {
            // Menambahkan kolom yg kurang sesuai SQL lama
            $table->string('jenis')->nullable()->after('nama_barang');
            $table->string('kategori')->default('Barang Habis Pakai')->after('jenis');
        });
    }

    public function down(): void
    {
        Schema::table('barang_gudang', function (Blueprint $table) {
            $table->dropColumn(['jenis', 'kategori']);
        });
    }
};
