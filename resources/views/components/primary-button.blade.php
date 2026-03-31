<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 rounded-xl font-semibold text-xs uppercase tracking-widest text-white bg-gradient-to-r from-sky-600 to-blue-700 shadow-lg shadow-blue-500/30 hover:from-sky-500 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2 transition ease-out duration-200']) }}>
    {{ $slot }}
</button>
