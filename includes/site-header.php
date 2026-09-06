<?php
$currentPage = basename($_SERVER['PHP_SELF'] ?? 'index.php');
$isHome = ($currentPage === 'index.php');
?>
<header id="site-nav" class="site-nav fixed top-0 left-0 right-0 z-50 <?= $isHome ? 'bg-transparent' : 'bg-zinc-950 shadow-lg' ?>">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <a href="index.php" class="flex items-center gap-3 group">
                <img src="assets/images/IMG-20260902-WA0086.jpg" alt="Delamoda Active" class="h-10 w-10 object-contain rounded-sm">
                <div class="hidden sm:block">
                    <span class="font-display text-xl font-bold text-white uppercase tracking-widest leading-none block">Delamoda</span>
                    <span class="text-[10px] font-bold text-rose-500 uppercase tracking-[0.35em]">Active</span>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-8">
                <a href="index.php#shop" class="text-sm font-semibold text-zinc-300 hover:text-white uppercase tracking-wider transition-colors">Shop</a>
                <a href="index.php#collections" class="text-sm font-semibold text-zinc-300 hover:text-white uppercase tracking-wider transition-colors">Collections</a>
                <a href="index.php#about" class="text-sm font-semibold text-zinc-300 hover:text-white uppercase tracking-wider transition-colors">About</a>
                <a href="checkout.php" class="inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-bold uppercase tracking-wider px-5 py-2.5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Cart
                    <span id="nav-cart-count" class="bg-black text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full">0</span>
                </a>
            </nav>

            <button id="mobile-menu-btn" type="button" class="md:hidden text-white p-2" aria-label="Open menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</header>

<div id="mobile-menu" class="mobile-menu fixed inset-y-0 right-0 w-72 bg-zinc-950 z-[60] shadow-2xl md:hidden">
    <div class="flex flex-col h-full p-6">
        <div class="flex justify-between items-center mb-10">
            <span class="font-display text-lg font-bold text-white uppercase tracking-widest">Menu</span>
            <button id="mobile-menu-close" type="button" class="text-white p-2" aria-label="Close menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="flex flex-col gap-6">
            <a href="index.php#shop" class="text-lg font-semibold text-zinc-300 hover:text-white uppercase tracking-wider">Shop</a>
            <a href="index.php#collections" class="text-lg font-semibold text-zinc-300 hover:text-white uppercase tracking-wider">Collections</a>
            <a href="index.php#about" class="text-lg font-semibold text-zinc-300 hover:text-white uppercase tracking-wider">About</a>
            <a href="checkout.php" class="mt-4 inline-flex items-center justify-center gap-2 bg-rose-600 text-white font-bold uppercase tracking-wider py-4">
                Cart (<span id="mobile-cart-count">0</span>)
            </a>
        </nav>
    </div>
</div>
<div id="mobile-menu-backdrop" class="fixed inset-0 bg-black/60 z-[55] hidden md:hidden"></div>
