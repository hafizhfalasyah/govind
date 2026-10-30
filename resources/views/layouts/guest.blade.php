<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Account | Govind</title>

    <!-- Tailwind (sama dengan halaman login); dark mode hanya lewat class agar tampilan tetap terang -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = { darkMode: 'class' };
    </script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
      body {
        font-family: 'Inter', sans-serif;
        background: radial-gradient(circle at top left, #e3f2f2, #c1dcdc);
        overflow-x: hidden;
      }

      .shadow-glow {
        box-shadow: 0 20px 45px rgba(40, 94, 94, 0.25);
      }
    </style>
  </head>

  <body class="flex items-center justify-center min-h-screen px-4 py-10">
    <main
      class="relative w-full max-w-md mx-auto rounded-3xl overflow-hidden shadow-glow bg-white/80 backdrop-blur p-8 sm:p-10 text-gray-700"
      data-aos="fade-up"
      data-aos-duration="1000"
      data-aos-easing="ease-out-cubic"
    >
      <a href="{{ url('/') }}" class="block mb-6">
        <h2 class="text-3xl font-bold text-[#285E5E]">Govind</h2>
        <p class="text-sm text-[#285E5E]/70">Govind Abra Enterprise</p>
      </a>

      {{ $slot }}

      <p class="mt-8 text-sm text-[#285E5E]/80 text-center">
        <a href="{{ route('login') }}" class="font-semibold text-[#285E5E] hover:underline">Back to sign in</a>
      </p>
    </main>

    <script>
      AOS.init();
    </script>
  </body>
</html>
