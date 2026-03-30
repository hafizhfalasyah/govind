<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>International Certification & Professional Training Institution in Indonesia | Govind Abra Enterprise</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        {{-- PRIMARY SEO (EN + ID) --}}
        <meta name="description"
            content="Govind Abra Enterprise adalah lembaga pendidikan dan pelatihan profesional di Indonesia yang berfokus pada program sertifikasi internasional untuk individu, profesional, dan organisasi, selaras dengan standar global dan regulasi pemerintah ASN. Govind Abra Enterprise is a professional education and training institution dedicated to developing world-class human resources through globally recognized International Certification Programs.">
        <meta name="keywords"
            content="Govind Abra Enterprise, lembaga pelatihan profesional, sertifikasi internasional Indonesia, international certification Indonesia, pelatihan ASN, ASN-aligned development, professional training, competency-based certification, communication certification, business certification, HR certification, technology certification, health and safety certification">
        <meta name="author" content="Govind Abra Enterprise">
        <meta name="robots" content="index, follow">
        <meta name="language" content="id,en">
        <meta name="geo.region" content="ID-JI">
        <meta name="geo.placename" content="Malang, Indonesia">
        <meta name="theme-color" content="#C1DCDC">

        {{-- CANONICAL & HREFLANG --}}
        <link rel="canonical" href="{{ url('/') }}">
        <link rel="alternate" href="{{ url('/') }}" hreflang="x-default">
        <link rel="alternate" href="{{ url('/') }}" hreflang="en">
        <link rel="alternate" href="{{ url('/') }}" hreflang="id">

        {{-- OPEN GRAPH (FB, LINKEDIN, WHATSAPP) --}}
        <meta property="og:type" content="website">
        <meta property="og:title"
            content="International Certification & Professional Training Institution in Indonesia | Govind Abra Enterprise">
        <meta property="og:description"
            content="Govind Abra Enterprise membantu individu, profesional, dan organisasi di Indonesia meningkatkan kompetensi melalui program sertifikasi internasional, pelatihan berbasis teknologi, dan consulting terpadu yang selaras dengan standar global dan regulasi pemerintah.">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:site_name" content="Govind Abra Enterprise">
        <meta property="og:image" content="{{ asset('img/og-govind.jpg') }}">
        <meta property="og:locale" content="en_US">
        <meta property="og:locale:alternate" content="id_ID">

        {{-- TWITTER CARD --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title"
            content="Govind Abra Enterprise – International Certification & Professional Training Institution in Indonesia">
        <meta name="twitter:description"
            content="International certification programs, ASN-aligned development, competency-based training, and integrated consulting solutions from Indonesia to the world.">
        <meta name="twitter:image" content="{{ asset('img/og-govind.jpg') }}">

        {{-- STRUCTURED DATA (SCHEMA.ORG JSON-LD) --}}
        @verbatim
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "name": "Govind Abra Enterprise",
                "url": "{{ url('/') }}",
                "logo": "{{ asset('img/Logo.png') }}",
                "description": "Govind Abra Enterprise is a professional education and training institution dedicated to developing world-class human resources through globally recognized International Certification Programs.",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "Perum Bumi Rajasa A3, Bumiayu, Kedungkandang",
                    "addressLocality": "Malang",
                    "addressRegion": "Jawa Timur",
                    "postalCode": "65135",
                    "addressCountry": "ID"
                },
                "contactPoint": [{
                    "@type": "ContactPoint",
                    "telephone": "+62-822-4597-5553",
                    "contactType": "customer service",
                    "areaServed": "ID",
                    "availableLanguage": ["id", "en"]
                }],
                "sameAs": [
                    "https://www.instagram.com/govindabra"
                ]
            }
            </script>
        @endverbatim

        @verbatim
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "WebSite",
                "name": "Govind Abra Enterprise",
                "url": "{{ url('/') }}",
                "potentialAction": {
                    "@type": "SearchAction",
                    "target": "{{ url('/') }}?q={search_term_string}",
                    "query-input": "required name=search_term_string"
                }
            }
            </script>
        @endverbatim

        <!-- Tailwind CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Aboreto&display=swap" rel="stylesheet">

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

        <!-- AOS CSS -->
        <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

        <style>
            body { font-family: 'Poppins', sans-serif; }
        </style>
    </head>

    <body class="bg-[#FFFFFF] text-slate-800 overflow-x-hidden">

        <!-- NAVBAR -->
        <header class="fixed top-0 inset-x-0 bg-white/80 backdrop-blur border-b border-slate-200 z-40" data-aos="fade-down">
            <div class="max-w-6xl mx-auto px-4 lg:px-0">
                <div class="flex items-center justify-between py-3">

                    <!-- LEFT: Logo + Brand -->
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <img src="{{ asset('img/Logo.png') }}" alt="Govind Logo" class="h-10 w-auto object-contain"/>
                        <span class="text-base font-semibold text-[#8B5A2B]">
                            Govind
                        </span>
                    </div>

                    <!-- CENTER NAV -->
                    <nav class="hidden lg:flex items-center justify-center flex-grow gap-10 text-[14px] text-slate-800">
                        <a href="#hero-section" class="hover:text-[#6AAEAD] transition">Home</a>
                        <a href="#about-section" class="hover:text-[#6AAEAD] transition">About</a>
                        <a href="#program-section" class="hover:text-[#6AAEAD] transition">Certifications</a>
                        <a href="#benefit-section" class="hover:text-[#6AAEAD] transition">Benefits</a>
                        <a href="#service-section" class="hover:text-[#6AAEAD] transition">Services</a>
                        <a href="#contact-section" class="hover:text-[#6AAEAD] transition">Contact</a>
                    </nav>

                    <!-- RIGHT AUTH -->
                    <div class="hidden lg:flex items-center gap-3 text-[13px] ml-6 flex-shrink-0">
                        {{-- Guest: Sign In + Sign Up --}}
                        @guest
                            <a href="{{ route('login') }}" class="px-4 py-1.5 border border-slate-300 rounded-md hover:bg-slate-50 transition">
                                Sign In
                            </a>
                            <a href="{{ route('register') }}" class="px-4 py-1.5 rounded-md bg-slate-900 text-white hover:bg-black transition">
                                Sign Up
                            </a>
                        @endguest

                        {{-- Authenticated: dropdown avatar for role=user --}}
                        @auth
                            @php
                                $u = auth()->user();
                                $avatar = $u->img
                                    ? asset('storage/users/' . $u->img)
                                    : null;
                                $initial = \Illuminate\Support\Str::upper(substr($u->name, 0, 1));
                            @endphp

                            @if($u->role === 'user')
                            <details id="desktopProfile" class="relative">
                                <summary
                                    class="flex items-center gap-2 cursor-pointer select-none list-none rounded-md px-2 py-1.5 hover:bg-slate-100 focus:outline-none"
                                >
                                    {{-- PROFILE PHOTO --}}
                                    @if($avatar)
                                        <img src="{{ $avatar }}"
                                            class="h-9 w-9 rounded-full object-cover border border-slate-300 shadow-sm"
                                            alt="Avatar">
                                    @else
                                        {{-- INITIALS FALLBACK --}}
                                        <div class="h-9 w-9 rounded-full bg-[#C1DCDC] text-slate-900 grid place-items-center font-semibold shadow">
                                            {{ $initial }}
                                        </div>
                                    @endif

                                    <span class="text-sm font-medium text-slate-700 max-w-[12rem] truncate">
                                        {{ $u->name }}
                                    </span>

                                    <svg class="h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                            clip-rule="evenodd"/>
                                    </svg>
                                </summary>

                                <!-- DROPDOWN -->
                                <ul class="absolute right-0 mt-2 w-64 rounded-xl border border-slate-200 bg-white shadow-lg z-50 overflow-hidden">
                                    <li class="px-4 py-3">
                                        <div class="text-sm font-semibold text-slate-800 truncate">{{ $u->name }}</div>
                                        <div class="text-xs text-slate-500 truncate">{{ $u->email }}</div>
                                    </li>
                                    <li><hr class="border-slate-200"></li>

                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                    class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </details>
                            @else
                                <a href="{{ route('admin.home') }}" class="px-4 py-1.5 rounded-md bg-slate-900 text-white hover:bg-black transition">
                                    Admin Panel
                                </a>
                            @endif
                        @endauth
                    </div>

                    <!-- HAMBURGER MOBILE -->
                    <button id="navbarToggle" class="lg:hidden inline-flex items-center justify-center p-2 rounded-md border border-slate-300 text-slate-700 ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"/>
                        </svg>
                    </button>

                </div>

                <!-- MOBILE MENU -->
                <div id="mobileMenu" class="lg:hidden hidden pb-4">
                    <nav class="flex flex-col gap-3 pt-3 text-[14px] text-slate-800">
                        <a href="#hero-section" class="hover:text-[#6AAEAD] transition">Home</a>
                        <a href="#about-section" class="hover:text-[#6AAEAD] transition">About</a>
                        <a href="#program-section" class="hover:text-[#6AAEAD] transition">Certifications</a>
                        <a href="#benefit-section" class="hover:text-[#6AAEAD] transition">Benefits</a>
                        <a href="#service-section" class="hover:text-[#6AAEAD] transition">Services</a>
                        <a href="#contact-section" class="hover:text-[#6AAEAD] transition">Contact</a>
                    </nav>

                    <div class="flex items-center gap-3 mt-4 text-[13px]">
                        {{-- GUEST: Sign In + Sign Up --}}
                        @guest
                            <a href="{{ route('login') }}"
                            class="flex-1 px-4 py-1.5 border border-slate-300 rounded-md hover:bg-slate-50 transition">
                                Sign In
                            </a>
                            <a href="{{ route('register') }}"
                            class="flex-1 px-4 py-1.5 rounded-md bg-slate-900 text-white hover:bg-black transition">
                                Sign Up
                            </a>
                        @endguest

                        {{-- AUTH: inline profile dropdown for user --}}
                        @auth
                            @if(auth()->user()->role === 'user')
                                @php
                                    $u = auth()->user();
                                    $avatar = $u->img
                                        ? asset('storage/users/' . $u->img)
                                        : null;
                                    $initial = \Illuminate\Support\Str::upper(substr($u->name, 0, 1));
                                @endphp

                                <details id="mobileInlineProfile" class="w-full relative">
                                    <summary
                                        class="flex items-center gap-3 cursor-pointer select-none rounded-md px-3 py-2.5 border border-slate-300 hover:bg-slate-50"
                                    >

                                        {{-- PROFILE PHOTO --}}
                                        @if($avatar)
                                            <img src="{{ $avatar }}"
                                                class="h-9 w-9 rounded-full object-cover border border-slate-300 shadow-sm"
                                                alt="Avatar">
                                        @else
                                            {{-- INITIALS FALLBACK --}}
                                            <div class="h-9 w-9 rounded-full bg-[#C1DCDC] text-slate-900 grid place-items-center font-semibold shadow">
                                                {{ $initial }}
                                            </div>
                                        @endif

                                        <div class="flex-1 min-w-0 text-left">
                                            <div class="text-sm font-semibold text-slate-800 truncate">
                                                {{ $u->name }}
                                            </div>
                                            <div class="text-xs text-slate-500 truncate">
                                                {{ $u->email }}
                                            </div>
                                        </div>

                                        <svg class="h-4 w-4 text-slate-500 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                                clip-rule="evenodd"/>
                                        </svg>
                                    </summary>

                                    <div class="mt-2 w-full rounded-md border border-slate-200 bg-white shadow-lg overflow-hidden">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                    class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </details>
                            @endif
                        @endauth
                    </div>
                </div>

            </div>
            @if(session('success'))
            <div
                id="success-alert"
                class="fixed top-4 left-1/2 transform -translate-x-1/2
                    bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg
                    opacity-100 transition-all duration-700 z-50"
            >
                {{ session('success') }}
            </div>
            <div class="hidden opacity-0 translate-y-5"></div>
            @endif
        </header>

        <!-- HERO -->
        <section id="hero-section" class="mt-28 relative z-0 scroll-mt-36">
            <div class="max-w-6xl mx-auto px-4 lg:px-0">

                <div class="bg-[#C1DCDC] rounded-[20px] flex flex-col lg:flex-row items-stretch shadow-[0_18px_40px_rgba(0,0,0,0.12)] pb-[40px]" data-aos="fade-up">

                    <!-- LEFT CONTENT -->
                    <div class="w-full lg:w-1/2 px-8 lg:px-10 py-10" data-aos="fade-up">
                        <h1 class="text-[40px] sm:text-[56px] lg:text-[65px] leading-snug font-normal font-[Aboreto]">
                            GOVIND ABRA<br>ENTERPRISE
                        </h1>

                        <!-- STATS -->
                        <div class="flex items-center space-x-10 mt-8 text-[13px]" data-aos="fade-up" data-aos-delay="150">
                            <div>
                                <p class="text-2xl font-semibold leading-tight">10+</p>
                                <p class="mt-1 text-[11px] text-slate-900">Certifications</p>
                            </div>

                            <div class="h-12 w-px bg-slate-900/40"></div>

                            <div>
                                <p class="text-2xl font-semibold leading-tight">100+</p>
                                <p class="mt-1 text-[11px] text-slate-900">Clients</p>
                            </div>
                        </div>

                        <!-- SEARCH BAR -->
                        <div class="mt-8" data-aos="fade-up" data-aos-delay="250">
                            <div class="max-w-md bg-white rounded-[12px] flex items-center overflow-hidden shadow-sm">
                                <input type="text" placeholder="What are you looking for?" class="flex-1 px-4 py-3 text-[13px] outline-none placeholder:text-slate-400"/>
                                <button class="h-12 w-12 flex items-center justify-center rounded-[12px] rounded-l-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 5a6 6 0 100 12 6 6 0 000-12z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT ILLUSTRATION -->
                    <div class="relative w-full lg:w-1/2 h-full pr-14 py-6 flex justify-end" data-aos="fade-up">
                        <!-- LOGO HERO → visible from lg (>=1024px) -->
                        <img src="{{ asset('img/hero1.png') }}" alt="Govind Abra Logo" class="hidden lg:block absolute bottom-6 right-10 w-[330px] lg:w-[360px] drop-shadow-[0_30px_70px_rgba(0,0,0,0.45)] translate-y-[483px] mr-5"/>

                        <!-- HERO 2 -->
                        <img src="{{ asset('img/hero2.png') }}" alt="" class="hidden lg:block absolute top-[20px] right-[20px] w-[80px]"/>

                        <!-- HERO 3 -->
                        <img src="{{ asset('img/hero3.png') }}" alt="" class="hidden lg:block absolute top-[300px] right-[450px] w-[170px]"/>
                    </div>

                </div>
            </div>
        </section>

        <!-- ABOUT -->
        <section id="about-section" class="mt-40 scroll-mt-36">
            <!-- Heading -->
            <div class="max-w-6xl mx-auto text-center px-4 lg:px-0" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">
                    About<span class="text-[#6AAEAD]"> Us</span>
                </h2>
                <p class="mt-3 text-sm md:text-base text-slate-500 max-w-2xl mx-auto">
                    We are a platform that provides curated certification programs to support your professional development.
                </p>
            </div>

            <!-- Content -->
            <div class="max-w-6xl mx-auto mt-12 px-4 lg:px-0">
                <div class="flex flex-col md:flex-row items-center md:items-center gap-12">

                    <!-- LEFT VIDEO -->
                    <div class="relative group w-full md:w-1/2" data-aos="zoom-in">

                        <!-- VIDEO -->
                        <div class="rounded-[20px] overflow-hidden">
                            <video id="aboutVideo"
                                class="w-full h-[260px] md:h-[300px] object-cover"
                                autoplay
                                loop
                                muted
                                playsinline>
                                <source src="https://www.pexels.com/download/video/34804472/" type="video/mp4">
                            </video>
                        </div>

                        <!-- PLAY / PAUSE BUTTON -->
                        <button id="videoToggle"
                            class="absolute inset-0 m-auto flex items-center justify-center
                                w-14 h-14 rounded-full bg-white/70 backdrop-blur-md text-slate-900 text-2xl font-bold
                                opacity-0 group-hover:opacity-100 transition duration-300 shadow-lg">
                            ❚❚
                        </button>

                    </div>

                    <!-- RIGHT TEXT -->
                    <div class="w-full md:w-1/2" data-aos="fade-left">
                        <h3 class="text-2xl md:text-3xl font-semibold text-slate-800 mb-5 leading-snug">
                            Govind Abra Enterprise
                        </h3>

                        <p class="text-[14px] md:text-[15px] text-slate-600 leading-relaxed mb-4">
                            Govind Abra Enterprise is a professional training and certification institution
                            committed to developing globally competitive human resources.
                        </p>

                        <p class="text-[14px] md:text-[15px] text-slate-600 leading-relaxed">
                            We provide technology-based education, international certifications,
                            and strategic consulting services aligned with government standards —
                            helping professionals stand out in the digital era.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- PROGRAMS -->
        <section id="program-section" class="mt-40 scroll-mt-44">
            <!-- Heading -->
            <div class="max-w-6xl mx-auto text-center px-4 lg:px-0" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">
                    Certification <span class="text-[#6AAEAD]">Programs</span>
                </h2>
                <p class="mt-3 text-sm md:text-base text-slate-500 max-w-2xl mx-auto">
                    Enhance your skills through curated certification tracks designed for various professional focuses.
                </p>
            </div>

            <!-- Carousel Wrapper -->
            <div class="max-w-5xl mx-auto mt-10 px-4 lg:px-0">
                <div class="relative">

                    <!-- Slides -->
                    <div class="overflow-hidden rounded-3xl bg-white/95 shadow-[0_24px_80px_rgba(15,23,42,0.16)] ring-1 ring-slate-100">
                        @forelse($programs as $index => $program)
                            @php
                                $programNo   = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                                $badgeLabel  = $program->category->name ?? 'Program';
                                $imageUrl    = $program->image_url
                                    ?? ($program->img
                                        ? asset('storage/programs/' . $program->img)
                                        : 'https://images.pexels.com/photos/1181649/pexels-photo-1181649.jpeg?auto=compress&cs=tinysrgb&w=800');
                                $shortDesc   = $program->short_desc ?: 'No short description available yet.';
                                $longDesc    = $program->long_desc ?: 'No detailed description available yet.';
                                $duration    = $program->duration ?: '-';
                                $priceLabel  = 'Rp ' . number_format($program->price, 0, ',', '.');
                                $registerUrl = route('register-program', $program->slug ?? $program->name);
                            @endphp

                            <article
                                class="{{ $index === 0 ? '' : 'hidden' }} flex flex-col md:flex-row gap-0 md:gap-6 items-stretch min-h-[260px]"
                                data-program-slide
                            >
                                <!-- Image -->
                                <div class="md:w-1/2 relative h-52 md:h-auto overflow-hidden">
                                    <img
                                        src="{{ $imageUrl }}"
                                        alt="{{ $program->name }}"
                                        class="h-full w-full object-cover transition-transform duration-700"
                                        data-program-image
                                    />
                                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-tr from-slate-900/40 via-slate-900/0"></div>
                                    <span
                                        class="absolute bottom-4 left-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-[11px] font-medium text-slate-800 shadow-sm"
                                    >
                                        <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-[#6AAEAD]"></span>
                                        {{ $badgeLabel }}
                                    </span>
                                </div>

                                <!-- Content -->
                                <div class="md:w-1/2 p-6 md:p-7 flex flex-col justify-center">
                                    <p class="text-xs font-semibold uppercase tracking-[0.15em] text-[#6AAEAD] mb-1.5">
                                        Program {{ $programNo }}
                                    </p>

                                    <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                                        {{ $program->name }}
                                    </h3>

                                    <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                                        {{ $shortDesc }}
                                    </p>

                                    <ul class="mt-3 space-y-1.5 text-xs text-slate-500">
                                        <li>• Duration: {{ $duration }}</li>
                                        <li>• Price: {{ $priceLabel }}</li>
                                    </ul>

                                    <div class="mt-5 flex flex-wrap gap-3">
                                        {{-- View Details (POPUP TRIGGER) --}}
                                        <button
                                            type="button"
                                            class="inline-flex items-center justify-center rounded-xl border border-[#6AAEAD] px-4 py-2 text-xs font-medium text-[#6AAEAD] hover:bg-[#6AAEAD] hover:text-white transition-colors"
                                            data-program-detail-trigger
                                            data-program-no="{{ $programNo }}"
                                            data-program-name="{{ e($program->name) }}"
                                            data-program-category="{{ e($badgeLabel) }}"
                                            data-program-duration="{{ e($duration) }}"
                                            data-program-price="{{ e($priceLabel) }}"
                                            data-program-short="{{ e($shortDesc) }}"
                                            data-program-long="{{ e($longDesc) }}"
                                            data-program-image="{{ $imageUrl }}"
                                            data-program-register-url="{{ $registerUrl }}"
                                        >
                                            View Details
                                        </button>

                                        {{-- Register program --}}
                                        <a href="{{ $registerUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex items-center justify-center rounded-xl bg-[#6AAEAD] px-4 py-2 text-xs font-medium text-white hover:bg-[#5ba09f] transition-colors">
                                            Register
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="p-8 text-center text-sm text-slate-500">
                                No programs available at the moment.
                            </div>
                        @endforelse
                    </div>

                    <!-- Controls -->
                    <div class="mt-6 flex flex-col items-center justify-center gap-3">

                        <!-- Dots Centered -->
                        <div class="flex items-center justify-center gap-2" id="programDots">
                            <!-- Auto-generated dots via JS -->
                        </div>

                        <!-- Prev / Next Buttons Centered -->
                        <div class="flex items-center justify-center gap-4">
                            <button
                                type="button"
                                class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 shadow-sm"
                                id="programPrev"
                            >
                                ‹
                            </button>
                            <button
                                type="button"
                                class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 shadow-sm"
                                id="programNext"
                            >
                                ›
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ================= MODAL VIEW DETAILS ================= --}}
            <div
                id="programModal"
                class="fixed inset-0 z-50 hidden"
                aria-hidden="true"
            >
                <!-- Overlay -->
                <div
                    class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"
                    data-program-modal-overlay
                ></div>

                <!-- Modal Card -->
                <div class="relative min-h-full flex items-center justify-center px-4 py-8">
                    <div class="relative w-full max-w-xl bg-white rounded-3xl shadow-[0_24px_80px_rgba(15,23,42,0.24)] overflow-hidden">
                        <!-- Image -->
                        <div class="relative h-40 md:h-48 overflow-hidden">
                            <img
                                src=""
                                alt="Program preview"
                                class="h-full w-full object-cover"
                                data-program-modal-image
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-slate-900/10"></div>

                            <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between">
                                <span
                                    class="inline-flex items-center rounded-full bg-white/90 px-3 py-1 text-[11px] font-medium text-slate-800 shadow-sm"
                                    data-program-modal-category
                                >
                                    <!-- filled via JS -->
                                </span>
                                <span class="text-[11px] font-semibold text-white/90" data-program-modal-number>
                                    <!-- Program 01 -->
                                </span>
                            </div>

                            <!-- Close Button -->
                            <button
                                type="button"
                                class="absolute top-3 right-3 inline-flex h-8 w-8 items-center justify-center rounded-full bg-white/90 text-slate-700 hover:bg-white shadow-sm text-lg"
                                data-program-modal-close
                                aria-label="Close"
                            >
                                ×
                            </button>
                        </div>

                        <!-- Content -->
                        <div class="p-6 md:p-7">
                            <h3
                                class="text-lg md:text-xl font-semibold text-slate-900"
                                data-program-modal-title
                            ></h3>

                            <p
                                class="mt-2 text-sm text-slate-500 leading-relaxed"
                                data-program-modal-short
                            ></p>

                            <p
                                class="mt-3 text-sm text-slate-600 leading-relaxed"
                                data-program-modal-long
                            ></p>

                            <dl class="mt-4 grid grid-cols-2 gap-3 text-xs text-slate-600">
                                <div class="flex flex-col">
                                    <dt class="font-semibold text-slate-800 mb-0.5">Duration</dt>
                                    <dd data-program-modal-duration>-</dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="font-semibold text-slate-800 mb-0.5">Price</dt>
                                    <dd data-program-modal-price>-</dd>
                                </div>
                            </dl>

                            <div class="mt-6 flex items-center justify-end gap-3">
                                <button
                                    type="button"
                                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-4 py-2 text-xs font-medium text-slate-600 hover:bg-slate-50 transition-colors"
                                    data-program-modal-close
                                >
                                    Close
                                </button>

                                <a href="#"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    data-program-modal-register
                                    class="inline-flex items-center justify-center rounded-xl bg-[#6AAEAD] px-4 py-2 text-xs font-medium text-white hover:bg-[#5ba09f] transition-colors">
                                    Register for this Program
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- BENEFIT US -->
        <section id="benefit-section" class="mt-40 scroll-mt-28">
            <!-- Heading -->
            <div class="max-w-6xl mx-auto text-center px-4 lg:px-0" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">
                    Our <span class="text-[#6AAEAD]">Advantages</span>
                </h2>
                <p class="mt-3 text-sm md:text-base text-slate-500 max-w-2xl mx-auto">
                    We offer high-quality programs, experienced instructors, and trusted standards to support your professional growth.
                </p>
            </div>

            <!-- Cards -->
            <div class="max-w-6xl mx-auto mt-10 px-4 lg:px-0 grid gap-6 md:grid-cols-3">

                <div class="bg-gradient-to-br from-[#E8F4F3] via-[#D0E7E6] to-[#C4DEDD]
                    border border-[#A6DCD3]
                    rounded-[22px]
                    px-6 py-7
                    shadow-[0_22px_50px_rgba(148,104,31,0.10)]
                    transition-all duration-500 ease-out
                    hover:from-[#EAF7F6] hover:via-[#D5EBEA] hover:to-[#C1DCDC]
                    hover:border-[#D4A046]
                    hover:shadow-[0_30px_70px_rgba(148,104,31,0.18)]"
                    data-aos="fade-up" data-aos-delay="0"
                    style="transition: transform 0.3s ease;"
                    onmouseenter="this.style.transform='scale(1.05) translateY(-6px)';"
                    onmouseleave="this.style.transform='scale(1) translateY(0)';">

                    <div class="w-10 h-10 flex items-center justify-center mb-4">
                        <img src="{{ asset('img/choose1.png') }}"
                            class="w-8 h-8"
                            style="filter: brightness(0) saturate(100%)
                                    invert(44%) sepia(12%)
                                    saturate(1600%) hue-rotate(123deg)
                                    brightness(90%) contrast(90%);">
                    </div>

                    <p class="font-semibold text-slate-900 mb-3 leading-snug">
                        Internationally Certified Programs
                    </p>

                    <p class="text-[13px] text-slate-600 leading-relaxed">
                        Obtain globally recognized certifications that strengthen your professional profile
                        and open broader career opportunities across industries.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-gradient-to-br from-[#E8F4F3] via-[#D0E7E6] to-[#C4DEDD]
                    border border-[#A6DCD3]
                    rounded-[22px]
                    px-6 py-7
                    shadow-[0_22px_50px_rgba(148,104,31,0.10)]
                    transition-all duration-300
                    hover:from-[#EAF7F6] hover:via-[#D5EBEA] hover:to-[#C1DCDC]
                    hover:border-[#D4A046]
                    hover:shadow-[0_30px_70px_rgba(148,104,31,0.18)]"
                    data-aos="fade-up" data-aos-delay="100"
                    style="transition: transform 0.3s ease;"
                    onmouseenter="this.style.transform='scale(1.05) translateY(-6px)';"
                    onmouseleave="this.style.transform='scale(1) translateY(0)';">

                    <div class="w-10 h-10 flex items-center justify-center mb-4">
                        <img src="{{ asset('img/choose2.png') }}"
                            class="w-8 h-8"
                            style="
                                filter: brightness(0) saturate(100%)
                                        invert(44%) sepia(12%)
                                        saturate(1600%) hue-rotate(123deg)
                                        brightness(90%) contrast(90%);
                            ">
                    </div>

                    <p class="font-semibold text-slate-900 mb-3 leading-snug">
                        Expert Instructors &amp;<br>Industry Practitioners
                    </p>

                    <p class="text-[13px] text-slate-600 leading-relaxed">
                        Learn directly from seasoned professionals who combine academic excellence with real-world
                        expertise to deliver practical and impactful learning.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-gradient-to-br from-[#E8F4F3] via-[#D0E7E6] to-[#C4DEDD]
                    border border-[#A6DCD3]
                    rounded-[22px]
                    px-6 py-7
                    shadow-[0_22px_50px_rgba(148,104,31,0.10)]
                    transition-all duration-300
                    hover:from-[#EAF7F6] hover:via-[#D5EBEA] hover:to-[#C1DCDC]
                    hover:border-[#D4A046]
                    hover:shadow-[0_30px_70px_rgba(148,104,31,0.18)]"
                    data-aos="fade-up" data-aos-delay="200"
                    style="transition: transform 0.3s ease;"
                    onmouseenter="this.style.transform='scale(1.05) translateY(-6px)';"
                    onmouseleave="this.style.transform='scale(1) translateY(0)';">

                    <div class="w-10 h-10 flex items-center justify-center mb-4">
                        <img src="{{ asset('img/choose3.png') }}"
                            class="w-8 h-8"
                            style="
                                filter: brightness(0) saturate(100%)
                                        invert(44%) sepia(12%)
                                        saturate(1600%) hue-rotate(123deg)
                                        brightness(90%) contrast(90%);
                            ">
                    </div>

                    <p class="font-semibold text-slate-900 mb-3 leading-snug">
                        Standards Aligned<br>with Government Frameworks
                    </p>
                    <p class="text-[13px] text-slate-600 leading-relaxed">
                        All programs follow national and international competency frameworks to ensure credibility,
                        compliance, and relevance for civil servants and professionals.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="bg-gradient-to-br from-[#E8F4F3] via-[#D0E7E6] to-[#C4DEDD]
                    border border-[#A6DCD3]
                    rounded-[22px]
                    px-6 py-7
                    shadow-[0_22px_50px_rgba(148,104,31,0.10)]
                    transition-all duration-300
                    hover:from-[#EAF7F6] hover:via-[#D5EBEA] hover:to-[#C1DCDC]
                    hover:border-[#D4A046]
                    hover:shadow-[0_30px_70px_rgba(148,104,31,0.18)]"
                    data-aos="fade-up" data-aos-delay="300"
                    style="transition: transform 0.3s ease;"
                    onmouseenter="this.style.transform='scale(1.05) translateY(-6px)';"
                    onmouseleave="this.style.transform='scale(1) translateY(0)';">

                    <div class="w-10 h-10 flex items-center justify-center mb-4">
                        <img src="{{ asset('img/choose4.png') }}"
                            class="w-8 h-8"
                            style="
                                filter: brightness(0) saturate(100%)
                                        invert(44%) sepia(12%)
                                        saturate(1600%) hue-rotate(123deg)
                                        brightness(90%) contrast(90%);
                            ">
                    </div>

                    <p class="font-semibold text-slate-900 mb-3 leading-snug">
                        Technology-Driven<br>Learning Experience
                    </p>
                    <p class="text-[13px] text-slate-600 leading-relaxed">
                        Experience digitally integrated training methods designed to increase engagement,
                        accessibility, and adaptability in the era of Industry 4.0.
                    </p>
                </div>

                <!-- Card 5 -->
                <div class="bg-gradient-to-br from-[#E8F4F3] via-[#D0E7E6] to-[#C4DEDD]
                    border border-[#A6DCD3]
                    rounded-[22px]
                    px-6 py-7
                    shadow-[0_22px_50px_rgba(148,104,31,0.10)]
                    transition-all duration-300
                    hover:from-[#EAF7F6] hover:via-[#D5EBEA] hover:to-[#C1DCDC]
                    hover:border-[#D4A046]
                    hover:shadow-[0_30px_70px_rgba(148,104,31,0.18)]"
                    data-aos="fade-up" data-aos-delay="400"
                    style="transition: transform 0.3s ease;"
                    onmouseenter="this.style.transform='scale(1.05) translateY(-6px)';"
                    onmouseleave="this.style.transform='scale(1) translateY(0)';">

                    <div class="w-10 h-10 flex items-center justify-center mb-4">
                        <img src="{{ asset('img/choose3.png') }}"
                            class="w-8 h-8"
                            style="
                                filter: brightness(0) saturate(100%)
                                        invert(44%) sepia(12%)
                                        saturate(1600%) hue-rotate(123deg)
                                        brightness(90%) contrast(90%);
                            ">
                    </div>

                    <p class="font-semibold text-slate-900 mb-3 leading-snug">
                        Comprehensive<br>Consulting Services
                    </p>

                    <p class="text-[13px] text-slate-600 leading-relaxed">
                        Receive end-to-end support in data management using SQL,
                        Machine Learning, and Python over 4.5 months with experienced data practitioners.
                    </p>
                </div>

                <!-- Card 6 -->
                <div class="bg-gradient-to-br from-[#E8F4F3] via-[#D0E7E6] to-[#C4DEDD]
                    border border-[#A6DCD3]
                    rounded-[22px]
                    px-6 py-7
                    shadow-[0_22px_50px_rgba(148,104,31,0.10)]
                    transition-all duration-300
                    hover:from-[#EAF7F6] hover:via-[#D5EBEA] hover:to-[#C1DCDC]
                    hover:border-[#D4A046]
                    hover:shadow-[0_30px_70px_rgba(148,104,31,0.18)]"
                    data-aos="fade-up" data-aos-delay="500"
                    style="transition: transform 0.3s ease;"
                    onmouseenter="this.style.transform='scale(1.05) translateY(-6px)';"
                    onmouseleave="this.style.transform='scale(1) translateY(0)';">

                    <div class="w-10 h-10 flex items-center justify-center mb-4">
                        <img src="{{ asset('img/choose5.png') }}"
                            class="w-8 h-8"
                            style="
                                filter: brightness(0) saturate(100%)
                                        invert(44%) sepia(12%)
                                        saturate(1600%) hue-rotate(123deg)
                                        brightness(90%) contrast(90%);
                            ">
                    </div>

                    <p class="font-semibold text-slate-900 mb-3 leading-snug">
                        Commitment to<br>Excellence &amp; Integrity
                    </p>

                    <p class="text-[13px] text-slate-600 leading-relaxed">
                        We uphold professionalism, transparency, and innovation in every program
                        to build long-term trust and deliver measurable, high-quality results.
                    </p>
                </div>
            </div>
        </section>

        <!-- OUR SERVICES -->
        <section id="service-section" class="mt-40 scroll-mt-36">
            <!-- Heading -->
            <div class="max-w-6xl mx-auto text-center px-4 lg:px-0" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">
                    Our <span class="text-[#6AAEAD]">Services</span>
                </h2>
                <p class="mt-3 text-sm md:text-base text-slate-500 max-w-2xl mx-auto">
                    We provide a range of training, certification, and consulting services designed to support the growth of both individuals and organizations.
                </p>
            </div>

            <!-- Cards -->
            <div class="max-w-5xl mx-auto mt-14 px-4 lg:px-0 grid gap-8 md:grid-cols-2">

                <!-- Card 1 -->
                <div
                    class="bg-gradient-to-br from-[#E8F4F3] via-[#D0E7E6] to-[#C4DEDD]
                        rounded-[22px] px-8 py-7
                        shadow-[0_22px_50px_rgba(148,104,31,0.10)]
                        flex items-start gap-5"
                    data-aos="fade-right"
                    style="transition: transform 0.3s ease;"
                    onmouseenter="this.style.transform='scale(1.06)';"
                    onmouseleave="this.style.transform='scale(1)';">

                    <div class="w-12 h-12 rounded-2xl bg-[#6AAEAD] flex items-center justify-center shrink-0 mt-1">
                        <span class="text-white text-xl">🎓</span>
                    </div>

                    <div>
                        <p class="text-base md:text-lg font-semibold text-slate-900 leading-snug">
                            Training &amp;<br>Certification
                        </p>
                        <p class="mt-3 text-[13px] md:text-sm text-slate-600 leading-relaxed">
                            Elevate your competencies through technology-based training with official certifications recognized internationally.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-gradient-to-br from-[#E8F4F3] via-[#D0E7E6] to-[#C4DEDD]
                        rounded-[22px] px-8 py-7
                        shadow-[0_22px_50px_rgba(148,104,31,0.10)]
                        flex items-start gap-5"
                    data-aos="fade-left"
                    style="transition: transform 0.3s ease;"
                    onmouseenter="this.style.transform='scale(1.06)';"
                    onmouseleave="this.style.transform='scale(1)';">

                    <div class="w-12 h-12 rounded-2xl bg-[#6AAEAD] flex items-center justify-center shrink-0 mt-1">
                        <span class="text-white text-xl">🏢</span>
                    </div>

                    <div>
                        <p class="text-base md:text-lg font-semibold text-slate-900 leading-snug">
                            Organizational<br>Consulting
                        </p>
                        <p class="mt-3 text-[13px] md:text-sm text-slate-600 leading-relaxed">
                            Get strategic solutions to improve organizational performance and optimize human resource management.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- TESTIMONIALS -->
        <section id="testimonial-section" class="mt-40 relative overflow-hidden">
            <div class="max-w-6xl mx-auto px-4 lg:px-0">

                <div class="max-w-6xl mx-auto text-center px-4 lg:px-0" data-aos="fade-up">
                    <!-- Heading -->
                    <h2 class="text-2xl md:text-3xl font-semibold text-center text-slate-900" data-aos="fade-up">
                        Client <span class="text-[#6AAEAD]">Testimonials</span>
                    </h2>
                    <p class="mt-3 text-sm md:text-base text-slate-500 max-w-2xl mx-auto">
                        Opinions and experiences from participants who have experienced the benefits of our training and certification programs.
                    </p>
                </div>

                <div class="mt-12 flex flex-col lg:flex-row lg:items-center lg:gap-16">

                    <!-- LEFT SIDE TEXT -->
                    <div class="lg:w-5/12 mb-10 lg:mb-0" data-aos="fade-right">
                        <div class="text-5xl text-[#6AAEAD] leading-none mb-4">“</div>

                        <p class="text-2xl md:text-3xl font-semibold leading-snug text-slate-900">
                            What they say<br>
                            about Govind<br>
                            Abra Enterprise
                        </p>

                        <p class="mt-5 text-[13px] text-slate-500 max-w-xs">
                            More than 3,000 participants have trusted our programs to enhance their skills.
                        </p>
                    </div>

                    <!-- RIGHT SIDE CARD -->
                    <div class="lg:w-7/12 relative" data-aos="fade-left">
                        @php
                            $firstTestimonial = $testimonials->first();
                            $firstAvatarUrl = null;
                        @endphp

                        <div class="bg-gradient-to-br from-[#E8F4F3] via-[#D0E7E6] to-[#C4DEDD]
                                    border border-[#A6DCD3]
                                    rounded-[26px]
                                    shadow-[0_22px_60px_rgba(148,104,31,0.12)]
                                    px-8 py-8 md:px-10 md:py-9
                                    transition-all duration-500 ease-out
                                    hover:shadow-[0_32px_80px_rgba(148,104,31,0.18)]
                                    hover:-translate-y-1">

                            <!-- top row: label + dots -->
                            <div class="flex items-start justify-between mb-6">
                                <p class="text-[11px] font-semibold text-[#6AAEAD] uppercase tracking-[0.22em]">
                                    What they say
                                </p>

                                <div class="flex items-center space-x-1 text-slate-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                </div>
                            </div>

                            {{-- QUOTE TEXT (akan dioverwrite JS, tapi ada fallback kalau nggak ada data) --}}
                            <p id="testimonial-text"
                                class="text-sm md:text-[15px] text-slate-800 leading-relaxed
                                        min-h-[4.8em] line-clamp-3"
                                >
                                @if($firstTestimonial)
                                    “{{ $firstTestimonial->text }}”
                                @else
                                    “There are no testimonials yet. Be the first to share your experience with Govind Abra Enterprise.”
                                @endif
                            </p>

                            <!-- bottom row: user + arrows -->
                            <div class="mt-8 flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    {{-- WRAPPER FOTO / INITIAL (ISINYA AKAN DIGANTI JS) --}}
                                    <div id="testimonial-photo">
                                        @if($firstTestimonial && $firstAvatarUrl)
                                            <img src="{{ $firstAvatarUrl }}"
                                                class="h-9 w-9 rounded-full object-cover border border-slate-300 shadow-sm"
                                                alt="Avatar">
                                        @elseif($firstTestimonial)
                                            <div class="h-9 w-9 rounded-full bg-[#C1DCDC] text-slate-900 grid place-items-center font-semibold shadow">
                                                {{ \Illuminate\Support\Str::upper(substr($firstTestimonial->name, 0, 1)) }}
                                            </div>
                                        @else
                                            <div class="h-9 w-9 rounded-full bg-[#C1DCDC] text-slate-900 grid place-items-center font-semibold shadow">
                                                G
                                            </div>
                                        @endif
                                    </div>

                                    <div>
                                        <p id="testimonial-name" class="text-[13px] font-semibold text-slate-900">
                                            {{ $firstTestimonial->name ?? 'Govind Participant' }}
                                        </p>
                                        <div class="flex flex-row gap-2">
                                            <p id="testimonial-role" class="text-[11px] text-slate-500">
                                                {{ $firstTestimonial->occupation ?? 'Program Participant' }}
                                            </p>
                                            <p class="text-[11px] text-slate-500">|</p>
                                            <span id="testimonial-date" class="text-[11px] text-slate-500 inline">
                                                @if($firstTestimonial)
                                                    {{ $firstTestimonial->created_at->translatedFormat('d F Y') }}
                                                @else
                                                    {{ now()->translatedFormat('d F Y') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <button
                                        id="prev-testimonial-btn"
                                        class="w-9 h-9 rounded-full border border-[#A6DCD3] text-[#6AAEAD] flex items-center justify-center bg-white hover:scale-105 transition-all">
                                        ‹
                                    </button>
                                    <button
                                        id="next-testimonial-btn"
                                        class="w-9 h-9 rounded-full border border-[#A6DCD3] text-[#6AAEAD] flex items-center justify-center bg-white hover:scale-105 transition-all">
                                        ›
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="mt-5 lg:mt-8 flex flex-col justify-center items-center gap-2 lg:justify-between lg:flex-row">
                    <div class="flex flex-col text-center lg:flex-row lg:items-center lg:text-start lg:gap-5">
                        <div class="hidden lg:block" data-aos="fade-right">
                            <img src="{{ asset('img/pencil-simple-line.png') }}"
                                class="w-7 h-7"
                                style="
                                    filter: brightness(0) saturate(100%)
                                            invert(44%) sepia(12%)
                                            saturate(1600%) hue-rotate(123deg)
                                            brightness(90%) contrast(90%);
                                ">
                        </div>
                        <p class="text-xs lg:text-sm md:text-base text-slate-500 " data-aos="fade-right">
                            If you’d like to share your experience, tap the button to leave us a testimonial!
                        </p>
                    </div>
                    <a  href="{{ route('testimonial') }}"
                        data-aos="fade-left"
                        class="w-30 lg:w-50 rounded-[5px] border border-[#6AAEAD] px-2 py-1 lg:px-4 lg:py-2 text-xs lg:text-sm font-medium text-[#6AAEAD] hover:bg-[#6AAEAD] hover:text-white transition-colors">
                        Give Testimonial
                    </a>
                </div>
            </div>
        </section>

        <!-- DECORATION BETWEEN TESTIMONIAL & CONTACT (NO EXTRA HEIGHT) -->
        <div class="relative w-full h-0">
            <img src="{{ asset('img/Illustration.png') }}" alt="Decoration" class="hidden lg:block w-60 absolute right-0 -bottom-[300px] pointer-events-none select-none"/>
        </div>

        <!-- CONTACT -->
        <section id="contact-section" class="mt-40 relative overflow-hidden scroll-mt-36">
            <div class="max-w-6xl mx-auto px-4 lg:px-0">

                <div class="max-w-6xl mx-auto text-center px-4 lg:px-0" data-aos="fade-up">
                    <!-- Heading -->
                    <h2 class="text-2xl md:text-[26px] font-semibold text-center text-slate-900" data-aos="fade-up">
                        Contact <span class="text-[#6AAEAD]">Us</span>
                    </h2>
                    <p class="mt-3 text-sm md:text-base text-slate-500 max-w-2xl mx-auto">
                        We are ready to assist you. Please contact us for inquiries, collaborations, or further information about our services.
                    </p>
                </div>

                <!-- Form + Map -->
                <div class="mt-10 grid gap-10 lg:grid-cols-2 lg:items-center">

                    <!-- LEFT: FORM -->
                    <form class="space-y-5" data-aos="fade-right" method="get" action="{{ route('submit-contact') }}">

                        <!-- Name -->
                        <div>
                            <label class="block mb-1 text-[11px] text-slate-600">Name</label>
                            <input type="text" placeholder="Name" name="name"
                                class="w-full rounded-[10px] border border-[#A6DCD3]
                                        px-4 py-2.5 text-[13px] text-slate-900
                                        focus:outline-none focus:ring-2 focus:ring-[#7EC6C4]/60
                                        focus:border-[#6AAEAD] transition"/>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block mb-1 text-[11px] text-slate-600">Email*</label>
                            <input type="email" placeholder="Email" name="email"
                                class="w-full rounded-[10px] border border-[#A6DCD3]
                                        px-4 py-2.5 text-[13px] text-slate-900
                                        focus:outline-none focus:ring-2 focus:ring-[#7EC6C4]/60
                                        focus:border-[#6AAEAD] transition"/>
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block mb-1 text-[11px] text-slate-600">Message*</label>
                            <textarea rows="5" placeholder="Message" name="message"
                                    class="w-full rounded-[10px] border border-[#A6DCD3]
                                            px-4 py-2.5 text-[13px] text-slate-900 resize-none
                                            focus:outline-none focus:ring-2 focus:ring-[#7EC6C4]/60
                                            focus:border-[#6AAEAD] transition"></textarea>
                        </div>

                        <!-- Button -->
                        <button type="submit"
                                class="w-full rounded-[10px] bg-[#6AAEAD] py-3 text-[13px] font-semibold text-white
                                    shadow-[0_18px_40px_rgba(106,174,173,0.55)]
                                    hover:bg-[#5BA4A3] transition duration-300">

                            Send Message
                        </button>
                    </form>

                    <!-- RIGHT: MAP -->
                    <div class="w-full h-[320px] rounded-[16px] overflow-hidden border border-[#A6DCD3]
                                bg-gradient-to-br from-[#E8F4F3] via-[#D0E7E6] to-[#C4DEDD]
                                shadow-[0_22px_60px_rgba(148,104,31,0.10)]
                                lg:self-center p-[2px]"
                        data-aos="fade-left">

                        <div class="w-full h-full rounded-[14px] overflow-hidden" id="leafletMap"></div>
                    </div>

                </div>
            </div>
        </section>

        <!-- CTA BANNER -->
        <section class="mt-40">
            <div
                class="relative bg-gradient-to-br from-[#B8E4E1] via-[#A9DDDB] to-[#90CFCD]
                    py-32 overflow-hidden"
                data-aos="zoom-in">

                <!-- PATTERN / MASK -->
                <img src="{{ asset('img/Mask group.png') }}"
                    alt="Pattern"
                    class="pointer-events-none select-none absolute bottom-[-260px] left-1/2
                            -translate-x-1/2 w-[900px] sm:w-[1200px] md:w-[1600px]
                            max-w-none opacity-70" />

                <!-- CONTENT -->
                <div class="relative z-10 max-w-5xl mx-auto px-4 text-center flex flex-col items-center">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-white leading-snug">
                        Join 3000+ participants around the world<br />
                        and achieve your goals!
                    </h2>

                    <a href="#program-section"
                        class="mt-8 px-10 py-3 text-sm font-semibold rounded-md
                            bg-white text-[#4D9A99]
                            shadow-[0_18px_40px_rgba(100,160,160,0.50)]
                            hover:bg-[#F9FFFF] hover:text-[#3A8584]
                            transition duration-300">
                        Join Now!
                    </a>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-[#181818] text-slate-300 mt-0" data-aos="fade-up" data-aos-offset="50">
            <div class="max-w-7xl mx-auto px-6 py-14">

                <div class="flex flex-col md:flex-row justify-between gap-12 items-start">
                    <!-- LEFT: LOGO + BRAND + DESCRIPTION + SOCIALS -->
                    <div class="w-full md:w-[38%]">
                        <!-- LOGO + GOVIND -->
                        <div class="flex items-center gap-3 mb-5">
                            <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="w-[80px] h-auto object-contain" />
                            <div>
                                <p class="text-[18px] font-semibold text-[#8B5A2B] leading-tight">Govind</p>
                                <p class="tracking-[0.2em] text-[11px] text-white uppercase">
                                    ABRA ENTERPRISE
                                </p>
                            </div>
                        </div>

                        <!-- DESCRIPTION -->
                        <p class="text-[12px] text-slate-200 leading-relaxed mb-6">
                            Govind Abra Enterprise is a professional training and certification institution
                            committed to developing human resources that are globally competitive.
                        </p>

                        <!-- SOCIAL MEDIA -->
                        <div class="flex items-center space-x-4 text-white text-[18px]">
                            <!-- Instagram -->
                            <a href="https://www.instagram.com/govind.abra?igsh=eDhjbGJja2gya3pt"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="group transition"
                            >
                                <svg class="w-5 h-5 text-white group-hover:text-[#B48B2E] transition" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm10 2c1.654 0 3
                                    1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3
                                    3-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.75-.75a1.25
                                    1.25 0 100 2.5 1.25 1.25 0 000-2.5z" />
                                </svg>
                            </a>

                            <!-- WhatsApp -->
                            <a href="https://wa.me/6282245975553"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="group transition"
                            >
                                <svg class="w-5 h-5 text-white group-hover:text-[#B48B2E] transition" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.52 3.48A11.8 11.8 0 0012 0a11.8 11.8 0 00-8.52
                                    3.48A11.8 11.8 0 000 12c0 2.07.54 4.1 1.56 5.88L0 24l6.3-1.62A11.96
                                    11.96 0 0012 24a11.8 11.8 0 008.52-3.48A11.8 11.8 0 0024 12c0-3.19-1.24-6.21-3.48-8.52zM12
                                    22c-1.77 0-3.49-.46-5.04-1.34L5 21l.34-1.96A9.96 9.96 0 012 12a10
                                    10 0 1110 10zm5.35-6.65c-.29-.15-1.71-.84-1.98-.94-.27-.1-.47-.15-.67
                                    .15-.2.29-.77.94-.95 1.14-.17.2-.35.22-.64.07-.29-.15-1.23-.45-2.34-1.43-.86-.77-1.44-1.72-1.61-2.01-.17-.29-.02-.45.13-.6.13-.13.29-.35.43-.52.15-.17.2-.29.3-.49.1-.2.05-.37-.02-.52-.07-.15-.67-1.61-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2
                                    0-.52.07-.79.37-.27.29-1.04 1.01-1.04 2.47s1.07 2.86 1.22 3.06c.15.2 2.1
                                    3.34 5.08 4.68 2.98 1.34 2.98.89 3.52.83.54-.05 1.71-.7 1.96-1.38.24-.69.24-1.28.17-1.38-.07-.1-.27-.17-.57-.32z"/>
                                </svg>
                            </a>

                            <!-- YouTube -->
                            <a href="#" class="group transition">
                                <svg class="w-5 h-5 text-white group-hover:text-[#B48B2E] transition" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.5 6.2s-.2-1.7-.9-2.5c-.8-.9-1.6-.9-2-1C17.5 2.3 12
                                    2.3 12 2.3h-.1s-5.5 0-8.6.4c-.4.1-1.2.1-2
                                    1-.7.8-.9 2.5-.9 2.5S0 8.1 0 10.1v1.8c0 2 .2 3.9.2
                                    3.9s.2 1.7.9 2.5c.8.9 1.9.9 2.4 1 1.8.2 7.5.4 7.5.4s5.5 0 8.6-.4c.4-.1
                                    1.2-.1 2-1 .7-.8.9-2.5.9-2.5s.2-2 .2-3.9v-1.8c0-2-.2-3.9-.2-3.9zM9.6
                                    14.6V7.8l6.2 3.4-6.2 3.4z"/>
                                </svg>
                            </a>

                            <!-- LinkedIn -->
                            <a href="#" class="group transition">
                                <svg class="w-5 h-5 text-white group-hover:text-[#B48B2E] transition" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4.98 3.5C4.98 5 3.9 6 2.5 6S0 5 0 3.5 1.08 1 2.48
                                    1s2.5 1 2.5 2.5zM.5 8h4V24h-4V8zm7.5 0h3.8v2.2h.1c.5-.9 1.8-2.2
                                    4-2.2 4.3 0 5.1 2.8 5.1 6.4V24h-4v-8.2c0-1.9-.1-4.4-2.7-4.4-2.7
                                    0-3.1 2.1-3.1 4.3V24h-4V8z"/>
                                </svg>
                            </a>

                            <!-- Twitter/X -->
                            <a href="#" class="group transition">
                                <svg class="w-5 h-5 text-white group-hover:text-[#B48B2E] transition" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.9 4.6c-.9.4-1.8.6-2.8.8 1-.6 1.7-1.5 2.1-2.6-.9.6-2 .9-3
                                    1.2-1-1-2.3-1.5-3.7-1.5-2.9 0-5.2 2.5-5.2 5.4v.8C7.7 8.5 4.1
                                    6.3 1.7 2.9c-.3.6-.5 1.3-.5 2 0 1.8 1 3.4 2.5
                                    4.4-.8 0-1.6-.3-2.3-.6v.1c0 2.6 1.7 4.7 4.1
                                    5.2-.4.1-.8.2-1.3.2-.3 0-.6 0-.9-.1.6 2.2 2.6 3.8
                                    5 3.9-1.8 1.5-4.1 2.4-6.5 2.4-.4 0-.8
                                    0-1.2-.1 2.3 1.6 5.1 2.5 8 2.5 9.5 0 14.7-8.4
                                    14.7-15.7v-.7c1-.8 1.8-1.6 2.5-2.5z"/>
                                </svg>
                            </a>

                        </div>
                    </div>

                    <!-- RIGHT: HOME / ABOUT / CONTACT -->
                    <div class="w-full md:w-[55%] flex flex-col md:flex-row justify-between items-start md:mt-2">

                        <!-- HOME -->
                        <div class="mb-8 md:mb-0">
                            <h4 class="text-[13px] font-semibold mb-3 text-white">Navigation</h4>
                            <ul class="space-y-2 text-[12px] text-slate-200">
                                <li><a href="#hero-section" class="hover:text-[#B48B2E] transition">Home</a></li>
                                <li><a href="#about-section" class="hover:text-[#B48B2E] transition">About</a></li>
                                <li><a href="#program-section" class="hover:text-[#B48B2E] transition">Certifications</a></li>
                                <li><a href="#benefit-section" class="hover:text-[#B48B2E] transition">Benefits</a></li>
                                <li><a href="#service-section" class="hover:text-[#B48B2E] transition">Services</a></li>
                                <li><a href="#contact-section" class="hover:text-[#B48B2E] transition">Contact</a></li>
                            </ul>
                        </div>

                        <!-- ABOUT -->
                        <div class="mb-8 md:mb-0">
                            <h4 class="text-[13px] font-semibold mb-3 text-white">About</h4>
                            <ul class="space-y-2 text-[12px] text-slate-200">
                                <li><a href="#" class="pointer-events-none cursor-not-allowed transition">Company</a></li>
                                <li><a href="#" class="pointer-events-none cursor-not-allowed transition">Certifications</a></li>
                                <li><a href="#" class="pointer-events-none cursor-not-allowed transition">Gallery</a></li>
                                <li><a href="#" class="pointer-events-none cursor-not-allowed transition">Our News</a></li>
                            </ul>
                        </div>

                        <!-- CONTACT -->
                        <div>
                            <h4 class="text-[13px] font-semibold mb-3 text-white">Contact</h4>
                            <ul class="space-y-3 text-[12px] text-slate-200">

                                <!-- Phone -->
                                <li class="flex items-start space-x-3">
                                    <svg class="w-4 h-4 text-[#B48B2E] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6.6 10.8a15.5 15.5 0 006.6 6.6l2.2-2.2c.3-.3.7-.4
                                        1-.3 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V21c0 .6-.4 1-1
                                        1C10.5 22 2 13.5 2 3c0-.6.4-1 1-1h3.5c.6 0
                                        1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .8-.3 1l-2.2 2.2z"/>
                                    </svg>
                                    <span>(406) 555-0120</span>
                                </li>

                                <!-- Email -->
                                <li class="flex items-start space-x-3">
                                    <svg class="w-4 h-4 text-[#B48B2E] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20 4H4C2.9 4 2 4.9 2 6v12c0 1.1.9 2 2
                                        2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0
                                        4l-8 5-8-5V6l8 5 8-5v2z"/>
                                    </svg>
                                    <span>kreasi.digital@gmail.com</span>
                                </li>

                                <!-- Address -->
                                <li class="flex items-start space-x-3">
                                    <svg class="w-4 h-4 text-[#B48B2E] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.1 2 5 5.1 5 9c0
                                        5.2 7 13 7 13s7-7.8 7-13c0-3.9-3.1-7-7-7zm0
                                        9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12
                                        6.5s2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z"/>
                                    </svg>
                                    <span>
                                        2972 Westheimer Rd. Santa<br/>
                                        Ana, Illinois 85486
                                    </span>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <!-- BOTTOM BAR -->
            <div class="border-t border-[#222222]">
                <div class="max-w-7xl mx-auto px-6 py-4 text-[12px] text-slate-500 flex justify-between">
                    <p>© 2025 Govind. All rights reserved.</p>
                    <p>Developed by Solveit.id</p>
                </div>
            </div>
        </footer>

        <!-- JS: cdn leaflet -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <!-- JS: aos js -->
        <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                AOS.init({
                    duration: 800,
                    offset: 120,
                    once: true,

                    disable: function () {
                        // use Tailwind breakpoint: md = 768px
                        return window.innerWidth < 768;   // if <768px (mobile) => disable
                    }
                });
            });
        </script>

        <!-- JS: custom js -->
        <script src="{{ asset('js/script.js') }}"></script>

        <!-- JS: auto-close desktop dropdown -->
        <script>
            (function () {
                const dd = document.getElementById('desktopProfile');
                if (!dd) return;

                const close = () => dd.removeAttribute('open');

                document.addEventListener('click', (e) => {
                    if (dd.hasAttribute('open') && !dd.contains(e.target)) close();
                }, true);

                window.addEventListener('scroll', () => {
                    if (dd.hasAttribute('open')) close();
                }, { passive: true });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && dd.hasAttribute('open')) close();
                });
            })();

            (function () {
                const dd = document.getElementById('mobileInlineProfile');
                if (!dd) return;

                const close = () => dd.removeAttribute('open');

                document.addEventListener('click', (e) => {
                    if (dd.hasAttribute('open') && !dd.contains(e.target)) close();
                }, true);

                window.addEventListener('scroll', () => {
                    if (dd.hasAttribute('open')) close();
                }, { passive: true });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && dd.hasAttribute('open')) close();
                });
            })();
        </script>

        <!-- JS: video about us -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {

                const video = document.getElementById("aboutVideo");
                const btn   = document.getElementById("videoToggle");

                if (!video || !btn) return;

                btn.addEventListener("click", (e) => {
                    e.stopPropagation(); // prevent click from triggering other handlers

                    if (video.paused) {
                        video.play();
                        btn.innerHTML = "❚❚"; // pause icon
                    } else {
                        video.pause();
                        btn.innerHTML = "▶"; // play icon
                    }
                });

            });
        </script>

        <!-- JS: programs carousel -->
        <script>
            (function () {
                const slides = document.querySelectorAll('[data-program-slide]');
                const dotsContainer = document.getElementById('programDots');
                const prevBtn = document.getElementById('programPrev');
                const nextBtn = document.getElementById('programNext');

                if (!slides.length) return;

                let current = 0;
                let intervalId = null;

                // Create dots
                slides.forEach((_, idx) => {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className =
                        'h-2.5 w-2.5 rounded-full bg-slate-200 transition-all duration-300';
                    dot.dataset.index = idx;
                    dotsContainer.appendChild(dot);
                });

                const dots = dotsContainer.querySelectorAll('button');

                function showSlide(index) {
                    slides.forEach((slide, i) => {
                        if (i === index) {
                            slide.classList.remove('hidden');
                            slide.classList.add('flex');
                        } else {
                            slide.classList.add('hidden');
                            slide.classList.remove('flex');
                        }
                    });

                    dots.forEach((dot, i) => {
                        if (i === index) {
                            dot.classList.remove('bg-slate-200');
                            dot.classList.add('bg-[#6AAEAD]', 'w-5');
                        } else {
                            dot.classList.add('bg-slate-200');
                            dot.classList.remove('bg-[#6AAEAD]', 'w-5');
                        }
                    });

                    current = index;
                }

                function nextSlide() {
                    const next = (current + 1) % slides.length;
                    showSlide(next);
                }

                function prevSlide() {
                    const prev = (current - 1 + slides.length) % slides.length;
                    showSlide(prev);
                }

                function startAutoPlay() {
                    intervalId = setInterval(nextSlide, 6000);
                }

                function stopAutoPlay() {
                    if (intervalId) clearInterval(intervalId);
                }

                // Init
                showSlide(0);
                startAutoPlay();

                // Events
                nextBtn.addEventListener('click', () => {
                    stopAutoPlay();
                    nextSlide();
                    startAutoPlay();
                });

                prevBtn.addEventListener('click', () => {
                    stopAutoPlay();
                    prevSlide();
                    startAutoPlay();
                });

                dots.forEach((dot) => {
                    dot.addEventListener('click', () => {
                        stopAutoPlay();
                        const idx = Number(dot.dataset.index || 0);
                        showSlide(idx);
                        startAutoPlay();
                    });
                });
            })();
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                alert.classList.add('opacity-0', 'translate-y-5');
                setTimeout(() => alert.remove(), 700);
            }, 3000);
        </script>

        <!-- JS: video detail programs -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('programModal');
                if (!modal) return;

                const imgEl      = modal.querySelector('[data-program-modal-image]');
                const titleEl    = modal.querySelector('[data-program-modal-title]');
                const catEl      = modal.querySelector('[data-program-modal-category]');
                const numEl      = modal.querySelector('[data-program-modal-number]');
                const shortEl    = modal.querySelector('[data-program-modal-short]');
                const longEl     = modal.querySelector('[data-program-modal-long]');
                const durationEl = modal.querySelector('[data-program-modal-duration]');
                const priceEl    = modal.querySelector('[data-program-modal-price]');
                const regBtn     = modal.querySelector('[data-program-modal-register]');

                function openModal(data) {
                    if (imgEl && data.image) {
                        imgEl.src = data.image;
                    }
                    if (titleEl)    titleEl.textContent    = data.name || '';
                    if (catEl)      catEl.textContent      = data.category || 'Program';
                    if (numEl)      numEl.textContent      = data.number ? ('Program ' + data.number) : '';
                    if (shortEl)    shortEl.textContent    = data.short || '';
                    if (longEl)     longEl.textContent     = data.long || '';
                    if (durationEl) durationEl.textContent = data.duration || '-';
                    if (priceEl)    priceEl.textContent    = data.price || '-';
                    if (regBtn && data.registerUrl) {
                        regBtn.href = data.registerUrl;
                    }

                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }

                function closeModal() {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }

                // Trigger buttons
                document.querySelectorAll('[data-program-detail-trigger]').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        const ds = this.dataset;
                        openModal({
                            number:      ds.programNo,
                            name:        ds.programName,
                            category:    ds.programCategory,
                            duration:    ds.programDuration,
                            price:       ds.programPrice,
                            short:       ds.programShort,
                            long:        ds.programLong,
                            image:       ds.programImage,
                            registerUrl: ds.programRegisterUrl
                        });
                    });
                });

                // Close via buttons + overlay
                modal.querySelectorAll('[data-program-modal-close],[data-program-modal-overlay]')
                    .forEach(function (el) {
                        el.addEventListener('click', closeModal);
                    });

                // Close on ESC
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                        closeModal();
                    }
                });
            });
        </script>

        <!-- JS: testimonial carousel -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const testimonials = @json($testimonialsJs);

                if (!Array.isArray(testimonials) || testimonials.length === 0) {
                    console.warn('No testimonials data available.');
                    return;
                }

                let currentIndex = 0;

                const prevBtn = document.getElementById("prev-testimonial-btn");
                const nextBtn = document.getElementById("next-testimonial-btn");

                const textEl  = document.getElementById('testimonial-text');
                const nameEl  = document.getElementById('testimonial-name');
                const roleEl  = document.getElementById('testimonial-role');
                const dateEl  = document.getElementById('testimonial-date');
                const photoEl = document.getElementById('testimonial-photo');

                function applyTestimonial() {
                    const item = testimonials[currentIndex];
                    if (!item || !textEl || !nameEl || !roleEl || !dateEl || !photoEl) return;

                    textEl.textContent  = `“${item.text}”`;
                    nameEl.textContent  = item.name || '';
                    roleEl.textContent  = item.role || 'Program Participant';
                    dateEl.textContent  = item.date || '';

                    if (false) {
                        photoEl.innerHTML = `
                            <img
                                src="${item.photo}"
                                class="h-9 w-9 rounded-full object-cover border border-slate-300 shadow-sm"
                                alt="Avatar"
                            >
                        `;
                    } else {
                        const initial = item.initial || (item.name ? item.name.charAt(0).toUpperCase() : 'G');
                        photoEl.innerHTML = `
                            <div class="h-9 w-9 rounded-full bg-[#C1DCDC] text-slate-900 grid place-items-center font-semibold shadow">
                                ${initial}
                            </div>
                        `;
                    }
                }

                function nextTestimonial() {
                    currentIndex = (currentIndex + 1) % testimonials.length;
                    applyTestimonial();
                }

                function prevTestimonial() {
                    currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
                    applyTestimonial();
                }

                if (prevBtn) prevBtn.addEventListener('click', prevTestimonial);
                if (nextBtn) nextBtn.addEventListener('click', nextTestimonial);

                // Kalau hanya 1 testimonial, boleh sekalian disable tombol (opsional)
                if (testimonials.length <= 1) {
                    if (prevBtn) prevBtn.classList.add('opacity-40', 'pointer-events-none');
                    if (nextBtn) nextBtn.classList.add('opacity-40', 'pointer-events-none');
                }

                // initial render – penting!
                applyTestimonial();
            });
        </script>

    </body>

</html>
