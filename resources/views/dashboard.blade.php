<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500 hover:shadow-lg transition">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                            <i class="fa-solid fa-boxes-stacked text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Aset Terdata</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalAset }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-red-500 hover:shadow-lg transition">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600">
                            <i class="fa-solid fa-screwdriver-wrench text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Perbaikan Pending</p>
                            <p class="text-2xl font-bold text-red-600">{{ $perbaikanPending }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500 hover:shadow-lg transition">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Stok BHP Kritis</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stokKritisCount }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-gray-500 hover:shadow-lg transition">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gray-100 text-gray-600">
                            <i class="fa-solid fa-heart-crack text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Aset Rusak/Mati</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $asetRusak }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-bell text-yellow-500"></i> Peringatan Stok Menipis
                        </h3>
                        <a href="{{ route('gudang.stok') }}" class="text-sm text-indigo-600 hover:underline">Lihat
                            Semua</a>
                    </div>
                    <div class="p-6">
                        @if ($listStokKritis->isEmpty())
                            <div class="text-center py-4 text-green-600 bg-green-50 rounded-lg">
                                <i class="fa-solid fa-check-circle mr-1"></i> Aman! Tidak ada stok kritis.
                            </div>
                        @else
                            <table class="w-full text-sm text-left">
                                <thead class="bg-gray-50 text-gray-500">
                                    <tr>
                                        <th class="px-4 py-2">Barang</th>
                                        <th class="px-4 py-2 text-center">Sisa</th>
                                        <th class="px-4 py-2 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($listStokKritis as $item)
                                        <tr>
                                            <td class="px-4 py-3 font-medium">{{ $item->nama_barang }}</td>
                                            <td class="px-4 py-3 text-center font-bold text-red-600">
                                                {{ $item->stok_saat_ini }} {{ $item->satuan }}</td>
                                            <td class="px-4 py-3 text-center">
                                                <span
                                                    class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs">Segera
                                                    Restock</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-clock-rotate-left text-indigo-500"></i> Laporan Kerusakan Terbaru
                        </h3>
                        <a href="{{ route('kerusakan.index') }}" class="text-sm text-indigo-600 hover:underline">Lihat
                            Semua</a>
                    </div>
                    <div class="p-6">
                        @if ($laporanTerbaru->isEmpty())
                            <div class="text-center py-4 text-gray-500 bg-gray-50 rounded-lg">
                                Belum ada laporan kerusakan masuk.
                            </div>
                        @else
                            <ul class="space-y-4">
                                @foreach ($laporanTerbaru as $laporan)
                                    <li class="flex items-start space-x-3 pb-3 border-b border-gray-100 last:border-0">
                                        <div class="flex-shrink-0 mt-1">
                                            @if ($laporan->status == 'Pending')
                                                <i class="fa-solid fa-circle-exclamation text-yellow-500"></i>
                                            @elseif($laporan->status == 'Selesai')
                                                <i class="fa-solid fa-circle-check text-green-500"></i>
                                            @else
                                                <i class="fa-solid fa-spinner text-blue-500"></i>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $laporan->inventaris->barang->nama_barang ?? 'Barang Terhapus' }}
                                            </p>
                                            <p class="text-xs text-gray-500 truncate">
                                                {{ Str::limit($laporan->deskripsi_kerusakan, 40) }}
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $laporan->inventaris->ruangan->nama_ruangan ?? '-' }} •
                                                {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div>
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                            {{ $laporan->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : ($laporan->status == 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                                {{ $laporan->status }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

            </div>

            <div class="mt-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 px-1">Akses Cepat</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('gudang-masuk.create') }}"
                        class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition text-center group border hover:border-indigo-500">
                        <i
                            class="fa-solid fa-cart-plus text-3xl text-indigo-500 mb-2 group-hover:scale-110 transition"></i>
                        <p class="font-medium text-gray-700">Restock Gudang</p>
                    </a>
                    <a href="{{ route('gudang-keluar.create') }}"
                        class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition text-center group border hover:border-indigo-500">
                        <i class="fa-solid fa-dolly text-3xl text-indigo-500 mb-2 group-hover:scale-110 transition"></i>
                        <p class="font-medium text-gray-700">Distribusi Barang</p>
                    </a>
                    <a href="{{ route('kerusakan.create') }}"
                        class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition text-center group border hover:border-indigo-500">
                        <i
                            class="fa-solid fa-triangle-exclamation text-3xl text-indigo-500 mb-2 group-hover:scale-110 transition"></i>
                        <p class="font-medium text-gray-700">Lapor Kerusakan</p>
                    </a>
                    <a href="{{ route('laporan.index') }}"
                        class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition text-center group border hover:border-indigo-500">
                        <i class="fa-solid fa-print text-3xl text-indigo-500 mb-2 group-hover:scale-110 transition"></i>
                        <p class="font-medium text-gray-700">Cetak Laporan</p>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
