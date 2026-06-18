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
                            <tbody id="batchesTableBody" class="text-xs divide-y divide-slate-100 text-slate-700 font-medium">



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
            .then(batches => {

                const tbody = document.getElementById('batchesTableBody');

                if (batches.length === 0) {
                    tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="py-12 px-5 text-center">
                        <div class="flex flex-col items-center justify-center gap-2 max-w-sm mx-auto">
                            <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100">
                                <i class="fa-solid fa-box-open text-xl"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-800 mt-2">
                                No active batches tracked
                            </p>
                        </div>
                    </td>
                </tr>
            `;
                    return;
                }

                let html = '';

                batches.forEach(batch => {

                    let statusBadge = '';

                    if (batch.status === 'ACTIVE') {
                        statusBadge = `
                    <span class="inline-flex items-center gap-1 bg-emerald-50 border border-emerald-200 text-emerald-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                        <i class="fa-solid fa-circle text-[5px] text-emerald-500"></i>
                        ACTIVE
                    </span>
                `;
                    } else if (batch.status === 'EXPIRED') {
                        statusBadge = `
                    <span class="inline-flex items-center gap-1 bg-rose-50 border border-rose-200 text-rose-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                        <i class="fa-solid fa-circle text-[5px] text-rose-500"></i>
                        EXPIRED
                    </span>
                `;
                    } else if (batch.status === 'DESTROYED') {
                        statusBadge = `
                    <span class="inline-flex items-center gap-1 bg-slate-100 border border-slate-300 text-slate-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                        <i class="fa-solid fa-circle text-[5px] text-slate-500"></i>
                        DESTROYED
                    </span>
                `;
                    } else {
                        statusBadge = `
                    <span class="inline-flex items-center gap-1 bg-amber-50 border border-amber-200 text-amber-800 px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide uppercase">
                        ${batch.status}
                    </span>
                `;
                    }

                    html += `
                <tr class="hover:bg-slate-50/60 transition-colors">

                    <td class="py-4 px-5 font-semibold text-slate-900">
                        ${batch.product_name}
                    </td>

                    <td class="py-4 px-5 text-slate-600 font-mono tracking-tight font-bold">
                        ${batch.batch_number}
                    </td>

                    <td class="py-4 px-5 text-slate-500">
                        ${batch.expiration_date}
                    </td>

                    <td class="py-4 px-5 text-slate-500">
                        ${batch.qty_received}
                    </td>

                    <td class="py-4 px-5">
                        ${
                            batch.qty_available <= 0
                            ? `<span class="inline-flex items-center px-2 py-0.5 rounded bg-rose-50 text-rose-700 font-bold border border-rose-100">
                                    0 Available
                               </span>`
                            : `<span class="text-slate-900 font-bold text-sm">
                                    ${batch.qty_available}
                               </span>`
                        }
                    </td>

                    <td class="py-4 px-5">
                        ${statusBadge}
                    </td>

                    <td class="py-4 px-5 text-right whitespace-nowrap">
                        <div class="inline-flex items-center gap-1.5">

                            <a href="index.php?action=batch_edit&id=${batch.id}"
                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 bg-white text-slate-600 hover:text-amber-700 hover:bg-amber-50 hover:border-amber-200 transition-all">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>
                    <a
                        href="#"
                        data-id="${batch.id}"
                        class="delete-batch w-8 h-8 flex items-center justify-center bg-white border border-rose-100 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all shadow-sm">
                        <i class="fa-solid fa-trash text-[11px]"></i>
                    </a>
                        </div>
                    </td>
                </tr>
            `;
                });

                tbody.innerHTML = html;
            })
            .catch(error => console.error(error));
    </script>

    <script>
        document.addEventListener('click', async function(e) {

            const button = e.target.closest('.delete-batch');

            if (!button) return;

            e.preventDefault();

            const id = button.dataset.id;

            if (!confirm('Are you sure ?')) {
                return;
            }

            const response = await fetch(
                `index.php?action=api_batch_delete&id=${id}`, {
                    method: 'POST'
                }
            );

            const result = await response.json();

            if (result.success) {

                button.closest('tr').remove();
                window.location.href = 'index.php?action=batches&message=' + encodeURIComponent(result.message || 'Batch deleted successfully');

            } else {

                window.location.href = 'index.php?action=batches&message=' + encodeURIComponent(result.message || 'Error while deleting batch');
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