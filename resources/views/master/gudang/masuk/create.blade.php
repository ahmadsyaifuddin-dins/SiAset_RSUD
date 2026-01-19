<x-app-layout>
    <x-slot name="header">Tambah Stok Barang (Restock)</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
        <form action="{{ route('gudang-masuk.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <x-forms.label value="Pilih Barang" required="true" />
                <select name="barang_gudang_id" class="w-full border-gray-300 rounded-md focus:ring-indigo-500">
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_barang }} (Sisa: {{ $item->stok_saat_ini }}
                            {{ $item->satuan }})</option>
                    @endforeach
                </select>
            </div>

            <x-forms.input type="date" name="tanggal_masuk" label="Tanggal Masuk" :value="date('Y-m-d')"
                required="true" />

            <x-forms.input type="number" name="jumlah_masuk" label="Jumlah Masuk" placeholder="Contoh: 50"
                required="true" />

            <div class="mt-6 flex justify-end">
                <a href="{{ route('gudang-masuk.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
