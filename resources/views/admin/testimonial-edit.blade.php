@extends('admin.layouts.main')

@section('title', 'Edit Testimonial | Admin Govind')
@section('page_title', 'Testimonials')
@section('page_subtitle', 'Edit testimonial')

@section('content')

    <section class="space-y-4">

        @include('admin.partials.validation-errors')

        <div class="max-w-lg bg-white/90 rounded-2xl border border-[#C1DCDC]/70 shadow-sm overflow-hidden">

            {{-- Header --}}
            <div class="px-5 py-4 border-b border-[#C1DCDC]/70 bg-[#F4FBFA]">
                <h1 class="text-sm font-semibold text-[#1E4B4B] leading-tight">
                    Edit Testimonial
                </h1>
                <p class="text-[11px] text-[#285E5E]/80 leading-tight mt-0.5">
                    Update client name, occupation, testimonial text, and visibility.
                </p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.testimonial.update', $testimonial->id) }}" class="px-5 py-5 space-y-4">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-[12px] font-medium text-[#285E5E] mb-1">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        required
                        maxlength="255"
                        value="{{ old('name', $testimonial->name) }}"
                        class="w-full rounded-xl border border-[#C1DCDC]/80 bg-white px-3 py-2 text-[13px] text-[#285E5E] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]"
                        placeholder="Client name"
                    >
                </div>

                {{-- Occupation --}}
                <div>
                    <label for="occupation" class="block text-[12px] font-medium text-[#285E5E] mb-1">
                        Occupation / Role
                    </label>
                    <input
                        type="text"
                        name="occupation"
                        id="occupation"
                        maxlength="255"
                        value="{{ old('occupation', $testimonial->occupation) }}"
                        class="w-full rounded-xl border border-[#C1DCDC]/80 bg-white px-3 py-2 text-[13px] text-[#285E5E] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]"
                        placeholder="e.g. HR Manager, Participant, Student"
                    >
                </div>

                {{-- Text --}}
                <div>
                    <label for="text" class="block text-[12px] font-medium text-[#285E5E] mb-1">
                        Testimonial Text <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="text"
                        id="text"
                        rows="4"
                        required
                        maxlength="255"
                        class="w-full rounded-xl border border-[#C1DCDC]/80 bg-white px-3 py-2 text-[13px] text-[#285E5E] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD] resize-none"
                        placeholder="Client feedback"
                    >{{ old('text', $testimonial->text) }}</textarea>
                </div>

                {{-- Visibility --}}
                <div>
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input
                            type="checkbox"
                            name="is_visible"
                            value="1"
                            @checked(old('name') !== null ? old('is_visible') : $testimonial->is_visible)
                            class="rounded border-[#C1DCDC] text-[#6AAEAD] focus:ring-[#6AAEAD]"
                        >
                        <span class="text-[12px] text-[#285E5E]">
                            Show this testimonial on public site
                        </span>
                    </label>
                </div>

                {{-- Actions --}}
                <div class="pt-2 flex items-center justify-end gap-3">
                    <a
                        href="{{ route('admin.testimonial') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-[12px] font-medium text-slate-600 hover:bg-slate-50 transition-colors"
                    >
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-[#6AAEAD] px-5 py-2 text-[12px] font-medium text-white hover:bg-[#5ba09f] transition-colors shadow-sm"
                    >
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

    </section>

@endsection
