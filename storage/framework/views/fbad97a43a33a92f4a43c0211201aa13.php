<?php $__env->startSection('title', 'Programs | Admin Govind'); ?>
<?php $__env->startSection('page_title', 'Programs'); ?>
<?php $__env->startSection('page_subtitle', 'Manage certification programs'); ?>

<?php $__env->startSection('content'); ?>

    <section
        x-data="programPage()"
        x-init="init({
            programs: <?php echo $programs->map(function($p){
                return [
                    'id'          => $p->id,
                    'name'        => $p->name,
                    'slug'        => $p->slug,
                    'category_id' => $p->category_id,
                    'category'    => $p->category?->name,
                    'duration'    => $p->duration,
                    'price'       => (string) $p->price,
                    'is_active'   => (bool) $p->is_active,
                    'short_desc'  => $p->short_desc,
                    'long_desc'   => $p->long_desc,
                    'image_url'   => $p->image_url,
                    'created_at'  => $p->created_at?->format('d M Y'),
                ];
            })->values()->toJson(); ?>

        })"
        class="space-y-4"
    >

        
        <?php if(session('success')): ?>
            <div
                x-data="{show:true}"
                x-show="show"
                x-transition
                class="rounded-xl border border-green-300 bg-green-50/80 text-green-700 text-[13px] px-4 py-3 flex items-start justify-between shadow-sm"
            >
                <div class="flex-1">
                    <div class="font-semibold text-[13px] leading-tight">Success</div>
                    <div class="text-[12px] leading-tight"><?php echo e(session('success')); ?></div>
                </div>
                <button @click="show=false" class="ml-4 text-green-600 hover:text-green-800 text-xs font-semibold">
                    ✕
                </button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div
                x-data="{show:true}"
                x-show="show"
                x-transition
                class="rounded-xl border border-red-300 bg-red-50/80 text-red-700 text-[13px] px-4 py-3 flex items-start justify-between shadow-sm"
            >
                <div class="flex-1">
                    <div class="font-semibold text-[13px] leading-tight">Failed</div>
                    <div class="text-[12px] leading-tight"><?php echo e(session('error')); ?></div>
                </div>
                <button @click="show=false" class="ml-4 text-red-600 hover:text-red-800 text-xs font-semibold">
                    ✕
                </button>
            </div>
        <?php endif; ?>

        <!-- HEADER -->
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-base font-semibold text-[#285E5E] leading-tight">Program List</h1>
                <p class="text-[11px] text-[#5A9A9A] leading-tight">
                    Total: <?php echo e($programs->total() ?? $programs->count()); ?> registered programs
                </p>

                <?php if(request('q')): ?>
                    <div class="text-[11px] text-[#5A9A9A] leading-tight mt-1">
                        Search results for:
                        <span class="font-semibold text-[#285E5E]">"<?php echo e(request('q')); ?>"</span>
                    </div>
                <?php endif; ?>
            </div>

            <button
                @click="openCreateModal()"
                type="button"
                class="inline-flex items-center justify-center rounded-xl bg-[#5AAEAE] hover:bg-[#489B9B] text-white text-xs font-semibold px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5AAEAE] transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                </svg>
                Add Program
            </button>
        </div>

        <!-- CARD WRAPPER -->
        <div class="bg-white/60 backdrop-blur-xl border border-[#A3D4D4] rounded-2xl shadow-sm">
            <!-- TOP BAR -->
            <div class="px-4 py-3 border-b border-[#A3D4D4] flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div class="text-[11px] text-[#5A9A9A] leading-tight">
                    Showing
                    <span class="font-semibold text-[#285E5E]"><?php echo e($programs->firstItem() ?? 1); ?> - <?php echo e($programs->lastItem() ?? $programs->count()); ?></span>
                    of
                    <span class="font-semibold text-[#285E5E]"><?php echo e($programs->total() ?? $programs->count()); ?></span>
                    programs
                </div>

                <form action="<?php echo e(route('admin.program')); ?>" method="GET" class="flex items-center gap-2">
                    <div class="relative">
                        <input
                            type="text"
                            name="q"
                            value="<?php echo e(request('q')); ?>"
                            class="w-48 sm:w-60 rounded-xl border border-[#A3D4D4] bg-white/70 px-3 py-2 pr-8 text-[12px] text-[#285E5E] placeholder-[#7FB1B1] focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]"
                            placeholder="Search name / category..."
                        />
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-[#7FB1B1] hover:text-[#285E5E]" title="Search">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" />
                            </svg>
                        </button>
                    </div>

                    <?php if(request('q')): ?>
                        <a href="<?php echo e(route('admin.program')); ?>"
                        class="text-[11px] text-[#5A9A9A] hover:text-[#285E5E] underline">
                            Reset
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-[#285E5E]">
                    <thead class="text-[11px] uppercase tracking-wide text-[#5A9A9A] bg-[#D7ECEC]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">No</th>
                            <th class="px-4 py-3 font-semibold">Program</th>
                            <th class="px-4 py-3 font-semibold">Category</th>
                            <th class="px-4 py-3 font-semibold">Duration</th>
                            <th class="px-4 py-3 font-semibold">Price</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                            <th class="px-4 py-3 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C5E2E2] text-[13px]">
                        <?php $__empty_1 = true; $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-[#E3F3F3] transition-colors">
                                <td class="px-4 py-3 align-top text-[#5A9A9A]">
                                    <?php echo e(($programs->firstItem() ?? 1) + $index); ?>

                                </td>

                                <!-- Program: image + name -->
                                <td class="px-4 py-3 align-top">
                                    <div class="flex items-start gap-3">
                                        <div class="h-10 w-10 rounded-xl overflow-hidden bg-[#D7ECEC] border border-[#A3D4D4] flex items-center justify-center shadow-sm">
                                            <img
                                                src="<?php echo e($program->image_url); ?>"
                                                alt="Image <?php echo e($program->name); ?>"
                                                class="h-full w-full object-cover"
                                            >
                                        </div>
                                        <div>
                                            <div class="leading-tight text-[#285E5E] font-semibold">
                                                <?php echo e($program->name); ?>

                                            </div>
                                            <div class="text-[11px] text-[#5A9A9A] leading-tight">
                                                Slug: <?php echo e($program->slug); ?>

                                            </div>
                                            <?php if($program->short_desc): ?>
                                                <div class="text-[11px] text-[#5A9A9A] leading-snug mt-1 line-clamp-2">
                                                    <?php echo e($program->short_desc); ?>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="px-4 py-3 align-top">
                                    <span class="inline-flex items-center rounded-lg px-2 py-1 text-[11px] font-medium bg-[#D7ECEC] text-[#285E5E]">
                                        <?php echo e($program->category?->name ?? '-'); ?>

                                    </span>
                                </td>

                                <!-- Duration -->
                                <td class="px-4 py-3 align-top">
                                    <div class="leading-tight text-[#285E5E]">
                                        <?php echo e($program->duration ?? '-'); ?>

                                    </div>
                                    <div class="text-[11px] text-[#5A9A9A] leading-tight">
                                        Created: <?php echo e($program->created_at?->format('d M Y') ?? '-'); ?>

                                    </div>
                                </td>

                                <!-- Price -->
                                <td class="px-4 py-3 align-top">
                                    <div class="leading-tight text-[#285E5E] font-semibold">
                                        Rp <?php echo e(number_format($program->price, 0, ',', '.')); ?>

                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-4 py-3 align-top">
                                    <span class="inline-flex items-center rounded-lg px-2 py-1 text-[10px] font-semibold
                                        <?php echo e($program->is_active
                                            ? 'bg-[#CDEFEA] text-[#2E6B63]'
                                            : 'bg-[#E3F3F3] text-[#5A9A9A]'); ?>">
                                        <?php echo e($program->is_active ? 'ACTIVE' : 'INACTIVE'); ?>

                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="px-4 py-3 align-top whitespace-nowrap">
                                    <div class="flex items-start justify-center gap-2">
                                        <button
                                            type="button"
                                            @click="openEditModal({
                                                id: <?php echo e($program->id); ?>,
                                                name: <?php echo \Illuminate\Support\Js::from($program->name)->toHtml() ?>,
                                                slug: <?php echo \Illuminate\Support\Js::from($program->slug)->toHtml() ?>,
                                                category_id: <?php echo e($program->category_id); ?>,
                                                duration: <?php echo \Illuminate\Support\Js::from($program->duration)->toHtml() ?>,
                                                price: '<?php echo e($program->price); ?>',
                                                short_desc: <?php echo \Illuminate\Support\Js::from($program->short_desc)->toHtml() ?>,
                                                long_desc: <?php echo \Illuminate\Support\Js::from($program->long_desc)->toHtml() ?>,
                                                is_active: <?php echo e($program->is_active ? 'true' : 'false'); ?>,
                                                image_url: <?php echo \Illuminate\Support\Js::from($program->image_url)->toHtml() ?>,
                                            })"
                                            class="inline-flex items-center rounded-lg border border-[#E3C45B] bg-[#FFF8D9] px-2 py-1 text-[11px] font-medium text-[#856300] hover:bg-[#FDEEB7] transition"
                                        >
                                            Edit
                                        </button>

                                        <form action="<?php echo e(route('admin.program.destroy', $program)); ?>" method="POST"
                                            onsubmit="return confirm('Delete this program?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button
                                                class="inline-flex items-center rounded-lg border border-red-400 bg-red-50/80 px-2 py-1 text-[11px] font-medium text-red-700 hover:bg-red-100 transition"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-[13px] text-[#5A9A9A]">
                                    No program data yet.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if(method_exists($programs, 'links')): ?>
                <div class="px-4 py-3 border-t border-[#A3D4D4] flex items-center justify-between text-[12px] text-[#417F7F]">
                    <div>
                        Showing
                        <span class="font-semibold text-[#285E5E]"><?php echo e($programs->firstItem()); ?></span>
                        -
                        <span class="font-semibold text-[#285E5E]"><?php echo e($programs->lastItem()); ?></span>
                        of
                        <span class="font-semibold text-[#285E5E]"><?php echo e($programs->total()); ?></span>
                        programs
                    </div>
                    <div class="text-[#285E5E]">
                        <?php echo e($programs->links('pagination::tailwind')); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>

        
        <div x-show="showCreate" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display:none;">
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="closeCreateModal()"></div>

            <div class="relative w-full max-w-2xl bg-white/95 rounded-2xl shadow-xl border border-[#A3D4D4]">
                <div class="px-5 py-4 border-b border-[#A3D4D4] flex items-start justify-between">
                    <div>
                        <div class="text-sm font-semibold text-[#285E5E] leading-tight">Add Program</div>
                        <div class="text-[11px] text-[#5A9A9A] leading-tight">Create a new certification program</div>
                    </div>
                    <button @click="closeCreateModal()" class="text-[#7FB1B1] hover:text-[#285E5E] text-sm font-semibold">
                        ✕
                    </button>
                </div>

                <form action="<?php echo e(route('admin.program.store')); ?>" method="POST" enctype="multipart/form-data" class="px-5 py-4 space-y-4 text-[13px]">
                    <?php echo csrf_field(); ?>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Program Name</label>
                        <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                            class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]" />
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">
                            Slug <span class="text-[11px] text-[#7FB1B1]">(auto generated if left blank)</span>
                        </label>
                        <input type="text" name="slug" value="<?php echo e(old('slug')); ?>"
                            class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]" />
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Category</label>
                        <select name="category_id" required
                            class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]">
                            <option value="" disabled selected>Select a category...</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"
                                    <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Duration</label>
                            <input type="text" name="duration" value="<?php echo e(old('duration')); ?>" placeholder="Example: 3 Months"
                                class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                    focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]" />
                        </div>
                        <div>
                            <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Price</label>
                            <input type="number" name="price" value="<?php echo e(old('price', 0)); ?>" min="0"
                                class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                    focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]" />
                        </div>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">
                            Short Description
                            <span class="text-[11px] text-[#7FB1B1]">(can be multiline & emoji)</span>
                        </label>
                        <textarea name="short_desc" rows="2"
                            class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]"
                            placeholder="Short program description... 😊"><?php echo e(old('short_desc')); ?></textarea>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">
                            Full Description
                        </label>
                        <textarea name="long_desc" rows="4"
                            class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]"
                            placeholder="Full program explanation, benefits, modules, etc."><?php echo e(old('long_desc')); ?></textarea>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">
                            Program Image
                            <span class="text-[11px] text-[#7FB1B1]">(optional)</span>
                        </label>
                        <input type="file" name="img" accept="image/*"
                            class="block w-full text-[12px] text-[#285E5E]
                                file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0
                                file:text-[11px] file:font-semibold
                                file:bg-[#D7ECEC] file:text-[#285E5E]
                                hover:file:bg-[#C4E2E2] cursor-pointer" />
                        <p class="mt-1 text-[11px] text-[#7FB1B1]">
                            Formats: JPG, JPEG, PNG, WEBP. Maximum 4 MB.
                        </p>
                    </div>

                    
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="create_is_active" value="1" checked
                            class="h-3.5 w-3.5 rounded border-[#A3D4D4] text-[#5AAEAE] focus:ring-[#5AAEAE]" />
                        <label for="create_is_active" class="text-[12px] text-[#285E5E]">Active</label>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2 text-[12px]">
                        <button type="button"
                            @click="closeCreateModal()"
                            class="inline-flex items-center rounded-xl border border-[#A3D4D4] bg-white/70 px-3 py-2 font-medium text-[#285E5E] hover:bg-white transition">
                            Cancel
                        </button>

                        <button type="submit"
                            class="inline-flex items-center rounded-xl bg-[#5AAEAE] hover:bg-[#489B9B] text-white font-semibold px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5AAEAE]">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

        
        <div x-show="showEdit" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display:none;">
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="closeEditModal()"></div>

            <div class="relative w-full max-w-2xl bg-white/95 rounded-2xl shadow-xl border border-[#A3D4D4]">
                <div class="px-5 py-4 border-b border-[#A3D4D4] flex items-start justify-between">
                    <div>
                        <div class="text-sm font-semibold text-[#285E5E] leading-tight">Edit Program</div>
                        <div class="text-[11px] text-[#5A9A9A] leading-tight">Update program information</div>
                    </div>
                    <button @click="closeEditModal()" class="text-[#7FB1B1] hover:text-[#285E5E] text-sm font-semibold">
                        ✕
                    </button>
                </div>

                <form :action="editActionUrl()" method="POST" enctype="multipart/form-data" class="px-5 py-4 space-y-4 text-[13px]">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <input type="hidden" name="id" x-model="editProgram.id" />

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Program Name</label>
                        <input type="text" name="name" required x-model="editProgram.name"
                            class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]" />
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Slug</label>
                        <input type="text" name="slug" x-model="editProgram.slug"
                            class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]" />
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Category</label>
                        <select name="category_id" x-model="editProgram.category_id"
                            class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Duration</label>
                            <input type="text" name="duration" x-model="editProgram.duration"
                                class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                    focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]" />
                        </div>
                        <div>
                            <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Price</label>
                            <input type="number" name="price" x-model="editProgram.price" min="0"
                                class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                    focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]" />
                        </div>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Short Description</label>
                        <textarea name="short_desc" rows="2" x-model="editProgram.short_desc"
                            class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]"></textarea>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Full Description</label>
                        <textarea name="long_desc" rows="4" x-model="editProgram.long_desc"
                            class="w-full rounded-xl border border-[#A3D4D4] px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]"></textarea>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">
                            Program Image
                            <span class="text-[11px] text-[#7FB1B1]">(leave empty if not changed)</span>
                        </label>

                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-xl overflow-hidden bg-[#D7ECEC] border border-[#A3D4D4] flex items-center justify-center shadow-sm">
                                <img :src="editProgram.image_url" alt="Preview Program" class="h-full w-full object-cover">
                            </div>
                            <div class="flex-1">
                                <input type="file" name="img" accept="image/*"
                                    class="block w-full text-[12px] text-[#285E5E]
                                        file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0
                                        file:text-[11px] file:font-semibold
                                        file:bg-[#D7ECEC] file:text-[#285E5E]
                                        hover:file:bg-[#C4E2E2] cursor-pointer" />
                                <p class="mt-1 text-[11px] text-[#7FB1B1]">
                                    Formats: JPG, JPEG, PNG, WEBP. Maximum 4 MB.
                                </p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="edit_is_active" value="1"
                            :checked="editProgram.is_active"
                            class="h-3.5 w-3.5 rounded border-[#A3D4D4] text-[#5AAEAE] focus:ring-[#5AAEAE]" />
                        <label for="edit_is_active" class="text-[12px] text-[#285E5E]">Active</label>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2 text-[12px]">
                        <button type="button"
                            @click="closeEditModal()"
                            class="inline-flex items-center rounded-xl border border-[#A3D4D4] bg-white/70 px-3 py-2 font-medium text-[#285E5E] hover:bg-white transition">
                            Cancel
                        </button>

                        <button type="submit"
                            class="inline-flex items-center rounded-xl bg-[#5AAEAE] hover:bg-[#489B9B] text-white font-semibold px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5AAEAE]">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>

    <script>
        function programPage() {
            return {
                showCreate: false,
                showEdit: false,
                programs: [],

                editProgram: {
                    id: null,
                    name: '',
                    slug: '',
                    category_id: null,
                    duration: '',
                    price: '',
                    short_desc: '',
                    long_desc: '',
                    is_active: true,
                    image_url: '',
                },

                init(payload) {
                    this.programs = payload.programs || [];
                },

                openCreateModal() {
                    this.showCreate = true;
                },
                closeCreateModal() {
                    this.showCreate = false;
                },

                openEditModal(program) {
                    this.editProgram = {
                        id: program.id,
                        name: program.name,
                        slug: program.slug,
                        category_id: program.category_id,
                        duration: program.duration || '',
                        price: program.price || '',
                        short_desc: program.short_desc || '',
                        long_desc: program.long_desc || '',
                        is_active: !!program.is_active,
                        image_url: program.image_url,
                    };
                    this.showEdit = true;
                },
                closeEditModal() {
                    this.showEdit = false;
                },

                editActionUrl() {
                    return "<?php echo e(route('admin.program.update', ['id' => '__ID__'])); ?>"
                        .replace('__ID__', this.editProgram.id ?? 0);
                },
            };
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PROJEK\PROJEK SOLVE IT\WEB\govind\resources\views/admin/program.blade.php ENDPATH**/ ?>