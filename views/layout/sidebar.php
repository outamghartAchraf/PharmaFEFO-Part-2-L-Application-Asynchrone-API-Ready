<?php

$page = $_GET['action'] ?? 'dashboard';
$role = trim($_SESSION['user']['role'] ?? '');

function canAccess(array $roles): bool
{
    return in_array(
        trim($_SESSION['user']['role'] ?? ''),
        $roles,
        true
    );
}

?>
<aside class="w-60 bg-slate-900 text-white flex flex-col flex-shrink-0 border-r border-slate-800 hidden md:flex">

    <!-- Logo -->
    <div class="p-5 border-b border-slate-800 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-blue-600/15 border border-blue-500/30 flex items-center justify-center">
            <i class="fa-solid fa-capsules text-blue-400 text-xl"></i>
        </div>

        <div>
            <h1 class="text-sm font-bold tracking-tight text-white">
                PharmaFEFO
            </h1>

            <p class="text-[11px] text-slate-500 font-medium tracking-wide">
                FEFO Management
            </p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-3 flex flex-col gap-1 overflow-y-auto">

        <!-- Dashboard -->
        <a href="index.php?action=dashboard"
           class="<?= $page === 'dashboard'
                ? 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg bg-blue-600 text-white font-medium text-sm'
                : 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/50 font-medium text-sm transition-all' ?>">
            <i class="fa-solid fa-chart-pie text-base w-5 text-center"></i>
            <span>Dashboard</span>
        </a>

        <!-- Products -->
        <?php if (canAccess(['ADMIN', 'PHARMACIEN'])): ?>
            <a href="index.php?action=products"
               class="<?= in_array($page, ['products', 'products_create', 'products_edit'])
                    ? 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg bg-blue-600 text-white font-medium text-sm'
                    : 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/50 font-medium text-sm transition-all' ?>">
                <i class="fa-solid fa-pills text-base w-5 text-center"></i>
                <span>Products</span>
            </a>
        <?php endif; ?>

        <!-- Batches -->
        <?php if (canAccess(['ADMIN', 'PHARMACIEN'])): ?>
            <a href="index.php?action=batches"
               class="<?= in_array($page, ['batches', 'batches_create', 'batch_edit'])
                    ? 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg bg-blue-600 text-white font-medium text-sm'
                    : 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/50 font-medium text-sm transition-all' ?>">
                <i class="fa-solid fa-boxes-stacked text-base w-5 text-center"></i>
                <span>Batches</span>
            </a>
        <?php endif; ?>

        <!-- Stock Movements -->
        <?php if (canAccess(['ADMIN', 'PHARMACIEN', 'PREPARATEUR'])): ?>
            <a href="index.php?action=stock_movements"
               class="<?= in_array($page, ['stock_movements', 'stock_create'])
                    ? 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg bg-blue-600 text-white font-medium text-sm'
                    : 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/50 font-medium text-sm transition-all' ?>">
                <i class="fa-solid fa-arrow-right-arrow-left text-base w-5 text-center"></i>
                <span>Stock Movements</span>
            </a>
        <?php endif; ?>

        <!-- Notifications -->
        <?php if (canAccess(['ADMIN', 'PHARMACIEN'])): ?>
            <a href="index.php?action=notifications"
               class="<?= $page === 'notifications'
                    ? 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg bg-blue-600 text-white font-medium text-sm'
                    : 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/50 font-medium text-sm transition-all' ?>">
                <i class="fa-solid fa-bell text-base w-5 text-center"></i>

                <span>Notifications</span>

                <?php if (!empty($notificationCount)): ?>
                    <span class="ml-auto bg-rose-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                        <?= $notificationCount ?>
                    </span>
                <?php endif; ?>
            </a>
        <?php endif; ?>

        <!-- Reports -->
        <?php if (canAccess(['ADMIN'])): ?>
            <a href="index.php?action=reports"
               class="<?= in_array($page, [
                        'reports',
                        'report_expired',
                        'report_expiring',
                        'report_stock',
                        'report_movements'
                    ])
                    ? 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg bg-blue-600 text-white font-medium text-sm'
                    : 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/50 font-medium text-sm transition-all' ?>">
                <i class="fa-solid fa-file-lines text-base w-5 text-center"></i>
                <span>Reports</span>
            </a>
        <?php endif; ?>

        <!-- Users -->
        <?php if (canAccess(['ADMIN'])): ?>
            <a href="index.php?action=user_index"
               class="<?= in_array($page, [
                        'user_index',
                        'user_create',
                        'user_edit'
                    ])
                    ? 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg bg-blue-600 text-white font-medium text-sm'
                    : 'flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/50 font-medium text-sm transition-all' ?>">
                <i class="fa-solid fa-users text-base w-5 text-center"></i>
                <span>Users</span>
            </a>
        <?php endif; ?>

    </nav>

    <!-- Logout -->
    <div class="p-3 border-t border-slate-800">
        <a href="index.php?action=logout"
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 font-medium text-sm transition-all">
            <i class="fa-solid fa-right-from-bracket text-base w-5 text-center"></i>
            <span>Logout</span>
        </a>
    </div>

</aside>