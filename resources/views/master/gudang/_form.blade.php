<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>
        <x-forms.input name="nama_barang" label="Nama Barang Gudang" :value="$barangGudang->nama_barang ?? ''" required="true"
            placeholder="Contoh: Kertas A4, Tinta Epson" />

        @php
            $kategoriGudang = [
                'Barang Habis Pakai' => 'Barang Habis Pakai',
                'Suku Cadang' => 'Suku Cadang',
                'Logistik Umum' => 'Logistik Umum',
                'Alat Kebersihan' => 'Alat Kebersihan',
            ];
        @endphp
        <x-forms.select name="kategori" label="Kategori" :options="$kategoriGudang" :value="$barangGudang->kategori ?? ''" required="true" />
    </div>

    <div>
        <x-forms.input name="jenis" label="Jenis / Asal / Spesifikasi" :value="$barangGudang->jenis ?? ''" required="true"
            placeholder="Contoh: Pengadaan 2024 / Besi dari Medan" />

        <div class="grid grid-cols-2 gap-4">
            <x-forms.input name="satuan" label="Satuan" :value="$barangGudang->satuan ?? ''" required="true"
                placeholder="Rim, Box, Pcs" />

            <x-forms.input type="number" name="stok_saat_ini" label="Stok Awal" :value="$barangGudang->stok_saat_ini ?? 0" required="true" />
        </div>
    </div>

</div>

<div class="mt-6 flex justify-end border-t pt-4">
    <a href="{{ route('barang-gudang.index') }}"
        class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2 hover:bg-gray-600 transition">
        Batal
    </a>
    <button type="submit"
        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">
        Simpan Item
    </button>
</div>
