@extends('admin.layouts.main')

@section('title', 'Testimonials | Admin Govind')
@section('page_title', 'Testimonials')
@section('page_subtitle', 'Clients & participants feedback')

@section('content')

    <section class="space-y-4">

        {{-- FLASH --}}
        @if (session('success'))
            <div
                x-data="{show:true}"
                x-show="show"
                x-transition
                class="rounded-xl border border-[#6AAEAD]/70 bg-[#E3F7F6] text-[#1E4B4B] text-[13px] px-4 py-3 flex items-start justify-between shadow-sm"
            >
                <div class="flex-1">
                    <div class="font-semibold text-[13px] leading-tight">
                        Success
                    </div>
                    <div class="text-[12px] leading-tight">
                        {{ session('success') }}
                    </div>
                </div>
                <button @click="show=false"
                        class="ml-4 text-[#285E5E] hover:text-[#0F3535] text-xs font-semibold">
                    ✕
                </button>
            </div>
        @endif

        @if (session('error'))
            <div
                x-data="{show:true}"
                x-show="show"
                x-transition
                class="rounded-xl border border-red-300 bg-red-50/80 text-red-700 text-[13px] px-4 py-3 flex items-start justify-between shadow-sm"
            >
                <div class="flex-1">
                    <div class="font-semibold text-[13px] leading-tight">
                        Failed
                    </div>
                    <div class="text-[12px] leading-tight">
                        {{ session('error') }}
                    </div>
                </div>
                <button @click="show=false"
                        class="ml-4 text-red-600 hover:text-red-800 text-xs font-semibold">
                    ✕
                </button>
            </div>
        @endif

        {{-- HEADER --}}
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-base font-semibold text-[#1E4B4B] leading-tight">Testimonial List</h1>
                <p class="text-[11px] text-[#285E5E]/80 leading-tight">
                    Total:
                    <span class="font-semibold text-[#1E4B4B]">
                        {{ $testimonials->total() ?? $testimonials->count() }}
                    </span>
                    testimonials recorded
                </p>

                @if(request('q'))
                    <div class="text-[11px] text-[#285E5E]/80 leading-tight mt-1">
                        Search results for:
                        <span class="font-semibold text-[#1E4B4B]">"{{ request('q') }}"</span>
                    </div>
                @endif
            </div>

            {{-- SEARCH --}}
            <form action="{{ route('admin.testimonial') }}" method="GET" class="flex items-center gap-2">
                <div class="relative">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        class="w-48 sm:w-60 rounded-xl border border-[#C1DCDC]/80 bg-white/70 px-3 py-2 pr-8 text-[12px] text-[#285E5E] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]"
                        placeholder="Search name / role / text..."
                    />
                    <button type="submit"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-[#285E5E]/70 hover:text-[#0F3535]"
                            title="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z"/>
                        </svg>
                    </button>
                </div>

                @if(request('q'))
                    <a href="{{ route('admin.testimonial') }}"
                       class="text-[11px] text-[#285E5E]/80 hover:text-[#0F3535] underline">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- WRAPPER CARD --}}
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)]">

            {{-- TOP BAR INFO --}}
            <div class="px-4 py-3 border-b border-[#C1DCDC]/60 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div class="text-[11px] text-[#285E5E]/80 leading-tight">
                    Showing
                    <span class="font-semibold text-[#1E4B4B]">
                        {{ $testimonials->firstItem() ?? 1 }} - {{ $testimonials->lastItem() ?? $testimonials->count() }}
                    </span>
                    of
                    <span class="font-semibold text-[#1E4B4B]">
                        {{ $testimonials->total() ?? $testimonials->count() }}
                    </span>
                    testimonials
                </div>
                <div class="text-[11px] text-[#285E5E]/70">
                    Manage visibility and content of client testimonials.
                </div>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-[#285E5E]">
                    <thead class="text-[11px] uppercase tracking-wide text-[#285E5E] bg-[#E8F3F3]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">No</th>
                            <th class="px-4 py-3 font-semibold">Client</th>
                            <th class="px-4 py-3 font-semibold">Occupation</th>
                            <th class="px-4 py-3 font-semibold">Testimonial</th>
                            <th class="px-4 py-3 font-semibold">Date</th>
                            <th class="px-4 py-3 font-semibold text-center">Status</th>
                            <th class="px-4 py-3 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#C1DCDC]/70 text-[13px]">
                        @forelse($testimonials as $index => $t)
                            @php
                                $avatarUrl = $t->img
                                    ? asset('storage/users/' . $t->img)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($t->name) . '&background=C1DCDC&color=1E4B4B&size=64';
                            @endphp

                            <tr class="hover:bg-[#F3FBFB] transition-colors">
                                {{-- No --}}
                                <td class="px-4 py-3 align-top text-[#285E5E]/80">
                                    @if(method_exists($testimonials, 'firstItem'))
                                        {{ $testimonials->firstItem() + $index }}
                                    @else
                                        {{ $index + 1 }}
                                    @endif
                                </td>

                                {{-- Client + avatar --}}
                                <td class="px-4 py-3 align-top">
                                    <div class="flex items-start gap-3">
                                        <div class="h-9 w-9 rounded-full overflow-hidden bg-[#E3F2F2] flex items-center justify-center shadow-sm">
                                            @if($t->img)
                                                <img src="{{ $avatarUrl }}" alt="Avatar {{ $t->name }}" class="h-full w-full object-cover">
                                            @else
                                                <div class="h-full w-full bg-[#C1DCDC] text-[#1E4B4B] grid place-items-center font-semibold">
                                                    {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($t->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="leading-tight text-[#1E4B4B] font-medium">
                                                {{ $t->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Occupation --}}
                                <td class="px-4 py-3 align-top">
                                    <span class="inline-flex items-center rounded-lg px-2 py-1 text-[11px] font-medium
                                        bg-[#E8F3F3] text-[#285E5E]">
                                        {{ $t->occupation ?: '—' }}
                                    </span>
                                </td>

                                {{-- Testimonial text --}}
                                <td class="px-4 py-3 align-top">
                                    <p class="text-[13px] text-[#285E5E] leading-relaxed">
                                        “{{ \Illuminate\Support\Str::limit($t->text, 160) }}”
                                    </p>
                                </td>

                                {{-- Date --}}
                                <td class="px-4 py-3 align-top">
                                    <div class="text-[12px] text-[#285E5E]">
                                        {{ $t->created_at?->format('d M Y') ?? '-' }}
                                    </div>
                                </td>

                                {{-- Status (checkbox toggle) --}}
                                <td class="px-4 py-3 align-top">
                                    <div class="flex items-center justify-center">
                                        <form action="{{ route('admin.testimonial.toggle', $t->id) }}" method="POST" class="flex items-center">
                                            @csrf
                                            @method('PATCH')
                                            <label class="inline-flex items-center gap-2 cursor-pointer text-[11px] text-[#285E5E]">
                                                <input
                                                    type="checkbox"
                                                    name="is_visible"
                                                    value="1"
                                                    onchange="this.form.submit()"
                                                    {{ $t->is_visible ? 'checked' : '' }}
                                                    class="h-4 w-4 rounded border-[#C1DCDC] text-[#6AAEAD] focus:ring-[#6AAEAD]"
                                                >
                                                <span>
                                                    {{ $t->is_visible ? 'Visible' : 'Hidden' }}
                                                </span>
                                            </label>
                                        </form>
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td class="px-4 py-3 align-top">
                                    <div class="flex items-center justify-end">
                                        {{-- Edit button with requested style --}}
                                        <button type="button"
                                            data-edit-testimonial
                                            data-id="{{ $t->id }}"
                                            data-name="{{ e($t->name) }}"
                                            data-occupation="{{ e($t->occupation) }}"
                                            data-text="{{ e($t->text) }}"
                                            data-visible="{{ $t->is_visible ? '1' : '0' }}"
                                            class="inline-flex items-center rounded-lg border border-[#6AAEAD] bg-[#E3F7F6] px-2 py-1 text-[11px] font-medium text-[#1E4B4B] hover:bg-[#D4EFEE] transition"
                                            title="Edit testimonial"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 3.487a2.1 2.1 0 0 1 2.97 2.97l-9.32 9.32a4.5 4.5 0 0 1-1.773 1.08l-3.003.858a.75.75 0 0 1-.923-.923l.858-3.003a4.5 4.5 0 0 1 1.08-1.773l9.32-9.32z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12.75v6.75A1.5 1.5 0 0 1 18 21H6a1.5 1.5 0 0 1-1.5-1.5v-12A1.5 1.5 0 0 1 6 6h6.75" />
                                            </svg>
                                            <span>Edit</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-[13px] text-[#285E5E]/70">
                                    No testimonials yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if(method_exists($testimonials, 'links'))
                <div class="px-4 py-3 border-t border-[#C1DCDC]/60 flex items-center justify-between text-[12px] text-[#285E5E]/90">
                    <div>
                        Showing
                        <span class="font-semibold text-[#1E4B4B]">{{ $testimonials->firstItem() }}</span>
                        -
                        <span class="font-semibold text-[#1E4B4B]">{{ $testimonials->lastItem() }}</span>
                        of
                        <span class="font-semibold text-[#1E4B4B]">{{ $testimonials->total() }}</span>
                        testimonials
                    </div>
                    <div class="text-[#285E5E]">
                        {{ $testimonials->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>

    </section>

    {{-- ================= MODAL EDIT TESTIMONIAL ================= --}}
    <div
        id="editTestimonialModal"
        class="fixed inset-0 z-50 hidden"
        aria-hidden="true"
    >
        {{-- Overlay --}}
        <div
            class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"
            data-modal-overlay
        ></div>

        {{-- Modal Card --}}
        <div class="relative min-h-full flex items-center justify-center px-4 py-8">
            <div class="relative w-full max-w-lg bg-white/90 rounded-2xl border border-[#C1DCDC]/70 shadow-[0_24px_80px_rgba(15,23,42,0.25)] overflow-hidden">

                {{-- Header --}}
                <div class="px-5 py-4 border-b border-[#C1DCDC]/70 flex items-center justify-between bg-[#F4FBFA]">
                    <div>
                        <h2 class="text-sm font-semibold text-[#1E4B4B] leading-tight">
                            Edit Testimonial
                        </h2>
                        <p class="text-[11px] text-[#285E5E]/80 leading-tight mt-0.5">
                            Update client name, occupation, testimonial text, and visibility.
                        </p>
                    </div>
                    <button
                        type="button"
                        class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white text-[#285E5E] hover:bg-[#E3F7F6] hover:text-[#0F3535] shadow-sm text-sm"
                        data-modal-close
                        aria-label="Close"
                    >
                        ✕
                    </button>
                </div>

                {{-- Form --}}
                <form id="editTestimonialForm" method="POST" class="px-5 py-5 space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="edit-name"
                            class="w-full rounded-xl border border-[#C1DCDC]/80 bg-white px-3 py-2 text-[13px] text-[#285E5E] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]"
                            placeholder="Client name"
                        >
                    </div>

                    {{-- Occupation --}}
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">
                            Occupation / Role
                        </label>
                        <input
                            type="text"
                            name="occupation"
                            id="edit-occupation"
                            class="w-full rounded-xl border border-[#C1DCDC]/80 bg-white px-3 py-2 text-[13px] text-[#285E5E] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]"
                            placeholder="e.g. HR Manager, Participant, Student"
                        >
                    </div>

                    {{-- Text --}}
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">
                            Testimonial Text <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            name="text"
                            id="edit-text"
                            rows="4"
                            class="w-full rounded-xl border border-[#C1DCDC]/80 bg-white px-3 py-2 text-[13px] text-[#285E5E] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD] resize-none"
                            placeholder="Client feedback"
                        ></textarea>
                    </div>

                    {{-- Visibility --}}
                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                name="is_visible"
                                id="edit-visible"
                                value="1"
                                class="rounded border-[#C1DCDC] text-[#6AAEAD] focus:ring-[#6AAEAD]"
                            >
                            <span class="text-[12px] text-[#285E5E]">
                                Show this testimonial on public site
                            </span>
                        </label>
                    </div>

                    {{-- Actions --}}
                    <div class="pt-2 flex items-center justify-end gap-3">
                        <button
                            type="button"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-[12px] font-medium text-slate-600 hover:bg-slate-50 transition-colors"
                            data-modal-close
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-[#6AAEAD] px-5 py-2 text-[12px] font-medium text-white hover:bg-[#5ba09f] transition-colors shadow-sm"
                        >
                            Save Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- SCRIPT: HANDLE EDIT MODAL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal     = document.getElementById('editTestimonialModal');
            const form      = document.getElementById('editTestimonialForm');
            const nameInput = document.getElementById('edit-name');
            const occInput  = document.getElementById('edit-occupation');
            const textInput = document.getElementById('edit-text');
            const visInput  = document.getElementById('edit-visible');

            if (!modal || !form) return;

            const baseUpdateUrl = "{{ route('admin.testimonial.update', '__ID__') }}";

            function openModal(data) {
                form.action = baseUpdateUrl.replace('__ID__', data.id);
                nameInput.value = data.name || '';
                occInput.value  = data.occupation || '';
                textInput.value = data.text || '';
                visInput.checked = data.visible === '1';

                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeModal() {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            document.querySelectorAll('[data-edit-testimonial]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const ds = this.dataset;
                    openModal({
                        id:         ds.id,
                        name:       ds.name,
                        occupation: ds.occupation,
                        text:       ds.text,
                        visible:    ds.visible,
                    });
                });
            });

            modal.querySelectorAll('[data-modal-close], [data-modal-overlay]').forEach(function (el) {
                el.addEventListener('click', closeModal);
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        });
    </script>

@endsection
