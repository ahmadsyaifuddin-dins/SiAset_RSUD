<x-app-layout>
    <x-slot name="header">Buat Laporan Kerusakan</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('kerusakan.store') }}" method="POST">
            @csrf
            @include('perbaikan.kerusakan._form')
        </form>
    </div>
</x-app-layout>
