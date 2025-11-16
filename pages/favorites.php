<?php
require_once '../config.php';

$page_title = 'Избранное';

include '../includes/header.php';
?>

<div class="container">
    <h1>Избранное</h1>

    <div id="favorites-container" class="products-grid">
    </div>

    <div id="empty-favorites-message" class="text-center" style="display: none; padding: 60px 20px;">
        <h2 style="color: #999;">Избранное пусто</h2>
        <p>Добавьте товары, нажав на И в каталоге</p>
        <a href="/pages/catalog.php" class="btn btn-primary" style="margin-top: 20px;">Перейти в каталог</a>
    </div>
</div>

<script>
function displayFavorites() {
    const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    const container = document.getElementById('favorites-container');
    const emptyMessage = document.getElementById('empty-favorites-message');

    if (favorites.length === 0) {
        container.innerHTML = '';
        emptyMessage.style.display = 'block';
        return;
    }

    emptyMessage.style.display = 'none';
    container.innerHTML = '';

    favorites.forEach(item => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        productCard.innerHTML = `
            <div class="product-image">200x200 px</div>
            <div class="product-info">
                <h3>${item.name}</h3>
                <p class="product-price">${parseFloat(item.price).toLocaleString('ru-RU')} BYN</p>
                <div class="product-actions">
                    <button class="btn btn-primary add-to-cart-fav"
                            data-id="${item.id}"
                            data-name="${item.name}"
                            data-price="${item.price}"
                            data-color="Не указан"
                            data-size="M">
                        В корзину
                    </button>
                    <button class="favorite-btn active"
                            data-id="${item.id}">
                        ♥
                    </button>
                </div>
            </div>
        `;
        container.appendChild(productCard);
    });

    document.querySelectorAll('.add-to-cart-fav').forEach(btn => {
        btn.addEventListener('click', function() {
            const item = {
                id: this.dataset.id,
                name: this.dataset.name,
                price: parseFloat(this.dataset.price),
                color: this.dataset.color,
                size: this.dataset.size,
                quantity: 1
            };

            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const existingItem = cart.find(cartItem => cartItem.id === item.id);

            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push(item);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();

            this.textContent = 'Товар в корзине';
            this.classList.remove('btn-primary');
            this.classList.add('btn-success');

            setTimeout(() => {
                this.textContent = 'В корзину';
                this.classList.remove('btn-success');
                this.classList.add('btn-primary');
            }, 2000);
        });
    });

    document.querySelectorAll('.favorite-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.dataset.id;
            removeFromFavorites(productId);
        });
    });
}

function removeFromFavorites(productId) {
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    favorites = favorites.filter(item => item.id !== productId);
    localStorage.setItem('favorites', JSON.stringify(favorites));
    displayFavorites();
}

displayFavorites();
</script>

<?php
include '../includes/footer.php';
?>
