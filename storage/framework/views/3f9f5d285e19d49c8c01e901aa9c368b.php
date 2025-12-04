<?php $__env->startSection('title', 'Users | Admin Govind'); ?>
<?php $__env->startSection('page_title', 'Users'); ?>
<?php $__env->startSection('page_subtitle', 'Manage user accounts and roles'); ?>

<?php $__env->startSection('content'); ?>

    <section
        x-data="userPage()"
        x-init="init({
            users: <?php echo e($users->map(function($u){
                return [
                    'id'         => $u->id,
                    'name'       => $u->name,
                    'email'      => $u->email,
                    'phone'      => $u->phone,
                    'role'       => $u->role ?? ($u->is_admin ?? false ? 'admin' : 'user'),
                    'created_at' => $u->created_at?->format('d M Y'),
                ];
            })->values()->toJson()); ?>

        })"
        class="space-y-4"
    >

        
        <?php if(session('success')): ?>
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
                        <?php echo e(session('success')); ?>

                    </div>
                </div>
                <button @click="show=false"
                    class="ml-4 text-[#285E5E] hover:text-[#0F3535] text-xs font-semibold">
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
                    <div class="font-semibold text-[13px] leading-tight">
                        Failed
                    </div>
                    <div class="text-[12px] leading-tight">
                        <?php echo e(session('error')); ?>

                    </div>
                </div>
                <button @click="show=false"
                    class="ml-4 text-red-600 hover:text-red-800 text-xs font-semibold">
                    ✕
                </button>
            </div>
        <?php endif; ?>

        <!-- TOP HEADER -->
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-base font-semibold text-[#1E4B4B] leading-tight">User List</h1>
                <p class="text-[11px] text-[#285E5E]/80 leading-tight">
                    Total: <span class="font-semibold text-[#1E4B4B]"><?php echo e($users->total() ?? $users->count()); ?></span> registered users
                </p>

                <?php if(request('q')): ?>
                    <div class="text-[11px] text-[#285E5E]/80 leading-tight mt-1">
                        Search results for:
                        <span class="font-semibold text-[#1E4B4B]">"<?php echo e(request('q')); ?>"</span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Add User Button -->
            <button
                @click="openCreateModal()"
                type="button"
                class="inline-flex items-center justify-center rounded-xl bg-[#6AAEAD] hover:bg-[#5CA3A2] text-white text-xs font-semibold px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-[#6AAEAD]/80 transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 4v16m8-8H4" />
                </svg>
                Add User
            </button>
        </div>

        <!-- WRAPPER CARD -->
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)]">
            <!-- TOP BAR: info + search -->
            <div class="px-4 py-3 border-b border-[#C1DCDC]/60 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div class="text-[11px] text-[#285E5E]/80 leading-tight">
                    Showing
                    <span class="font-semibold text-[#1E4B4B]"><?php echo e($users->firstItem() ?? 1); ?> - <?php echo e($users->lastItem() ?? $users->count()); ?></span>
                    of
                    <span class="font-semibold text-[#1E4B4B]"><?php echo e($users->total() ?? $users->count()); ?></span>
                    users
                </div>

                <form action="<?php echo e(route('admin.user')); ?>" method="GET" class="flex items-center gap-2">
                    <div class="relative">
                        <input
                            type="text"
                            name="q"
                            value="<?php echo e(request('q')); ?>"
                            class="w-48 sm:w-60 rounded-xl border border-[#C1DCDC]/80 bg-white/70 px-3 py-2 pr-8 text-[12px] text-[#285E5E] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]"
                            placeholder="Search name / email..."
                        />
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-[#285E5E]/70 hover:text-[#0F3535]" title="Search">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" />
                            </svg>
                        </button>
                    </div>

                    <?php if(request('q')): ?>
                        <a href="<?php echo e(route('admin.user')); ?>"
                        class="text-[11px] text-[#285E5E]/80 hover:text-[#0F3535] underline">
                            Reset
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-[#285E5E]">
                    <thead class="text-[11px] uppercase tracking-wide text-[#285E5E] bg-[#E8F3F3]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">No</th>
                            <th class="px-4 py-3 font-semibold">Name</th>
                            <th class="px-4 py-3 font-semibold">Email</th>
                            <th class="px-4 py-3 font-semibold">Phone Number</th>
                            <th class="px-4 py-3 font-semibold">Address</th>
                            <th class="px-4 py-3 font-semibold">Role</th>
                            <th class="px-4 py-3 font-semibold">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#C1DCDC]/70 text-[13px]">
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $role   = $user->role ?? ($user->is_admin ?? false ? 'admin' : 'user');
                                $active = $user->is_active ?? true;

                                $avatarUrl = $user->img
                                    ? asset('storage/users/' . $user->img)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=C1DCDC&color=1E4B4B&size=64';
                            ?>

                            <tr class="hover:bg-[#F3FBFB] transition-colors">
                                <!-- index -->
                                <td class="px-4 py-3 align-top text-[#285E5E]/80">
                                    <?php if(method_exists($users, 'firstItem')): ?>
                                        <?php echo e($users->firstItem() + $index); ?>

                                    <?php else: ?>
                                        <?php echo e($index + 1); ?>

                                    <?php endif; ?>
                                </td>

                                <!-- name + avatar -->
                                <td class="px-4 py-3 align-top text-[#1E4B4B] font-medium">
                                    <div class="flex items-start gap-3">
                                        <div class="h-9 w-9 rounded-full overflow-hidden bg-[#E3F2F2] flex items-center justify-center shadow-sm">
                                            <img
                                                src="<?php echo e($avatarUrl); ?>"
                                                alt="Avatar <?php echo e($user->name); ?>"
                                                class="h-full w-full object-cover"
                                            >
                                        </div>
                                        <div>
                                            <div class="leading-tight">
                                                <?php echo e($user->name); ?>

                                            </div>
                                            <div class="text-[11px] text-[#285E5E]/70 leading-tight">
                                                ID: <?php echo e($user->id); ?>

                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- email -->
                                <td class="px-4 py-3 align-top">
                                    <div class="leading-tight text-[#285E5E]"><?php echo e($user->email); ?></div>
                                    <div class="text-[11px] text-[#285E5E]/70 leading-tight">
                                        Registered: <?php echo e($user->created_at?->format('d M Y') ?? '-'); ?>

                                    </div>
                                </td>

                                <!-- phone -->
                                <td class="px-4 py-3 align-top">
                                    <div class="leading-tight text-[#285E5E]">
                                        <?php echo e($user->phone ?? '-'); ?>

                                    </div>
                                </td>

                                <!-- address -->
                                <td class="px-4 py-3 align-top">
                                    <div class="leading-tight text-[#285E5E]">
                                        <?php echo e($user->address ?? '-'); ?>

                                    </div>
                                </td -->

                                <!-- role -->
                                <td class="px-4 py-3 align-top">
                                    <span class="inline-flex items-center rounded-lg px-2 py-1 text-[10px] font-semibold
                                        <?php echo e($role === 'admin'
                                            ? 'bg-[#C1DCDC]/80 text-[#1E4B4B]'
                                            : 'bg-[#E8F3F3] text-[#285E5E]'); ?>">
                                        <?php echo e(strtoupper($role)); ?>

                                    </span>
                                </td>

                                <!-- actions -->
                                <td class="px-4 py-3 align-top text-center whitespace-nowrap">
                                    <div class="flex items-start justify-center gap-2">
                                        <!-- Edit: open modal -->
                                        <button type="button"
                                            @click="openEditModal({
                                            id: <?php echo e($user->id); ?>,
                                            name: '<?php echo e($user->name); ?>',
                                            email: '<?php echo e($user->email); ?>',
                                            phone: '<?php echo e($user->phone); ?>',
                                            address: '<?php echo e($user->address); ?>',
                                            role: '<?php echo e($role); ?>',
                                            img_url: '<?php echo e($avatarUrl); ?>'
                                        })"
                                            class="inline-flex items-center rounded-lg border border-[#6AAEAD] bg-[#E3F7F6] px-2 py-1 text-[11px] font-medium text-[#1E4B4B] hover:bg-[#D4EFEE] transition"
                                            title="Edit user data"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 3.487a2.1 2.1 0 0 1 2.97 2.97l-9.32 9.32a4.5 4.5 0 0 1-1.773 1.08l-3.003.858a.75.75 0 0 1-.923-.923l.858-3.003a4.5 4.5 0 0 1 1.08-1.773l9.32-9.32z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12.75v6.75A1.5 1.5 0 0 1 18 21H6a1.5 1.5 0 0 1-1.5-1.5v-12A1.5 1.5 0 0 1 6 6h6.75" />
                                            </svg>
                                            <span>Edit</span>
                                        </button>

                                        <!-- Delete -->
                                        <form action="<?php echo e(route('admin.user.delete', $user->id)); ?>" method="POST"
                                            onsubmit="return confirm('Delete this user?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button
                                                class="inline-flex items-center gap-1 rounded-lg border border-red-400 bg-red-50/80 px-2 py-1 text-[11px] font-medium text-red-700 hover:bg-red-100 transition"
                                                title="Delete user"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 6h18M9 6V4.5A1.5 1.5 0 0 1 10.5 3h3A1.5 1.5 0 0 1 15 4.5V6m-9 0h12l-.867 12.142A2.25 2.25 0 0 1 14.892 20.25H9.108a2.25 2.25 0 0 1-2.241-2.108L6 6z" />
                                                </svg>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-[13px] text-[#285E5E]/70">
                                    No users found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <?php if(method_exists($users, 'links')): ?>
                <div class="px-4 py-3 border-t border-[#C1DCDC]/60 flex items-center justify-between text:[12px] text-[#285E5E]/90">
                    <div>
                        Showing
                        <span class="font-semibold text-[#1E4B4B]"><?php echo e($users->firstItem()); ?></span>
                        -
                        <span class="font-semibold text-[#1E4B4B]"><?php echo e($users->lastItem()); ?></span>
                        of
                        <span class="font-semibold text-[#1E4B4B]"><?php echo e($users->total()); ?></span>
                        users
                    </div>
                    <div class="text-[#285E5E]">
                        <?php echo e($users->links('pagination::tailwind')); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- MODAL: ADD USER -->
        <div x-show="showCreate" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
            <!-- backdrop -->
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="closeCreateModal()"></div>

            <!-- card -->
            <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-[#C1DCDC]/80">
                <div class="px-5 py-4 border-b border-[#C1DCDC]/60 flex items-start justify-between">
                    <div>
                        <div class="text-sm font-semibold text-[#1E4B4B] leading-tight">Add User</div>
                        <div class="text-[11px] text-[#285E5E]/80 leading-tight">Create a new account & assign role</div>
                    </div>
                    <button @click="closeCreateModal()" class="text-[#285E5E]/70 hover:text-[#0F3535] text-sm font-semibold">
                        ✕
                    </button>
                </div>

                <form action="<?php echo e(route('admin.user.store')); ?>" method="POST" enctype="multipart/form-data" class="px-5 py-4 space-y-4 text-[13px]">
                    <?php echo csrf_field(); ?>

                    <!-- submit source marker -->
                    <input type="hidden" name="_from" value="create" />

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">
                            Profile Photo
                            <span class="text-[11px] text-[#285E5E]/80 font-normal">(optional)</span>
                        </label>

                        <div class="flex items-center gap-3">
                            
                            <div class="h-10 w-10 rounded-full overflow-hidden bg-[#E3F2F2] flex items-center justify-center shadow-sm">
                                <img
                                    x-bind:src="createPreview || 'https://ui-avatars.com/api/?name=User&background=C1DCDC&color=1E4B4B&size=64'"
                                    alt="Preview Avatar"
                                    class="h-full w-full object-cover"
                                >
                            </div>

                            
                            <div class="flex-1">
                                <input
                                    type="file"
                                    name="img"
                                    accept="image/*"
                                    @change="handleCreateImgChange($event)"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'block w-full text-[12px] text-[#285E5E]
                                        file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0
                                        file:text-[11px] file:font-semibold
                                        file:bg-[#E3F7F6] file:text-[#1E4B4B]
                                        hover:file:bg-[#D4EFEE] cursor-pointer',
                                        'border border-red-400 rounded-lg px-2 py-1 file:bg-red-50 file:text-red-700' => $errors->has('img'),
                                    ]); ?>"
                                />
                                <p class="mt-1 text-[11px] text-[#285E5E]/70">
                                    Format: JPG, JPEG, PNG, WEBP. Maximum 2 MB.
                                </p>
                                <?php $__errorArgs = ['img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">Full Name</label>
                        <input type="text" name="name" placeholder="New user name..." required
                            value="<?php echo e(old('name')); ?>"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]',
                                'border-red-400 focus:ring-red-500 focus:border-red-500' => $errors->has('name'),
                                'border-[#C1DCDC]/80' => !$errors->has('name'),
                            ]); ?>"
                        />
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">Email</label>
                        <input type="email" name="email" placeholder="email@example.com" required
                            value="<?php echo e(old('email')); ?>"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]',
                                'border-red-400 focus:ring-red-500 focus:border-red-500' => $errors->has('email'),
                                'border-[#C1DCDC]/80' => !$errors->has('email'),
                            ]); ?>"
                        />
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">Phone Number</label>
                        <input type="text" name="phone" placeholder="08xxxxxxxxxx" required
                            value="<?php echo e(old('phone')); ?>"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]',
                                'border-red-400 focus:ring-red-500 focus:border-red-500' => $errors->has('phone'),
                                'border-[#C1DCDC]/80' => !$errors->has('phone'),
                            ]); ?>"
                        />
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">Address</label>
                        <input type="text" name="address" placeholder="Street / Address..." required
                            value="<?php echo e(old('address')); ?>"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]',
                                'border-red-400 focus:ring-red-500 focus:border-red-500' => $errors->has('address'),
                                'border-[#C1DCDC]/80' => !$errors->has('address'),
                            ]); ?>"
                        />
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">Password</label>
                        <input type="password" name="password" placeholder="Minimum 8 characters" required
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]',
                                'border-red-400 focus:ring-red-500 focus:border-red-500' => $errors->has('password'),
                                'border-[#C1DCDC]/80' => !$errors->has('password'),
                            ]); ?>"
                        />
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">Role</label>
                        <select name="role"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]',
                                'border-red-400 focus:ring-red-500 focus:border-red-500' => $errors->has('role'),
                                'border-[#C1DCDC]/80' => !$errors->has('role'),
                            ]); ?>"
                        >
                            <option value="user" <?php echo e(old('role', $user->role ?? '') === 'user' ? 'selected' : ''); ?>>User</option>
                            <option value="admin" <?php echo e(old('role', $user->role ?? '') === 'admin' ? 'selected' : ''); ?>>Admin</option>
                        </select>
                        <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2 text-[12px]">
                        <button type="button"
                                @click="closeCreateModal()"
                                class="inline-flex items-center rounded-xl border border-[#C1DCDC]/80 bg-white/70 px-3 py-2 font-medium text-[#285E5E] hover:bg-white transition">
                            Cancel
                        </button>

                        <button type="submit"
                                class="inline-flex items-center rounded-xl bg-[#6AAEAD] hover:bg-[#5CA3A2] text-white font-semibold px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-[#6AAEAD]">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL: EDIT USER -->
        <div x-show="showEdit" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
            <!-- backdrop -->
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="closeEditModal()"></div>

            <!-- card -->
            <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-[#C1DCDC]/80">
                <div class="px-5 py-4 border-b border-[#C1DCDC]/60 flex items-start justify-between">
                    <div>
                        <div class="text-sm font-semibold text-[#1E4B4B] leading-tight">Edit User</div>
                        <div class="text-[11px] text-[#285E5E]/80 leading-tight">
                            Update account information (password cannot be changed here)
                        </div>
                    </div>
                    <button @click="closeEditModal()" class="text-[#285E5E]/70 hover:text-[#0F3535] text-sm font-semibold">
                        ✕
                    </button>
                </div>

                <form x-bind:action="editActionUrl()" method="POST" enctype="multipart/form-data" class="px-5 py-4 space-y-4 text-[13px]">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <!-- submit source marker -->
                    <input type="hidden" name="_from" value="edit" />
                    <!-- user id for reopening modal on validation error -->
                    <input type="hidden" name="id" x-model="editUser.id" />

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">
                            Profile Photo
                            <span class="text-[11px] text-[#285E5E]/80 font-normal">(optional)</span>
                        </label>

                        <div class="flex items-center gap-3">
                            
                            <div class="h-10 w-10 rounded-full overflow-hidden bg-[#E3F2F2] flex items-center justify-center shadow-sm">
                                <img
                                    x-bind:src="editPreview || editUser.img_url"
                                    alt="Preview Avatar"
                                    class="h-full w-full object-cover"
                                >
                            </div>

                            
                            <div class="flex-1">
                                <input
                                    type="file"
                                    name="img"
                                    accept="image/*"
                                    @change="handleEditImgChange($event)"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'block w-full text-[12px] text-[#285E5E]
                                        file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0
                                        file:text-[11px] file:font-semibold
                                        file:bg-[#E3F7F6] file:text-[#1E4B4B]
                                        hover:file:bg-[#D4EFEE] cursor-pointer',
                                        'border border-red-400 rounded-lg px-2 py-1 file:bg-red-50 file:text-red-700' => $errors->has('img'),
                                    ]); ?>"
                                />
                                <p class="mt-1 text-[11px] text-[#285E5E]/70">
                                    Leave empty if you do not want to change the photo.
                                </p>
                                <?php $__errorArgs = ['img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">Full Name</label>
                        <input type="text" name="name" required
                            x-model="editUser.name"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]',
                                'border-red-400 focus:ring-red-500 focus:border-red-500' => $errors->has('name'),
                                'border-[#C1DCDC]/80' => !$errors->has('name'),
                            ]); ?>"
                        />
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">Email</label>
                        <input type="email" name="email" required
                            x-model="editUser.email"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]',
                                'border-red-400 focus:ring-red-500 focus:border-red-500' => $errors->has('email'),
                                'border-[#C1DCDC]/80' => !$errors->has('email'),
                            ]); ?>"
                        />
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">Phone Number</label>
                        <input type="text" name="phone" required
                            x-model="editUser.phone"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]',
                                'border-red-400 focus:ring-red-500 focus:border-red-500' => $errors->has('phone'),
                                'border-[#C1DCDC]/80' => !$errors->has('phone'),
                            ]); ?>"
                        />
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">Address</label>
                        <input type="text" name="address" required
                            x-model="editUser.address"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]',
                                'border-red-400 focus:ring-red-500 focus:border-red-500' => $errors->has('address'),
                                'border-[#C1DCDC]/80' => !$errors->has('address'),
                            ]); ?>"
                        />
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-[12px] font-medium text-[#1E4B4B] mb-1">Role</label>
                        <select name="role"
                                x-model="editUser.role"
                                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'w-full rounded-xl border px-3 py-2 text-[13px] text-[#285E5E] bg-white
                                focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:border-[#6AAEAD]',
                                'border-red-400 focus:ring-red-500 focus:border-red-500' => $errors->has('role'),
                                'border-[#C1DCDC]/80' => !$errors->has('role'),
                            ]); ?>"
                        >
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-[12px] text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2 text-[12px]">
                        <button type="button"
                                @click="closeEditModal()"
                                class="inline-flex items-center rounded-xl border border-[#C1DCDC]/80 bg-white/70 px-3 py-2 font-medium text-[#285E5E] hover:bg-white transition">
                            Cancel
                        </button>

                        <button type="submit"
                                class="inline-flex items-center rounded-xl bg-[#6AAEAD] hover:bg-[#5CA3A2] text-white font-semibold px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-[#6AAEAD]">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>

    <!-- Alpine component logic -->
    <script>
        function userPage() {
            return {
                showCreate: false,
                showEdit: false,
                users: [],

                createPreview: null,
                editPreview: null,

                editUser: {
                    id: null,
                    name: '',
                    email: '',
                    phone: '',
                    address: '',
                    role: 'user',
                    img_url: '',
                },

                init(payload) {
                    this.users = payload.users || [];

                    <?php if($errors->any() && old('_from') === 'create'): ?>
                        this.showCreate = true;
                    <?php endif; ?>

                    <?php if($errors->any() && old('_from') === 'edit'): ?>
                        this.editUser.id        = <?php echo e(old('id') ?? 'null'); ?>;
                        this.editUser.name      = "<?php echo e(old('name')); ?>";
                        this.editUser.email     = "<?php echo e(old('email')); ?>";
                        this.editUser.phone     = "<?php echo e(old('phone')); ?>";
                        this.editUser.address   = "<?php echo e(old('address')); ?>";
                        this.editUser.role      = "<?php echo e(old('role')); ?>";
                        this.showEdit = true;
                    <?php endif; ?>
                },

                // ADD MODAL
                openCreateModal() {
                    this.showCreate = true;
                },
                closeCreateModal() {
                    this.showCreate = false;
                },

                // EDIT MODAL
                openEditModal(user) {
                    this.editUser.id        = user.id;
                    this.editUser.name      = user.name;
                    this.editUser.email     = user.email;
                    this.editUser.phone     = user.phone ?? '';
                    this.editUser.address   = user.address;
                    this.editUser.role      = user.role || 'user';
                    this.editUser.img_url   = user.img_url || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(user.name || 'User') + '&background=C1DCDC&color=1E4B4B&size=64';

                    this.editPreview = null;

                    this.showEdit = true;
                },
                closeEditModal() {
                    this.showEdit = false;
                },

                handleCreateImgChange(event) {
                    const file = event.target.files[0];
                    if (!file) {
                        this.createPreview = null;
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.createPreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },

                handleEditImgChange(event) {
                    const file = event.target.files[0];
                    if (!file) {
                        this.editPreview = null;
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.editPreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },

                editActionUrl() {
                    return "<?php echo e(route('admin.user.update', ['id' => '__ID__'])); ?>"
                        .replace('__ID__', this.editUser.id ?? 0);
                },
            };
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PROJEK\PROJEK SOLVE IT\WEB\govind\resources\views/admin/user.blade.php ENDPATH**/ ?>