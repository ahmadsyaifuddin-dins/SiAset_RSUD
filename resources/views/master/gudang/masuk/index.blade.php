<x-app-layout>
    <x-slot name="header">Riwayat Barang Masuk</x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('gudang-masuk.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-plus mr-1"></i> Input Barang Masuk
            </a>
        </div>

        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Nama Barang</th>
                    <th class="px-4 py-2 text-center">Jumlah Masuk</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d M Y') }}</td>
                        <td class="px-4 py-2 font-bold text-gray-700">{{ $item->barangGudang->nama_barang ?? '-' }}</td>
                        <td class="px-4 py-2 text-center">
                            <span class="text-green-600 font-bold">+{{ $item->jumlah_masuk }}</span>
                            {{ $item->barangGudang->satuan ?? '' }}
                        </td>
                        <td class="px-4 py-2 text-center">
                            <form action="{{ route('gudang-masuk.destroy', $item->id) }}" method="POST"
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
