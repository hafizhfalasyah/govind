@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'rounded-xl bg-[#e3f2f2] px-4 py-2 text-sm font-medium text-[#285E5E]']) }}>
        {{ $status }}
    </div>
@endif
