<x-app-layout>
    <x-slot name="header">
        Tambah Barang Gudang (BHP)
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('barang-gudang.store') }}" method="POST">
            @csrf

            @include('master.gudang._form')

        </form>
    </div>
</x-app-layout>
