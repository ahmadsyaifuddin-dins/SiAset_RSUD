@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center mt-2 py-2 px-6 bg-indigo-600 text-white rounded-md mx-2 transition-colors duration-200'
            : 'flex items-center mt-2 py-2 px-6 text-gray-400 hover:bg-gray-800 hover:text-gray-100 rounded-md mx-2 transition-colors duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $icon ?? '' }}
    <span class="mx-3 font-medium">{{ $slot }}</span>
</a>
