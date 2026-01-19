<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>
        <div class="mb-4">
            <x-forms.label for="ruangan_id" value="Lokasi Ruangan" required="true" />
            <select name="ruangan_id"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Pilih Ruangan --</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{ $ruangan->id }}"
                        {{ old('ruangan_id', $inventaris->ruangan_id ?? '') == $ruangan->id ? 'selected' : '' }}>
                        {{ $ruangan->nama_ruangan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <x-forms.label for="barang_id" value="Nama Barang (Aset)" required="true" />
            <select name="barang_id"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Pilih Barang --</option>
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}"
                        {{ old('barang_id', $inventaris->barang_id ?? '') == $barang->id ? 'selected' : '' }}>
                        {{ $barang->nama_barang }} ({{ $barang->jenis_barang }})
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">*Barang yang muncul adalah dari Master Data Aset</p>
        </div>

        <x-forms.input name="kode_inventaris" label="Kode Inventaris / Label Barang" :value="$inventaris->kode_inventaris ?? ''" required="true"
            placeholder="Contoh: INV/2026/IGD/001" />
    </div>

    <div>
        <x-forms.input type="date" name="tanggal_masuk" label="Tanggal Masuk" :value="$inventaris->tanggal_masuk ?? date('Y-m-d')" required="true" />

        @php
            $opsiKondisi = [
                'Baik' => 'Baik',
                'Rusak Ringan' => 'Rusak Ringan (Perlu Servis)',
                'Rusak Berat' => 'Rusak Berat (Penghapusan)',
            ];
        @endphp
        <x-forms.select name="kondisi" label="Kondisi Barang" :options="$opsiKondisi" :value="$inventaris->kondisi ?? 'Baik'" required="true" />

        <x-forms.input name="keterangan" label="Keterangan Tambahan" :value="$inventaris->keterangan ?? ''" placeholder="Opsional" />
    </div>
</div>

<div class="mt-6 flex justify-end border-t pt-4">
    <a href="{{ route('inventaris.index') }}"
        class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2 hover:bg-gray-600 transition">Batal</a>
    <button type="submit"
        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">Simpan
        Data</button>
</div>
