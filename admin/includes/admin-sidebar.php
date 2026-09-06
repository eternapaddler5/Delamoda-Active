<?php
$activeSection = $activeSection ?? '';
?>
<aside id="admin-sidebar" class="admin-sidebar fixed lg:static inset-y-0 left-0 w-64 bg-zinc-950 text-white flex flex-col z-40 lg:z-20 shrink-0">
    <div class="p-6 border-b border-zinc-800">
        <a href="index.php" class="flex items-center gap-3">
            <img src="../assets/images/IMG-20260902-WA0086.jpg" alt="Delamoda Active" class="h-10 w-10 object-contain">
            <div>
                <span class="font-display text-lg font-bold uppercase tracking-widest leading-none block">Delamoda</span>
                <span class="text-[10px] font-bold text-rose-500 uppercase tracking-[0.3em]">Admin</span>
            </div>
        </a>
    </div>

    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        <a href="index.php#orders" class="flex items-center gap-3 p-3 rounded font-semibold uppercase text-xs tracking-wider transition-colors <?= $activeSection === 'orders' ? 'bg-rose-600 text-white' : 'text-zinc-400 hover:bg-zinc-900 hover:text-white' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
            Live Orders
        </a>
        <a href="index.php#inventory" class="flex items-center gap-3 p-3 rounded font-semibold uppercase text-xs tracking-wider transition-colors <?= $activeSection === 'inventory' ? 'bg-rose-600 text-white' : 'text-zinc-400 hover:bg-zinc-900 hover:text-white' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
            Inventory
        </a>
        <a href="index.php#add-product" class="flex items-center gap-3 p-3 rounded font-semibold uppercase text-xs tracking-wider transition-colors <?= $activeSection === 'add-product' ? 'bg-rose-600 text-white' : 'text-zinc-400 hover:bg-zinc-900 hover:text-white' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Add Product
        </a>
    </nav>

    <div class="p-4 border-t border-zinc-800 space-y-2">
        <a href="../index.php" target="_blank" class="flex items-center justify-center gap-2 p-3 text-xs font-bold uppercase tracking-wider text-zinc-400 hover:text-white border border-zinc-800 hover:border-zinc-600 rounded transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
            View Store
        </a>
        <a href="logout.php" class="block text-center p-3 text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-rose-500 transition-colors">Logout</a>
    </div>
</aside>
<div id="admin-sidebar-backdrop" class="fixed inset-0 bg-black/60 z-30 hidden lg:hidden"></div>
