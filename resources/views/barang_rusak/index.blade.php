<x-app-layout>
    <x-slot name="header">Arsip Pemusnahan Aset (BAP)</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

        <div class="mb-4 text-sm text-gray-500 bg-gray-50 p-3 rounded-md border">
            <i class="fa-solid fa-circle-info text-blue-500 mr-2"></i> Data di bawah ini adalah aset yang telah berstatus
            <strong>Dimusnahkan</strong>.
        </div>

        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Tgl Hapus</th>
                    <th class="px-4 py-2 text-left">Kode / Barang</th>
                    <th class="px-4 py-2 text-left">Penyetuju</th>
                    <th class="px-4 py-2 text-left">Alasan</th>
                    <th class="px-4 py-2 text-center">Dokumen BAP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangRusak as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_dihapus)->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            <div class="font-bold text-indigo-700">{{ $item->kode_inventaris }}</div>
                            <div class="text-sm">{{ $item->barang->nama_barang ?? '-' }}</div>
                        </td>
                        <td class="px-4 py-2 font-medium">{{ $item->nama_penyetuju }}</td>
                        <td class="px-4 py-2 text-sm text-red-600">{{ $item->alasan_hapus }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('barang-rusak.bap', $item->id) }}" target="_blank"
                                class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md text-sm font-medium transition">
                                <i class="fa-solid fa-file-pdf mr-1"></i> BAP
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
