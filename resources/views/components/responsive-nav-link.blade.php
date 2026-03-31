@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full px-4 py-2.5 rounded-lg text-start text-sm font-semibold text-sky-800 bg-sky-100 border border-sky-200 transition duration-150 ease-in-out'
            : 'block w-full px-4 py-2.5 rounded-lg text-start text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
