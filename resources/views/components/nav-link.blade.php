@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center px-4 py-2.5 text-sm font-medium rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-900/20 transition duration-200'
            : 'flex items-center px-4 py-2.5 text-sm font-medium rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
