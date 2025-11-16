<?php
require_once '../config.php';

$page_title = 'Корзина';

include '../includes/header.php';
?>

<div class="container">
    <h1>Корзина</h1>

    <div id="cart-items-container" class="cart-items">
        
    </div>

    <div id="empty-cart-message" class="text-center" style="display: none; padding: 60px 20px;">
        <h2 style="color: #999;">Корзина пуста</h2>
        <p>Добавьте товары из каталога</p>
        <a href="/pages/catalog.php" class="btn btn-primary" style="margin-top: 20px;">Перейти в каталог</a>
    </div>

    <div id="cart-actions" style="display: none;">
        <div class="cart-total">
            <span id="cart-total-text">Итого: 0 BYN</span>
        </div>

        <div style="display: flex; gap: 20px; justify-content: flex-end; margin-top: 20px;">
            <button class="btn btn-secondary" id="clear-cart-btn">Очистить корзину</button>
            <a href="/pages/checkout.php" class="btn btn-primary">Оформить заказ</a>
        </div>
    </div>
</div>

<script>

function displayCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const container = document.getElementById('cart-items-container');
    const emptyMessage = document.getElementById('empty-cart-message');
    const cartActions = document.getElementById('cart-actions');

    if (cart.length === 0) {
        container.innerHTML = '';
        emptyMessage.style.display = 'block';
        cartActions.style.display = 'none';
        return;
    }

    emptyMessage.style.display = 'none';
    cartActions.style.display = 'block';

    let total = 0;
    container.innerHTML = '';

    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.innerHTML = `
            <div class="cart-item-image"></div>
            <div class="cart-item-info">
                <h3>${item.name}</h3>
                <p class="cart-item-details">${item.size}, ${item.color}</p>
            </div>
            <div class="quantity-controls">
                <button class="quantity-btn" onclick="updateQuantity(${index}, -1)">−</button>
                <span class="quantity">${item.quantity}</span>
                <button class="quantity-btn" onclick="updateQuantity(${index}, 1)">+</button>
            </div>
            <div class="cart-item-price">
                ${itemTotal.toLocaleString('ru-RU')} BYN
            </div>
            <button class="remove-btn" onclick="removeFromCart(${index})"><img src="/images/delete.svg" alt="Удалить из корзины"></button>
        `;
        container.appendChild(cartItem);
    });

    document.getElementById('cart-total-text').textContent =
        `${cart.length} ${getProductWord(cart.length)} на сумму ${total.toLocaleString('ru-RU')} BYN`;
}

function getProductWord(count) {
    const lastDigit = count % 10;
    const lastTwoDigits = count % 100;

    if (lastTwoDigits >= 11 && lastTwoDigits <= 19) {
        return 'товаров';
    }

    if (lastDigit === 1) {
        return 'товар';
    }

    if (lastDigit >= 2 && lastDigit <= 4) {
        return 'товара';
    }

    return 'товаров';
}

function updateQuantity(index, change) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    if (cart[index]) {
        cart[index].quantity += change;

        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        displayCart();
        updateCartCount();
    }
}

function removeFromCart(index) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    displayCart();
    updateCartCount();
}

document.getElementById('clear-cart-btn').addEventListener('click', function() {
    if (confirm('Вы уверены, что хотите очистить корзину?')) {
        localStorage.setItem('cart', JSON.stringify([]));
        displayCart();
        updateCartCount();
    }
});

displayCart();
</script>

<?php
include '../includes/footer.php';
?>
