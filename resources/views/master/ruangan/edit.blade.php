<x-app-layout>
    <x-slot name="header">
        Edit Ruangan: {{ $ruangan->nama_ruangan }}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('master.ruangan._form')
        </form>
    </div>
</x-app-layout>
