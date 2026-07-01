{{-- @props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a> --}}
@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center rounded-lg border border-cyan-100 bg-cyan-50 px-3 py-2 text-sm font-semibold leading-5 text-cyan-800 transition duration-150 ease-in-out'
    : 'inline-flex items-center rounded-lg border border-transparent px-3 py-2 text-sm font-medium leading-5 text-slate-600 transition duration-150 ease-in-out hover:border-slate-200 hover:bg-slate-50 hover:text-slate-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
