<?php
$products = $products ?? [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - PharmaFEFO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
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
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight">Products Management</h2>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Configure medications, master pricing index cards, and monitor minimum criteria metrics.</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="index.php?action=products_create"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold shadow-sm shadow-blue-600/10 transition-all">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Add Product</span>
                    </a>
                    <div class="h-6 w-px bg-slate-200 mx-1"></div>
                    <div class="flex items-center gap-2.5 pl-1 pr-3 py-1 rounded-full border border-slate-200 bg-slate-50 cursor-default">
                        <div class="w-7 h-7 rounded-full bg-blue-100 border border-blue-200 flex items-center justify-center text-[11px] font-bold text-blue-700 shadow-sm">
                            AU
                        </div>
                        <span class="text-xs font-semibold text-slate-700">Admin User</span>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 md:p-6 lg:p-8 overflow-y-auto space-y-6">

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Registered Items</p>
                            <h3 class="text-2xl font-bold text-slate-900 mt-1.5 tracking-tight"><?= count($products) ?></h3>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-semibold">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Inventory Engine</p>
                            <h3 class="text-2xl font-bold text-emerald-600 mt-1.5 tracking-tight flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Active</span>
                            </h3>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-semibold">
                            <i class="fa-solid fa-warehouse"></i>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Protocol Pipeline</p>
                            <h3 class="text-2xl font-bold text-amber-600 mt-1.5 tracking-tight">FEFO Enabled</h3>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-semibold">
                            <i class="fa-solid fa-hourglass-start"></i>
                        </div>
                    </div>

                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

                    <div class="p-4 bg-slate-50 border-b border-slate-200 flex items-center gap-3">
                        <div class="relative flex-1 max-w-md">
                            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text"
                                placeholder="Filter specific molecular designation tokens or CIP keys..."
                                class="w-full bg-white border border-slate-200 rounded-lg pl-9 pr-4 py-2 text-xs font-medium text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm transition-all">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">

                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                    <th class="py-3.5 px-5 w-44">CIP Identifier Token</th>
                                    <th class="py-3.5 px-5">Pharmaceutical Designation Name</th>
                                    <th class="py-3.5 px-5 w-40 text-right">Standard Rate Price</th>
                                    <th class="py-3.5 px-5 w-44 text-right">Min Threshold Trigger</th>
                                    <th class="py-3.5 px-5 text-center w-32">Control Actions</th>
                                </tr>
                            </thead>

                            <tbody id="products-table-body" class="text-xs divide-y divide-slate-100 text-slate-700 font-medium">

                                        

                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        fetch('index.php?action=api_products')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('products-table-body');

                if (!data || data.length === 0) {
                    tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="py-16 px-5 text-center">
                        No products found
                    </td>
                </tr>
            `;
                    return;
                }

                tbody.innerHTML = '';

                data.forEach(product => {
                    tbody.innerHTML += `
                <tr class="hover:bg-slate-50/60 transition-colors">

                    <td class="py-4 px-5 font-mono font-bold text-slate-500 tracking-tight">
                        ${product.cip_code}
                    </td>

                    <td class="py-4 px-5 font-bold text-slate-900 text-sm tracking-tight">
                        ${product.designation}
                    </td>

                    <td class="py-4 px-5 text-right font-extrabold text-slate-900 tracking-tight text-sm">
                        ${parseFloat(product.price).toFixed(2)}
                        <span class="text-xs font-bold text-slate-400 ml-0.5">DH</span>
                    </td>

                    <td class="py-4 px-5 text-right whitespace-nowrap">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded bg-slate-100 text-slate-700 font-bold tracking-tight">
                            <i class="fa-solid fa-bell-concierge text-slate-400 text-[10px]"></i>
                            ${product.min_stock_alert} units
                        </span>
                    </td>

                    <td class="py-4 px-5 text-center whitespace-nowrap">
                        <div class="flex justify-center items-center gap-1.5">

                            <a href="index.php?action=products_edit&id=${product.id}"
                               class="w-8 h-8 flex items-center justify-center bg-white border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition-all shadow-sm">
                                <i class="fa-solid fa-pen text-[11px]"></i>
                            </a>

                    <a
                        href="#"
                        data-id="${product.id}"
                        class="delete-product w-8 h-8 flex items-center justify-center bg-white border border-rose-100 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all shadow-sm">
                        <i class="fa-solid fa-trash text-[11px]"></i>
                    </a>

                        </div>
                    </td>

                </tr>
            `;
                });
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
    </script>

    <script>
        document.addEventListener('click', async function(e) {

            const button = e.target.closest('.delete-product');

            if (!button) return;

            e.preventDefault();

            const id = button.dataset.id;

            if (!confirm('Are you sure ?')) {
                return;
            }

            const response = await fetch(
                `index.php?action=api_product_delete&id=${id}`, {
                    method: 'POST'
                }
            );

            const result = await response.json();

            if (result.success) {

                button.closest('tr').remove();

                alert(result.message);

            } else {

                alert(result.message);

            }

        });
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