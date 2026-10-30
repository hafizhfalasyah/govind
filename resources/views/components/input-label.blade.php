@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-[#285E5E]']) }}>
    {{ $value ?? $slot }}
</label>
