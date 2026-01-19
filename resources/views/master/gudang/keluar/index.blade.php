<x-app-layout>
    <x-slot name="header">Riwayat Barang Keluar</x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('gudang-keluar.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-minus mr-1"></i> Distribusi Barang
            </a>
        </div>

        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Barang</th>
                    <th class="px-4 py-2 text-left">Tujuan</th>
                    <th class="px-4 py-2 text-center">Jumlah</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d M Y') }}</td>
                        <td class="px-4 py-2 font-bold">{{ $item->barangGudang->nama_barang ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded">
                                {{ $item->ruangan->nama_ruangan ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center text-red-600 font-bold">
                            -{{ $item->jumlah_keluar }}
                        </td>
                        <td class="px-4 py-2 text-center">
                            <form action="{{ route('gudang-keluar.destroy', $item->id) }}" method="POST"
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
