{{-- Pesan validasi (form di modal tertutup lagi setelah redirect, jadi error ditampilkan di atas halaman) --}}
@if ($errors->any())
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
            <ul class="mt-1 text-[12px] leading-tight list-disc pl-4 space-y-0.5">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        <button @click="show=false"
                class="ml-4 text-red-600 hover:text-red-800 text-xs font-semibold">
            ✕
        </button>
    </div>
@endif
