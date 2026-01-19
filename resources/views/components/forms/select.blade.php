@props([
    'name',
    'label' => null,
    'options' => [],
    'value' => null,
    'required' => false,
    'placeholder' => '-- Pilih --',
])

<div class="mb-4">
    @if ($label)
        <x-forms.label :for="$name" :value="$label" :required="$required" />
    @endif

    <select name="{{ $name }}" id="{{ $name }}" {!! $attributes->merge([
        'class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
    ]) !!}>
        <option value="" disabled {{ is_null($value) ? 'selected' : '' }}>{{ $placeholder }}</option>

        @foreach ($options as $key => $optionLabel)
            <option value="{{ $key }}" {{ (string) $value === (string) $key ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
