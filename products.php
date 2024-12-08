<?php
require 'db_creds.php';

$result = $conn->query("SELECT * FROM products");

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Iverson's Bookstore</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="products.css">
    <script src="products.js" defer></script>
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
    <h1>Featured Selection</h1>
    <div id="product-list">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product" data-description="<?= $product['description']; ?>">
                    <img src="<?= $product['image_url']; ?>" alt="<?= $product['name']; ?>">
                    <h3><?= $product['name']; ?></h3>
                    <p>Price: $<?= number_format($product['price'], 2); ?></p>
                    <select id="quantity-<?= $product['id']; ?>">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <button onclick="addToCart(<?= $product['id']; ?>)">Add to Cart</button>
                    <button onclick="showMore('<?= addslashes($product['description']); ?>')">More</button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products available at the moment.</p>
        <?php endif; ?>
    </div>
</main>

<!-- Popup modal for "More" -->
<div id="more-popup" class="popup" style="display: none;">
    <div class="popup-content">
        <p id="popup-description"></p>
        <span class="close-button" onclick="closePopup()">&times;</span>
    </div>
</div>

</body>
</html>
