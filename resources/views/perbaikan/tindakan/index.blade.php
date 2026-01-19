<x-app-layout>
    <x-slot name="header">Riwayat Tindakan Perbaikan</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('tindakan.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-wrench mr-1"></i> Input Tindakan
            </a>
        </div>
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Barang</th>
                    <th class="px-4 py-2 text-left">Tindakan</th>
                    <th class="px-4 py-2 text-right">Biaya</th>
                    <th class="px-4 py-2 text-left">Teknisi</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perbaikans as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_perbaikan)->format('d M Y') }}
                        </td>
                        <td class="px-4 py-2 font-bold">{{ $item->kerusakan->inventaris->barang->nama_barang ?? '-' }}
                        </td>
                        <td class="px-4 py-2">{{ $item->tindakan }}</td>
                        <td class="px-4 py-2 text-right font-mono text-green-700">
                            Rp {{ number_format($item->biaya, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-2">{{ $item->teknisi }}</td>
                        <td class="px-4 py-2 text-center">
                            <form action="{{ route('tindakan.destroy', $item->id) }}" method="POST"
                                class="inline delete-form">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
