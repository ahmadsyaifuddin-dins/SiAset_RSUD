<x-app-layout>
    <x-slot name="header">Inventaris Barang (Aset Aktif)</x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Daftar Aset Terdistribusi</h2>
            <a href="{{ route('inventaris.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30 flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Catat Barang Masuk
            </a>
        </div>

        <div class="overflow-x-auto border rounded-lg">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode / Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi Ruangan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Kondisi</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($inventaris as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-indigo-700">{{ $item->kode_inventaris }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->barang->nama_barang ?? '-' }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $item->barang->jenis_barang ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fa-solid fa-location-dot mr-1"></i>
                                    {{ $item->ruangan->nama_ruangan ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($item->kondisi == 'Baik')
                                    <span
                                        class="px-2 py-1 text-xs font-bold text-green-700 bg-green-100 rounded-full">Baik</span>
                                @elseif($item->kondisi == 'Rusak Ringan')
                                    <span
                                        class="px-2 py-1 text-xs font-bold text-yellow-700 bg-yellow-100 rounded-full">Rusak
                                        Ringan</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-bold text-red-700 bg-red-100 rounded-full">Rusak
                                        Berat</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('inventaris.edit', $item->id) }}"
                                    class="text-yellow-500 hover:text-yellow-600 mx-2"><i
                                        class="fa-solid fa-pen-to-square text-lg"></i></a>

                                <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST"
                                    class="inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 mx-2"><i
                                            class="fa-solid fa-trash text-lg"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 italic bg-gray-50">Belum ada
                                data inventaris.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
