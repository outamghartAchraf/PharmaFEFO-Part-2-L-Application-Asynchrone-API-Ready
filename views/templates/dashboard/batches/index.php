<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaFEFO - Batches Inventory Ledger</title>
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

        <header class="bg-white border-b border-slate-200 px-6 lg:px-8 py-4 flex justify-between items-center z-10 flex-shrink-0">
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">Batches Inventory</h2>
                <p class="text-xs text-slate-500 font-medium mt-0.5">Wednesday, 10 June 2026</p>
            </div>
            
            <div class="flex items-center gap-4">
                <button class="relative w-9 h-9 flex items-center justify-center rounded-lg border border-slate-200 bg-slate-50 text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-all" title="Notifications">
                    <i class="fa-solid fa-bell text-base"></i>
                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
                </button>

                <div class="flex items-center gap-2.5 pl-2.5 pr-3.5 py-1.5 rounded-full border border-slate-200 bg-slate-50 hover:bg-slate-100 cursor-pointer transition-all">
                    <div class="w-7 h-7 rounded-full bg-blue-100 border border-blue-200 flex items-center justify-center text-[11px] font-bold text-blue-700 shadow-sm">
                        AU
                    </div>
                    <span class="text-xs font-semibold text-slate-700">Admin User</span>
                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8 space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-600">
                            <i class="fa-solid fa-boxes-stacked text-sm"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 tracking-tight">List of Batches</h3>
                    </div>
                    <p class="text-xs text-slate-500 font-medium mt-1 pl-10">Manage stock inventory instances, tracking horizons, and active FEFO conditions.</p>
                </div>

                <a href="index.php?action=batches_create" class="sm:self-center inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm transition-all shadow-sm shadow-blue-600/10 whitespace-nowrap">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Add New Batch</span>
                </a>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                <th class="py-3.5 px-5">Product Target</th>
                                <th class="py-3.5 px-5">Batch Identifier</th>
                                <th class="py-3.5 px-5">Expiration Limit</th>
                                <th class="py-3.5 px-5">Qty Received</th>
                                <th class="py-3.5 px-5">Qty Available</th>
                                <th class="py-3.5 px-5">Operational Status</th>
                                <th class="py-3.5 px-5 text-right">Actions Matrix</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs divide-y divide-slate-100 text-slate-700 font-medium">

                        <?php if (!empty($batches)): ?>
                            <?php foreach ($batches as $batch): ?>
                                <tr class="hover:bg-slate-50/60 transition-colors">

                                    <td class="py-4 px-5 font-semibold text-slate-900">
                                        <?= htmlspecialchars($batch->product_name ?? 'N/A') ?>
                                    </td>

                                    <td class="py-4 px-5 text-slate-600 font-mono tracking-tight font-bold">
                                        <?= htmlspecialchars($batch->batch_number) ?>
                                    </td>

                                    <td class="py-4 px-5 text-slate-500">
                                        <?= htmlspecialchars($batch->expiration_date) ?>
                                    </td>

                                    <td class="py-4 px-5 text-slate-500">
                                        <?= (int)$batch->qty_received ?>
                                    </td>

                                    <td class="py-4 px-5">
                                        <?php if ($batch->qty_available <= 0): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded bg-rose-50 text-rose-700 font-bold border border-rose-100">0 Available</span>
                                        <?php else: ?>
                                            <span class="text-slate-900 font-bold text-sm"><?= (int)$batch->qty_available ?></span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="py-4 px-5">
                                        <?php if ($batch->status === 'ACTIVE'): ?>
                                            <span class="inline-flex items-center gap-1 bg-emerald-50 border border-emerald-200 text-emerald-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                                                <i class="fa-solid fa-circle text-[5px] text-emerald-500"></i> ACTIVE
                                            </span>

                                        <?php elseif ($batch->status === 'EXPIRED'): ?>
                                            <span class="inline-flex items-center gap-1 bg-rose-50 border border-rose-200 text-rose-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                                                <i class="fa-solid fa-circle text-[5px] text-rose-500 animate-pulse"></i> EXPIRED
                                            </span>

                                        <?php elseif ($batch->status === 'DESTROYED'): ?>
                                            <span class="inline-flex items-center gap-1 bg-slate-100 border border-slate-300 text-slate-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                                                <i class="fa-solid fa-circle text-[5px] text-slate-500"></i> DESTROYED
                                            </span>

                                        <?php elseif ($batch->status === 'RETURNED'): ?>
                                            <span class="inline-flex items-center gap-1 bg-amber-50 border border-amber-200 text-amber-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                                                <i class="fa-solid fa-circle text-[5px] text-amber-500"></i> RETURNED
                                            </span>

                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 bg-blue-50 border border-blue-200 text-blue-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                                                <?= htmlspecialchars($batch->status) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="py-4 px-5 text-right whitespace-nowrap">
                                        <div class="inline-flex items-center gap-1.5">
                                            <a href="index.php?action=batch_edit&id=<?= $batch->id ?>" 
                                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 bg-white text-slate-600 hover:text-amber-700 hover:bg-amber-50 hover:border-amber-200 transition-all" 
                                               title="Edit Parameters">
                                                <i class="fa-solid fa-pen text-xs"></i>
                                            </a>
                                            
                                            <a href="index.php?action=batch_delete&id=<?= $batch->id ?>" 
                                               onclick="return confirm('Are you sure you want to permanently delete this batch reference?')"
                                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 bg-white text-slate-400 hover:text-rose-700 hover:bg-rose-50 hover:border-rose-200 transition-all" 
                                               title="Delete Entry">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>

                            <tr>
                                <td colspan="7" class="py-12 px-5 text-center">
                                    <div class="flex flex-col items-center justify-center gap-2 max-w-sm mx-auto">
                                        <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100">
                                            <i class="fa-solid fa-box-open text-xl"></i>
                                        </div>
                                        <p class="text-sm font-bold text-slate-800 mt-2">No active batches tracked</p>
                                        <p class="text-xs text-slate-400">There are currently no record indicators configured inside this dataset schema context frame.</p>
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
    fetch('index.php?action=api_batches')
        .then(response => response.json())
        .then(data => {
  
        })
        .catch(error => console.error('Error fetching products:', error));
</script>

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