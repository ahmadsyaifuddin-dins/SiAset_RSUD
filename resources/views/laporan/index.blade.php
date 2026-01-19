<x-app-layout>
    <x-slot name="header">Pusat Laporan & Cetak PDF</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="font-bold text-lg mb-2 text-indigo-700"><i class="fa-solid fa-hospital-user mr-2"></i>Inventaris
                Ruangan</h3>
            <p class="text-sm text-gray-500 mb-4">Cetak daftar aset yang ada di ruangan tertentu.</p>

            <form action="{{ route('laporan.inventaris') }}" method="GET" target="_blank">
                <select name="ruangan_id" class="w-full border-gray-300 rounded-md text-sm mb-3" required>
                    <option value="">-- Pilih Ruangan --</option>
                    @foreach ($ruangans as $r)
                        <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                    @endforeach
                </select>
                <button class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">
                    <i class="fa-solid fa-print mr-2"></i> Preview PDF
                </button>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="font-bold text-lg mb-2 text-indigo-700"><i class="fa-solid fa-boxes-stacked mr-2"></i>Stok Gudang
                (BHP)</h3>
            <p class="text-sm text-gray-500 mb-4">Cetak sisa stok barang habis pakai saat ini.</p>
            <a href="{{ route('laporan.stok') }}" target="_blank"
                class="block text-center w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-print mr-2"></i> Preview PDF
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="font-bold text-lg mb-2 text-indigo-700"><i class="fa-solid fa-download mr-2"></i>Barang Masuk
            </h3>
            <p class="text-sm text-gray-500 mb-4">Rekap riwayat penambahan stok gudang.</p>
            <a href="{{ route('laporan.masuk') }}" target="_blank"
                class="block text-center w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-print mr-2"></i> Preview PDF
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="font-bold text-lg mb-2 text-indigo-700"><i class="fa-solid fa-upload mr-2"></i>Barang Keluar</h3>
            <p class="text-sm text-gray-500 mb-4">Rekap distribusi barang ke ruangan.</p>
            <a href="{{ route('laporan.keluar') }}" target="_blank"
                class="block text-center w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-print mr-2"></i> Preview PDF
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="font-bold text-lg mb-2 text-indigo-700"><i
                    class="fa-solid fa-screwdriver-wrench mr-2"></i>Maintenance</h3>
            <p class="text-sm text-gray-500 mb-4">Rekap kerusakan dan biaya perbaikan.</p>
            <a href="{{ route('laporan.perbaikan') }}" target="_blank"
                class="block text-center w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-print mr-2"></i> Preview PDF
            </a>
        </div>

    </div>
</x-app-layout>
