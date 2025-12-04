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
                        <a href="#" class="hover:text-[#6AAEAD] transition">Home</a>
                        <a href="#" class="hover:text-[#6AAEAD] transition">About</a>
                        <a href="#" class="hover:text-[#6AAEAD] transition">Certifications</a>
                        <a href="#" class="hover:text-[#6AAEAD] transition">Benefits</a>
                        <a href="#" class="hover:text-[#6AAEAD] transition">Services</a>
                        <a href="#" class="hover:text-[#6AAEAD] transition">Contact</a>
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
                        <a href="#" class="hover:text-[#6AAEAD] transition">Home</a>
                        <a href="#" class="hover:text-[#6AAEAD] transition">About</a>
                        <a href="#" class="hover:text-[#6AAEAD] transition">Certifications</a>
                        <a href="#" class="hover:text-[#6AAEAD] transition">Benefits</a>
                        <a href="#" class="hover:text-[#6AAEAD] transition">Services</a>
                        <a href="#" class="hover:text-[#6AAEAD] transition">Contact</a>
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
        </header>

        <!-- HERO -->
        <section class="mt-28 relative z-0">
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
        <section class="mt-40">
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
        <section class="mt-40">
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
                        <!-- Slide 1 -->
                        <article
                            class="flex flex-col md:flex-row gap-0 md:gap-6 items-stretch min-h-[260px]"
                            data-program-slide
                        >
                            <!-- Image -->
                            <div class="md:w-1/2 relative h-52 md:h-auto overflow-hidden">
                                <img
                                    src="https://images.pexels.com/photos/1181649/pexels-photo-1181649.jpeg?auto=compress&cs=tinysrgb&w=800"
                                    alt="Communication & Services"
                                    class="h-full w-full object-cover transition-transform duration-700"
                                    data-program-image
                                />
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-tr from-slate-900/40 via-slate-900/0"></div>
                                <span
                                    class="absolute bottom-4 left-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-[11px] font-medium text-slate-800 shadow-sm"
                                >
                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-[#6AAEAD]"></span>
                                    Soft Skills
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="md:w-1/2 p-6 md:p-7 flex flex-col justify-center">
                                <p class="text-xs font-semibold uppercase tracking-[0.15em] text-[#6AAEAD] mb-1.5">
                                    Program 01
                                </p>
                                <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                                    Communication &amp; Services
                                </h3>
                                <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                                    Build strong communication, customer care, and service excellence capabilities for
                                    professional and frontline roles.
                                </p>

                                <ul class="mt-3 space-y-1.5 text-xs text-slate-500">
                                    <li>• Duration: 4–6 weeks</li>
                                    <li>• Format: Online live sessions & assignments</li>
                                </ul>

                                <!-- Buttons -->
                                <div class="mt-5 flex flex-wrap gap-3">
                                    <a href="#" class="inline-flex items-center justify-center rounded-xl border border-[#6AAEAD] px-4 py-2 text-xs font-medium text-[#6AAEAD] hover:bg-[#6AAEAD] hover:text-white transition-colors">
                                        View Details
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center rounded-xl bg-[#6AAEAD] px-4 py-2 text-xs font-medium text-white hover:bg-[#5ba09f] transition-colors">
                                        Register
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Slide 2 -->
                        <article
                            class="hidden flex-col md:flex-row gap-0 md:gap-6 items-stretch min-h-[260px]"
                            data-program-slide
                        >
                            <div class="md:w-1/2 relative h-52 md:h-auto overflow-hidden">
                                <img
                                    src="https://images.pexels.com/photos/1181534/pexels-photo-1181534.jpeg?auto=compress&cs=tinysrgb&w=800"
                                    alt="Business & Economy"
                                    class="h-full w-full object-cover transition-transform duration-700"
                                    data-program-image
                                />
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-tr from-slate-900/40 via-slate-900/0"></div>
                                <span
                                    class="absolute bottom-4 left-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-[11px] font-medium text-slate-800 shadow-sm"
                                >
                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-[#6AAEAD]"></span>
                                    Management
                                </span>
                            </div>

                            <div class="md:w-1/2 p-6 md:p-7 flex flex-col justify-center">
                                <p class="text-xs font-semibold uppercase tracking-[0.15em] text-[#6AAEAD] mb-1.5">
                                    Program 02
                                </p>
                                <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                                    Business &amp; Economy
                                </h3>
                                <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                                    Strengthen your understanding of business fundamentals, finance basics, and strategic
                                    decision making.
                                </p>

                                <ul class="mt-3 space-y-1.5 text-xs text-slate-500">
                                    <li>• Duration: 6–8 weeks</li>
                                    <li>• Format: Online + capstone project</li>
                                </ul>

                                <div class="mt-5 flex flex-wrap gap-3">
                                    <a href="#" class="inline-flex items-center justify-center rounded-xl border border-[#6AAEAD] px-4 py-2 text-xs font-medium text-[#6AAEAD] hover:bg-[#6AAEAD] hover:text-white transition-colors">
                                        View Details
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center rounded-xl bg-[#6AAEAD] px-4 py-2 text-xs font-medium text-white hover:bg-[#5ba09f] transition-colors">
                                        Register
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Slide 3 -->
                        <article
                            class="hidden flex-col md:flex-row gap-0 md:gap-6 items-stretch min-h-[260px]"
                            data-program-slide
                        >
                            <div class="md:w-1/2 relative h-52 md:h-auto overflow-hidden">
                                <img
                                    src="https://images.pexels.com/photos/845451/pexels-photo-845451.jpeg?auto=compress&cs=tinysrgb&w=800"
                                    alt="Human Resource (HR)"
                                    class="h-full w-full object-cover transition-transform duration-700"
                                    data-program-image
                                />
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-tr from-slate-900/40 via-slate-900/0"></div>
                                <span
                                    class="absolute bottom-4 left-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-[11px] font-medium text-slate-800 shadow-sm"
                                >
                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-[#6AAEAD]"></span>
                                    People
                                </span>
                            </div>

                            <div class="md:w-1/2 p-6 md:p-7 flex flex-col justify-center">
                                <p class="text-xs font-semibold uppercase tracking-[0.15em] text-[#6AAEAD] mb-1.5">
                                    Program 03
                                </p>
                                <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                                    Human Resource (HR)
                                </h3>
                                <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                                    Learn modern HR practices, recruitment, performance management, and people development.
                                </p>

                                <ul class="mt-3 space-y-1.5 text-xs text-slate-500">
                                    <li>• Duration: 4–6 weeks</li>
                                    <li>• Format: Online live sessions & case studies</li>
                                </ul>

                                <div class="mt-5 flex flex-wrap gap-3">
                                    <a href="#" class="inline-flex items-center justify-center rounded-xl border border-[#6AAEAD] px-4 py-2 text-xs font-medium text-[#6AAEAD] hover:bg-[#6AAEAD] hover:text-white transition-colors">
                                        View Details
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center rounded-xl bg-[#6AAEAD] px-4 py-2 text-xs font-medium text-white hover:bg-[#5ba09f] transition-colors">
                                        Register
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Slide 4 -->
                        <article
                            class="hidden flex-col md:flex-row gap-0 md:gap-6 items-stretch min-h-[260px]"
                            data-program-slide
                        >
                            <div class="md:w-1/2 relative h-52 md:h-auto overflow-hidden">
                                <img
                                    src="https://images.pexels.com/photos/1181562/pexels-photo-1181562.jpeg?auto=compress&cs=tinysrgb&w=800"
                                    alt="Technology"
                                    class="h-full w-full object-cover transition-transform duration-700"
                                    data-program-image
                                />
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-tr from-slate-900/40 via-slate-900/0"></div>
                                <span
                                    class="absolute bottom-4 left-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-[11px] font-medium text-slate-800 shadow-sm"
                                >
                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-[#6AAEAD]"></span>
                                    Tech
                                </span>
                            </div>

                            <div class="md:w-1/2 p-6 md:p-7 flex flex-col justify-center">
                                <p class="text-xs font-semibold uppercase tracking-[0.15em] text-[#6AAEAD] mb-1.5">
                                    Program 04
                                </p>
                                <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                                    Technology
                                </h3>
                                <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                                    Explore digital tools, IT fundamentals, and technology trends relevant for modern roles.
                                </p>

                                <ul class="mt-3 space-y-1.5 text-xs text-slate-500">
                                    <li>• Duration: 6–8 weeks</li>
                                    <li>• Format: Online + hands-on project</li>
                                </ul>

                                <div class="mt-5 flex flex-wrap gap-3">
                                    <a href="#" class="inline-flex items-center justify-center rounded-xl border border-[#6AAEAD] px-4 py-2 text-xs font-medium text-[#6AAEAD] hover:bg-[#6AAEAD] hover:text-white transition-colors">
                                        View Details
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center rounded-xl bg-[#6AAEAD] px-4 py-2 text-xs font-medium text-white hover:bg-[#5ba09f] transition-colors">
                                        Register
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Slide 5 -->
                        <article
                            class="hidden flex-col md:flex-row gap-0 md:gap-6 items-stretch min-h-[260px]"
                            data-program-slide
                        >
                            <div class="md:w-1/2 relative h-52 md:h-auto overflow-hidden">
                                <img
                                    src="https://images.pexels.com/photos/3828832/pexels-photo-3828832.jpeg?auto=compress&cs=tinysrgb&w=800"
                                    alt="Health & Safety"
                                    class="h-full w-full object-cover transition-transform duration-700"
                                    data-program-image
                                />
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-tr from-slate-900/40 via-slate-900/0"></div>
                                <span
                                    class="absolute bottom-4 left-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-[11px] font-medium text-slate-800 shadow-sm"
                                >
                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-[#6AAEAD]"></span>
                                    Compliance
                                </span>
                            </div>

                            <div class="md:w-1/2 p-6 md:p-7 flex flex-col justify-center">
                                <p class="text-xs font-semibold uppercase tracking-[0.15em] text-[#6AAEAD] mb-1.5">
                                    Program 05
                                </p>
                                <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                                    Health &amp; Safety
                                </h3>
                                <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                                    Understand workplace safety, risk awareness, and basic health & safety compliance.
                                </p>

                                <ul class="mt-3 space-y-1.5 text-xs text-slate-500">
                                    <li>• Duration: 3–4 weeks</li>
                                    <li>• Format: Online + assessment</li>
                                </ul>

                                <div class="mt-5 flex flex-wrap gap-3">
                                    <a href="#" class="inline-flex items-center justify-center rounded-xl border border-[#6AAEAD] px-4 py-2 text-xs font-medium text-[#6AAEAD] hover:bg-[#6AAEAD] hover:text-white transition-colors">
                                        View Details
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center rounded-xl bg-[#6AAEAD] px-4 py-2 text-xs font-medium text-white hover:bg-[#5ba09f] transition-colors">
                                        Register
                                    </a>
                                </div>
                            </div>
                        </article>
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
        </section>

        <!-- WHY CHOOSE US -->
        <section class="mt-40">
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
                <!-- Card 1 -->
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
        <section class="mt-40">
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
        <section class="mt-40 relative overflow-hidden">
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
                            what they say<br>
                            about Govind<br>
                            Abra Enterprise
                        </p>

                        <p class="mt-5 text-[13px] text-slate-500 max-w-xs">
                            More than 3,000 participants have trusted our programs to enhance their skills.
                        </p>
                    </div>

                    <!-- RIGHT SIDE CARD -->
                    <div class="lg:w-7/12 relative" data-aos="fade-left">

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

                            <!-- quote text -->
                            <p id="testimonial-text" class="text-sm md:text-[15px] text-slate-800 leading-relaxed">
                                “Learning at GAE is very engaging, structured, and aligned with the needs of the modern workforce.
                                The mentors are experienced, and the material is highly relevant to current industry developments.”
                            </p>

                            <!-- bottom row: user + arrows -->
                            <div class="mt-8 flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div id="testimonial-photo" class="w-10 h-10 rounded-full bg-slate-300 overflow-hidden"></div>
                                    <div>
                                        <p id="testimonial-name" class="text-[13px] font-semibold text-slate-900">
                                            Resky Fernanda
                                        </p>
                                        <p id="testimonial-role" class="text-[11px] text-slate-500">
                                            Product Designer at Tokopedia
                                        </p>
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
            </div>
        </section>

        <!-- DECORATION BETWEEN TESTIMONIAL & CONTACT (NO EXTRA HEIGHT) -->
        <div class="relative w-full h-0">
            <img src="{{ asset('img/Illustration.png') }}" alt="Decoration" class="hidden lg:block w-60 absolute right-0 -bottom-[300px] pointer-events-none select-none"/>
        </div>

        <!-- CONTACT -->
        <section class="mt-40 relative overflow-hidden">
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
                    <form class="space-y-5" data-aos="fade-right">

                        <!-- Name -->
                        <div>
                            <label class="block mb-1 text-[11px] text-slate-600">Name</label>
                            <input type="text" placeholder="Name"
                                class="w-full rounded-[10px] border border-[#A6DCD3]
                                        px-4 py-2.5 text-[13px] text-slate-900
                                        focus:outline-none focus:ring-2 focus:ring-[#7EC6C4]/60
                                        focus:border-[#6AAEAD] transition"/>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block mb-1 text-[11px] text-slate-600">Email*</label>
                            <input type="email" placeholder="Email"
                                class="w-full rounded-[10px] border border-[#A6DCD3]
                                        px-4 py-2.5 text-[13px] text-slate-900
                                        focus:outline-none focus:ring-2 focus:ring-[#7EC6C4]/60
                                        focus:border-[#6AAEAD] transition"/>
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block mb-1 text-[11px] text-slate-600">Message*</label>
                            <textarea rows="5" placeholder="Message"
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

                    <button
                        class="mt-8 px-10 py-3 text-sm font-semibold rounded-md
                            bg-white text-[#4D9A99]
                            shadow-[0_18px_40px_rgba(100,160,160,0.50)]
                            hover:bg-[#F9FFFF] hover:text-[#3A8584]
                            transition duration-300">
                        Join Now!
                    </button>
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
                        <div class="flex items-center space-x-4 text-white text-[16px]">
                            <span class="hover:text-[#D4AC37] cursor-pointer"></span>
                            <span class="hover:text-[#D4AC37] cursor-pointer"></span>
                            <span class="hover:text-[#D4AC37] cursor-pointer"></span>
                            <span class="hover:text-[#D4AC37] cursor-pointer"></span>
                            <span class="hover:text-[#D4AC37] cursor-pointer"></span>
                        </div>
                    </div>

                    <!-- RIGHT: HOME / ABOUT / CONTACT -->
                    <div class="w-full md:w-[55%] flex flex-col md:flex-row justify-between items-start md:mt-2">

                        <!-- HOME -->
                        <div class="mb-8 md:mb-0">
                            <h4 class="text-[13px] font-semibold mb-3 text-white">Home</h4>
                            <ul class="space-y-2 text-[12px] text-slate-200">
                                <li><a href="#" class="hover:text-white transition">Home</a></li>
                                <li><a href="#" class="hover:text-white transition">Programs</a></li>
                                <li><a href="#" class="hover:text-white transition">Benefits</a></li>
                                <li><a href="#" class="hover:text-white transition">Why Choose Us</a></li>
                                <li><a href="#" class="hover:text-white transition">Testimonials</a></li>
                            </ul>
                        </div>

                        <!-- ABOUT -->
                        <div class="mb-8 md:mb-0">
                            <h4 class="text-[13px] font-semibold mb-3 text-white">About</h4>
                            <ul class="space-y-2 text-[12px] text-slate-200">
                                <li><a href="#" class="hover:text-white transition">Company</a></li>
                                <li><a href="#" class="hover:text-white transition">Certifications</a></li>
                                <li><a href="#" class="hover:text-white transition">Gallery</a></li>
                                <li><a href="#" class="hover:text-white transition">Our News</a></li>
                            </ul>
                        </div>

                        <!-- CONTACT -->
                        <div>
                            <h4 class="text-[13px] font-semibold mb-3 text-white">Contact</h4>
                            <ul class="space-y-3 text-[12px] text-slate-200">
                                <li class="flex items-start space-x-3">
                                    <span class="text-[#D4AC37] text-[13px]"></span>
                                    <span>(406) 555-0120</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <span class="text-[#D4AC37] text-[13px]"></span>
                                    <span>kreasi.digital@gmail.com</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <span class="text-[#D4AC37] text-[13px]"></span>
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

        <!-- SCRIPTS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <!-- AOS JS -->
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

        <!-- Custom JS -->
        <script src="{{ asset('js/script.js') }}"></script>

        <!-- Video About Us -->
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

        <!-- Testimonials -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Testimonials data
                const testimonials = [
                    {
                        text: "“Learning at GAE is very engaging, structured, and aligned with the needs of the modern workforce. The mentors are experienced, and the material is highly relevant to current industry developments.”",
                        name: "Resky Fernanda",
                        role: "Product Designer at Tokopedia",
                        photo: ""
                    },
                    {
                        text: "“GAE's programs greatly helped me understand concepts more clearly. The materials are complete and easy to follow, suitable for both beginners and professionals.”",
                        name: "Nadia Putri",
                        role: "UI/UX Designer",
                        photo: ""
                    },
                    {
                        text: "“The training quality is outstanding! The facilitators explain in detail and provide real examples from the industry.”",
                        name: "Dimas Pratama",
                        role: "Fullstack Developer",
                        photo: ""
                    }
                ];

                let currentIndex = 0;

                const textEl  = document.getElementById("testimonial-text");
                const nameEl  = document.getElementById("testimonial-name");
                const roleEl  = document.getElementById("testimonial-role");
                const photoEl = document.getElementById("testimonial-photo");

                const prevBtn = document.getElementById("prev-testimonial-btn");
                const nextBtn = document.getElementById("next-testimonial-btn");

                function applyTestimonial() {
                    if (!textEl || !nameEl || !roleEl || !photoEl) {
                        console.warn("Testimonial elements not found.");
                        return;
                    }

                    const item = testimonials[currentIndex];
                    if (!item) return;

                    textEl.textContent  = item.text;
                    nameEl.textContent  = item.name;
                    roleEl.textContent  = item.role;

                    if (item.photo) {
                        photoEl.style.backgroundImage    = `url('${item.photo}')`;
                        photoEl.style.backgroundSize     = "cover";
                        photoEl.style.backgroundPosition = "center";
                    } else {
                        photoEl.style.backgroundImage = "none";
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

                // Connect buttons to functions (WITHOUT onclick in HTML)
                if (prevBtn) {
                    prevBtn.addEventListener('click', prevTestimonial);
                }
                if (nextBtn) {
                    nextBtn.addEventListener('click', nextTestimonial);
                }

                // Initial sync
                // applyTestimonial();
            });
        </script>

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
        </script>

    </body>

</html>
