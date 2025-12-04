<?php $__env->startSection('title', 'Home | Admin Govind'); ?>
<?php $__env->startSection('page_title', 'Home'); ?>
<?php $__env->startSection('page_subtitle', 'System overview & statistics'); ?>

<?php $__env->startSection('content'); ?>

    <!-- TOP STATISTIC CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        <!-- Users -->
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)] p-4">
            <div class="text-xs text-[#285E5E]/80 font-medium flex items-center justify-between">
                <span>Total Users</span>
                <span class="inline-flex items-center text-[10px] font-semibold text-[#1E4B4B] bg-[#C1DCDC]/60 px-2 py-0.5 rounded-full">
                    +4,2%
                </span>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <div>
                    <div class="text-2xl font-semibold text-[#1E4B4B] leading-none">1.284</div>
                    <div class="text-[11px] text-[#285E5E]/80 mt-1">active this month</div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-[#6AAEAD] text-white flex items-center justify-center shadow-inner text-sm font-semibold">
                    PG
                </div>
            </div>
        </div>

        <!-- Packages -->
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)] p-4">
            <div class="text-xs text-[#285E5E]/80 font-medium flex items-center justify-between">
                <span>Active Packages</span>
                <span class="inline-flex items-center text-[10px] font-semibold text-[#1E4B4B] bg-[#C1DCDC]/60 px-2 py-0.5 rounded-full">
                    +2 packages
                </span>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <div>
                    <div class="text-2xl font-semibold text-[#1E4B4B] leading-none">12</div>
                    <div class="text-[11px] text-[#285E5E]/80 mt-1">published</div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-[#6AAEAD] text-white flex items-center justify-center shadow-inner text-sm font-semibold">
                    PK
                </div>
            </div>
        </div>

        <!-- Orders 24 Hours -->
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)] p-4">
            <div class="text-xs text-[#285E5E]/80 font-medium flex items-center justify-between">
                <span>Orders (24 hours)</span>
                <span class="inline-flex items-center text-[10px] font-semibold text-[#1E4B4B] bg-[#C1DCDC]/60 px-2 py-0.5 rounded-full">
                    +2,1%
                </span>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <div>
                    <div class="text-2xl font-semibold text-[#1E4B4B] leading-none">312</div>
                    <div class="text-[11px] text-[#285E5E]/80 mt-1">need verification: 5</div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-[#6AAEAD] text-white flex items-center justify-center shadow-inner text-sm font-semibold">
                    PS
                </div>
            </div>
        </div>

        <!-- System Health -->
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)] p-4">
            <div class="text-xs text-[#285E5E]/80 font-medium flex items-center justify-between">
                <span>System Health</span>
                <span class="inline-flex items-center text-[10px] font-semibold text-[#1E4B4B] bg-[#C1DCDC]/60 px-2 py-0.5 rounded-full">
                    Normal
                </span>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <div>
                    <div class="text-2xl font-semibold text-[#1E4B4B] leading-none">99,98%</div>
                    <div class="text-[11px] text-[#285E5E]/80 mt-1">uptime</div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-[#6AAEAD] text-white flex items-center justify-center shadow-inner text-sm font-semibold">
                    ✔
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM GRID -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
        <!-- Recent Activity -->
        <div class="xl:col-span-2 bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)]">
            <div class="px-4 py-3 border-b border-[#C1DCDC]/60 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-[#1E4B4B]">Recent Activity</h2>
                <a href="#" class="text-[11px] text-[#285E5E] hover:text-[#0F3535] font-medium">
                    View all
                </a>
            </div>

            <ul class="divide-y divide-[#C1DCDC]/70 text-sm">
                <li class="px-4 py-3 flex items-start">
                    <div class="h-9 w-9 rounded-lg bg-[#6AAEAD] text-white flex items-center justify-center text-xs font-semibold mr-3">
                        USR
                    </div>
                    <div class="flex-1">
                        <div class="text-[#1E4B4B] font-medium">
                            Admin added new user "client_demo"
                        </div>
                        <div class="text-[11px] text-[#285E5E]/80 mt-0.5">
                            2 minutes ago
                        </div>
                    </div>
                    <span class="text-[10px] inline-flex items-center rounded-lg bg-[#C1DCDC]/70 text-[#1E4B4B] font-semibold px-2 py-0.5">
                        USER CREATED
                    </span>
                </li>

                <li class="px-4 py-3 flex items-start">
                    <div class="h-9 w-9 rounded-lg bg-[#6AAEAD] text-white flex items-center justify-center text-xs font-semibold mr-3">
                        PKT
                    </div>
                    <div class="flex-1">
                        <div class="text-[#1E4B4B] font-medium">
                            Package "Business Web Bundle" updated (price adjusted)
                        </div>
                        <div class="text-[11px] text-[#285E5E]/80 mt-0.5">
                            12 minutes ago
                        </div>
                    </div>
                    <span class="text-[10px] inline-flex items-center rounded-lg bg-[#FFF7D1] text-[#9A7B16] font-semibold px-2 py-0.5">
                        PACKAGE UPDATED
                    </span>
                </li>

                <li class="px-4 py-3 flex items-start">
                    <div class="h-9 w-9 rounded-lg bg-[#6AAEAD] text-white flex items-center justify-center text-xs font-semibold mr-3">
                        PSN
                    </div>
                    <div class="flex-1">
                        <div class="text-[#1E4B4B] font-medium">
                            Order #INV-2025-1021 marked as "Cancelled"
                        </div>
                        <div class="text-[11px] text-[#285E5E]/80 mt-0.5">
                            35 minutes ago
                        </div>
                    </div>
                    <span class="text-[10px] inline-flex items-center rounded-lg bg-red-100 text-red-700 font-semibold px-2 py-0.5">
                        ORDER CANCELLED
                    </span>
                </li>
            </ul>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white/70 backdrop-blur-xl border border-[#C1DCDC]/60 rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.06)] flex flex-col">
            <div class="px-4 py-3 border-b border-[#C1DCDC]/60 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-[#1E4B4B]">Quick Actions</h2>
            </div>

            <div class="p-4 text-sm space-y-3">
                <!-- Add User -->
                <a href="#"
                   class="w-full flex items-center justify-between rounded-xl border border-[#C1DCDC]/80 bg-white/70 px-3 py-2 hover:bg-[#F3FBFB] hover:border-[#6AAEAD] transition focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:ring-offset-0">
                    <div class="flex items-start">
                        <div class="h-9 w-9 rounded-lg bg-[#6AAEAD] text-white flex items-center justify-center text-[11px] font-semibold mr-3">
                            +PG
                        </div>
                        <div>
                            <div class="text-[#1E4B4B] font-medium leading-tight">Add User</div>
                            <div class="text-[11px] text-[#285E5E]/80 leading-tight">Create a new account & set roles</div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#285E5E]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- Add Package -->
                <a href="#"
                   class="w-full flex items-center justify-between rounded-xl border border-[#C1DCDC]/80 bg:white/70 px-3 py-2 hover:bg-[#F3FBFB] hover:border-[#6AAEAD] transition focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:ring-offset-0">
                    <div class="flex items-start">
                        <div class="h-9 w-9 rounded-lg bg-[#6AAEAD] text-white flex items-center justify-center text-[11px] font-semibold mr-3">
                            +PKT
                        </div>
                        <div>
                            <div class="text-[#1E4B4B] font-medium leading-tight">Add Package</div>
                            <div class="text-[11px] text-[#285E5E]/80 leading-tight">Register service / product package</div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#285E5E]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- Manage Orders -->
                <a href="#"
                   class="w-full flex items-center justify-between rounded-xl border border-[#C1DCDC]/80 bg:white/70 px-3 py-2 hover:bg-[#F3FBFB] hover:border-[#6AAEAD] transition focus:outline-none focus:ring-2 focus:ring-[#6AAEAD] focus:ring-offset-0">
                    <div class="flex items-start">
                        <div class="h-9 w-9 rounded-lg bg-[#6AAEAD] text-white flex items-center justify-center text-[11px] font-semibold mr-3">
                            PSN
                        </div>
                        <div>
                            <div class="text-[#1E4B4B] font-medium leading-tight">Manage Orders</div>
                            <div class="text-[11px] text-[#285E5E]/80 leading-tight">Verification & payment status</div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#285E5E]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PROJEK\PROJEK SOLVE IT\WEB\govind\resources\views/admin/home.blade.php ENDPATH**/ ?>