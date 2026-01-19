<x-app-layout>
    <x-slot name="header">Riwayat Serah Terima Barang</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('serah-terima.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-file-signature mr-1"></i> Buat BA Serah Terima
            </a>
        </div>
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Tgl Serah</th>
                    <th class="px-4 py-2 text-left">Barang</th>
                    <th class="px-4 py-2 text-left">Teknisi</th>
                    <th class="px-4 py-2 text-left">Penerima</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($serahTerima as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_serah)->format('d M Y') }}</td>
                        <td class="px-4 py-2 font-bold">
                            {{ $item->perbaikan->kerusakan->inventaris->barang->nama_barang ?? '-' }}
                        </td>
                        <td class="px-4 py-2">{{ $item->perbaikan->teknisi }}</td>
                        <td class="px-4 py-2">{{ $item->penerima }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('serah-terima.cetak', $item->id) }}" target="_blank"
                                class="text-blue-600 hover:text-blue-800 transition" title="Cetak Berita Acara">
                                <i class="fa-solid fa-print"></i> PDF
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
