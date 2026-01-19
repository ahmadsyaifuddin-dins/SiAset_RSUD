<x-app-layout>
    <x-slot name="header">Tambah Aset Barang</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('master.barang._form')
        </form>
    </div>
</x-app-layout>
