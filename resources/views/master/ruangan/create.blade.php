<x-app-layout>
    <x-slot name="header">
        Tambah Ruangan Baru
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('ruangan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('master.ruangan._form')
        </form>
    </div>
</x-app-layout>
