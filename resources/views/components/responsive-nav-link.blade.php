@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-lg border border-cyan-100 bg-cyan-50 px-3 py-2 text-start text-sm font-semibold text-cyan-800 transition duration-150 ease-in-out'
            : 'block w-full rounded-lg border border-transparent px-3 py-2 text-start text-sm font-medium text-slate-600 transition duration-150 ease-in-out hover:border-slate-200 hover:bg-slate-50 hover:text-slate-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
