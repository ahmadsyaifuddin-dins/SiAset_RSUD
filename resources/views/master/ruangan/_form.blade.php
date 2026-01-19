<div class="grid grid-cols-1 gap-6">

    <x-forms.input name="nama_ruangan" label="Nama Ruangan" :value="old('nama_ruangan', $ruangan->nama_ruangan ?? '')" required="true"
        placeholder="Contoh: Poli Umum" />

    <x-forms.input name="kepala_ruangan" label="Kepala Ruangan" :value="old('kepala_ruangan', $ruangan->kepala_ruangan ?? '')" required="true"
        placeholder="Nama Dokter / Penanggung Jawab" />

    <x-forms.upload-gambar name="foto" label="Foto Ruangan" :value="$ruangan->foto ?? null" />

</div>

<div class="mt-6 flex justify-end">
    <a href="{{ route('ruangan.index') }}"
        class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2 hover:bg-gray-600">Batal</a>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
        Simpan Data
    </button>
</div>
