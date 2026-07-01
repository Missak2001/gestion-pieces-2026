<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm transition duration-150 ease-in-out hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 active:bg-cyan-900']) }}>
    {{ $slot }}
</button>
