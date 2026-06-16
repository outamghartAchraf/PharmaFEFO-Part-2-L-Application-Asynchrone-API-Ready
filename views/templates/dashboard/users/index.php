<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management - PharmaFEFO</title>
    <!-- Tailwind CSS Script Architecture Engine CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Complete Font Awesome Elements Pack Components CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Google Fonts Inter Typography Configuration Matrix -->
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

    <!-- Workspace Window Core Context Container Block Framework -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <!-- Top Header Navigation Global Components -->
        <header class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center z-10 flex-shrink-0">
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">System Identity & Access</h2>
                <p class="text-xs font-semibold text-slate-400 mt-0.5">Manage operator permissions and application access roles</p>
            </div>

            <div class="flex items-center gap-4">
                <!-- PRIMARY RESOURCE INGESTION ACTION TRIGGER -->
                <a href="index.php?action=user_create"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm transition-all">
                    <i class="fa-solid fa-user-plus text-[11px]"></i>
                    <span>Add New Operator</span>
                </a>

                <div class="h-6 w-px bg-slate-200"></div>

                <div class="flex items-center gap-2.5 pl-2.5 pr-3.5 py-1.5 rounded-full border border-slate-200 bg-slate-50 cursor-default">
                    <div class="w-7 h-7 rounded-full bg-blue-100 border border-blue-200 flex items-center justify-center text-[11px] font-bold text-blue-700 shadow-sm">
                        AU
                    </div>
                    <span class="text-xs font-semibold text-slate-700">Admin User</span>
                </div>
            </div>
        </header>

        <!-- Scrollable Workspace Sub-Frame Window Area Viewport -->
        <main class="flex-1 p-4 md:p-6 lg:p-8 overflow-y-auto bg-slate-50/50 space-y-4">

            <!-- RUNTIME FLASH NOTIFICATION BLOCK SUCCESS EMISSION -->
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg shadow-sm max-w-4xl mx-auto">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                    <p class="text-xs font-semibold"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
                </div>
            <?php endif; ?>

            <!-- PRIMARY REGISTRATION LEDGER COMPONENT TABLE CARD -->
            <div class="max-w-4xl bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mx-auto">
                
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/70">
                                <th class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-5 py-3 text-left w-16">ID</th>
                                <th class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-5 py-3 text-left">Operator Identity</th>
                                <th class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-5 py-3 text-left">Electronic Mailing Endpoint</th>
                                <th class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-5 py-3 text-left">System Authorization Group</th>
                                <th class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-5 py-3 text-right">Records Operations</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">

 

                        </tbody>
                    </table>
                </div>

            </div>

        </main>
    </div>
</div>

<script>
fetch('index.php?action=api_users')
    .then(res => res.json())
    .then(data => {

        const users = Array.isArray(data) ? data : data.users;

        const tbody = document.querySelector("tbody");

        if (!tbody || !users) return;


        tbody.innerHTML = "";

        if (users.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-5 py-12 text-center">
                        <div class="max-w-xs mx-auto flex flex-col items-center gap-2">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-sm">
                                <i class="fa-solid fa-user-gear"></i>
                            </div>
                            <h4 class="text-xs font-bold text-slate-700">Identity Directory Empty</h4>
                            <p class="text-[11px] font-medium text-slate-400">No users found in system.</p>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        users.forEach(u => {
            const row = `
                <tr class="hover:bg-slate-50/80 transition-colors">

                    <td class="px-5 py-3.5 text-xs font-mono font-bold text-slate-400">
                        #${u.id}
                    </td>

                    <td class="px-5 py-3.5 text-xs font-bold text-slate-900">
                        <div class="flex items-center gap-2.5">
                            <div class="w-6 h-6 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center text-[10px]">
                                <i class="fa-solid fa-user text-[9px]"></i>
                            </div>
                            <span>${u.name}</span>
                        </div>
                    </td>

                    <td class="px-5 py-3.5 text-xs font-medium text-slate-600 font-mono">
                        ${u.email}
                    </td>

                    <td class="px-5 py-3.5 text-xs">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-50 border border-blue-200 text-blue-700 shadow-sm">
                            <i class="fa-solid fa-shield-halved text-[9px]"></i>
                            ${u.role_name ?? 'N/A'}
                        </span>
                    </td>

                    <td class="px-5 py-3.5 text-right text-xs space-x-1">

                        <a href="index.php?action=user_edit&id=${u.id}"
                           class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-600 hover:text-blue-600 hover:border-blue-200 font-bold transition-all shadow-sm">
                            <i class="fa-solid fa-user-pen text-[10px]"></i>
                            <span>Edit</span>
                        </a>

                        <a href="#"
                          data-id="${u.id}"
                         
                           class="delete-user inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-rose-100 bg-rose-50/50 text-rose-600 hover:bg-rose-600 hover:text-white hover:border-rose-600 font-bold transition-all shadow-sm">
                            <i class="fa-solid fa-user-slash text-[10px]"></i>
                            <span>Delete</span>
                        </a>

                    </td>
                </tr>
            `;

            tbody.insertAdjacentHTML("beforeend", row);
        });

    })
    .catch(err => console.error("Error loading users:", err));
</script>

 <script>
        document.addEventListener('click', async function(e) {

            const button = e.target.closest('.delete-user');

            if (!button) return;

            e.preventDefault();

            const id = button.dataset.id;

            if (!confirm('Are you sure ?')) {
                return;
            }

            const response = await fetch(
                `index.php?action=api_user_delete&id=${id}`, {
                    method: 'POST'
                }
            );

            const result = await response.json();

            if (result.success) {

                button.closest('tr').remove();
                window.location.href = 'index.php?action=user_index&message=' + encodeURIComponent(result.message || 'User deleted successfully');

            } else {

                window.location.href = 'index.php?action=user_index&message=' + encodeURIComponent(result.message || 'Error while deleting user');
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