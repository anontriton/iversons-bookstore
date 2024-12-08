<?php
session_start();
require 'db_creds.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

// fetch cart data
$cart = $_SESSION['cart'];
$total = 0;

foreach ($cart as $product_id => $quantity) {
    $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $total += $product['price'] * $quantity;
}

// insert the order
$stmt = $conn->prepare("INSERT INTO orders (order_date, total) VALUES (NOW(), ?)");
$stmt->bind_param("d", $total);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

// clear cart
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<header>
    <h1 class="site-title">Iverson's Bookstore</h1>
    <nav>
        <a href="products.php">Products</a>
        <a href="cart.php">Cart</a>
        <a href="orders.html">Orders</a>
    </nav>
</header>

<main>
    <h1>Enjoy your books!</h1>
    <p>Your order has been placed successfully!</p>
    <p>Order ID: <?= $order_id; ?></p>
    <p>Total: $<?= number_format($total, 2); ?></p>
    <a href="products.php" class="btn">Continue Shopping</a>
</main>

</body>
</html>
