<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>
        <x-forms.input name="nama_barang" label="Nama Barang" :value="$barang->nama_barang ?? ''" required="true"
            placeholder="Contoh: Laptop Acer Aspire" />

        <x-forms.input name="sn" label="Serial Number (SN)" :value="$barang->sn ?? ''"
            placeholder="Masukkan Nomor Seri Unik (Jika ada)" />

        @php
            $opsiJenis = [
                'Elektronik' => 'Elektronik',
                'Suku Cadang' => 'Suku Cadang',
                'Barang Habis Pakai' => 'Barang Habis Pakai',
            ];
        @endphp
        <x-forms.select name="jenis_barang" label="Jenis Barang" :options="$opsiJenis" :value="$barang->jenis_barang ?? ''" required="true" />
    </div>

    <div>
        @php
            $opsiKategori = [
                'Laptop/PC' => 'Laptop / Komputer',
                'Printer' => 'Printer / Scanner',
                'Furniture' => 'Meja / Kursi / Lemari',
                'Medis' => 'Alat Medis',
                'Kendaraan' => 'Kendaraan Dinas',
                'Lainnya' => 'Lainnya',
            ];
        @endphp
        <x-forms.select name="kategori_barang" label="Kategori Detail" :options="$opsiKategori" :value="$barang->kategori_barang ?? ''"
            required="true" />

        <x-forms.input name="keterangan" label="Keterangan" :value="$barang->keterangan ?? ''"
            placeholder="Kondisi awal, spesifikasi, dll" />

        <x-forms.upload-gambar name="foto" label="Foto Barang" :value="$barang->foto ?? null" />
    </div>

</div>

<div class="mt-6 flex justify-end border-t pt-4">
    <a href="{{ route('barang.index') }}"
        class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2 hover:bg-gray-600 transition">
        Batal
    </a>
    <button type="submit"
        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">
        Simpan Data
    </button>
</div>
