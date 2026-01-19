@props(['name', 'label' => null, 'required' => false, 'value' => null])

<div class="mb-4">
    @if ($label)
        <x-forms.label :for="$name" :value="$label" :required="$required" />
    @endif

    <input type="file" name="{{ $name }}" id="{{ $name }}" accept="image/*" {!! $attributes->merge([
        'class' => 'mt-1 block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-md file:border-0
                file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-700
                hover:file:bg-indigo-100',
    ]) !!}>

    @if ($value)
        <div class="mt-2 text-sm text-gray-500">
            File saat ini: <a href="{{ asset('uploads/' . $value) }}" target="_blank"
                class="text-indigo-600 underline">Lihat Gambar</a>
        </div>
    @endif

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
