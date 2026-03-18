<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {
            // Status Aset: 'Aktif' (Default) atau 'Dimusnahkan'
            $table->string('status_aset')->default('Aktif')->after('kondisi');
            $table->text('alasan_hapus')->nullable()->after('status_aset');
            $table->string('nama_penyetuju')->nullable()->after('alasan_hapus');
            $table->date('tanggal_dihapus')->nullable()->after('nama_penyetuju');
        });
    }

    public function down(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {
            $table->dropColumn(['status_aset', 'alasan_hapus', 'nama_penyetuju', 'tanggal_dihapus']);
        });
    }
};
