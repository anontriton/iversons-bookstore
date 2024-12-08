function addToCart(productId) {
    const quantity = document.getElementById(`quantity-${productId}`).value;

    // send data to the server w/ fetch
    fetch('add_to_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ product_id: productId, quantity: parseInt(quantity, 10) })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert('Failed to add to cart: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error adding to cart:', error);
    });
}

function showMore(description) {
    const popup = document.getElementById('more-popup');
    const popupDescription = document.getElementById('popup-description');

    // set description content
    popupDescription.textContent = description;

    // display popup
    popup.style.display = 'block';
}

function closePopup() {
    const popup = document.getElementById('more-popup');
    popup.style.display = 'none';
}
