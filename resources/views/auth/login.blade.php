<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Halaman login modern platform bimbingan skripsi GueBimbingin"
    />
    <title>Masuk | Govind</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- AOS (Animate On Scroll) -->
    <link
      href="https://unpkg.com/aos@2.3.1/dist/aos.css"
      rel="stylesheet"
    />
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

  <body class="flex items-center justify-center min-h-screen px-4">
    <main
      class="relative w-full max-w-5xl mx-auto flex flex-col md:flex-row rounded-3xl overflow-hidden shadow-glow bg-white/80 backdrop-blur"
      data-aos="fade-up"
      data-aos-duration="1000"
      data-aos-easing="ease-out-cubic"
    >
      <!-- Left: Form -->
      <section
        class="flex-1 p-10 md:p-14 flex flex-col justify-center items-start text-gray-700"
        data-aos="fade-right"
        data-aos-delay="200"
      >
        <h2 class="text-3xl font-bold mb-2 text-[#285E5E]">
          Govind
        </h2>
        <p class="text-sm mb-8 text-[#285E5E]/70">
          Sign in to your Govind account
        </p>

        <form
          action="{{ route('login') }}"
          method="POST"
          class="w-full space-y-3"
        >
          @csrf
          @error('email')
            <div class="text-red-500 text-sm mb-1 italic">{{ $message }}</div>
          @enderror

          @if(session('error'))
            <div class="text-red-500 text-sm mb-1 italic">{{ session('error') }}</div>
          @endif
          
          <!-- Email -->
          <div
            class="relative"
            data-aos="fade-right"
            data-aos-delay="400"
          >
            <span
              class="absolute left-3 top-1/2 -translate-y-1/2 text-[#285E5E]"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M21.75 6.75l-9 6-9-6M3.75 6.75l9 6 9-6m-18 0v10.5a2.25 2.25 0 002.25 2.25h13.5a2.25 2.25 0 002.25-2.25V6.75"
                />
              </svg>
            </span>
            
            <input
              id="email"
              type="email"
              name="email"
              placeholder="Email Address"
              required
              value="{{ old('email') }}"
              class="w-full pl-10 pr-4 py-2 rounded-xl border border-[#C1DCDC] 
              @error('email') border-red-500 @enderror
              focus:ring-2 focus:ring-[#285E5E] focus:outline-none bg-white/80 transition-all duration-300 placeholder:text-gray-400"
            />
          </div>

          <!-- Password -->
          <div
            class="relative"
            data-aos="fade-right"
            data-aos-delay="600"
          >
            <span
              class="absolute left-3 top-1/2 -translate-y-1/2 text-[#285E5E]"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M16.5 10.5V6a4.5 4.5 0 00-9 0v4.5m12 0h-15a.75.75 0 00-.75.75v8.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75V11.25a.75.75 0 00-.75-.75z"
                />
              </svg>
            </span>
            <input
              id="password"
              type="password"
              name="password"
              placeholder="Password"
              required
              class="w-full pl-10 pr-4 py-2 rounded-xl border border-[#C1DCDC]
              @error('email') border-red-500 @enderror
              focus:ring-2 focus:ring-[#285E5E] focus:outline-none bg-white/80 transition-all duration-300 placeholder:text-gray-400"
            />
          </div>

          <!-- Button -->
          <button
            type="submit"
            class="w-full py-2 mt-2 rounded-xl font-semibold text-white bg-gradient-to-r from-[#285E5E] to-[#1F4A4A] hover:opacity-95 hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]"
            data-aos="zoom-in"
            data-aos-delay="900"
          >
            SIGN IN
          </button>
        </form>

        <p
          class="mt-6 text-sm text-[#285E5E]/80 text-center mx-auto"
          data-aos="fade-up"
          data-aos-delay="1000"
        >
          Don’t have an account?
          <a
            href="{{ url('/register') }}"
            class="font-semibold text-[#285E5E] hover:underline"
          >
            Sign up now
          </a>
        </p>
      </section>

      <!-- Right: Background Wave -->
      <aside
        class="relative hidden md:flex md:w-1/2 justify-center items-center text-white p-10 bg-gradient-to-br from-[#C1DCDC] to-[#9ECACA]"
        data-aos="fade-left"
        data-aos-delay="300"
      >
        <div class="absolute inset-0 opacity-40">
          <!-- Decorative gradient circles -->
          <div
            class="absolute -top-10 -left-20 w-64 h-64 bg-white/30 rounded-full blur-3xl"
          ></div>
          <div
            class="absolute bottom-0 right-0 w-80 h-80 bg-white/20 rounded-full blur-3xl"
          ></div>
        </div>
        <div class="relative z-10 text-center px-6">
          <h2 class="text-4xl font-bold mb-3 drop-shadow-lg text-[#285E5E]">
            Welcome Back <br />
            Govind Member!
          </h2>
        </div>
      </aside>
    </main>

    <script>
      AOS.init();
    </script>
  </body>

</html>
