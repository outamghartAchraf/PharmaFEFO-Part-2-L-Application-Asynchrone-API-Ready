<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaFEFO - Add New Batch</title>
    <!-- Tailwind CSS Engine Architecture CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Complete Font Awesome Elements Pack CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Google Fonts Library Definition Framework -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-blue-500 selection:text-white">

<div class="flex h-screen w-screen overflow-hidden">

    <!-- Sidebar Layout Navigation Window -->
     <?php include __DIR__ . '/../../../layout/sidebar.php'; ?>

    <!-- Main Content Context Frame Window Container -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <!-- Top Header Navigation Global Components -->
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

        <!-- Dynamic Main Content View Area -->
        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8 space-y-6">
            
            <!-- Page Header Breadcrumbs Section -->
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600">
                        <i class="fa-solid fa-plus-circle text-sm"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 tracking-tight">Add New Batch</h3>
                </div>
                <p class="text-xs text-slate-500 font-medium mt-1 pl-10">Enter complete production metadata and expiration constraints for dynamic inventory stock control management.</p>
            </div>

            <!-- Form Content Blueprint Card Frame -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm max-w-2xl overflow-hidden">
                <div class="p-6 md:p-8">
                    
                    <form method="POST" action="index.php?action=createSubmitAction" class="space-y-5">

                        <!-- Product Selection Entry Row -->
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide flex items-center gap-1">
                                <i class="fa-solid fa-pills text-slate-400"></i> Product Target <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="product_id" 
                                        class="w-full bg-white text-sm rounded-lg border border-slate-200 px-3.5 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all appearance-none cursor-pointer" 
                                        required>
                                    <option value="" class="text-slate-400">-- Select Targeted Product Reference --</option>
                                    
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?= $product->id ?>">
                                            <?= htmlspecialchars($product->designation) ?>
                                        </option>
                                    <?php endforeach; ?>
                                    
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none text-slate-400 text-[10px]">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Batch Number Identification Alpha-Numeric String Input -->
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide flex items-center gap-1">
                                <i class="fa-solid fa-barcode text-slate-400"></i> Batch Identifier Reference <span class="text-rose-500">*</span>
                            </label>
                            <input type="text"
                                   name="batch_number"
                                   class="w-full bg-white text-sm font-mono tracking-tight rounded-lg border border-slate-200 px-3.5 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all"
                                   placeholder="e.g. PARA-001"
                                   required>
                        </div>

                        <!-- Grid Matrix Grouping: Expiration and Quantity Inputs -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            
                            <!-- Expiration Limitation Target Date Input Element -->
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-700 uppercase tracking-wide flex items-center gap-1">
                                    <i class="fa-solid fa-calendar-times text-slate-400"></i> Expiration Limit Date <span class="text-rose-500">*</span>
                                </label>
                                <input type="date"
                                       name="expiration_date"
                                       class="w-full bg-white text-sm rounded-lg border border-slate-200 px-3.5 py-2.5 text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all"
                                       required>
                            </div>

                            <!-- Initial Received Quantity Volume Metric Input Element -->
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-700 uppercase tracking-wide flex items-center gap-1">
                                    <i class="fa-solid fa-boxes-packing text-slate-400"></i> Quantity Received <span class="text-rose-500">*</span>
                                </label>
                                <input type="number"
                                       name="quantity"
                                       class="w-full bg-white text-sm rounded-lg border border-slate-200 px-3.5 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all"
                                       min="1"
                                       placeholder="Enter total input volume"
                                       required>
                            </div>

                        </div>

                        <!-- Visual Dividing Break Line -->
                        <div class="pt-2 border-t border-slate-100"></div>

                        <!-- Form Actions Navigation Matrix -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-1">
                            <a href="index.php?action=batch_index" 
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm transition-all">
                                <i class="fa-solid fa-arrow-left text-xs"></i>
                                <span>Return to Ledger</span>
                            </a>

                            <button type="submit" 
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm transition-all shadow-sm shadow-emerald-600/10">
                                <i class="fa-solid fa-floppy-disk text-xs"></i>
                                <span>Commit & Save Batch</span>
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </main>
    </div>
</div>

</body>
</html>