<x-app-layout>
    <x-slot name="header">Buat Berita Acara Serah Terima</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
        <form action="{{ route('serah-terima.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <x-forms.label value="Pilih Perbaikan Selesai" required="true" />
                <select name="perbaikan_id" class="w-full border-gray-300 rounded-md focus:ring-indigo-500">
                    <option value="">-- Pilih Barang Selesai Servis --</option>
                    @foreach ($perbaikanSiap as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->kerusakan->inventaris->barang->nama_barang }} (Teknisi: {{ $item->teknisi }})
                        </option>
                    @endforeach
                </select>
            </div>

            <x-forms.input type="date" name="tanggal_serah" label="Tanggal Penyerahan" :value="date('Y-m-d')"
                required="true" />

            <x-forms.input name="penerima" label="Nama Penerima (User Ruangan)"
                placeholder="Contoh: Kepala Ruangan / Staff" required="true" />

            <x-forms.input name="keterangan" label="Catatan Tambahan"
                placeholder="Contoh: Barang sudah dites dan oke" />

            <div class="mt-6 flex justify-end">
                <a href="{{ route('serah-terima.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan Berita
                    Acara</button>
            </div>
        </form>
    </div>
</x-app-layout>
