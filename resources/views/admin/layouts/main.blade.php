<!DOCTYPE html>
<html lang="id" class="h-full">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>@yield('title')</title>

        <!-- Tailwind CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                DEFAULT: '#1e40af',
                                50:  '#eff6ff',
                                100: '#dbeafe',
                                200: '#bfdbfe',
                                300: '#93c5fd',
                                400: '#60a5fa',
                                500: '#3b82f6',
                                600: '#2563eb',
                                700: '#1d4ed8',
                                800: '#1e40af',
                                900: '#1e3a8a',
                            }
                        }
                    }
                }
            }
        </script>

        <!-- Alpine.js CDN -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Font Inter -->
        <link rel="preconnect" href="https://fonts.gstatic.com"/>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
        <style>
            body {
                font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
            }

            /* Scrollbar Webkit (Chrome, Edge, Safari) */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            ::-webkit-scrollbar-track {
                background: rgba(193, 220, 220, 0.35); /* #C1DCDC but soft */
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb {
                background: linear-gradient(
                    to bottom,
                    #6AAEAD,  /* teal medium */
                    #1E4B4B   /* teal dark */
                );
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(
                    to bottom,
                    #5CA3A2,  /* sedikit lebih gelap dari #6AAEAD */
                    #173F3F   /* dark teal */
                );
            }

            /* Scrollbar Firefox */
            * {
                scrollbar-width: thin;
                scrollbar-color: #6AAEAD rgba(193, 220, 220, 0.4);
            }

            /* Scrollbar khusus main dan nav */
            main::-webkit-scrollbar,
            nav::-webkit-scrollbar {
                width: 8px;
            }

            html {
                scroll-behavior: smooth;
            }
        </style>
    </head>

    <body class="h-full bg-gradient-to-br from-[#C1DCDC] via-[#DFF1F1] to-white text-slate-800">
        <div class="flex h-screen overflow-hidden">

            <!-- SIDEBAR (fixed) -->
            <aside class="hidden md:flex md:flex-col fixed top-0 left-0 h-full w-64 bg-white/80 backdrop-blur-xl border-r border-[#C1DCDC]/60 shadow-lg z-20">
                <!-- Brand -->
                <div class="h-16 flex items-center px-6 border-b border-[#C1DCDC]/50">
                    <span class="text-[#1E4B4B] font-semibold text-xl tracking-tight">
                        Admin Panel
                    </span>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto p-4 space-y-1 text-sm font-medium">
                    <!-- Home -->
                    <a href="{{ route('admin.home') }}"
                    @class([
                        'flex items-center rounded-xl px-3 py-2 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#6AAEAD] focus-visible:ring-offset-0',
                        'bg-[#C1DCDC]/80 text-[#1E4B4B] font-semibold shadow-sm ring-1 ring-[#6AAEAD]/60' => Request::routeIs('admin.home'),
                        'text-[#285E5E] hover:bg-[#C1DCDC]/40 hover:text-[#0F3535]' => !Request::routeIs('admin.home'),
                    ])>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#285E5E]"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </a>

                    <!-- Users -->
                    <a href="{{ route('admin.user') }}"
                    @class([
                        'flex items-center rounded-xl px-3 py-2 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#6AAEAD] focus-visible:ring-offset-0',
                        'bg-[#C1DCDC]/80 text-[#1E4B4B] font-semibold shadow-sm ring-1 ring-[#6AAEAD]/60' => Request::routeIs('admin.user*'),
                        'text-[#285E5E] hover:bg-[#C1DCDC]/40 hover:text-[#0F3535]' => !Request::routeIs('admin.user*'),
                    ])>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#285E5E]"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Users
                    </a>

                    <!-- Category -->
                    <a href="{{ route('admin.category') }}"
                    @class([
                        'flex items-center rounded-xl px-3 py-2 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#6AAEAD] focus-visible:ring-offset-0',
                        'bg-[#C1DCDC]/80 text-[#1E4B4B] font-semibold shadow-sm ring-1 ring-[#6AAEAD]/60' => Request::routeIs('admin.category*'),
                        'text-[#285E5E] hover:bg-[#C1DCDC]/40 hover:text-[#0F3535]' => !Request::routeIs('admin.category*'),
                    ])>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#285E5E]" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 3h6a2 2 0 0 1 2 2v3.586a1 1 0 0 1-.293.707l-7.414 7.414a2 2 0 0 1-2.828 0L3.879 14.12a2 2 0 0 1 0-2.828L11.293 3.293A1 1 0 0 1 12 3Z" />
                        </svg>
                        Category
                    </a>

                    <!-- Program -->
                    <a href="{{ route('admin.program') }}"
                    @class([
                        'flex items-center rounded-xl px-3 py-2 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#6AAEAD] focus-visible:ring-offset-0',
                        'bg-[#C1DCDC]/80 text-[#1E4B4B] font-semibold shadow-sm ring-1 ring-[#6AAEAD]/60' => Request::routeIs('admin.program*'),
                        'text-[#285E5E] hover:bg-[#C1DCDC]/40 hover:text-[#0F3535]' => !Request::routeIs('admin.program*'),
                    ])>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#285E5E]" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 6h6m-6 4h6m-6 4h4m7-6V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8l4-4v-6z" />
                        </svg>
                        Program
                    </a>

                    <!-- Testimonial -->
                    <a href="{{ route('admin.testimonial') }}"
                    @class([
                        'flex items-center gap-2 rounded-xl px-3 py-2 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#6AAEAD]',
                        'bg-[#C1DCDC]/80 text-[#1E4B4B] font-semibold shadow-sm ring-1 ring-[#6AAEAD]/60'
                            => Request::routeIs('admin.testimonial*'),
                        'text-[#285E5E] hover:bg-[#C1DCDC]/40 hover:text-[#0F3535]'
                            => !Request::routeIs('admin.testimonial*'),
                    ])>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-current"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 9h4m-6 4h6m6-5h-3m-1 4h4m-9 7l-3 1 1-3m13-2a3 3 0 01-3 3H9a3 3 0 01-3-3V7a3 3 0 013-3h8a3 3 0 013 3v10z" />
                        </svg>
                        Testimonial
                    </a>

                </nav>

                <!-- Admin Info -->
                @php
                    $admin = Auth::user();
                    $adminName  = $admin->name ?? 'Admin';
                    $adminEmail = $admin->email ?? 'admin@example.com';

                    $adminAvatar = $admin && $admin->img
                        ? asset('storage/users/' . $admin->img)
                        : null;

                    $initials = 'AD';
                    if (!empty($adminName)) {
                        $parts = explode(' ', trim($adminName));
                        $first = $parts[0] ?? '';
                        $second = $parts[1] ?? '';
                        $initials = strtoupper(
                            mb_substr($first, 0, 1) .
                            ($second ? mb_substr($second, 0, 1) : '')
                        );
                    }
                @endphp

                <div class="border-t border-[#C1DCDC]/60 p-4 text-sm">
                    <div class="flex items-center">
                        @if($adminAvatar)
                            <img
                                src="{{ $adminAvatar }}"
                                alt="{{ $adminName }}"
                                class="h-10 w-10 rounded-full object-cover border border-[#C1DCDC]/70 shadow-sm"
                            >
                        @else
                            <div class="h-10 w-10 rounded-full bg-[#6AAEAD] text-white flex items-center justify-center font-semibold shadow-sm">
                                {{ $initials }}
                            </div>
                        @endif

                        <div class="ml-3">
                            <div class="text-[#1E4B4B] font-semibold leading-tight">
                                {{ $adminName }}
                            </div>
                            <div class="text-xs text-[#285E5E]/80">
                                {{ $adminEmail }}
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- CONTENT AREA -->
            <div class="flex-1 flex flex-col min-w-0 ml-0 md:ml-64">

                <!-- TOP BAR -->
                <header class="h-16 flex items-center justify-between px-4 md:px-6 bg-white/70 backdrop-blur-xl border-b border-[#C1DCDC]/60 shadow-sm sticky top-0 z-10">
                    <div class="flex items-center gap-3">
                        <button class="md:hidden inline-flex items-center justify-center rounded-lg border border-[#C1DCDC]/70 bg-white/80 p-2 text-[#285E5E] hover:bg-[#C1DCDC]/40 hover:text-[#0F3535] transition" title="Menu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <div>
                            <div class="text-[#1E4B4B] font-semibold text-sm leading-tight">
                                @yield('page_title')
                            </div>
                            <div class="text-xs text-[#285E5E]/80 leading-tight">
                                @yield('page_subtitle')
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <!-- Notification button -->
                        <button class="relative inline-flex items-center rounded-xl border border-[#6AAEAD]/70 bg-white/80 px-3 py-1.5 text-xs font-medium text-[#285E5E] hover:bg-[#C1DCDC]/40 hover:text-[#0F3535] transition focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:ring-offset-0" title="Notifications">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-[#285E5E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C8.67 6.165 8 7.388 8 8.75v5.407c0 .538-.214 1.055-.595 1.436L6 17h5" />
                            </svg>
                            <span>3</span>
                        </button>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="inline-flex items-center rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-3 py-1.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Logout
                            </button>
                        </form>
                    </div>
                </header>

                <!-- PAGE CONTENT -->
                <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-[#C1DCDC]/60 backdrop-blur-sm rounded-xl">
                    @yield('content')
                </main>

            </div>

        </div>
    </body>

</html>
