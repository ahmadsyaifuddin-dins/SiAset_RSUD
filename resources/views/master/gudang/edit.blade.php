<x-app-layout>
    <x-slot name="header">
        Edit Barang Gudang: {{ $barangGudang->nama_barang }}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('barang-gudang.update', $barangGudang->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('master.gudang._form')

        </form>
    </div>
</x-app-layout>
