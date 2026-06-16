<?php
/** @var object $statistics */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Dashboard - PharmaFEFO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-blue-500 selection:text-white">

<div class="flex h-screen w-screen overflow-hidden">

     <?php include __DIR__ . '/../../../layout/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <header class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center z-10 flex-shrink-0">
            <div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-file-lines text-slate-400 text-lg"></i>
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight">Reports Dashboard</h2>
                </div>
                <p class="text-xs text-slate-500 font-medium mt-0.5">
                    <?= date('l, d F Y') ?>
                </p>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2.5 pl-2.5 pr-3.5 py-1.5 rounded-full border border-slate-200 bg-slate-50 cursor-default">
                    <div class="w-7 h-7 rounded-full bg-blue-100 border border-blue-200 flex items-center justify-center text-[11px] font-bold text-blue-700 shadow-sm">
                        AU
                    </div>
                    <span class="text-xs font-semibold text-slate-700">Admin User</span>
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 md:p-6 lg:p-8 overflow-y-auto space-y-8">
            
            <div class="space-y-1">
                <h3 class="text-lg font-bold tracking-tight text-slate-900">Analytics Overview</h3>
                <p class="text-xs text-slate-500">Real-time status summaries tracking pharmaceutical stock volume configurations, custom batch lines, and operational lifecycle limits.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 relative overflow-hidden group">
                    <div class="flex items-center justify-between">
                        <div class="space-y-1.5">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Products</p>
                            <h4 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                                <?= number_format((int) $statistics->total_products) ?>
                            </h4>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-all duration-300">
                            <i class="fa-solid fa-pills text-lg"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 relative overflow-hidden group">
                    <div class="flex items-center justify-between">
                        <div class="space-y-1.5">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Batches</p>
                            <h4 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                                <?= number_format((int) $statistics->total_batches) ?>
                            </h4>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600 transition-all duration-300">
                            <i class="fa-solid fa-boxes-stacked text-lg"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 relative overflow-hidden group">
                    <div class="flex items-center justify-between">
                        <div class="space-y-1.5">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Expired Batches</p>
                            <h4 class="text-3xl font-extrabold text-rose-600 tracking-tight">
                                <?= number_format((int) $statistics->expired_batches) ?>
                            </h4>
                        </div>
                        <div class="w-12 h-12 rounded-xl <?= (int)$statistics->expired_batches > 0 ? 'bg-rose-50 text-rose-600 border border-rose-100' : 'bg-slate-50 text-slate-400 border border-slate-100' ?> flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white group-hover:border-rose-600 transition-all duration-300">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 relative overflow-hidden group">
                    <div class="flex items-center justify-between">
                        <div class="space-y-1.5">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Expiring Soon</p>
                            <h4 class="text-3xl font-extrabold text-amber-600 tracking-tight">
                                <?= number_format((int) $statistics->expiring_soon) ?>
                            </h4>
                        </div>
                        <div class="w-12 h-12 rounded-xl <?= (int)$statistics->expiring_soon > 0 ? 'bg-amber-50 text-amber-600 border border-amber-100' : 'bg-slate-50 text-slate-400 border border-slate-100' ?> flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white group-hover:border-amber-600 transition-all duration-300">
                            <i class="fa-solid fa-clock text-lg"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="space-y-3">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Available Report Channels</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <a href="index.php?action=report_stock"
                       class="group bg-white border border-slate-200 rounded-xl p-5 shadow-sm hover:border-blue-500 hover:shadow-md hover:shadow-blue-500/5 flex items-start gap-4 transition-all duration-200">
                        <div class="w-11 h-11 rounded-lg bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-colors">
                            <i class="fa-solid fa-warehouse text-base"></i>
                        </div>
                        <div class="space-y-0.5 flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors flex items-center justify-between">
                                <span>Current Stock Report</span>
                                <i class="fa-solid fa-arrow-right text-[10px] text-slate-300 group-hover:text-blue-500 group-hover:translate-x-0.5 transition-all"></i>
                            </h4>
                            <p class="text-xs text-slate-500 leading-relaxed">Extract and analyze absolute volumetric counts structured precisely by processing batch configurations.</p>
                        </div>
                    </a>

                    <a href="index.php?action=report_expired"
                       class="group bg-white border border-slate-200 rounded-xl p-5 shadow-sm hover:border-rose-500 hover:shadow-md hover:shadow-rose-500/5 flex items-start gap-4 transition-all duration-200">
                        <div class="w-11 h-11 rounded-lg bg-rose-50 border border-rose-100 text-rose-600 flex items-center justify-center flex-shrink-0 group-hover:bg-rose-600 group-hover:text-white group-hover:border-rose-600 transition-colors">
                            <i class="fa-solid fa-ban text-base"></i>
                        </div>
                        <div class="space-y-0.5 flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-slate-900 group-hover:text-rose-600 transition-colors flex items-center justify-between">
                                <span>Expired Products Report</span>
                                <i class="fa-solid fa-arrow-right text-[10px] text-slate-300 group-hover:text-rose-500 group-hover:translate-x-0.5 transition-all"></i>
                            </h4>
                            <p class="text-xs text-slate-500 leading-relaxed">Review broken lifetime indexes and extract safe waste listings for quarantined chemical structures.</p>
                        </div>
                    </a>

                    <a href="index.php?action=report_expiring"
                       class="group bg-white border border-slate-200 rounded-xl p-5 shadow-sm hover:border-amber-500 hover:shadow-md hover:shadow-amber-500/5 flex items-start gap-4 transition-all duration-200">
                        <div class="w-11 h-11 rounded-lg bg-amber-50 border border-amber-100 text-amber-600 flex items-center justify-center flex-shrink-0 group-hover:bg-amber-600 group-hover:text-white group-hover:border-amber-600 transition-colors">
                            <i class="fa-solid fa-hourglass-half text-base"></i>
                        </div>
                        <div class="space-y-0.5 flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-slate-900 group-hover:text-amber-600 transition-colors flex items-center justify-between">
                                <span>Expiring Soon Report</span>
                                <i class="fa-solid fa-arrow-right text-[10px] text-slate-300 group-hover:text-amber-600 group-hover:translate-x-0.5 transition-all"></i>
                            </h4>
                            <p class="text-xs text-slate-500 leading-relaxed">Isolate active products tracking down final 90 operational days to fine-tune FEFO allocation priorities.</p>
                        </div>
                    </a>

                    <a href="index.php?action=report_movements"
                       class="group bg-white border border-slate-200 rounded-xl p-5 shadow-sm hover:border-emerald-500 hover:shadow-md hover:shadow-emerald-500/5 flex items-start gap-4 transition-all duration-200">
                        <div class="w-11 h-11 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600 transition-colors">
                            <i class="fa-solid fa-arrow-right-arrow-left text-base"></i>
                        </div>
                        <div class="space-y-0.5 flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-slate-900 group-hover:text-emerald-600 transition-colors flex items-center justify-between">
                                <span>Stock Movements Report</span>
                                <i class="fa-solid fa-arrow-right text-[10px] text-slate-300 group-hover:text-emerald-500 group-hover:translate-x-0.5 transition-all"></i>
                            </h4>
                            <p class="text-xs text-slate-500 leading-relaxed">Audit comprehensive transaction execution timelines mapping every single inbound, entry or adjustment step.</p>
                        </div>
                    </a>

                </div>
            </div>

        </main>
    </div>
</div>

</body>
</html>