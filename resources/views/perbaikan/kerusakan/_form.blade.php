<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <div class="mb-4">
            <x-forms.label for="inventaris_id" value="Barang yang Rusak" required="true" />
            <select name="inventaris_id" class="w-full border-gray-300 rounded-md focus:ring-indigo-500">
                <option value="">-- Pilih Aset --</option>
                @foreach ($inventaris as $item)
                    <option value="{{ $item->id }}"
                        {{ old('inventaris_id', $kerusakan->inventaris_id ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->kode_inventaris }} - {{ $item->barang->nama_barang }}
                        ({{ $item->ruangan->nama_ruangan }})
                    </option>
                @endforeach
            </select>
        </div>

        <x-forms.input type="date" name="tanggal_laporan" label="Tanggal Lapor" :value="$kerusakan->tanggal_laporan ?? date('Y-m-d')" required="true" />

        <x-forms.input name="pelapor" label="Nama Pelapor" :value="$kerusakan->pelapor ?? Auth::user()->name" required="true" />
    </div>

    <div>
        <div class="mb-4">
            <x-forms.label for="deskripsi_kerusakan" value="Deskripsi Masalah" required="true" />
            <textarea name="deskripsi_kerusakan" rows="4" class="w-full border-gray-300 rounded-md focus:ring-indigo-500"
                placeholder="Contoh: AC tidak dingin, Printer macet kertas">{{ $kerusakan->deskripsi_kerusakan ?? '' }}</textarea>
        </div>

        @php
            $opsiStatus = [
                'Pending' => 'Pending (Menunggu Teknisi)',
                'Proses' => 'Sedang Dikerjakan',
                'Selesai' => 'Selesai Diperbaiki',
                'Tidak Bisa Diperbaiki' => 'Rusak Total (Tidak Bisa Diperbaiki)',
            ];
        @endphp
        <x-forms.select name="status" label="Status Laporan" :options="$opsiStatus" :value="$kerusakan->status ?? 'Pending'" required="true" />
    </div>
</div>

<div class="mt-6 flex justify-end">
    <a href="{{ route('kerusakan.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</a>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan Laporan</button>
</div>
