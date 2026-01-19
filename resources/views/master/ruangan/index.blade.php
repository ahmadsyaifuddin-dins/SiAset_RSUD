<x-app-layout>
    <x-slot name="header">
        Data Ruangan
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('ruangan.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                <i class="fa-solid fa-plus mr-1"></i> Tambah Ruangan
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Foto</th>
                        <th class="px-4 py-2 text-left">Nama Ruangan</th>
                        <th class="px-4 py-2 text-left">Kepala Ruangan</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ruangans as $ruangan)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">
                                @if ($ruangan->foto)
                                    <img src="{{ asset('uploads/' . $ruangan->foto) }}"
                                        class="w-12 h-12 object-cover rounded-md">
                                @else
                                    <span class="text-gray-400 text-xs italic">No Image</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 font-medium">{{ $ruangan->nama_ruangan }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $ruangan->kepala_ruangan }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('ruangan.edit', $ruangan->id) }}"
                                    class="text-yellow-500 hover:text-yellow-600 mx-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST"
                                    class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 mx-1">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
