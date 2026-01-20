<x-app-layout>
    <x-slot name="header">Tambah Pengguna Baru</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @include('master.users._form')
        </form>
    </div>
</x-app-layout>
