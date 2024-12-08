<?php
session_start();
header('Content-Type: application/json');

// read the product ID from the POST data
$input = json_decode(file_get_contents('php://input'), true);
$product_id = $input['order_id'] ?? null;

if ($product_id && isset($_SESSION['cart'][$product_id])) {
    unset($_SESSION['cart'][$product_id]);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID or not in cart']);
}
