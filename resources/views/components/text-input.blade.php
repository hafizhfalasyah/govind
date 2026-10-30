@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'px-4 py-2 rounded-xl border border-[#C1DCDC] bg-white/80 text-gray-700 focus:ring-2 focus:ring-[#285E5E] focus:outline-none transition-all duration-300 placeholder:text-gray-400']) }}>
