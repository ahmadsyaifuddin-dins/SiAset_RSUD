<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pusat Laporan & Rekapitulasi PDF
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-indigo-200 pb-2">
                    <i class="fa-solid fa-boxes-stacked text-indigo-600 mr-2"></i> Kategori Laporan Gudang (BHP)
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                        <h4 class="font-bold text-md mb-1 text-gray-800">Laporan Stok Opname</h4>
                        <p class="text-xs text-gray-500 mb-4 h-8">Cetak sisa stok barang habis pakai secara keseluruhan
                            untuk dicocokkan dengan fisik.</p>

                        <a href="{{ route('laporan.stok') }}" target="_blank"
                            class="block text-center w-full bg-indigo-50 border border-indigo-200 text-indigo-700 py-2 rounded-md hover:bg-indigo-600 hover:text-white transition shadow-sm">
                            <i class="fa-solid fa-print mr-1"></i> Preview PDF
                        </a>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                        <h4 class="font-bold text-md mb-1 text-gray-800">Rekap Barang Masuk</h4>
                        <p class="text-xs text-gray-500 mb-4 h-8">Cetak riwayat pengadaan/pembelian barang masuk ke
                            gudang.</p>

                        <form action="{{ route('laporan.masuk') }}" method="GET" target="_blank" class="space-y-2">
                            <div class="flex gap-2">
                                <input type="date" name="start_date" class="w-1/2 border-gray-300 rounded-md text-xs"
                                    title="Dari Tanggal">
                                <input type="date" name="end_date" class="w-1/2 border-gray-300 rounded-md text-xs"
                                    title="Sampai Tanggal">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1 italic">*Kosongkan tanggal untuk cetak semua data
                            </p>
                            <button type="submit"
                                class="w-full bg-indigo-50 border border-indigo-200 text-indigo-700 py-2 rounded-md hover:bg-indigo-600 hover:text-white transition shadow-sm">
                                <i class="fa-solid fa-filter mr-1"></i> Cetak PDF
                            </button>
                        </form>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                        <h4 class="font-bold text-md mb-1 text-gray-800">Distribusi Barang</h4>
                        <p class="text-xs text-gray-500 mb-4 h-8">Rekap pengeluaran barang yang telah di-ACC ke
                            masing-masing ruangan.</p>

                        <form action="{{ route('laporan.keluar') }}" method="GET" target="_blank" class="space-y-2">
                            <div class="flex gap-2">
                                <input type="date" name="start_date" class="w-1/2 border-gray-300 rounded-md text-xs"
                                    title="Dari Tanggal">
                                <input type="date" name="end_date" class="w-1/2 border-gray-300 rounded-md text-xs"
                                    title="Sampai Tanggal">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1 italic">*Kosongkan tanggal untuk cetak semua data
                            </p>
                            <button type="submit"
                                class="w-full bg-indigo-50 border border-indigo-200 text-indigo-700 py-2 rounded-md hover:bg-indigo-600 hover:text-white transition shadow-sm">
                                <i class="fa-solid fa-filter mr-1"></i> Cetak PDF
                            </button>
                        </form>
                    </div>

                </div>
            </div>


            <div class="mt-10">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-emerald-200 pb-2">
                    <i class="fa-solid fa-computer text-emerald-600 mr-2"></i> Kategori Laporan Inventaris Aset
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                        <h4 class="font-bold text-md mb-1 text-gray-800">Daftar Inventaris Aktif</h4>
                        <p class="text-xs text-gray-500 mb-4 h-8">Cetak daftar aset tetap berdasarkan lokasi ruangan.
                        </p>

                        <form action="{{ route('laporan.inventaris') }}" method="GET" target="_blank"
                            class="space-y-2">
                            <select name="ruangan_id" class="w-full border-gray-300 rounded-md text-sm">
                                <option value="semua">-- Semua Ruangan --</option>
                                @foreach ($ruangans as $r)
                                    <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                                @endforeach
                            </select>
                            <button type="submit"
                                class="w-full bg-emerald-50 border border-emerald-200 text-emerald-700 py-2 rounded-md hover:bg-emerald-600 hover:text-white transition shadow-sm">
                                <i class="fa-solid fa-print mr-1"></i> Cetak PDF
                            </button>
                        </form>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                        <h4 class="font-bold text-md mb-1 text-gray-800">Laporan Kerusakan</h4>
                        <p class="text-xs text-gray-500 mb-4 h-8">Rekap barang yang dilaporkan rusak oleh kepala
                            ruangan.</p>

                        <form action="{{ route('laporan.kerusakan') ?? '#' }}" method="GET" target="_blank"
                            class="space-y-2">
                            <div class="flex gap-2">
                                <input type="date" name="start_date"
                                    class="w-1/2 border-gray-300 rounded-md text-xs">
                                <input type="date" name="end_date" class="w-1/2 border-gray-300 rounded-md text-xs">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1 italic">*Kosongkan tanggal untuk cetak semua data
                            </p>
                            <button type="submit"
                                class="w-full bg-emerald-50 border border-emerald-200 text-emerald-700 py-2 rounded-md hover:bg-emerald-600 hover:text-white transition shadow-sm">
                                <i class="fa-solid fa-filter mr-1"></i> Cetak PDF
                            </button>
                        </form>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                        <h4 class="font-bold text-md mb-1 text-gray-800">Biaya Perbaikan</h4>
                        <p class="text-xs text-gray-500 mb-4 h-8">Rekap tindakan teknisi dan total biaya servis aset.
                        </p>

                        <form action="{{ route('laporan.perbaikan') }}" method="GET" target="_blank"
                            class="space-y-2">
                            <div class="flex gap-2">
                                <input type="date" name="start_date"
                                    class="w-1/2 border-gray-300 rounded-md text-xs">
                                <input type="date" name="end_date"
                                    class="w-1/2 border-gray-300 rounded-md text-xs">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1 italic">*Kosongkan tanggal untuk cetak semua data
                            </p>
                            <button type="submit"
                                class="w-full bg-emerald-50 border border-emerald-200 text-emerald-700 py-2 rounded-md hover:bg-emerald-600 hover:text-white transition shadow-sm">
                                <i class="fa-solid fa-filter mr-1"></i> Cetak PDF
                            </button>
                        </form>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                        <h4 class="font-bold text-md mb-1 text-gray-800">Arsip Pemusnahan</h4>
                        <p class="text-xs text-gray-500 mb-4 h-8">Daftar rekap aset yang telah berstatus dimusnahkan.
                        </p>

                        <form action="{{ route('laporan.pemusnahan') ?? '#' }}" method="GET" target="_blank"
                            class="space-y-2">
                            <div class="flex gap-2">
                                <input type="date" name="start_date"
                                    class="w-1/2 border-gray-300 rounded-md text-xs">
                                <input type="date" name="end_date"
                                    class="w-1/2 border-gray-300 rounded-md text-xs">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1 italic">*Kosongkan tanggal untuk cetak semua data
                            </p>
                            <button type="submit"
                                class="w-full bg-emerald-50 border border-emerald-200 text-emerald-700 py-2 rounded-md hover:bg-emerald-600 hover:text-white transition shadow-sm">
                                <i class="fa-solid fa-filter mr-1"></i> Cetak PDF
                            </button>
                        </form>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                        <h4 class="font-bold text-md mb-1 text-gray-800">Riwayat Serah Terima</h4>
                        <p class="text-xs text-gray-500 mb-4 h-8">Rekapitulasi bukti serah terima aset dari teknisi
                            kembali ke ruangan.</p>

                        <form action="{{ route('laporan.serah-terima-rekap') }}" method="GET" target="_blank"
                            class="space-y-2">
                            <div class="flex gap-2">
                                <input type="date" name="start_date"
                                    class="w-1/2 border-gray-300 rounded-md text-xs"
                                    title="Dari Tanggal (Boleh Kosong)">
                                <input type="date" name="end_date"
                                    class="w-1/2 border-gray-300 rounded-md text-xs"
                                    title="Sampai Tanggal (Boleh Kosong)">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1 italic">*Kosongkan tanggal untuk cetak semua</p>
                            <button type="submit"
                                class="w-full bg-emerald-50 border border-emerald-200 text-emerald-700 py-2 rounded-md hover:bg-emerald-600 hover:text-white transition shadow-sm">
                                <i class="fa-solid fa-filter mr-1"></i> Cetak PDF
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
