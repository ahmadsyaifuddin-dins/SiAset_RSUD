<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    
    <x-forms.input 
        name="name" 
        label="Nama Lengkap" 
        :value="$user->name ?? ''" 
        required="true" 
        placeholder="Contoh: Admin Utama" 
    />

    <x-forms.input 
        type="email"
        name="email" 
        label="Alamat Email" 
        :value="$user->email ?? ''" 
        required="true" 
        placeholder="Contoh: admin@rsud.com" 
    />

    <div class="mb-4">
        <x-forms.label for="password" value="Password" :required="!isset($user)" />
        <input type="password" name="password" id="password" 
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @if(isset($user))
            <p class="text-xs text-gray-500 mt-1">*Kosongkan jika tidak ingin mengganti password</p>
        @endif
        @error('password')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <x-forms.label for="password_confirmation" value="Ulangi Password" :required="!isset($user)" />
        <input type="password" name="password_confirmation" id="password_confirmation" 
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>

</div>

<div class="mt-6 flex justify-end border-t pt-4">
    <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2 hover:bg-gray-600 transition">Batal</a>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">Simpan Data</button>
</div>