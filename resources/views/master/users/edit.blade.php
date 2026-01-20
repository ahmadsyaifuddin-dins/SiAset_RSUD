<x-app-layout>
    <x-slot name="header">Edit Pengguna: {{ $user->name }}</x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf @method('PUT')
            @include('master.users._form')
        </form>
    </div>
</x-app-layout>
