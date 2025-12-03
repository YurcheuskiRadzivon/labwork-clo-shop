<?php
require_once '../config.php';

$page_title = 'Оформление заказа';

// Обработка формы
$order_success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $payment_method = $_POST['payment_method'] ?? 'card';

    if (!empty($name) && !empty($phone) && !empty($email)) {
        $cart_data = $_POST['cart_data'] ?? '[]';
        $cart = json_decode($cart_data, true);

        if (!empty($cart)) {
            $conn = getDbConnection();

            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $insert_order = "INSERT INTO orders (user_name, phone, email, total, payment_method, status)
                            VALUES ($1, $2, $3, $4, $5, $6) RETURNING id";
            $order_result = dbQuery($conn, $insert_order, [$name, $phone, $email, $total, $payment_method, 'new']);
            $order_id = pg_fetch_assoc($order_result)['id'];

            foreach ($cart as $item) {
                $insert_item = "INSERT INTO order_items (order_id, product_id, quantity, price)
                               VALUES ($1, $2, $3, $4)";
                dbQuery($conn, $insert_item, [$order_id, $item['id'], $item['quantity'], $item['price']]);
            }

            pg_close($conn);
            $order_success = true;
        }
    }
}

include '../includes/header.php';
?>

<div class="container">
    <?php if ($order_success): ?>
        <div style="text-align: center; padding: 60px 20px;">
            <h1 style="color: var(--accent-green);">✓ Заказ успешно оформлен!</h1>
            <p style="font-size: 18px; margin: 20px 0;">Спасибо за ваш заказ. Мы свяжемся с вами в ближайшее время.</p>
            <a href="/index.php" class="btn btn-primary" style="margin-top: 20px;">Вернуться на главную</a>
        </div>

        <script>
            localStorage.setItem('cart', JSON.stringify([]));
            updateCartCount();
        </script>
    <?php else: ?>
        <h1>Оформление заказа</h1>

        <div id="empty-order-message" class="text-center" style="display: none; padding: 60px 20px;">
            <h2 style="color: #999;">Корзина пуста</h2>
            <p>Добавьте товары перед оформлением заказа</p>
            <a href="/pages/catalog.php" class="btn btn-primary" style="margin-top: 20px;">Перейти в каталог</a>
        </div>

        <div id="checkout-form-container" style="max-width: 600px; margin: 0 auto;">
            <form method="POST" id="checkout-form">
                <input type="hidden" name="cart_data" id="cart-data-input">

                <div class="form-group">
                    <label for="name">Имя *</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="phone">Номер телефона *</label>
                    <input type="tel" id="phone" name="phone" placeholder="+3751234567" pattern="^\+375((29|33|44|25)\d{7})$" required />
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="payment_method">Способ оплаты *</label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="card">Банковская карта</option>
                        <option value="cash">Наличные при получении</option>
                        <option value="online">Электронный кошелек</option>
                    </select>
                </div>

                <div id="order-summary" style="background-color: var(--bg-light); padding: 20px; border-radius: 8px; margin: 30px 0;">
                    <h3>Итого:</h3>
                    <p id="summary-text" style="font-size: 20px; font-weight: 700;"></p>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">Подтвердить заказ</button>
            </form>
        </div>
    <?php endif; ?>
</div>

<script>
    
function checkCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const formContainer = document.getElementById('checkout-form-container');
    const emptyMessage = document.getElementById('empty-order-message');

    if (cart.length === 0) {
        if (formContainer) formContainer.style.display = 'none';
        if (emptyMessage) emptyMessage.style.display = 'block';
        return;
    }

    if (formContainer) formContainer.style.display = 'block';
    if (emptyMessage) emptyMessage.style.display = 'none';

    const cartInput = document.getElementById('cart-data-input');
    if (cartInput) {
        cartInput.value = JSON.stringify(cart);
    }

    let total = 0;
    cart.forEach(item => {
        total += item.price * item.quantity;
    });

    const summaryText = document.getElementById('summary-text');
    if (summaryText) {
        summaryText.textContent = `${cart.length} ${getProductWord(cart.length)} на сумму ${total.toLocaleString('ru-RU')} BYN`;
    }
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

checkCart();
</script>

<?php
include '../includes/footer.php';
?>
