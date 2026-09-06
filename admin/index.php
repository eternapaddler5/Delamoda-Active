<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['delivery_status'];

    $stmt = $pdo->prepare("UPDATE orders SET delivery_status = ? WHERE id = ?");
    $stmt->execute([$newStatus, $orderId]);

    header("Location: index.php?msg=Status+Updated");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_product') {
    $name = $_POST['name'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image_url = $_POST['image_url'];

    $stmt = $pdo->prepare("INSERT INTO products (name, slug, price, category, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $slug, $price, $category, $image_url]);

    header("Location: index.php?msg=Product+Added");
    exit;
}

$ordersStmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 50");
$orders = $ordersStmt->fetchAll();

$productsStmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 50");
$products = $productsStmt->fetchAll();

$statuses = ['pending', 'processing', 'dispatched', 'delivered', 'cancelled'];

$statusColors = [
    'pending'    => 'bg-amber-100 text-amber-800',
    'processing' => 'bg-blue-100 text-blue-800',
    'dispatched' => 'bg-purple-100 text-purple-800',
    'delivered'  => 'bg-green-100 text-green-800',
    'cancelled'  => 'bg-red-100 text-red-800',
];

$lowStockCount = count(array_filter($products, fn($p) => ($p['stock'] ?? 0) <= 5));
$pendingOrders = count(array_filter($orders, fn($o) => $o['delivery_status'] === 'pending'));

$adminTitle = 'Dashboard';
require 'includes/admin-head.php';
?>
<body class="bg-zinc-100 text-zinc-900 antialiased flex h-screen overflow-hidden">

<?php require 'includes/admin-sidebar.php'; ?>

<div class="flex-1 flex flex-col min-w-0 overflow-hidden">
    <header class="bg-white border-b border-zinc-200 px-4 sm:px-8 py-4 flex items-center justify-between shrink-0">
        <div class="flex items-center gap-4">
            <button id="admin-menu-open" type="button" class="lg:hidden text-zinc-900 p-1" aria-label="Open menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div>
                <p class="text-rose-600 font-bold uppercase tracking-[0.25em] text-[10px]">Dashboard</p>
                <h1 class="font-display text-2xl font-bold uppercase tracking-tight">Store Management</h1>
            </div>
        </div>
        <button id="admin-menu-close" type="button" class="lg:hidden text-zinc-400 p-1 hidden" aria-label="Close menu"></button>
    </header>

    <main class="flex-1 overflow-y-auto p-4 sm:p-8 lg:p-10 scroll-smooth">

        <?php if (isset($_GET['msg'])): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 font-bold uppercase text-xs tracking-wider flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                <?= htmlspecialchars($_GET['msg']) ?>
            </div>
        <?php endif; ?>

        <!-- Stats -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            <div class="bg-white border border-zinc-200 p-5">
                <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-1">Total Orders</p>
                <p class="font-display text-3xl font-bold"><?= count($orders) ?></p>
            </div>
            <div class="bg-white border border-zinc-200 p-5">
                <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-1">Pending</p>
                <p class="font-display text-3xl font-bold text-amber-600"><?= $pendingOrders ?></p>
            </div>
            <div class="bg-white border border-zinc-200 p-5">
                <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-1">Products</p>
                <p class="font-display text-3xl font-bold"><?= count($products) ?></p>
            </div>
            <div class="bg-white border border-zinc-200 p-5">
                <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-1">Low Stock</p>
                <p class="font-display text-3xl font-bold <?= $lowStockCount > 0 ? 'text-rose-600' : 'text-green-600' ?>"><?= $lowStockCount ?></p>
            </div>
        </div>

        <!-- Orders -->
        <section id="orders" class="mb-14">
            <div class="flex justify-between items-end mb-6">
                <div>
                    <p class="text-rose-600 font-bold uppercase tracking-[0.25em] text-[10px] mb-1">Orders</p>
                    <h2 class="font-display text-2xl sm:text-3xl font-bold uppercase tracking-tight">Live Orders</h2>
                </div>
            </div>

            <div class="bg-white border border-zinc-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[700px]">
                        <thead>
                            <tr class="bg-zinc-950 text-white uppercase text-[10px] tracking-widest">
                                <th class="p-4 font-semibold">Order</th>
                                <th class="p-4 font-semibold">Customer</th>
                                <th class="p-4 font-semibold">Payment</th>
                                <th class="p-4 font-semibold">Total</th>
                                <th class="p-4 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100">
                            <?php if (empty($orders)): ?>
                                <tr><td colspan="5" class="p-10 text-center text-zinc-400 text-sm">No orders yet.</td></tr>
                            <?php else: ?>
                                <?php foreach ($orders as $order):
                                    $statusClass = $statusColors[$order['delivery_status']] ?? 'bg-zinc-100 text-zinc-800';
                                ?>
                                    <tr class="hover:bg-zinc-50 transition-colors">
                                        <td class="p-4">
                                            <p class="font-bold text-sm"><?= htmlspecialchars($order['order_number']) ?></p>
                                            <p class="text-[10px] text-zinc-400 mt-0.5"><?= date('M j, Y', strtotime($order['created_at'] ?? 'now')) ?></p>
                                        </td>
                                        <td class="p-4 text-sm max-w-[200px]">
                                            <p class="truncate" title="<?= htmlspecialchars($order['shipping_address']) ?>"><?= htmlspecialchars($order['shipping_address']) ?></p>
                                        </td>
                                        <td class="p-4">
                                            <span class="px-2 py-1 bg-zinc-100 text-[10px] font-bold uppercase rounded tracking-wider">
                                                <?= str_replace('_', ' ', htmlspecialchars($order['payment_method'])) ?>
                                            </span>
                                        </td>
                                        <td class="p-4 font-bold text-rose-600 text-sm">K<?= number_format($order['total_amount'], 2) ?></td>
                                        <td class="p-4">
                                            <form method="POST" action="index.php" class="flex gap-2 items-center flex-wrap">
                                                <input type="hidden" name="action" value="update_status">
                                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                                <span class="px-2 py-1 text-[10px] font-bold uppercase rounded <?= $statusClass ?>"><?= htmlspecialchars($order['delivery_status']) ?></span>
                                                <select name="delivery_status" class="text-xs border border-zinc-200 p-1.5 font-semibold uppercase outline-none focus:border-zinc-950 cursor-pointer bg-white">
                                                    <?php foreach ($statuses as $status): ?>
                                                        <option value="<?= $status ?>" <?= $order['delivery_status'] === $status ? 'selected' : '' ?>>
                                                            <?= strtoupper($status) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit" class="bg-zinc-950 text-white px-3 py-1.5 text-[10px] font-bold uppercase hover:bg-rose-600 transition-colors">
                                                    Save
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Inventory -->
        <section id="inventory" class="mb-14">
            <div class="mb-6">
                <p class="text-rose-600 font-bold uppercase tracking-[0.25em] text-[10px] mb-1">Stock</p>
                <h2 class="font-display text-2xl sm:text-3xl font-bold uppercase tracking-tight">Inventory</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <?php foreach ($products as $product):
                    $img = $product['image_url'] ?? '../assets/images/IMG-20260902-WA0074.jpg';
                    if ($img && strpos($img, '../') !== 0 && strpos($img, 'http') !== 0) {
                        $img = '../' . ltrim($img, '/');
                    }
                    $stock = (int)($product['stock'] ?? 0);
                ?>
                    <div class="bg-white border border-zinc-200 overflow-hidden flex flex-col">
                        <div class="aspect-[4/3] bg-zinc-100 overflow-hidden">
                            <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-full object-cover" onerror="this.src='../assets/images/IMG-20260902-WA0074.jpg'">
                        </div>
                        <div class="p-4 flex flex-col flex-1">
                            <h4 class="font-bold uppercase text-sm truncate" title="<?= htmlspecialchars($product['name']) ?>"><?= htmlspecialchars($product['name']) ?></h4>
                            <div class="flex justify-between items-center mt-1 mb-4">
                                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest"><?= htmlspecialchars($product['category']) ?></p>
                                <p class="text-rose-600 font-bold text-sm">K<?= number_format($product['price'], 2) ?></p>
                            </div>
                            <div class="mt-auto border-t border-zinc-100 pt-4">
                                <p class="text-xs font-bold mb-3">
                                    Stock:
                                    <span class="<?= $stock <= 0 ? 'text-rose-600' : ($stock <= 5 ? 'text-amber-600' : 'text-green-600') ?>"><?= $stock ?></span>
                                </p>
                                <form action="update_stock.php" method="POST" class="flex gap-2">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                    <input type="number" name="added_stock" min="1" placeholder="+ Qty" required class="form-input !p-2 text-sm flex-1">
                                    <button type="submit" class="bg-zinc-950 text-white px-4 py-2 text-[10px] font-bold uppercase hover:bg-rose-600 transition-colors shrink-0">
                                        Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Add Product -->
        <section id="add-product" class="mb-10">
            <div class="mb-6">
                <p class="text-rose-600 font-bold uppercase tracking-[0.25em] text-[10px] mb-1">Catalog</p>
                <h2 class="font-display text-2xl sm:text-3xl font-bold uppercase tracking-tight">Add New Product</h2>
            </div>

            <div class="bg-white border border-zinc-200 p-6 sm:p-8 max-w-3xl">
                <form method="POST" action="index.php" class="space-y-6">
                    <input type="hidden" name="action" value="add_product">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-bold uppercase mb-2 tracking-widest text-zinc-500">Product Name</label>
                            <input type="text" name="name" required class="form-input">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase mb-2 tracking-widest text-zinc-500">Price (ZMW)</label>
                            <input type="number" step="0.01" name="price" required class="form-input">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase mb-2 tracking-widest text-zinc-500">Category</label>
                            <select name="category" required class="form-input uppercase text-sm">
                                <option value="men">Men</option>
                                <option value="women">Women</option>
                                <option value="accessories">Accessories</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase mb-2 tracking-widest text-zinc-500">Image Path</label>
                            <input type="text" name="image_url" placeholder="assets/images/IMG-20260902-WA0074.jpg" required class="form-input">
                            <p class="text-[10px] text-zinc-400 mt-1.5">Use paths from <code class="bg-zinc-100 px-1">assets/images/</code></p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-rose-600 text-white py-4 font-bold uppercase tracking-widest hover:bg-rose-700 transition-colors">
                        Add Product
                    </button>
                </form>
            </div>
        </section>

    </main>
</div>

<script src="assets/admin.js"></script>
</body>
</html>
