<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Official testimonial submission page for Govind Abra Enterprise."
    />
    <title>Testimonial | Govind</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- AOS -->
    <link
      href="https://unpkg.com/aos@2.3.1/dist/aos.css"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
      body {
        font-family: 'Inter', sans-serif;
        background:
          radial-gradient(circle at top left, #e3f2f2, #c1dcdc)
          fixed;
        overflow-x: hidden;
      }

      .shadow-glow {
        box-shadow: 0 20px 45px rgba(40, 94, 94, 0.25);
      }
    </style>
  </head>

  <body class="flex items-center justify-center min-h-screen px-4 py-8">
    <main
      class="relative w-full max-w-5xl mx-auto flex flex-col md:flex-row rounded-3xl overflow-hidden shadow-glow bg-white/85 backdrop-blur"
      data-aos="fade-up"
      data-aos-duration="1000"
      data-aos-easing="ease-out-cubic"
    >
      <!-- Left: Greeting & highlight -->
      <aside
        class="relative hidden md:flex md:w-2/5 justify-center items-center text-white p-10 bg-gradient-to-br from-[#C1DCDC] to-[#9ECACA]"
        data-aos="fade-right"
        data-aos-delay="200"
      >
        <div class="absolute inset-0 opacity-40">
          <div
            class="absolute -top-10 -right-16 w-64 h-64 bg-white/30 rounded-full blur-3xl"
          ></div>
          <div
            class="absolute bottom-0 left-0 w-80 h-80 bg-white/20 rounded-full blur-3xl"
          ></div>
        </div>
        <div class="relative z-10 space-y-4">
          <p class="text-xs font-semibold tracking-[0.2em] uppercase text-[#285E5E]">
            Govind Abra Enterprise
          </p>
          <h2 class="text-3xl font-bold mb-1 drop-shadow-lg text-[#285E5E]">
            Hello, {{ $user->name }}!
          </h2>
          <p class="text-sm text-[#285E5E]/90 leading-relaxed">
            Thank you for joining our program. Your testimonial helps future participants
            understand the value provided by Govind Abra Enterprise.
          </p>

          <div class="mt-4 inline-flex items-center gap-3 rounded-2xl bg-white/80 px-4 py-3 text-xs text-[#285E5E] shadow">
            <div class="h-8 w-8 rounded-full overflow-hidden grid place-items-center
            bg-[#C1DCDC] text-[#1E4B4B] font-semibold">

                @if ($user->img)
                    <img
                        src="{{ asset('storage/users/' . $user->img) }}"
                        alt="Profile photo"
                        class="h-full w-full object-cover"
                    >
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif

            </div>
            <div class="text-left leading-tight">
              <div class="font-semibold text-[13px]">{{ $user->name }}</div>
              @if(!empty($user->email))
                <div class="text-[11px] text-[#285E5E]/80">{{ $user->email }}</div>
              @endif
            </div>
          </div>
        </div>
      </aside>

      <!-- Right: Form -->
      <section
        class="flex-1 p-8 md:p-10 lg:p-12 flex flex-col justify-center items-start text-gray-700"
        data-aos="fade-left"
        data-aos-delay="250"
      >
        {{-- Flash success --}}
        @if(session('success'))
          <div
            class="w-full mb-4 rounded-xl border border-emerald-200 bg-emerald-50/90 px-4 py-3 text-[13px] text-emerald-800 flex items-start gap-3"
          >
            <div class="mt-0.5">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
            </div>
            <div>
              <div class="font-semibold text-[13px]">Thank you!</div>
              <div class="text-[12px] leading-snug">
                {{ session('success') }}
              </div>
            </div>
          </div>
        @endif

        {{-- Error validation --}}
        @if ($errors->any())
          <div
            class="w-full mb-4 rounded-xl border border-red-200 bg-red-50/95 px-4 py-3 text-[13px] text-red-700"
          >
            <div class="font-semibold mb-1">Please check your input:</div>
            <ul class="list-disc ml-4 space-y-0.5 text-[12px]">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <h2 class="text-2xl md:text-3xl font-bold text-[#285E5E] mb-1">
          Testimonial Form
        </h2>
        <p class="text-sm mb-6 text-[#285E5E]/70">
          Share your experience after joining a program at Govind Abra Enterprise.
        </p>

        <form
          action="{{ route('submit-testimonial') }}"
          method="POST"
          enctype="multipart/form-data"
          class="w-full space-y-7"
        >
          @csrf

          <!-- Input fields -->
          <div class="grid grid-cols-1 gap-5">
            {{-- Occupation --}}
            <div class="space-y-1.5" data-aos="fade-up" data-aos-delay="350">
              <label for="occupation" class="text-xs font-semibold text-[#285E5E]">
                Your Occupation / Current Role <span class="text-red-500">*</span>
              </label>
              <input
                id="occupation"
                type="text"
                name="occupation"
                value="{{ old('occupation') }}"
                placeholder="Example: HR Manager, IT Staff, Student, Trainer"
                required
                class="w-full pl-3.5 pr-3.5 py-2.5 rounded-xl border border-[#C1DCDC]
                       focus:ring-2 focus:ring-[#285E5E] focus:border-[#285E5E]
                       bg-white/90 text-[13px] text-[#285E5E]
                       placeholder:text-gray-400 transition-all duration-300"
              />
            </div>

            {{-- Testimonial text --}}
            <div class="space-y-1.5" data-aos="fade-up" data-aos-delay="420">
              <label for="text" class="text-xs font-semibold text-[#285E5E]">
                Your Testimonial <span class="text-red-500">*</span>
              </label>
              <p class="text-[11px] text-[#285E5E]/70 mb-1">
                Write a short review (for example: materials, instructors, benefits, or overall learning experience).
              </p>
              <textarea
                id="text"
                name="text"
                rows="5"
                placeholder="Example: The Govind training program really helped me understand the international certification materials in a structured and practical way..."
                required
                class="w-full px-3.5 py-2.5 rounded-xl border border-[#C1DCDC]
                       focus:ring-2 focus:ring-[#285E5E] focus:border-[#285E5E]
                       bg-white/90 text-[13px] text-[#285E5E]
                       placeholder:text-gray-400 transition-all duration-300
                       resize-y min-h-[140px]"
              >{{ old('text') }}</textarea>
            </div>
          </div>

          {{-- Info --}}
          <div class="text-[11px] text-[#285E5E]/70 flex items-start gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 mt-[2px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m0 3.75h.008v.008H12zM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span>
              By submitting this testimonial, you agree that Govind may display it
              (along with your name and occupation) publicly as a reference for future participants.
            </span>
          </div>

          <!-- Buttons -->
          <div class="flex flex-col sm:flex-row gap-4 pt-2" data-aos="zoom-in" data-aos-delay="500">
            <a
              href="{{ route('home') }}#testimonial-section"
              class="w-full sm:w-auto px-4 py-3 rounded-xl font-semibold text-[#285E5E] border border-[#285E5E]/30 bg-white/90
                     hover:bg-[#E3F2F2] hover:border-[#285E5E] hover:text-[#1F3B3B]
                     transition-all duration-300 flex items-center justify-center gap-2 text-sm"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7" />
              </svg>
              <span>Back</span>
            </a>

            <button
              type="submit"
              class="w-full py-3 rounded-xl font-semibold text-white bg-gradient-to-r
                     from-[#285E5E] to-[#1F4A4A] hover:opacity-95 hover:shadow-lg
                     transition-all duration-300 transform hover:scale-[1.02] text-sm"
            >
              Submit Testimonial
            </button>
          </div>
        </form>

      </section>
    </main>

    <script>
      AOS.init();
    </script>
  </body>
</html>
