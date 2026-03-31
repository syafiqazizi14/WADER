@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl px-3 py-2']) }}>
        {{ $status }}
    </div>
@endif
