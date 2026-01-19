<x-app-layout>
    <x-slot name="header">
        Data Barang Gudang (BHP)
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-700">List Stok Barang Habis Pakai</h2>
            <a href="{{ route('barang-gudang.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30 flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Item
            </a>
        </div>

        <div class="overflow-x-auto border rounded-lg">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                            / Kategori</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Stok</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Satuan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($items as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ $item->nama_barang }}</div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $item->jenis ?? '-' }}</div>
                                <div class="text-xs text-indigo-500 italic">{{ $item->kategori ?? '-' }}</div>
                            </td>

                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $item->stok_saat_ini > 10 ? 'bg-green-100 text-green-800' : ($item->stok_saat_ini > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $item->stok_saat_ini }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center text-sm text-gray-500">
                                {{ $item->satuan }}
                            </td>

                            <td class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('barang-gudang.edit', $item->id) }}"
                                    class="text-yellow-500 hover:text-yellow-600 mx-2 transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                                </a>

                                <form action="{{ route('barang-gudang.destroy', $item->id) }}" method="POST"
                                    class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 mx-2 transition"
                                        title="Hapus">
                                        <i class="fa-solid fa-trash text-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 italic bg-gray-50">
                                Belum ada data barang gudang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
