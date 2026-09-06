<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $paymentMethod = $_POST['payment_method'] ?? 'momo_mtn';
    $cartData = json_decode($_POST['cart_data'], true);

    if (!$cartData || empty($cartData)) {
        die("Cart is empty. Please go back and add items.");
    }

    try {
        $pdo->beginTransaction();
        $calculatedTotal = 0;
        $orderItems = [];

        // Step 1: Verify prices and check if enough stock exists
        $stmt = $pdo->prepare("SELECT id, price, stock FROM products WHERE id = ? FOR UPDATE");
        foreach ($cartData as $item) {
            $stmt->execute([$item['id']]);
            $product = $stmt->fetch();
            
            if ($product) {
                // Prevent checkout if someone orders more than you have
                if ($product['stock'] < $item['quantity']) {
                    throw new Exception("Insufficient stock for item ID: " . $product['id']);
                }

                $subtotal = $product['price'] * $item['quantity'];
                $calculatedTotal += $subtotal;
                $orderItems[] = [
                    'product_id' => $product['id'],
                    'quantity' => $item['quantity'],
                    'price_at_purchase' => $product['price']
                ];
            }
        }

        // Step 2: Create the main order record
        $orderNumber = 'ORD-' . strtoupper(substr(uniqid(), -6));
        $shippingAddress = "$fullName | $phone | $address";

        $insertOrder = $pdo->prepare("INSERT INTO orders (order_number, total_amount, payment_method, shipping_address, delivery_status) VALUES (?, ?, ?, ?, 'pending')");
        $insertOrder->execute([$orderNumber, $calculatedTotal, $paymentMethod, $shippingAddress]);
        $orderId = $pdo->lastInsertId();

        // Step 3: Insert individual items AND deduct their stock
        $insertItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (?, ?, ?, ?)");
        $updateStock = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");

        foreach ($orderItems as $item) {
            $insertItem->execute([$orderId, $item['product_id'], $item['quantity'], $item['price_at_purchase']]);
            // Subtract the purchased amount from current stock
            $updateStock->execute([$item['quantity'], $item['product_id']]);
        }

        $pdo->commit();
        header("Location: success.php?order=" . $orderNumber);
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        die("Order failed: " . $e->getMessage());
    }
}
?>