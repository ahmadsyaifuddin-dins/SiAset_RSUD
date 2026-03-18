<x-app-layout>
    <x-slot name="header">Inventaris Barang (Aset Aktif)</x-slot>

    <div x-data="{ openModal: false, selectedId: '', selectedNama: '', selectedKode: '' }" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 relative">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Daftar Aset Terdistribusi</h2>
            <a href="{{ route('inventaris.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                <i class="fa-solid fa-plus"></i> Catat Barang Masuk
            </a>
        </div>

        <div class="overflow-x-auto border rounded-lg">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode / Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Kondisi</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($inventaris as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-indigo-700">{{ $item->kode_inventaris }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->barang->nama_barang ?? '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $item->ruangan->nama_ruangan ?? '-' }}</td>
                            <td class="px-6 py-4 text-center text-sm font-bold">{{ $item->kondisi }}</td>

                            <td class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('inventaris.label', $item->id) }}" target="_blank"
                                    class="text-blue-500 hover:text-blue-700 mx-2" title="Cetak Label QR">
                                    <i class="fa-solid fa-qrcode text-lg"></i>
                                </a>

                                <a href="{{ route('inventaris.edit', $item->id) }}"
                                    class="text-yellow-500 hover:text-yellow-600 mx-2"><i
                                        class="fa-solid fa-pen-to-square text-lg"></i></a>

                                <button
                                    @click="openModal = true; selectedId = '{{ $item->id }}'; selectedNama = '{{ addslashes($item->barang->nama_barang) }}'; selectedKode = '{{ $item->kode_inventaris }}';"
                                    class="text-red-500 hover:text-red-600 mx-2" title="Musnahkan Aset">
                                    <i class="fa-solid fa-trash text-lg"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

        <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                <div x-show="openModal" x-transition.opacity
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="openModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="openModal" x-transition
                    class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">

                    <div class="sm:flex sm:items-start">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fa-solid fa-fire text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                Pemusnahan Aset
                            </h3>
                            <div class="mt-2 text-sm text-gray-500">
                                Anda akan memusnahkan <strong x-text="selectedKode"></strong> - <strong
                                    x-text="selectedNama"></strong>.<br>
                                Data tidak akan dihapus permanen, tapi akan dialihkan ke arsip BAP.
                            </div>

                            <form action="{{ route('barang-rusak.store') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="inventaris_id" :value="selectedId">

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pimpinan Penyetuju
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_penyetuju" required
                                        placeholder="Cth: Dr. Andi (Direktur)"
                                        class="w-full border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Pemusnahan <span
                                            class="text-red-500">*</span></label>
                                    <textarea name="alasan_hapus" required rows="3"
                                        placeholder="Cth: Rusak total akibat korsleting listrik, tidak bisa diservis."
                                        class="w-full border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500"></textarea>
                                </div>

                                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                    <button type="submit"
                                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                                        Proses Pemusnahan
                                    </button>
                                    <button type="button" @click="openModal = false"
                                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
