<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - PharmaFEFO</title>
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
            <div class="flex items-center gap-4">
                <a href="index.php?action=products" 
                   class="w-9 h-9 flex items-center justify-center rounded-lg border border-slate-200 bg-slate-50 text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-all"
                   title="Return to Catalog Inventory">
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                </a>
                <div>
                    <div class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                        <a href="index.php?action=products" class="hover:text-blue-600 transition-colors">Products</a>
                        <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                        <span class="text-slate-500">Modify Record</span>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight mt-0.5">Edit Product Record</h2>
                </div>
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

        <main class="flex-1 p-4 md:p-6 lg:p-8 overflow-y-auto bg-slate-50/50">

            <div class="max-w-xl bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mx-auto">
                
                <div class="p-5 bg-slate-50/70 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-file-pen"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Update Properties</h3>
                            <p class="text-[11px] font-medium text-slate-400">Modify the registration parameters for this catalog item card.</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold bg-slate-200/60 text-slate-600 px-2 py-0.5 rounded font-mono">
                        ID: #<?= htmlspecialchars($product->id) ?>
                    </span>
                </div>

             <form id="editProductForm" class="p-6 space-y-5">

                    <input type="hidden" name="id" value="<?= $product->id ?>">

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">
                            CIP Code Identifier <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa-solid fa-barcode absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text"
                                   name="cip_code"
                                   required
                                   value="<?= htmlspecialchars($product->cip_code) ?>"
                                   class="w-full bg-white border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-xs font-mono font-bold text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm transition-all"
                                   placeholder="e.g., 3400930001245">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">
                            Pharmaceutical Designation / Name <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa-solid fa-prescription-bottle-medical absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text"
                                   name="designation"
                                   required
                                   value="<?= htmlspecialchars($product->designation) ?>"
                                   class="w-full bg-white border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-xs font-semibold text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm transition-all"
                                   placeholder="e.g., Paracetamol 500mg (Box of 16)">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">
                                Standard Rate Price <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs font-bold">DH</span>
                                <input type="number"
                                       step="0.01"
                                       name="price"
                                       required
                                       min="0"
                                       value="<?= htmlspecialchars($product->price) ?>"
                                       class="w-full bg-white border border-slate-200 rounded-lg pl-10 pr-4 py-2.5 text-xs font-extrabold text-slate-900 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm transition-all"
                                       placeholder="0.00">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">
                                Min Stock Safety Trigger <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <i class="fa-solid fa-triangle-exclamation absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                                <input type="number"
                                       name="min_stock_alert"
                                       required
                                       min="0"
                                       value="<?= htmlspecialchars($product->min_stock_alert) ?>"
                                       class="w-full bg-white border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-xs font-bold text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm transition-all"
                                       placeholder="10">
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100 mt-6">
                        
                        <a href="index.php?action=products"
                           class="px-4 py-2 rounded-lg border border-slate-200 bg-white text-slate-500 hover:text-slate-800 hover:bg-slate-50 font-bold text-xs shadow-sm transition-all">
                            Cancel
                        </a>

                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-xs font-bold shadow-sm transition-all">
                            <i class="fa-solid fa-circle-check text-[11px]"></i>
                            <span>Update Changes</span>
                        </button>

                    </div>

                </form>

            </div>

        </main>
    </div>
</div>

<script>
document.getElementById('editProductForm').addEventListener('submit', async function(e) {

    e.preventDefault();

    const formData = new FormData(this);

    try {

        const response = await fetch(
            'index.php?action=api_product_update',
            {
                method: 'POST',
                body: formData
            }
        );

        const result = await response.json();

        if(result.success){

            alert(result.message);

            window.location.href =
                'index.php?action=products';

        }else{

            alert(result.message);

        }

    } catch(error){

        console.error(error);
        alert('Server Error');

    }

});
</script>

</body>
</html>