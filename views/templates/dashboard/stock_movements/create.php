<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaFEFO - New Stock Movement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=400;500;600;700&display=swap" rel="stylesheet">
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
                    <i class="fa-solid fa-arrow-right-arrow-left text-slate-400 text-lg"></i>
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight">Stock Movements</h2>
                </div>
                <p class="text-xs text-slate-500 font-medium mt-0.5">
                    <?= date('l, d F Y') ?>
                </p>
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
            
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600">
                        <i class="fa-solid fa-plus text-sm"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 tracking-tight">New Stock Movement</h3>
                </div>
                <p class="text-xs text-slate-500 font-medium mt-1 pl-10">Manually log an inbound delivery, dispense product, or process stock discrepancies.</p>
            </div>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="flex items-start gap-3 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-sm font-medium shadow-sm max-w-2xl animate-fade-in">
                    <i class="fa-solid fa-circle-exclamation text-rose-500 text-base mt-0.5"></i>
                    <div><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                </div>
            <?php endif; ?>

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm max-w-2xl overflow-hidden">
                <p id="Errorform" class="text-red-500 text-sm mt-2 px-4 pt-4"></p>
                <div class="p-6 md:p-8">

                    <form id="stockMovementForm" class="space-y-5">

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide flex items-center gap-1">
                                <i class="fa-solid fa-pills text-slate-400"></i> Product Target <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="product_id" 
                                        class="w-full bg-white text-sm rounded-lg border border-slate-200 px-3.5 py-2.5 text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all appearance-none cursor-pointer" 
                                         >
                                    <option value="" class="text-slate-400">-- Select Product --</option>
                                    
                                    <?php foreach ($products as $p): ?>
                                        <option value="<?= $p->id ?>">
                                            <?= htmlspecialchars($p->designation) ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none text-slate-400 text-[10px]">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-700 uppercase tracking-wide flex items-center gap-1">
                                    <i class="fa-solid fa-arrow-right-arrow-left text-slate-400"></i> Movement Type <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="type" 
                                            class="w-full bg-white text-sm rounded-lg border border-slate-200 px-3.5 py-2.5 text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all appearance-none cursor-pointer" 
                                             >
                                        <option value="IN">IN (Stock Entry)</option>
                                        <option value="OUT">OUT (Dispense)</option>
                                        <option value="RETURN">RETURN</option>
                                        <option value="ADJUSTMENT">ADJUSTMENT</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none text-slate-400 text-[10px]">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-700 uppercase tracking-wide flex items-center gap-1">
                                    <i class="fa-solid fa-boxes-stacked text-slate-400"></i> Units Quantity <span class="text-rose-500">*</span>
                                </label>
                                <input type="number" 
                                       name="quantity" 
                                       min="1"
                                       placeholder="e.g. 250"
                                       class="w-full bg-white text-sm rounded-lg border border-slate-200 px-3.5 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all"
                                        >
                            </div>

                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide flex items-center gap-1">
                                <i class="fa-solid fa-comment-dots text-slate-400"></i> Internal Note / Reason
                            </label>
                            <textarea name="note" 
                                      rows="3"
                                      placeholder="Add an optional explanation or purchase reference description..."
                                      class="w-full bg-white text-sm rounded-lg border border-slate-200 px-3.5 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all"></textarea>
                        </div>

                        <div class="pt-2 border-t border-slate-100"></div>

                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-1">
                            <a href="index.php?action=stock_movements" 
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm transition-all">
                                <i class="fa-solid fa-arrow-left text-xs"></i>
                                <span>Cancel</span>
                            </a>

                            <button type="submit" 
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm transition-all shadow-sm shadow-emerald-600/10">
                                <i class="fa-solid fa-square-check text-xs"></i>
                                <span>Save Stock Movement</span>
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </main>
    </div>
</div>

<script>
document.getElementById('stockMovementForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    if(!formData.get('product_id') || !formData.get('type') || !formData.get('quantity')) {
        document.getElementById('Errorform').textContent = 'Please fill in all required fields.';
        return;
    }

    fetch('index.php?action=api_stock_store', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        if (data.success) {

            window.location.href =
                'index.php?action=stock_movements&message=' +
                encodeURIComponent(data.message);

        } else {
            document.getElementById('Errorform').textContent = data.message || 'Error saving stock movement';
        }

    })
    .catch(err => {
        console.error(err);
        document.getElementById('Errorform').textContent = 'An unexpected error occurred';
    });

});
</script>
</body>
</html>