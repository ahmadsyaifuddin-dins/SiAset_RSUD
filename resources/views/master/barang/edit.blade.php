<x-app-layout>
    <x-slot name="header">Edit Aset: {{ $barang->nama_barang }}</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('master.barang._form')
        </form>
    </div>
</x-app-layout>
