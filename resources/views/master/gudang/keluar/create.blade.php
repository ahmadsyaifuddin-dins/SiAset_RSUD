<x-app-layout>
    <x-slot name="header">Input Barang Keluar (Distribusi)</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
        <form action="{{ route('gudang-keluar.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <x-forms.label value="Pilih Barang" required="true" />
                <select name="barang_gudang_id" class="w-full border-gray-300 rounded-md focus:ring-indigo-500">
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_barang }} (Stok: {{ $item->stok_saat_ini }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">*Hanya barang dengan stok > 0 yang muncul</p>
            </div>

            <div class="mb-4">
                <x-forms.label value="Tujuan Ruangan" required="true" />
                <select name="ruangan_id" class="w-full border-gray-300 rounded-md focus:ring-indigo-500">
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                    @endforeach
                </select>
            </div>

            <x-forms.input type="date" name="tanggal_keluar" label="Tanggal Keluar" :value="date('Y-m-d')"
                required="true" />

            <x-forms.input type="number" name="jumlah_keluar" label="Jumlah Keluar" required="true" />

            <x-forms.input name="keterangan" label="Keterangan" placeholder="Contoh: Permintaan bulanan" />

            <div class="mt-6 flex justify-end">
                <a href="{{ route('gudang-keluar.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
