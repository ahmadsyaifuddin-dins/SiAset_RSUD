<x-app-layout>
    <x-slot name="header">Edit Data Inventaris</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('inventaris.update', $inventaris->id) }}" method="POST">
            @csrf @method('PUT')
            @include('inventaris._form')
        </form>
    </div>
</x-app-layout>
