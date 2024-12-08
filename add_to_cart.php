<?php
session_start();
header('Content-Type: application/json');

// read product ID and quantity from POST data
$input = json_decode(file_get_contents('php://input'), true);
$product_id = $input['product_id'] ?? null;
$quantity = $input['quantity'] ?? 1;

if ($product_id) {
    // initialize cart just in case
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // add to cart or increment if already present
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
}
