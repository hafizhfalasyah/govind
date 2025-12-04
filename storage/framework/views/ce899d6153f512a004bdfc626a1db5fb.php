<?php $__env->startSection('title', 'Category | Admin Govind'); ?>
<?php $__env->startSection('page_title', 'Program Categories'); ?>
<?php $__env->startSection('page_subtitle', 'Manage the program category list'); ?>

<?php $__env->startSection('content'); ?>

    <section
        x-data="categoryPage()"
        x-init="init({
            categories: <?php echo $categories->map(function($c){
                return [
                    'id'          => $c->id,
                    'name'        => $c->name,
                    'description' => $c->description,
                    'created_at'  => $c->created_at?->format('d M Y'),
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
                class="rounded-xl border border-green-300 bg-green-50/80 text-green-700
                    text-[13px] px-4 py-3 flex items-start justify-between shadow-sm"
            >
                <div class="flex-1">
                    <div class="font-semibold text-[13px] leading-tight">Success</div>
                    <div class="text-[12px] leading-tight"><?php echo e(session('success')); ?></div>
                </div>
                <button @click="show=false" class="ml-4 text-green-600 hover:text-green-800 text-xs font-semibold">✕</button>
            </div>
        <?php endif; ?>

        
        <?php if(session('error')): ?>
            <div
                x-data="{show:true}"
                x-show="show"
                x-transition
                class="rounded-xl border border-red-300 bg-red-50/80 text-red-700
                    text-[13px] px-4 py-3 flex items-start justify-between shadow-sm"
            >
                <div class="flex-1">
                    <div class="font-semibold text-[13px] leading-tight">Failed</div>
                    <div class="text-[12px] leading-tight"><?php echo e(session('error')); ?></div>
                </div>
                <button @click="show=false" class="ml-4 text-red-600 hover:text-red-800 text-xs font-semibold">✕</button>
            </div>
        <?php endif; ?>

        <!-- HEADER -->
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-base font-semibold text-[#285E5E] leading-tight">Category List</h1>
                <p class="text-[11px] text-[#417F7F] leading-tight">
                    Total: <?php echo e($categories->total() ?? $categories->count()); ?> registered categories
                </p>
            </div>

            <!-- Add Button -->
            <button
                @click="openCreateModal()"
                type="button"
                class="inline-flex items-center justify-center rounded-xl
                    bg-[#5AAEAE] hover:bg-[#489B9B] text-white
                    text-xs font-semibold px-3 py-2 shadow-sm
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5AAEAE] transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                </svg>
                Add Category
            </button>
        </div>

        <!-- WRAPPER CARD -->
        <div class="bg-white/60 backdrop-blur-xl border border-[#A3D4D4] rounded-2xl shadow-sm">

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-[#285E5E]">
                    <thead class="text-[11px] uppercase tracking-wide text-[#417F7F] bg-[#E3F3F3]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">No</th>
                            <th class="px-4 py-3 font-semibold">Category Name</th>
                            <th class="px-4 py-3 font-semibold">Description</th>
                            <th class="px-4 py-3 font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#A3D4D4] text-[13px]">
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-[#E3F3F3]">

                                <td class="px-4 py-3 text-[#5A9A9A]">
                                    <?php echo e(($categories->firstItem() ?? 1) + $index); ?>

                                </td>

                                <td class="px-4 py-3 font-medium text-[#285E5E]">
                                    <div class="leading-tight"><?php echo e($category->name); ?></div>
                                    <div class="text-[11px] text-[#417F7F] leading-tight">
                                        Created: <?php echo e($category->created_at?->format('d M Y')); ?>

                                    </div>
                                </td>

                                <td class="px-4 py-3 align-top">
                                    <div class="leading-snug text-[#285E5E] max-w-xs whitespace-pre-line">
                                        <?php echo e($category->description ?? '-'); ?>

                                    </div>
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-start justify-center gap-2">

                                        <!-- Edit -->
                                        <button
                                            @click="openEditModal({
                                                id: <?php echo e($category->id); ?>,
                                                name: <?php echo \Illuminate\Support\Js::from($category->name)->toHtml() ?>,
                                                description: <?php echo \Illuminate\Support\Js::from($category->description)->toHtml() ?>,
                                            })"
                                            class="inline-flex items-center rounded-lg border border-yellow-400
                                                bg-yellow-50/80 px-2 py-1 text-[11px] font-medium text-yellow-700
                                                hover:bg-yellow-100 transition"
                                        >
                                            Edit
                                        </button>

                                        <!-- Delete -->
                                        <form
                                            action="<?php echo e(route('admin.category.destroy', $category)); ?>"
                                            method="POST"
                                            onsubmit="return confirm('Delete this category?');"
                                        >
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button
                                                class="inline-flex items-center rounded-lg border border-red-400
                                                    bg-red-50/80 px-2 py-1 text-[11px] font-medium text-red-700
                                                    hover:bg-red-100 transition"
                                            >
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-[13px] text-[#417F7F]">
                                    No categories created yet.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <?php if(method_exists($categories, 'links')): ?>
                <div class="px-4 py-3 border-t border-[#A3D4D4] flex items-center justify-between text-[12px] text-[#417F7F]">
                    <div>
                        Showing
                        <span class="font-semibold text-[#285E5E]"><?php echo e($categories->firstItem()); ?></span>
                        -
                        <span class="font-semibold text-[#285E5E]"><?php echo e($categories->lastItem()); ?></span>
                        of
                        <span class="font-semibold text-[#285E5E]"><?php echo e($categories->total()); ?></span>
                        categories
                    </div>
                    <div>
                        <?php echo e($categories->links('pagination::tailwind')); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>

        
        <div x-show="showCreate" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display:none;">
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="closeCreateModal()"></div>

            <div class="relative w-full max-w-lg bg-white/90 rounded-2xl shadow-xl border border-[#A3D4D4]">
                <div class="px-5 py-4 border-b border-[#A3D4D4] flex items-start justify-between">
                    <div>
                        <div class="text-sm font-semibold text-[#285E5E] leading-tight">Add Category</div>
                        <div class="text-[11px] text-[#417F7F] leading-tight">Create a new category</div>
                    </div>
                    <button @click="closeCreateModal()" class="text-[#5A9A9A] hover:text-[#285E5E] text-sm font-semibold">
                        ✕
                    </button>
                </div>

                <form action="<?php echo e(route('admin.category.store')); ?>" method="POST" class="px-5 py-4 space-y-4 text-[13px]">
                    <?php echo csrf_field(); ?>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Category Name</label>
                        <input type="text" name="name" placeholder="Example: Cloud Computing" required
                            value="<?php echo e(old('name')); ?>"
                            class="w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                border-[#A3D4D4]
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]" />
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">
                            Description
                            <span class="text-[11px] text-[#417F7F]">(can be multiline & emoji)</span>
                        </label>
                        <textarea name="description" rows="3"
                            class="w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                border-[#A3D4D4]
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]"
                            placeholder="Category description... 😊"><?php echo e(old('description')); ?></textarea>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2 text-[12px]">
                        <button type="button"
                            @click="closeCreateModal()"
                            class="inline-flex items-center rounded-xl border border-[#A3D4D4] bg-white/70 px-3 py-2
                                font-medium text-[#285E5E] hover:bg-[#E3F3F3] transition">
                            Cancel
                        </button>

                        <button type="submit"
                            class="inline-flex items-center rounded-xl bg-[#5AAEAE] hover:bg-[#489B9B]
                                text-white font-semibold px-3 py-2 shadow-sm
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5AAEAE]">
                            Save
                        </button>
                    </div>

                </form>
            </div>
        </div>

        
        <div x-show="showEdit" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display:none;">
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="closeEditModal()"></div>

            <div class="relative w-full max-w-lg bg-white/90 rounded-2xl shadow-xl border border-[#A3D4D4]">
                <div class="px-5 py-4 border-b border-[#A3D4D4] flex items-start justify-between">
                    <div>
                        <div class="text-sm font-semibold text-[#285E5E] leading-tight">Edit Category</div>
                        <div class="text-[11px] text-[#417F7F] leading-tight">Update category data</div>
                    </div>
                    <button @click="closeEditModal()" class="text-[#5A9A9A] hover:text-[#285E5E] text-sm font-semibold">✕</button>
                </div>

                <form :action="editActionUrl()" method="POST" class="px-5 py-4 space-y-4 text-[13px]">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <input type="hidden" name="id" x-model="editCategory.id" />

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Category Name</label>
                        <input type="text" name="name" required x-model="editCategory.name"
                            class="w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                border-[#A3D4D4]
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]" />
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#285E5E] mb-1">Description</label>
                        <textarea name="description" rows="3" x-model="editCategory.description"
                            class="w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                border-[#A3D4D4]
                                focus:outline-none focus:ring-2 focus:ring-[#5AAEAE] focus:border-[#5AAEAE]"></textarea>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2 text-[12px]">
                        <button type="button"
                            @click="closeEditModal()"
                            class="inline-flex items-center rounded-xl border border-[#A3D4D4] bg-white/70 px-3 py-2
                                font-medium text-[#285E5E] hover:bg-[#E3F3F3] transition">
                            Cancel
                        </button>

                        <button type="submit"
                            class="inline-flex items-center rounded-xl bg-[#5AAEAE] hover:bg-[#489B9B]
                                text-white font-semibold px-3 py-2 shadow-sm
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5AAEAE]">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </section>

    <script>
    function categoryPage() {
        return {
            showCreate: false,
            showEdit: false,
            categories: [],

            editCategory: {
                id: null,
                name: '',
                description: '',
            },

            init(payload) {
                this.categories = payload.categories || [];
            },

            openCreateModal() {
                this.showCreate = true;
            },
            closeCreateModal() {
                this.showCreate = false;
            },

            openEditModal(cat) {
                this.editCategory = {
                    id: cat.id,
                    name: cat.name,
                    description: cat.description || '',
                };
                this.showEdit = true;
            },
            closeEditModal() {
                this.showEdit = false;
            },

            editActionUrl() {
                return "<?php echo e(route('admin.category.update', ['id' => '__ID__'])); ?>"
                    .replace('__ID__', this.editCategory.id ?? 0);
            },
        };
    }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PROJEK\PROJEK SOLVE IT\WEB\govind\resources\views/admin/category.blade.php ENDPATH**/ ?>