<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 border border-slate-300 rounded-xl bg-white text-slate-700 font-semibold text-xs uppercase tracking-widest shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2 disabled:opacity-25 transition ease-out duration-200']) }}>
    {{ $slot }}
</button>
