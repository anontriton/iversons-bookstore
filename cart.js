function removeFromCart(productId) {
    fetch('remove_from_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ order_id: productId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        });
}

function checkout() {
    if (confirm('Proceed to checkout?')) {
        window.location.href = 'thankyou.php';
    }
}
