<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2 rounded-xl font-semibold text-sm text-white bg-gradient-to-r from-[#285E5E] to-[#1F4A4A] hover:opacity-95 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#285E5E] focus:ring-offset-2 transition-all duration-300']) }}>
    {{ $slot }}
</button>
