<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaFEFO - Stock Movements Ledger</title>
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

<?php if (isset($_GET['message'])): ?>
<div id="toast"
     class="fixed top-5 right-5 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50">
    <?= htmlspecialchars($_GET['message']) ?>
</div>
 
<?php endif; ?>

<div class="flex h-screen w-screen overflow-hidden">

       <?php include __DIR__ . '/../../../layout/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <header class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center z-10 flex-shrink-0">
            <div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-arrow-right-arrow-left text-slate-400 text-lg"></i>
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight">Stock Movements</h2>
                </div>
                <p class="text-xs text-slate-500 font-medium mt-0.5">
                    <?= date('l, d F Y') ?>
                </p>
            </div>

            <a href="index.php?action=stock_create"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 text-white rounded-lg text-sm font-semibold hover:bg-emerald-700 transition-all shadow-sm shadow-emerald-600/10">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>New Movement</span>
            </a>
        </header>

        <main class="flex-1 p-6 overflow-y-auto space-y-4">

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="flex items-start gap-3 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium shadow-sm animate-fade-in">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-base mt-0.5"></i>
                    <div><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="flex items-start gap-3 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-sm font-medium shadow-sm animate-fade-in">
                    <i class="fa-solid fa-circle-exclamation text-rose-500 text-base mt-0.5"></i>
                    <div><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">

                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                <th class="py-3.5 px-5 w-20 text-center">ID</th>
                                <th class="py-3.5 px-5">Batch Reference</th>
                                <th class="py-3.5 px-5 w-36">Movement Type</th>
                                <th class="py-3.5 px-5 w-28">Quantity</th>
                                <th class="py-3.5 px-5">Operational Note / Reason</th>
                                <th class="py-3.5 px-5 text-right w-44">Transaction Date</th>
                            </tr>
                        </thead>

                        <tbody class="text-xs divide-y divide-slate-100 text-slate-700 font-medium">

                        <?php if (!empty($movements)): ?>
                            <?php foreach ($movements as $m): ?>

                                <tr class="hover:bg-slate-50/60 transition-colors">

                                    <td class="py-4 px-5 text-center font-mono font-semibold text-slate-400">
                                        #<?= $m->id ?>
                                    </td>

                                    <td class="py-4 px-5 font-mono font-bold text-sm tracking-tight text-slate-900">
                                        <?= htmlspecialchars($m->batch_number ?? '-') ?>
                                    </td>

                                    <td class="py-4 px-5 whitespace-nowrap">
                                        <?php if ($m->type === 'IN'): ?>
                                            <span class="inline-flex items-center gap-1 bg-emerald-50 border border-emerald-200 text-emerald-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                                                <i class="fa-solid fa-arrow-turn-down text-emerald-500"></i> Stock In
                                            </span>

                                        <?php elseif ($m->type === 'OUT'): ?>
                                            <span class="inline-flex items-center gap-1 bg-rose-50 border border-rose-200 text-rose-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                                                <i class="fa-solid fa-arrow-turn-up text-rose-500"></i> Stock Out
                                            </span>

                                        <?php elseif ($m->type === 'RETURN'): ?>
                                            <span class="inline-flex items-center gap-1 bg-amber-50 border border-amber-200 text-amber-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                                                <i class="fa-solid fa-rotate-left text-amber-500"></i> Returned
                                            </span>

                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 bg-slate-100 border border-slate-200 text-slate-700 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                                                <?= htmlspecialchars($m->type) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="py-4 px-5 font-bold text-sm text-slate-900 tracking-tight">
                                        <?= number_format((int) $m->quantity) ?>
                                    </td>

                                    <td class="py-4 px-5 text-slate-500 max-w-xs truncate" title="<?= htmlspecialchars($m->note ?? '') ?>">
                                        <?= htmlspecialchars($m->note ?? '-') ?>
                                    </td>

                                    <td class="py-4 px-5 text-right text-slate-400 font-semibold tracking-tight whitespace-nowrap">
                                        <?= $m->movement_date ?? '-' ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>
                        <?php else: ?>

                            <tr>
                                <td colspan="6" class="py-14 px-5 text-center">
                                    <div class="flex flex-col items-center justify-center gap-2.5 max-w-sm mx-auto">
                                        <div class="w-11 h-11 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100">
                                            <i class="fa-solid fa-box-open text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">No transactions recorded</p>
                                            <p class="text-xs text-slate-400 mt-0.5">There are currently no real-time inventory entries tracked across this tracking ledger line segment window.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
    setTimeout(() => {
    const toast = document.getElementById('toast');
    if (toast) {
        toast.remove();
    }
}, 3000);
</script>

</body>
</html>