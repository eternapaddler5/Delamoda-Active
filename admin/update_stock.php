<?php
session_start();

// SECURITY LOCK
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $addedStock = (int)$_POST['added_stock'];

    // Only process if a valid positive number is entered
    if ($addedStock > 0) {
        $stmt = $pdo->prepare("UPDATE products SET stock = stock + ? WHERE id = ?");
        $stmt->execute([$addedStock, $productId]);
    }
    
    // Redirect back to the dashboard
    header("Location: index.php?msg=restocked");
    exit;
}
?>