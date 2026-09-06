<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | Delamoda Active</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
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
<body class="bg-zinc-950 text-white antialiased min-h-screen flex flex-col">

<main class="flex-1 flex items-center justify-center px-4 py-16 relative overflow-hidden">
    <img src="assets/images/IMG-20260902-WA0079.jpg" alt="" class="absolute inset-0 w-full h-full object-cover opacity-20" aria-hidden="true">
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/80 via-zinc-950/90 to-zinc-950"></div>

    <div class="relative z-10 bg-zinc-900/80 backdrop-blur-sm border border-zinc-800 p-10 sm:p-14 text-center max-w-lg w-full">
        <img src="assets/images/IMG-20260902-WA0086.jpg" alt="Delamoda Active" class="h-16 w-16 object-contain mx-auto mb-8">

        <div class="w-16 h-16 bg-rose-600/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="font-display text-4xl font-bold uppercase tracking-tight mb-4">You're Set</h1>
        <p class="text-zinc-400 mb-2 leading-relaxed">
            Your order has been received.
        </p>
        <p class="text-2xl font-display font-bold text-white mb-2">
            <?= htmlspecialchars($_GET['order'] ?? '') ?>
        </p>
        <p class="text-rose-500 font-bold uppercase text-xs tracking-[0.25em] mb-10">
            Our courier will call you shortly
        </p>

        <a href="index.php" class="block w-full bg-rose-600 text-white py-4 font-bold uppercase tracking-widest hover:bg-rose-700 transition-colors">
            Keep Shopping
        </a>
    </div>
</main>

<script>
    localStorage.removeItem('activewear_cart');
</script>
</body>
</html>
