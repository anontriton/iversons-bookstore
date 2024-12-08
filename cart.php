<?php
session_start();
require 'db_creds.php';

// initialize cart in session if doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// fetch product details for items in cart
$cart = $_SESSION['cart'];
$total = 0;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="cart.css">
    <script src="cart.js" defer></script>
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
    <h1>Shopping Cart</h1>
    <div id="cart-list">
        <?php if (!empty($cart)): ?>
            <?php foreach ($cart as $product_id => $quantity): ?>
                <?php
                $stmt = $conn->prepare("SELECT name, price FROM products WHERE id = ?");
                $stmt->bind_param("i", $product_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $product = $result->fetch_assoc();
                $subtotal = $product['price'] * $quantity;
                $total += $subtotal;
                ?>
                <div class="cart-item">
                    <p><?= $product['name']; ?> x<?= $quantity; ?> - $<?= number_format($subtotal, 2); ?></p>
                    <button onclick="removeFromCart(<?= $product_id; ?>)">Remove</button>
                </div>
            <?php endforeach; ?>
            <p class="cart-total">Total: $<?= number_format($total, 2); ?></p>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
    <div class="cart-actions">
        <button onclick="checkout()">Check Out</button>
        <button onclick="window.location.href='products.php'">Continue Shopping</button>
    </div>
</main>
</body>
</html>
