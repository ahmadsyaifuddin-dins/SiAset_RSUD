<x-app-layout>
    <x-slot name="header">Input Penghapusan Aset (Rusak Berat)</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
        <form action="{{ route('barang-rusak.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <x-forms.label value="Pilih Aset Rusak Berat" required="true" />
                <select name="inventaris_id" class="w-full border-gray-300 rounded-md focus:ring-indigo-500">
                    <option value="">-- Pilih Aset --</option>
                    @foreach ($inventaris as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->kode_inventaris }} - {{ $item->barang->nama_barang }}
                            ({{ $item->ruangan->nama_ruangan }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-red-500 mt-1">*Hanya menampilkan aset dengan kondisi "Rusak Berat"</p>
            </div>

            <x-forms.input type="date" name="tanggal_penghapusan" label="Tanggal Penghapusan" :value="date('Y-m-d')"
                required="true" />

            <div class="mb-4">
                <x-forms.label value="Alasan Penghapusan / Keterangan" required="true" />
                <textarea name="keterangan" rows="3" class="w-full border-gray-300 rounded-md focus:ring-indigo-500"
                    placeholder="Contoh: Terbakar, Hilang, atau Lelang"></textarea>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('barang-rusak.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</a>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Musnahkan
                    Aset</button>
            </div>
        </form>
    </div>
</x-app-layout>
