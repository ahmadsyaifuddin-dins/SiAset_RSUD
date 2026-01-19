@props(['disabled' => false, 'name', 'label' => null, 'required' => false])

<div class="mb-4">
    @if ($label)
        <x-forms.label :for="$name" :value="$label" :required="$required" />
    @endif

    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
    ]) !!} name="{{ $name }}" id="{{ $name }}">

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
