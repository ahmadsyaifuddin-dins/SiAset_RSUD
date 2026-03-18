<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gudang_keluar', function (Blueprint $table) {
            // Kolom status: 0 = Menunggu ACC, 1 = Di-ACC (Selesai), 2 = Ditolak
            $table->tinyInteger('status')->default(0)->after('keterangan');
            // Kolom user_id untuk tracking siapa yang request
            $table->foreignId('user_id')->nullable()->after('ruangan_id')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('gudang_keluar', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['status', 'user_id']);
        });
    }
};
