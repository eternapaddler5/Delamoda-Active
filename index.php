<?php
require 'includes/db.php';
$stmt = $pdo->query('SELECT * FROM products WHERE is_active = 1 LIMIT 8');
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delamoda Active | Premium Performance Wear</title>
    <meta name="description" content="Delamoda Active — premium performance activewear for athletes. Shop the latest drops with fast local delivery.">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { black: '#0a0a0a', red: '#e11d48', purple: '#7c3aed' }
                    },
                    fontFamily: {
                        display: ['Oswald', 'sans-serif'],
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-white text-zinc-900 antialiased">

<?php require 'includes/site-header.php'; ?>

<!-- Hero -->
<section class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden bg-zinc-950">
    <div class="hero-video-wrap">
        <video autoplay muted loop playsinline poster="assets/images/IMG-20260902-WA0079.jpg">
            <source src="assets/images/VID-20260902-WA0080.mp4" type="video/mp4">
        </video>
    </div>
    <div class="hero-overlay absolute inset-0 z-[1]"></div>

    <div class="relative z-10 text-center px-4 max-w-5xl mx-auto">
        <p class="text-rose-500 font-bold uppercase tracking-[0.4em] text-xs sm:text-sm mb-6 animate-pulse">New Season Drop</p>
        <h1 class="font-display text-5xl sm:text-7xl lg:text-8xl font-bold text-white uppercase tracking-tight leading-[0.95]">
            Train Hard.<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-500 to-rose-300">Look Elite.</span>
        </h1>
        <p class="mt-8 text-base sm:text-xl text-zinc-300 font-medium max-w-2xl mx-auto leading-relaxed">
            Delamoda Active — performance gear built for the relentless. Engineered fabrics, bold design, delivered to your door in under 24 hours.
        </p>
        <div class="mt-12 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#shop" class="px-10 py-4 bg-rose-600 text-white font-bold uppercase tracking-widest hover:bg-rose-700 transition-all hover:scale-105">
                Shop Collection
            </a>
            <a href="#collections" class="px-10 py-4 border-2 border-white/30 text-white font-bold uppercase tracking-widest hover:bg-white/10 transition-all backdrop-blur-sm">
                Explore Lookbook
            </a>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 animate-bounce">
        <a href="#shop" class="text-white/60 hover:text-white transition-colors" aria-label="Scroll down">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </a>
    </div>
</section>

<!-- Trust Marquee -->
<div class="bg-zinc-950 border-y border-zinc-800 py-4 overflow-hidden">
    <div class="marquee-track flex whitespace-nowrap">
        <?php
        $trustItems = ['Free Local Delivery', 'Premium Fabrics', 'MoMo Payments', '24hr Dispatch', 'Engineered for Performance', 'Delamoda Active'];
        for ($i = 0; $i < 2; $i++):
            foreach ($trustItems as $item): ?>
                <span class="mx-8 text-xs font-bold uppercase tracking-[0.25em] text-zinc-500 flex items-center gap-3">
                    <span class="w-1.5 h-1.5 bg-rose-600 rounded-full"></span>
                    <?= $item ?>
                </span>
            <?php endforeach;
        endfor; ?>
    </div>
</div>

<!-- Shop -->
<section id="shop" class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8 reveal">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
        <div>
            <p class="text-rose-600 font-bold uppercase tracking-[0.3em] text-xs mb-2">Shop Now</p>
            <h2 class="font-display text-4xl sm:text-5xl font-bold uppercase tracking-tight">Latest Drops</h2>
        </div>
        <p class="text-zinc-500 text-sm max-w-xs">Curated performance pieces — tap Quick Add or head to checkout when you're ready.</p>
    </div>

    <?php if (empty($products)): ?>
        <div class="text-center py-20 bg-zinc-50 border border-zinc-200">
            <p class="font-display text-2xl uppercase text-zinc-400">New gear arriving soon</p>
            <p class="text-zinc-500 mt-2 text-sm">Check back shortly for the latest collection.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-8">
            <?php foreach ($products as $product):
                $img = htmlspecialchars($product['image_url'] ?? 'assets/images/IMG-20260902-WA0074.jpg');
                $name = htmlspecialchars($product['name']);
                $placeholder = 'assets/images/IMG-20260902-WA0074.jpg';
            ?>
                <article class="group flex flex-col">
                    <div class="product-card relative aspect-[3/4] w-full overflow-hidden bg-zinc-100 cursor-pointer">
                        <img src="<?= $img ?>" alt="<?= $name ?>" class="img-zoom object-cover w-full h-full" onerror="this.src='<?= $placeholder ?>'">

                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-300"></div>

                        <button type="button"
                            class="quick-add-btn absolute bottom-0 left-0 right-0 z-10 bg-zinc-950/95 text-white py-3.5 font-bold uppercase tracking-wider text-sm translate-y-0 md:translate-y-full md:group-hover:translate-y-0 transition-transform duration-300 hover:bg-rose-600"
                            data-id="<?= (int)$product['id'] ?>"
                            data-name="<?= $name ?>"
                            data-price="<?= (float)$product['price'] ?>"
                            data-image="<?= $img ?>">
                            Add to Cart
                        </button>
                    </div>
                    <div class="flex justify-between items-start mt-4 gap-2">
                        <div>
                            <h3 class="font-bold uppercase tracking-tight text-sm text-zinc-900"><?= $name ?></h3>
                            <?php if (!empty($product['category'])): ?>
                                <p class="text-[10px] font-semibold text-zinc-400 uppercase tracking-widest mt-1"><?= htmlspecialchars($product['category']) ?></p>
                            <?php endif; ?>
                        </div>
                        <p class="text-rose-600 font-bold text-sm whitespace-nowrap">K<?= number_format($product['price'], 2) ?></p>
                    </div>
                    <button type="button"
                        class="quick-add-btn mt-3 w-full border border-zinc-900 py-2.5 text-xs font-bold uppercase tracking-widest hover:bg-zinc-900 hover:text-white transition-colors md:hidden"
                        data-id="<?= (int)$product['id'] ?>"
                        data-name="<?= $name ?>"
                        data-price="<?= (float)$product['price'] ?>"
                        data-image="<?= $img ?>">
                        Add to Cart
                    </button>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<!-- Collections -->
<section id="collections" class="bg-zinc-950 text-white py-20 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-rose-500 font-bold uppercase tracking-[0.3em] text-xs mb-3">Collections</p>
            <h2 class="font-display text-4xl sm:text-5xl font-bold uppercase tracking-tight">Built For Every Rep</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
            <a href="#shop" class="group relative aspect-[3/4] md:aspect-auto md:row-span-2 overflow-hidden">
                <img src="assets/images/IMG-20260902-WA0077.jpg" alt="Women's cycling collection" class="img-zoom w-full h-full object-cover min-h-[400px] md:min-h-full">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
                    <p class="text-rose-400 text-xs font-bold uppercase tracking-widest mb-2">Women</p>
                    <h3 class="font-display text-2xl sm:text-3xl font-bold uppercase">Power Cycle</h3>
                    <span class="inline-block mt-4 text-sm font-bold uppercase tracking-wider border-b-2 border-rose-500 pb-1 group-hover:text-rose-400 transition-colors">Shop Women &rarr;</span>
                </div>
            </a>

            <a href="#shop" class="group relative aspect-[4/3] overflow-hidden">
                <img src="assets/images/IMG-20260902-WA0076.jpg" alt="Men's running collection" class="img-zoom w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    <p class="text-rose-400 text-xs font-bold uppercase tracking-widest mb-1">Men</p>
                    <h3 class="font-display text-xl font-bold uppercase">Running Division</h3>
                </div>
            </a>

            <a href="#shop" class="group relative aspect-[4/3] overflow-hidden">
                <img src="assets/images/IMG-20260902-WA0082.jpg" alt="Lifestyle athleisure" class="img-zoom w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    <p class="text-rose-400 text-xs font-bold uppercase tracking-widest mb-1">Lifestyle</p>
                    <h3 class="font-display text-xl font-bold uppercase">Street to Studio</h3>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Performance Banner with second video -->
<section class="relative py-0 overflow-hidden reveal">
    <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[500px]">
        <div class="relative overflow-hidden bg-zinc-900 flex items-center justify-center">
            <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover opacity-80" poster="assets/images/IMG-20260902-WA0078.jpg">
                <source src="assets/images/VID-20260902-WA0081.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-zinc-950/40"></div>
        </div>
        <div class="bg-zinc-950 flex items-center p-8 sm:p-16 lg:p-20 diagonal-accent relative">
            <div class="relative z-10">
                <p class="text-rose-500 font-bold uppercase tracking-[0.3em] text-xs mb-4">Performance</p>
                <h2 class="font-display text-4xl sm:text-5xl font-bold text-white uppercase tracking-tight leading-tight mb-6">
                    Work. Sweat.<br>Repeat.
                </h2>
                <p class="text-zinc-400 leading-relaxed mb-8 max-w-md">
                    Every stitch is designed for movement. Moisture-wicking fabrics, compression fit, and bold Delamoda branding that performs as hard as you do.
                </p>
                <div class="grid grid-cols-3 gap-6 mb-10">
                    <div>
                        <p class="font-display text-3xl font-bold text-white">24h</p>
                        <p class="text-[10px] uppercase tracking-widest text-zinc-500 mt-1">Delivery</p>
                    </div>
                    <div>
                        <p class="font-display text-3xl font-bold text-white">100%</p>
                        <p class="text-[10px] uppercase tracking-widest text-zinc-500 mt-1">Premium</p>
                    </div>
                    <div>
                        <p class="font-display text-3xl font-bold text-white">MoMo</p>
                        <p class="text-[10px] uppercase tracking-widest text-zinc-500 mt-1">Payments</p>
                    </div>
                </div>
                <a href="#shop" class="inline-block px-8 py-4 bg-white text-zinc-950 font-bold uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-colors">
                    Shop Performance
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Lifestyle Gallery -->
<section class="py-20 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
            <div class="col-span-2 row-span-2 relative aspect-square overflow-hidden group">
                <img src="assets/images/IMG-20260902-WA0083.jpg" alt="Spin class in Delamoda Active" class="img-zoom w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/10 transition-colors"></div>
            </div>
            <div class="relative aspect-square overflow-hidden group">
                <img src="assets/images/IMG-20260902-WA0075.jpg" alt="Running shorts detail" class="img-zoom w-full h-full object-cover">
            </div>
            <div class="relative aspect-square overflow-hidden group">
                <img src="assets/images/IMG-20260902-WA0074.jpg" alt="Purple Delamoda set" class="img-zoom w-full h-full object-cover">
            </div>
            <div class="relative aspect-square overflow-hidden group">
                <img src="assets/images/IMG-20260902-WA0078.jpg" alt="Treadmill training" class="img-zoom w-full h-full object-cover">
            </div>
            <div class="relative aspect-square overflow-hidden group">
                <img src="assets/images/IMG-20260902-WA0079.jpg" alt="Delamoda running tank" class="img-zoom w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<!-- About -->
<section id="about" class="bg-zinc-100 py-20 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="relative">
                <img src="assets/images/IMG-20260902-WA0086.jpg" alt="Delamoda Active logo" class="w-48 h-48 object-contain mb-8 bg-zinc-950 p-6">
                <h2 class="font-display text-4xl sm:text-5xl font-bold uppercase tracking-tight mb-6">
                    The Delamoda<br><span class="text-rose-600">Standard</span>
                </h2>
                <p class="text-zinc-600 leading-relaxed mb-4">
                    Delamoda Active was born from a simple belief: your gear should never hold you back. We design premium activewear that transitions seamlessly from high-intensity training to everyday life.
                </p>
                <p class="text-zinc-600 leading-relaxed">
                    From our signature purple and coral collections to our performance running line — every piece carries the Delamoda mark of quality, style, and relentless pursuit of excellence.
                </p>
            </div>
            <div class="relative aspect-[4/5] overflow-hidden">
                <img src="assets/images/IMG-20260902-WA0082.jpg" alt="Delamoda Active lifestyle" class="w-full h-full object-cover">
                <div class="absolute inset-0 ring-1 ring-inset ring-black/10"></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="relative py-24 overflow-hidden reveal">
    <img src="assets/images/IMG-20260902-WA0076.jpg" alt="" class="absolute inset-0 w-full h-full object-cover" aria-hidden="true">
    <div class="absolute inset-0 bg-zinc-950/75"></div>
    <div class="relative z-10 text-center px-4 max-w-3xl mx-auto">
        <h2 class="font-display text-4xl sm:text-6xl font-bold text-white uppercase tracking-tight mb-6">
            Ready to Level Up?
        </h2>
        <p class="text-zinc-300 text-lg mb-10">Join athletes across the city wearing Delamoda Active. Your next PR starts with what you wear.</p>
        <a href="#shop" class="inline-block px-12 py-5 bg-rose-600 text-white font-bold uppercase tracking-widest hover:bg-rose-700 transition-all hover:scale-105">
            Shop Now
        </a>
    </div>
</section>

<?php require 'includes/site-footer.php'; ?>

<!-- Floating Cart -->
<a href="checkout.php" class="cart-fab fixed bottom-6 right-6 bg-rose-600 text-white p-4 rounded-full shadow-2xl hover:bg-rose-700 transition-colors z-50 flex items-center gap-3 pr-6 group">
    <div class="relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
        <span id="cart-count" class="absolute -top-2 -right-3 bg-zinc-950 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full transition-transform duration-200">0</span>
    </div>
    <span class="font-bold uppercase tracking-wider text-sm hidden sm:inline">Checkout</span>
</a>

<script src="assets/js/cart.js"></script>
<script src="assets/js/site.js"></script>
</body>
</html>
