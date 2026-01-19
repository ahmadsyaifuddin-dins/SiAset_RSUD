<x-app-layout>
    <x-slot name="header">Data Master Barang (Aset)</x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('barang.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-plus mr-1"></i> Tambah Barang
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Foto</th>
                        <th class="px-4 py-2 text-left">Nama / SN</th>
                        <th class="px-4 py-2 text-left">Jenis / Kategori</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">
                                @if ($item->foto)
                                    <img src="{{ asset('uploads/' . $item->foto) }}"
                                        class="w-12 h-12 object-cover rounded-md border">
                                @else
                                    <div
                                        class="w-12 h-12 bg-gray-200 rounded-md flex items-center justify-center text-gray-400">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <div class="font-bold text-gray-800">{{ $item->nama_barang }}</div>
                                <div class="text-xs text-indigo-600 font-mono mt-1">SN: {{ $item->sn ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-2">
                                <div class="text-sm">{{ $item->jenis_barang }}</div>
                                <div class="text-xs text-gray-500">{{ $item->kategori_barang }}</div>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('barang.edit', $item->id) }}"
                                    class="text-yellow-500 hover:text-yellow-600 mx-2"><i
                                        class="fa-solid fa-pen-to-square"></i></a>

                                <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                    class="inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 mx-2"><i
                                            class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
