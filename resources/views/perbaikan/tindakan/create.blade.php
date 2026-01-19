<x-app-layout>
    <x-slot name="header">Input Tindakan Perbaikan</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
        <form action="{{ route('tindakan.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <x-forms.label value="Pilih Laporan Kerusakan" required="true" />
                <select name="kerusakan_id" class="w-full border-gray-300 rounded-md focus:ring-indigo-500">
                    <option value="">-- Pilih Laporan --</option>
                    @foreach ($laporanPending as $laporan)
                        <option value="{{ $laporan->id }}">
                            {{ $laporan->inventaris->barang->nama_barang }} -
                            {{ Str::limit($laporan->deskripsi_kerusakan, 30) }} ({{ $laporan->pelapor }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">*Hanya menampilkan laporan status Pending/Proses</p>
            </div>

            <x-forms.input type="date" name="tanggal_perbaikan" label="Tanggal Perbaikan" :value="date('Y-m-d')"
                required="true" />

            <x-forms.input name="tindakan" label="Tindakan Perbaikan" placeholder="Contoh: Ganti LCD, Isi Freon, dll"
                required="true" />

            <div class="grid grid-cols-2 gap-4">
                <x-forms.input type="number" name="biaya" label="Biaya (Rp)" placeholder="0" required="true" />
                <x-forms.input name="teknisi" label="Nama Teknisi" required="true" />
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('tindakan.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan &
                    Selesaikan</button>
            </div>
        </form>
    </div>
</x-app-layout>
