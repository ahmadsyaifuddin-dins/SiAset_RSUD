<x-app-layout>
    <x-slot name="header">
        {{ auth()->user()->role === 'admin' ? 'Riwayat Distribusi & Permintaan' : 'Permintaan Barang Saya' }}
    </x-slot>

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('gudang-keluar.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-plus mr-1"></i> Buat Permintaan Barang
            </a>
        </div>

        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Pemohon / Ruangan</th>
                    <th class="px-4 py-2 text-left">Barang</th>
                    <th class="px-4 py-2 text-center">Jumlah</th>
                    <th class="px-4 py-2 text-center">Status</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            <div class="font-bold">{{ $item->user->name ?? 'Admin' }}</div>
                            <div class="text-xs text-gray-500">{{ $item->ruangan->nama_ruangan ?? '-' }}</div>
                        </td>
                        <td class="px-4 py-2 font-bold">{{ $item->barangGudang->nama_barang ?? '-' }}</td>
                        <td class="px-4 py-2 text-center font-bold">{{ $item->jumlah_keluar }}</td>

                        <td class="px-4 py-2 text-center">
                            @if ($item->status == 0)
                                <span
                                    class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full">Menunggu
                                    ACC</span>
                            @elseif($item->status == 1)
                                <span
                                    class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full">Di-ACC</span>
                            @else
                                <span
                                    class="px-2 py-1 bg-red-100 text-red-800 text-xs font-bold rounded-full">Ditolak</span>
                            @endif
                        </td>

                        <td class="px-4 py-2 text-center whitespace-nowrap">
                            @if (auth()->user()->role === 'admin' && $item->status == 0)
                                <form action="{{ route('gudang-keluar.approve', $item->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800 mx-1"
                                        title="Setujui (ACC)">
                                        <i class="fa-solid fa-circle-check text-xl"></i>
                                    </button>
                                </form>
                                <form action="{{ route('gudang-keluar.reject', $item->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800 mx-1" title="Tolak">
                                        <i class="fa-solid fa-circle-xmark text-xl"></i>
                                    </button>
                                </form>
                            @endif

                            @if (auth()->user()->role === 'admin' || $item->status == 0)
                                <form action="{{ route('gudang-keluar.destroy', $item->id) }}" method="POST"
                                    class="inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500 mx-1 ml-2"
                                        title="Hapus Data">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
