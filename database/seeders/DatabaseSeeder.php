<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User Admin (Penting buat login)
        User::create([
            'name' => 'Admin RSUD',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Data Ruangan (Sesuai Screenshot/Data RSUD)
        $ruangans = [
            ['nama_ruangan' => 'IGD', 'kepala_ruangan' => 'Dr. Budi'],
            ['nama_ruangan' => 'Poli Anak', 'kepala_ruangan' => 'Dr. Siska'],
            ['nama_ruangan' => 'Ruang IT', 'kepala_ruangan' => 'Pak Ahmad'],
            ['nama_ruangan' => 'Gudang Farmasi', 'kepala_ruangan' => 'Ibu Rina'],
        ];
        DB::table('ruangan')->insert($ruangans);

        // 3. Data Barang Aset (Dengan SN)
        $barangs = [
            [
                'nama_barang' => 'Laptop Acer Aspire 3',
                'sn' => 'SN-ACER-001',
                'jenis_barang' => 'Elektronik',
                'kategori_barang' => 'Laptop',
                'keterangan' => 'Aset IT',
            ],
            [
                'nama_barang' => 'Printer Epson L3110',
                'sn' => 'SN-EPSON-889',
                'jenis_barang' => 'Elektronik',
                'kategori_barang' => 'Printer',
                'keterangan' => 'Printer Warna',
            ],
            [
                'nama_barang' => 'Tensimeter Digital',
                'sn' => 'SN-OMRON-555',
                'jenis_barang' => 'Alat Medis',
                'kategori_barang' => 'Diagnostik',
                'keterangan' => 'Kondisi Baru',
            ],
        ];
        DB::table('barang')->insert($barangs);

        // 4. Data Barang Gudang (BHP)
        DB::table('barang_gudang')->insert([
            ['nama_barang' => 'Kertas A4', 'satuan' => 'Rim', 'stok_saat_ini' => 50],
            ['nama_barang' => 'Tinta Epson Hitam', 'satuan' => 'Botol', 'stok_saat_ini' => 10],
            ['nama_barang' => 'Masker Medis', 'satuan' => 'Box', 'stok_saat_ini' => 100],
        ]);

        // 5. Plotting Inventaris (Barang Masuk ke Ruangan)
        // ID 1 (Laptop) masuk ke ID 3 (Ruang IT)
        DB::table('inventaris')->insert([
            'barang_id' => 1,
            'ruangan_id' => 3,
            'kode_inventaris' => 'INV/IT/2026/001',
            'tanggal_masuk' => '2025-12-01',
            'kondisi' => 'Baik',
        ]);

        // ID 2 (Printer) masuk ke ID 1 (IGD)
        DB::table('inventaris')->insert([
            'barang_id' => 2,
            'ruangan_id' => 1,
            'kode_inventaris' => 'INV/IGD/2026/002',
            'tanggal_masuk' => '2025-12-05',
            'kondisi' => 'Baik',
        ]);
    }
}
