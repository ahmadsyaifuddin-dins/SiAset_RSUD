<x-app-layout>
    <x-slot name="header">Daftar Permintaan Perbaikan</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('kerusakan.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-triangle-exclamation mr-1"></i> Lapor Kerusakan
            </a>
        </div>
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Barang / Lokasi</th>
                    <th class="px-4 py-2 text-left">Masalah</th>
                    <th class="px-4 py-2 text-center">Status</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kerusakans as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            <div class="font-bold">{{ $item->inventaris->barang->nama_barang ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $item->inventaris->ruangan->nama_ruangan ?? '-' }}
                            </div>
                        </td>
                        <td class="px-4 py-2 text-sm">{{ Str::limit($item->deskripsi_kerusakan, 50) }}</td>
                        <td class="px-4 py-2 text-center">
                            <span
                                class="px-2 py-1 text-xs rounded-full font-bold
                            {{ $item->status == 'Pending'
                                ? 'bg-yellow-100 text-yellow-800'
                                : ($item->status == 'Selesai'
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-blue-100 text-blue-800') }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('kerusakan.edit', $item->id) }}" class="text-yellow-500 mx-2"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('kerusakan.destroy', $item->id) }}" method="POST"
                                class="inline delete-form">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 mx-2"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
