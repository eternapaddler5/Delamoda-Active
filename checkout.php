<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Delamoda Active</title>
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
<body class="bg-zinc-50 text-zinc-900 antialiased min-h-screen flex flex-col">

<?php require 'includes/site-header.php'; ?>

<main class="flex-1 pt-28 pb-16 px-4 sm:px-6">
    <div class="max-w-6xl mx-auto">
        <div class="mb-10">
            <p class="text-rose-600 font-bold uppercase tracking-[0.3em] text-xs mb-2">Secure Checkout</p>
            <h1 class="font-display text-4xl sm:text-5xl font-bold uppercase tracking-tight">Complete Your Order</h1>
        </div>

        <div class="grid lg:grid-cols-5 gap-10 lg:gap-16">
            <form action="process_order.php" method="POST" class="lg:col-span-3 space-y-10">
                <section class="bg-white p-6 sm:p-8 border border-zinc-200 shadow-sm">
                    <h2 class="font-display text-xl font-bold uppercase tracking-wide mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 bg-zinc-950 text-white text-sm flex items-center justify-center font-bold rounded-full">1</span>
                        Delivery Details
                    </h2>
                    <div class="space-y-4">
                        <input type="text" name="full_name" required placeholder="Full Name" class="form-input">
                        <input type="text" name="phone" required placeholder="Phone Number (For Courier / MoMo)" class="form-input">
                        <textarea name="address" required placeholder="Delivery Address &amp; Instructions" class="form-input h-28 resize-none"></textarea>
                    </div>
                </section>

                <section class="bg-white p-6 sm:p-8 border border-zinc-200 shadow-sm">
                    <h2 class="font-display text-xl font-bold uppercase tracking-wide mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 bg-zinc-950 text-white text-sm flex items-center justify-center font-bold rounded-full">2</span>
                        Payment Method
                    </h2>
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border border-zinc-200 cursor-pointer hover:border-zinc-950 transition-colors has-[:checked]:border-rose-600 has-[:checked]:bg-rose-50">
                            <input type="radio" name="payment_method" value="momo_mtn" checked class="mr-4 accent-rose-600 w-5 h-5">
                            <div>
                                <span class="font-bold uppercase text-sm block">MTN Mobile Money</span>
                                <span class="text-xs text-zinc-500">Pay on delivery confirmation</span>
                            </div>
                        </label>
                        <label class="flex items-center p-4 border border-zinc-200 cursor-pointer hover:border-zinc-950 transition-colors has-[:checked]:border-rose-600 has-[:checked]:bg-rose-50">
                            <input type="radio" name="payment_method" value="momo_airtel" class="mr-4 accent-rose-600 w-5 h-5">
                            <div>
                                <span class="font-bold uppercase text-sm block">Airtel Money</span>
                                <span class="text-xs text-zinc-500">Pay on delivery confirmation</span>
                            </div>
                        </label>
                    </div>
                </section>

                <input type="hidden" name="cart_data" id="cart_data">

                <button type="submit" class="w-full bg-rose-600 text-white py-5 font-bold uppercase tracking-widest hover:bg-rose-700 transition-colors shadow-lg shadow-rose-600/20">
                    Confirm &amp; Pay
                </button>

                <p class="text-center text-xs text-zinc-400 uppercase tracking-wider">
                    <a href="index.php#shop" class="hover:text-zinc-600 transition-colors">&larr; Continue Shopping</a>
                </p>
            </form>

            <div class="lg:col-span-2">
                <div class="bg-zinc-950 text-white p-6 sm:p-8 sticky top-28">
                    <h2 class="font-display text-xl font-bold uppercase tracking-wide mb-6">Order Summary</h2>
                    <div id="checkout-cart-items" class="space-y-1 mb-6 max-h-64 overflow-y-auto"></div>
                    <div class="flex justify-between items-center border-t border-zinc-700 pt-6 mt-4">
                        <span class="font-bold uppercase text-sm tracking-wider text-zinc-400">Total</span>
                        <span id="checkout-total" class="font-display text-4xl font-bold text-rose-500">K0.00</span>
                    </div>
                    <div class="mt-6 pt-6 border-t border-zinc-800">
                        <div class="flex items-center gap-3 text-xs text-zinc-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span>Secure checkout — delivered within 24 hours</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require 'includes/site-footer.php'; ?>

<script src="assets/js/cart.js"></script>
<script src="assets/js/site.js"></script>
</body>
</html>
