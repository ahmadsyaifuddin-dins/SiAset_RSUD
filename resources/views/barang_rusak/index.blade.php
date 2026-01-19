<x-app-layout>
    <x-slot name="header">Data Barang Rusak Berat (Dihapus)</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('barang-rusak.create') }}"
                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                <i class="fa-solid fa-trash-can mr-1"></i> Input Penghapusan
            </a>
        </div>
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Tgl Hapus</th>
                    <th class="px-4 py-2 text-left">Barang</th>
                    <th class="px-4 py-2 text-left">Ruangan Asal</th>
                    <th class="px-4 py-2 text-left">Alasan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangRusak as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_penghapusan)->format('d M Y') }}
                        </td>
                        <td class="px-4 py-2 font-bold">
                            {{ $item->inventaris->barang->nama_barang ?? 'Data Master Terhapus' }}</td>
                        <td class="px-4 py-2">{{ $item->inventaris->ruangan->nama_ruangan ?? '-' }}</td>
                        <td class="px-4 py-2 text-red-600">{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
