@extends('admin.layouts.main')

@section('title', 'Home | Admin Govind')
@section('page_title', 'Home')
@section('page_subtitle', 'System overview & statistics')

@section('content')

    @php
        $userTrendUp    = ($userGrowthPercent ?? 0) >= 0;
        $progTrendUp    = ($programGrowthPercent ?? 0) >= 0;
        $healthWidth    = min(100, max(0, $healthScore ?? 100));
        $activeProgRate = $totalPrograms > 0 ? ($activePrograms / $totalPrograms) * 100 : 0;
    @endphp

    <!-- TOP STATISTIC CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        <!-- Users -->
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)] p-4">
            <div class="text-xs text-[#285E5E]/80 font-medium flex items-center justify-between">
                <span>Total Users</span>
                <span class="inline-flex items-center text-[10px] font-semibold
                    {{ $userTrendUp ? 'text-emerald-700 bg-emerald-50' : 'text-red-700 bg-red-50' }}
                    px-2 py-0.5 rounded-full">
                    @if($userGrowthPercent !== null)
                        @if($userTrendUp) ↑ @else ↓ @endif
                        {{ number_format($userGrowthPercent, 1) }}%
                    @else
                        —
                    @endif
                </span>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <div>
                    <div class="text-2xl font-semibold text-[#1E4B4B] leading-none">
                        {{ number_format($totalUsers) }}
                    </div>
                    <div class="text-[11px] text-[#285E5E]/80 mt-1">
                        Joined this month:
                        <span class="font-semibold text-[#1E4B4B]">
                            {{ number_format($usersThisMonth) }}
                        </span>
                    </div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-[#6AAEAD] text-white flex items-center justify-center shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1116.5 0"/>
                    </svg>
                </div>
            </div>

            {{-- progress kecil: user baru bulan ini vs total --}}
            <div class="mt-3">
                @php
                    $userRate = $totalUsers > 0 ? min(100, ($usersThisMonth / max(1, $totalUsers)) * 100) : 0;
                @endphp
                <div class="h-1.5 w-full rounded-full bg-slate-100 overflow-hidden">
                    <div class="h-full bg-[#6AAEAD]" style="width: {{ $userRate }}%"></div>
                </div>
                <p class="mt-1 text-[10px] text-[#285E5E]/70">
                    {{ number_format($userRate, 1) }}% of current users registered this month
                </p>
            </div>
        </div>

        <!-- Programs -->
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)] p-4">
            <div class="text-xs text-[#285E5E]/80 font-medium flex items-center justify-between">
                <span>Programs</span>
                <span class="inline-flex items-center text-[10px] font-semibold
                    {{ $progTrendUp ? 'text-emerald-700 bg-emerald-50' : 'text-red-700 bg-red-50' }}
                    px-2 py-0.5 rounded-full">
                    @if($programGrowthPercent !== null)
                        @if($progTrendUp) ↑ @else ↓ @endif
                        {{ number_format($programGrowthPercent, 1) }}%
                    @else
                        —
                    @endif
                </span>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <div>
                    <div class="text-2xl font-semibold text-[#1E4B4B] leading-none">
                        {{ number_format($totalPrograms) }}
                    </div>
                    <div class="text-[11px] text-[#285E5E]/80 mt-1">
                        Active:
                        <span class="font-semibold text-[#1E4B4B]">
                            {{ number_format($activePrograms) }}
                        </span>
                        &nbsp;•&nbsp;New this month: {{ number_format($programsThisMonth) }}
                    </div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-[#6AAEAD] text-white flex items-center justify-center shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 6H7a2 2 0 01-2-2V6a2 2 0 012-2h3l1-2h2l1 2h3a2 2 0 012 2v14a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>

            {{-- progress: program aktif --}}
            <div class="mt-3">
                <div class="h-1.5 w-full rounded-full bg-slate-100 overflow-hidden">
                    <div class="h-full bg-[#6AAEAD]" style="width: {{ $activeProgRate }}%"></div>
                </div>
                <p class="mt-1 text-[10px] text-[#285E5E]/70">
                    {{ number_format($activeProgRate, 1) }}% of programs are marked as active
                </p>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)] p-4">
            <div class="text-xs text-[#285E5E]/80 font-medium flex items-center justify-between">
                <span>Testimonials</span>
                <span class="inline-flex items-center text-[10px] font-semibold text-[#1E4B4B] bg-[#C1DCDC]/60 px-2 py-0.5 rounded-full">
                    +{{ number_format($testimonialsThisMonth) }} this month
                </span>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <div>
                    <div class="text-2xl font-semibold text-[#1E4B4B] leading-none">
                        {{ number_format($totalTestimonials) }}
                    </div>
                    <div class="text-[11px] text-[#285E5E]/80 mt-1">
                        Feedbacks from participants
                    </div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-[#6AAEAD] text-white flex items-center justify-center shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 9h4m-6 4h6m6-5h-3m-1 4h4m-9 7l-3 1 1-3m13-2a3 3 0 01-3 3H9a3 3 0 01-3-3V7a3 3 0 013-3h8a3 3 0 013 3v10z"/>
                    </svg>
                </div>
            </div>

            <div class="mt-3 text-[10px] text-[#285E5E]/70">
                Use testimonials to validate program impact & marketing materials.
            </div>
        </div>

        <!-- System Health -->
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)] p-4">
            <div class="text-xs text-[#285E5E]/80 font-medium flex items-center justify-between">
                <span>System Health</span>
                <span class="inline-flex items-center text-[10px] font-semibold
                    {{ $healthScore >= 90 ? 'text-emerald-700 bg-emerald-50' : 'text-amber-700 bg-amber-50' }}
                    px-2 py-0.5 rounded-full">
                    {{ $healthScore >= 90 ? 'Stable' : 'Attention' }}
                </span>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <div>
                    <div class="text-2xl font-semibold text-[#1E4B4B] leading-none">
                        {{ number_format($healthScore, 2) }}%
                    </div>
                    <div class="text-[11px] text-[#285E5E]/80 mt-1">
                        Based on active programs & user base
                    </div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-[#6AAEAD] text-white flex items-center justify-center shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 12l3.5 3.5L19.5 6"/>
                    </svg>
                </div>
            </div>

            <div class="mt-3">
                <div class="h-1.5 w-full rounded-full bg-slate-100 overflow-hidden">
                    <div class="h-full bg-[#6AAEAD]" style="width: {{ $healthWidth }}%"></div>
                </div>
                <p class="mt-1 text-[10px] text-[#285E5E]/70">
                    Keep programs updated & monitor user growth to maintain system health.
                </p>
            </div>
        </div>
    </div>

    <!-- BOTTOM GRID -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
        <!-- Recent Activity -->
        <div class="xl:col-span-2 bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)]">
            <div class="px-4 py-3 border-b border-[#C1DCDC]/60 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-[#1E4B4B]">Recent Activity</h2>
                <span class="text-[11px] text-[#285E5E]/80">
                    Last {{ $activities->count() }} events
                </span>
            </div>

            <ul class="divide-y divide-[#C1DCDC]/70 text-sm">
                @forelse($activities as $activity)
                    @php
                        $type = $activity['type'];
                        $created = $activity['created_at'];

                        switch ($type) {
                            case 'user':
                                $icon = '
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        class="h-5 w-5 block text-white" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1116.5 0"/>
                                    </svg>
                                ';
                                $bgIcon  = '#6AAEAD';
                                $badgeBg = 'bg-[#C1DCDC]/70 text-[#1E4B4B]';
                                break;

                            case 'program':
                                $icon = '
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        class="h-5 w-5 block text-white" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 6H7a2 2 0 01-2-2V6a2 2 0 012-2h3l1-2h2l1 2h3a2 2 0 012 2v14a2 2 0 01-2 2z"/>
                                    </svg>
                                ';
                                $bgIcon  = '#6AAEAD';
                                $badgeBg = 'bg-[#FFF7D1] text-[#9A7B16]';
                                break;

                            case 'testimonial':
                            default:
                                $icon = '
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        class="h-5 w-5 block text-white" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9h4m-6 4h6m6-5h-3m-1 4h4m-9 7l-3 1 1-3m13-2a3 3 0 01-3 3H9a3 3 0 01-3-3V7a3 3 0 013-3h8a3 3 0 013 3v10z"/>
                                    </svg>
                                ';
                                $bgIcon  = '#6AAEAD';
                                $badgeBg = 'bg-emerald-50 text-emerald-700';
                                break;
                        }
                    @endphp
                    <li class="px-4 py-3 flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl grid place-items-center" style="background: {{ $bgIcon }}">
                            {!! $icon !!}
                        </div>
                        <div class="flex-1">
                            <div class="text-[#1E4B4B] font-medium">
                                {{ $activity['title'] }}
                            </div>
                            <div class="text-[11px] text-[#285E5E]/80 mt-0.5">
                                {{ $activity['subtitle'] }}
                            </div>
                            <div class="text-[10px] text-[#285E5E]/70 mt-0.5">
                                {{ $created?->diffForHumans() }}
                            </div>
                        </div>
                        <span class="text-[10px] inline-flex items-center rounded-lg px-2 py-0.5 font-semibold {{ $badgeBg }}">
                            {{ $activity['label'] }}
                        </span>
                    </li>
                @empty
                    <li class="px-4 py-6 text-center text-[13px] text-[#285E5E]/70">
                        No activity recorded yet.
                    </li>
                @endforelse
            </ul>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)] flex flex-col">
            <div class="px-4 py-3 border-b border-[#C1DCDC]/60 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-[#1E4B4B]">Quick Actions</h2>
            </div>

            <div class="p-4 text-sm space-y-3">
                <!-- Add User -->
                <a href="{{ route('admin.user') }}"
                   class="w-full flex items-center justify-between rounded-xl border border-[#C1DCDC]/80 bg-white/70 px-3 py-2 hover:bg-[#F3FBFB] hover:border-[#6AAEAD] transition focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:ring-offset-0">
                    <div class="flex items-start">
                        <div class="h-9 w-9 rounded-lg bg-[#6AAEAD] flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5 block text-white" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1116.5 0"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[#1E4B4B] font-medium leading-tight">Manage Users</div>
                            <div class="text-[11px] text-[#285E5E]/80 leading-tight">View & create new accounts</div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#285E5E]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- Manage Programs -->
                <a href="{{ route('admin.program') }}"
                   class="w-full flex items-center justify-between rounded-xl border border-[#C1DCDC]/80 bg-white/70 px-3 py-2 hover:bg-[#F3FBFB] hover:border-[#6AAEAD] transition focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:ring-offset-0">
                    <div class="flex items-start">
                        <div class="h-9 w-9 rounded-lg bg-[#6AAEAD] flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5 block text-white" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 6H7a2 2 0 01-2-2V6a2 2 0 012-2h3l1-2h2l1 2h3a2 2 0 012 2v14a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[#1E4B4B] font-medium leading-tight">Manage Programs</div>
                            <div class="text-[11px] text-[#285E5E]/80 leading-tight">Create & update certification programs</div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#285E5E]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- View Testimonials -->
                <a href="{{ route('admin.testimonial') }}"
                   class="w-full flex items-center justify-between rounded-xl border border-[#C1DCDC]/80 bg-white/70 px-3 py-2 hover:bg-[#F3FBFB] hover:border-[#6AAEAD] transition focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:ring-offset-0">
                    <div class="flex items-start">
                        <div class="h-9 w-9 rounded-lg bg-[#6AAEAD] flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-5 w-5 block text-white" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 9h4m-6 4h6m6-5h-3m-1 4h4m-9 7l-3 1 1-3m13-2a3 3 0 01-3 3H9a3 3 0 01-3-3V7a3 3 0 013-3h8a3 3 0 013 3v10z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[#1E4B4B] font-medium leading-tight">View Testimonials</div>
                            <div class="text-[11px] text-[#285E5E]/80 leading-tight">Monitor participant feedback</div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#285E5E]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

@endsection
