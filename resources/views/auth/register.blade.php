<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Halaman pendaftaran akun platform bimbingan skripsi GueBimbingin"
    />
    <title>Daftar | Govind</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
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
        <!-- Left: Background Wave -->
        <aside
        class="relative hidden md:flex md:w-1/2 justify-center items-center text-white p-10 bg-gradient-to-br from-[#C1DCDC] to-[#9ECACA]"
        data-aos="fade-right"
        data-aos-delay="300"
        >
        <div class="absolute inset-0 opacity-40">
            <div
            class="absolute -top-10 -right-16 w-64 h-64 bg-white/30 rounded-full blur-3xl"
            ></div>
            <div
            class="absolute bottom-0 left-0 w-80 h-80 bg-white/20 rounded-full blur-3xl"
            ></div>
        </div>
        <div class="relative z-10 text-center px-6">
            <h2 class="text-4xl font-bold mb-3 drop-shadow-lg text-[#285E5E]">
            Hello Govind Member!
            </h2>
        </div>
        </aside>

        <!-- Right: Form -->
        <section
        class="flex-1 p-10 md:p-14 flex flex-col justify-center items-start text-gray-700"
        data-aos="fade-left"
        data-aos-delay="200"
        >
        <h2 class="text-3xl font-bold text-[#285E5E] mb-2">
            Govind
        </h2>
        <p class="text-sm mb-8 text-[#285E5E]/70">
            Create a new Govind account
        </p>

        <form
            action="{{ route('register') }}"
            method="POST"
            enctype="multipart/form-data"
            class="w-full space-y-4"
        >
            @csrf
            @if ($errors->any())
                <div class="text-red-500 text-sm mb-1 italic">
                    @foreach($errors->all() as $key => $error)
                    @php
                        $isLast = !isset($errors->all()[$key + 1]);
                    @endphp
                    @if($isLast)
                        {{ $error }} 
                    @else
                        {{ $error }} <br>
                    @endif
                    @endforeach
                </div>
            @endif

            <!-- GRID 3 LEFT & 3 RIGHT -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- LEFT COLUMN -->
            <div class="space-y-5">
                <!-- Name -->
                <div class="relative" data-aos="fade-left" data-aos-delay="400">
                <input
                    id="name"
                    type="text"
                    name="name"
                    placeholder="Full Name"
                    required
                    value="{{ old('name') }}"
                    class="w-full pl-4 pr-4 py-2 rounded-xl border border-[#C1DCDC]
                    @error('name') border-red-500 @enderror
                    focus:ring-2 focus:ring-[#285E5E] bg-white/80 transition-all
                    duration-300 placeholder:text-gray-400"
                />
                </div>

                <!-- Email -->
                <div class="relative" data-aos="fade-left" data-aos-delay="450">
                <input
                    id="email"
                    type="email"
                    name="email"
                    placeholder="Email Address"
                    required
                    value="{{ old(key: 'email') }}"
                    class="w-full pl-4 pr-4 py-2 rounded-xl border border-[#C1DCDC]
                    @error('email') border-red-500 @enderror
                    focus:ring-2 focus:ring-[#285E5E] bg-white/80 transition-all
                    duration-300 placeholder:text-gray-400"
                />
                </div>

                <!-- Phone -->
                <div class="relative" data-aos="fade-left" data-aos-delay="500">
                <input
                    id="phone"
                    type="text"
                    name="phone"
                    placeholder="Phone Number"
                    required
                    value="{{ old(key: 'phone') }}"
                    class="w-full pl-4 pr-4 py-2 rounded-xl border border-[#C1DCDC]
                    @error('phone') border-red-500 @enderror
                    focus:ring-2 focus:ring-[#285E5E] bg-white/80 transition-all
                    duration-300 placeholder:text-gray-400"
                />
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="space-y-5">
                <!-- Address -->
                <div class="relative" data-aos="fade-left" data-aos-delay="600">
                <input
                    id="address"
                    type="text"
                    name="address"
                    placeholder="Full Address"
                    required
                    value="{{ old('address') }}"
                    class="w-full pl-4 pr-4 py-2 rounded-xl border border-[#C1DCDC]
                    @error('address') border-red-500 @enderror
                    focus:ring-2 focus:ring-[#285E5E] bg-white/80 transition-all
                    duration-300 placeholder:text-gray-400"
                />
                </div>

                <!-- Password -->
                <div class="relative" data-aos="fade-left" data-aos-delay="650">
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                    class="w-full pl-4 pr-4 py-2 rounded-xl border border-[#C1DCDC]
                    @error('password') border-red-500 @enderror
                    focus:ring-2 focus:ring-[#285E5E] bg-white/80 transition-all
                    duration-300 placeholder:text-gray-400"
                />
                </div>

                <!-- Confirm Password -->
                <div class="relative" data-aos="fade-left" data-aos-delay="700">
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    required
                    class="w-full pl-4 pr-4 py-2 rounded-xl border border-[#C1DCDC]
                    @error('password_confirmation') border-red-500 @enderror
                    @error('password') border-red-500 @enderror
                    focus:ring-2 focus:ring-[#285E5E] bg-white/80 transition-all
                    duration-300 placeholder:text-gray-400"
                />
                </div>
            </div>
            </div>

            <!-- PROFILE PHOTO — FULL WIDTH ROW -->
            <div class="space-y-2" data-aos="fade-up" data-aos-delay="750">
            <div
                class="flex items-center gap-3 px-4 py-3 rounded-xl border border-dashed border-[#C1DCDC]
                @error('img') border-red-500 @enderror
                bg-white/70 hover:bg-white/90 cursor-pointer transition-all duration-300"
                onclick="document.getElementById('img').click()"
            >
                <div
                class="flex h-10 w-10 items-center justify-center rounded-full bg-[#285E5E]/10
                    text-[#285E5E] text-xs font-semibold"
                >
                JPG
                </div>

                <div class="flex-1">
                <p class="text-sm text-[#285E5E]">Upload your profile photo (Optional)</p>
                <p class="text-xs text-gray-500">Format: JPG, PNG, max 2MB</p>
                </div>
            </div>

            <input
                id="img"
                type="file"
                name="img"
                accept="image/*"
                class="hidden"
            />

            <!-- IMAGE PREVIEW -->
            <div id="img-preview-container" class="mt-3 hidden">
                <p class="text-xs text-[#285E5E]/80 mb-1">Profile photo preview:</p>
                <div class="flex items-center gap-3">
                <img
                    id="img-preview"
                    src=""
                    alt="Profile photo preview"
                    class="h-16 w-16 rounded-full object-cover border border-[#C1DCDC] bg-gray-100"
                />
                </div>
            </div>
            </div>

            <!-- Submit Button -->
            <button
            type="submit"
            class="w-full py-3 mt-2 rounded-xl font-semibold text-white bg-gradient-to-r
                from-[#285E5E] to-[#1F4A4A] hover:opacity-95 hover:shadow-lg transition-all
                duration-300 transform hover:scale-[1.02]"
            data-aos="zoom-in"
            data-aos-delay="900"
            >
            Register
            </button>

            <!-- Login Link -->
            <p
            class="mt-4 text-sm text-[#285E5E]/80 text-center"
            data-aos="fade-up"
            data-aos-delay="1000"
            >
            Already have an account?
            <a href="{{ url('/login') }}" class="font-semibold text-[#285E5E] hover:underline">
                Sign in now
            </a>
            </p>
        </form>

        </section>
    </main>

    <script>
        AOS.init();

        // Image preview logic
        const imgInput = document.getElementById('img');
        const previewContainer = document.getElementById('img-preview-container');
        const previewImg = document.getElementById('img-preview');

        if (imgInput) {
        imgInput.addEventListener('change', function (e) {
            const file = e.target.files && e.target.files[0];

            if (!file) {
            previewContainer.classList.add('hidden');
            previewImg.src = '';
            return;
            }

            // Optional: validasi hanya file image
            if (!file.type.startsWith('image/')) {
            previewContainer.classList.add('hidden');
            previewImg.src = '';
            return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
            previewImg.src = event.target.result;
            previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });
        }
    </script>
  </body>

</html>
