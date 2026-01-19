<x-app-layout>
    <x-slot name="header">Edit Laporan Kerusakan</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('kerusakan.update', $kerusakan->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('perbaikan.kerusakan._form')
        </form>
    </div>
</x-app-layout>
