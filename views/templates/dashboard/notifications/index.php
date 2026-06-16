<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - PharmaFEFO</title>
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
                    <i class="fa-solid fa-bell text-slate-400 text-lg"></i>
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight">System Alerts Matrix</h2>
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

            <div class="space-y-3">
                <div class="flex items-center gap-2.5 text-rose-700">
                    <div class="w-8 h-8 rounded-lg bg-rose-50 border border-rose-200 flex items-center justify-center">
                        <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold tracking-tight text-slate-900">Expired Batches Ledger</h3>
                        <p class="text-xs text-slate-500">Products that have surpassed expiration dates and must be locked down for immediate manual extraction.</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-rose-200/80 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-rose-50/50 border-b border-rose-100 text-[11px] font-bold text-rose-700 uppercase tracking-wider">
                                    <th class="py-3.5 px-5">Product Destination</th>
                                    <th class="py-3.5 px-5 w-44">Batch Reference</th>
                                    <th class="py-3.5 px-5 w-44">Expiration Deadline</th>
                                    <th class="py-3.5 px-5 text-right w-40">Available Volume</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs divide-y divide-slate-100 text-slate-700 font-medium">
                            
                            <?php if (!empty($expiredBatches)): ?>
                                <?php foreach ($expiredBatches as $batch): ?>
                                    <tr class="hover:bg-rose-50/20 transition-colors">
                                        <td class="py-4 px-5 font-semibold text-slate-900">
                                            <?= htmlspecialchars($batch->product_name) ?>
                                        </td>
                                        <td class="py-4 px-5 font-mono font-bold text-slate-600">
                                            <?= htmlspecialchars($batch->batch_number) ?>
                                        </td>
                                        <td class="py-4 px-5 whitespace-nowrap">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-rose-50 text-rose-700 border border-rose-200 font-bold tracking-tight">
                                                <i class="fa-regular fa-calendar-xmark text-rose-500"></i>
                                                <?= $batch->expiration_date ?>
                                            </span>
                                        </td>
                                        <td class="py-4 px-5 text-right text-slate-900 font-bold text-sm tracking-tight">
                                            <?= number_format($batch->qty_available) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="py-10 px-5 text-center">
                                        <div class="flex flex-col items-center justify-center gap-2 max-w-xs mx-auto">
                                            <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100">
                                                <i class="fa-solid fa-circle-check text-base"></i>
                                            </div>
                                            <p class="text-xs font-bold text-slate-800 mt-1">Clear Status Horizon</p>
                                            <p class="text-[11px] text-slate-400">No active stock items matching standard expired timeline indices found.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex items-center gap-2.5 text-amber-700">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 border border-amber-200 flex items-center justify-center">
                        <i class="fa-solid fa-clock text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold tracking-tight text-slate-900">Expiring Within 90 Days</h3>
                        <p class="text-xs text-slate-500">Proactive inventory lines approaching deadlines. Priortize distribution under strict FEFO protocols.</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                    <th class="py-3.5 px-5">Product Destination</th>
                                    <th class="py-3.5 px-5 w-44">Batch Reference</th>
                                    <th class="py-3.5 px-5 w-44">Expiration Deadline</th>
                                    <th class="py-3.5 px-5 text-right w-40">Available Volume</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs divide-y divide-slate-100 text-slate-700 font-medium">

                            <?php if (!empty($expiringBatches)): ?>
                                <?php foreach ($expiringBatches as $batch): ?>
                                    <tr class="hover:bg-slate-50/60 transition-colors">
                                        <td class="py-4 px-5 font-semibold text-slate-900">
                                            <?= htmlspecialchars($batch->product_name) ?>
                                        </td>
                                        <td class="py-4 px-5 font-mono font-bold text-slate-600">
                                            <?= htmlspecialchars($batch->batch_number) ?>
                                        </td>
                                        <td class="py-4 px-5 whitespace-nowrap">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-50 text-amber-800 border border-amber-200 font-bold tracking-tight">
                                                <i class="fa-regular fa-clock text-amber-600"></i>
                                                <?= $batch->expiration_date ?>
                                            </span>
                                        </td>
                                        <td class="py-4 px-5 text-right text-slate-900 font-bold text-sm tracking-tight">
                                            <?= number_format($batch->qty_available) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="py-10 px-5 text-center">
                                        <div class="flex flex-col items-center justify-center gap-2 max-w-xs mx-auto">
                                            <div class="w-10 h-10 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center border border-slate-100">
                                                <i class="fa-solid fa-box-open text-sm"></i>
                                            </div>
                                            <p class="text-xs font-bold text-slate-800 mt-1">No upcoming warnings</p>
                                            <p class="text-[11px] text-slate-400">All current batch records hold safe lifetime profiles exceeding 90 operational days.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

</body>
</html>