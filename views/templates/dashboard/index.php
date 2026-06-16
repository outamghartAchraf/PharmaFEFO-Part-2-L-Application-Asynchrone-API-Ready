<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PharmaFEFO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy-brand': '#0f3460',
                        'blue-active': '#1a56db',
                        'red-alert': '#e24b4a',
                    },
                    fontFamily: {
                        sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Context Layout Custom Scrollbar Elements */
        .content::-webkit-scrollbar { width: 5px; }
        .content::-webkit-scrollbar-track { background: transparent; }
        .content::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-blue-500 selection:text-white overflow-hidden">

<div class="flex h-screen w-screen overflow-hidden">

        <?php include __DIR__ . '/../../layout/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <header class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center z-10 flex-shrink-0">
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">Dashboard Overview</h2>
                <p class="text-xs font-semibold text-slate-400 mt-0.5">Wednesday, 10 June 2026</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative w-9 h-9 rounded-lg border border-slate-200 bg-slate-50 text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-all flex items-center justify-center cursor-pointer" title="System Notifications Panel">
                    <i class="fa-solid fa-bell text-sm"></i>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                </div>

                <div class="flex items-center gap-2.5 pl-2.5 pr-3.5 py-1.5 rounded-full border border-slate-200 bg-slate-50 hover:bg-slate-100 cursor-pointer transition-all">
                    <div class="w-7 h-7 rounded-full bg-blue-100 border border-blue-200 flex items-center justify-center text-[11px] font-bold text-blue-700 shadow-sm">
                        AU
                    </div>
                    <span class="text-xs font-bold text-slate-700"><?php echo $_SESSION['user']['name'] ?? 'User'; ?></span>
                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                </div>
            </div>
        </header>

        <main class="content flex-1 p-4 md:p-6 lg:p-8 overflow-y-auto bg-slate-50/50 space-y-6">
            
            <div>
                <p class="text-[10px] font-bold text-slate-400 tracking-wider uppercase mb-3">Core Stock Metrics</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm flex flex-col justify-between gap-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Products Total</span>
                                <div class="text-2xl font-extrabold text-slate-900 mt-1"><?php echo $totalProducts; ?></div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600">
                                <i class="fa-solid fa-pills text-lg"></i>
                            </div>
                        </div>
                        <div class="text-[11px] font-semibold text-slate-400 flex items-center gap-1.5">
                            <i class="fa-solid fa-layer-group text-slate-300"></i> Active managed items
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm flex flex-col justify-between gap-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Active Batches</span>
                                <div class="text-2xl font-extrabold text-slate-900 mt-1"><?php echo $totalBatches; ?></div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600">
                                <i class="fa-solid fa-boxes-stacked text-lg"></i>
                            </div>
                        </div>
                        <div class="text-[11px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-100/40 px-2 py-0.5 rounded self-start flex items-center gap-1">
                            <i class="fa-solid fa-arrow-trend-up text-xs"></i> +12 this month
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm flex flex-col justify-between gap-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Expiring Soon</span>
                                <div class="text-2xl font-extrabold text-slate-900 mt-1"><?php echo $expiringCount; ?></div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600">
                                <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                            </div>
                        </div>
                        <div class="text-[11px] font-bold text-rose-600 bg-rose-50 border border-rose-100/40 px-2 py-0.5 rounded self-start flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-xs"></i> 5 critical thresholds
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm flex flex-col justify-between gap-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Monthly Losses</span>
                                <div class="text-2xl font-extrabold text-slate-900 mt-1">2,450.00 <span class="text-sm font-semibold text-slate-500">DH</span></div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600">
                                <i class="fa-solid fa-coins text-lg"></i>
                            </div>
                        </div>
                        <div class="text-[11px] font-semibold text-slate-400 flex items-center gap-1.5">
                            <i class="fa-solid fa-calendar-minus text-slate-300"></i> Tracked for June 2026
                        </div>
                    </div>

                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-teal-50 text-teal-600 border border-teal-100 flex items-center justify-center text-base flex-shrink-0">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">Next Expiration Deadline</span>
                        <div class="text-base font-bold text-slate-900 mt-0.5">July 15, 2026</div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-violet-50 text-violet-600 border border-violet-100 flex items-center justify-center text-base flex-shrink-0">
                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">Total Transactions Today</span>
                        <div class="text-base font-bold text-slate-900 mt-0.5">37 stock movements</div>
                    </div>
                </div>

            </div>

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                
                <div class="px-5 py-4 bg-slate-50/70 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 border border-rose-100 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900">Critical FEFO Expiration Warnings</h3>
                    </div>
                    <a href="index.php?action=notifications_index" class="text-xs font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
                        <span>View complete queue</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/50">
                                <th class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-5 py-3 text-left">Product Label Name</th>
                                <th class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-5 py-3 text-left">Batch Code</th>
                                <th class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-5 py-3 text-left">Expiration Target Date</th>
                                <th class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-5 py-3 text-left">Remaining Quantity</th>
                                <th class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-5 py-3 text-center">Threat Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php foreach ($fefoWarnings as $warning): ?>
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-5 py-3.5 text-xs font-semibold text-slate-900"><?php echo $warning->product_name; ?></td>
                                    <td class="px-5 py-3.5 text-xs font-mono font-bold text-slate-500"><?php echo $warning->batch_number; ?></td>
                                    <td class="px-5 py-3.5 text-xs font-mono font-bold text-slate-600"><?php echo $warning->expiration_date; ?></td>
                                    <td class="px-5 py-3.5 text-xs font-bold text-slate-900"><?php echo $warning->qty_available; ?> units</td>
                                <td class="px-5 py-3.5 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-rose-50 border border-rose-200 text-rose-700 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span> Critical
                                    </span>
                                </td>
                            </tr>
                                
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            </div>

        </main>
    </div>
</div>

</body>
</html>