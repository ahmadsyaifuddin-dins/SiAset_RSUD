<x-app-layout>
    <x-slot name="header">Catat Inventaris Masuk</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('inventaris.store') }}" method="POST">
            @csrf
            @include('inventaris._form')
        </form>
    </div>
</x-app-layout>
