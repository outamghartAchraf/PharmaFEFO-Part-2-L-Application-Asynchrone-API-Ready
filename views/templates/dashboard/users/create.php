<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User - PharmaFEFO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-blue-500 selection:text-white overflow-hidden">

<div class="flex h-screen w-screen overflow-hidden">

      <?php include __DIR__ . '/../../../layout/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <header class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center z-10 flex-shrink-0">
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">Provision Identity</h2>
                <p class="text-xs font-semibold text-slate-400 mt-0.5">Register a new system operator profile with specific access permissions</p>
            </div>
        </header>

        <main class="flex-1 p-4 md:p-6 lg:p-8 overflow-y-auto bg-slate-50/50 space-y-6 flex flex-col items-center">

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-lg shadow-sm w-full max-w-xl">
                    <i class="fa-solid fa-circle-exclamation text-rose-500 text-sm"></i>
                    <p class="text-xs font-semibold"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
                </div>
            <?php endif; ?>

            <div class="w-full max-w-xl bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                
                <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Account Credentials Configuration</h3>
                </div>

                <form action="index.php?action=user_store" method="POST" class="p-6 space-y-5">

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-1.5">Full Name</label>
                        <div class="relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-user text-xs"></i>
                            </div>
                            <input type="text" name="name"
                                   class="block w-full pl-9 pr-3 py-2 border border-slate-200 bg-white text-slate-900 placeholder-slate-400 font-medium text-xs rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                                   placeholder="e.g. John Doe"
                                   required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-1.5">Email Address</label>
                        <div class="relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-envelope text-xs"></i>
                            </div>
                            <input type="email" name="email"
                                   class="block w-full pl-9 pr-3 py-2 border border-slate-200 bg-white text-slate-900 placeholder-slate-400 font-mono text-xs rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                                   placeholder="operator@pharmafefo.com"
                                   required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-1.5">Security Password</label>
                        <div class="relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-lock text-xs"></i>
                            </div>
                            <input type="password" name="password"
                                   class="block w-full pl-9 pr-3 py-2 border border-slate-200 bg-white text-slate-900 placeholder-slate-400 font-mono text-xs rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                                   placeholder="••••••••••••"
                                   required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-1.5">System Privilege Role</label>
                        <div class="relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-shield-halved text-xs"></i>
                            </div>
                            <select name="role_id"
                                    class="block w-full pl-9 pr-3 py-2 border border-slate-200 bg-white text-slate-900 text-xs font-medium rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all appearance-none cursor-pointer"
                                    required>
                                <option value="" class="text-slate-400">-- Assign Authorization Level --</option>
                                <?php foreach ($roles as $r): ?>
                                    <option value="<?= $r->id ?>">
                                        <?= htmlspecialchars($r->label) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between border-t border-slate-100 pt-4 mt-2">
                        <a href="index.php?action=user_index"
                           class="inline-flex items-center gap-1.5 px-4 py-2 border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 rounded-lg text-xs font-bold transition-all shadow-sm">
                            <i class="fa-solid fa-xmark text-[11px]"></i>
                            <span>Cancel</span>
                        </a>

                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm transition-all">
                            <i class="fa-solid fa-check text-[11px]"></i>
                            <span>Commit Profile Creation</span>
                        </button>
                    </div>

                </form>

            </div>

        </main>
    </div>
</div>

<script>
document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    fetch('index.php?action=api_user_store', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'index.php?action=user_index&message=' + encodeURIComponent(data.message);
        } else {
            const errorBox = document.querySelector(".bg-rose-50");
            if (errorBox) {
                errorBox.querySelector("p").textContent = data.message || "Error creating user";
            }
        }
    })
    .catch(err => {
        console.error("Error creating user:", err);
    });
});
</script>

</body>
</html>