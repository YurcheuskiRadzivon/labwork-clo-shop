<?php
require_once '../config.php';

// Получение ID товара
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id <= 0) {
    header('Location: /pages/catalog.php');
    exit;
}

// Подключение к БД
$conn = getDbConnection();

// Получение информации о товаре
$query = "SELECT * FROM products WHERE id = $1";
$result = dbQuery($conn, $query, [$product_id]);
$product = pg_fetch_assoc($result);

if (!$product) {
    header('Location: /pages/catalog.php');
    exit;
}

$page_title = $product['name'];

include '../includes/header.php';
?>

<div class="container">
    <div class="product-detail">
        <div class="product-detail-image">
            <img src="../<?php echo htmlspecialchars($product['image_url']); ?>"
                 alt="<?php echo htmlspecialchars($product['name']); ?>"
                 onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=\'display:flex;align-items:center;justify-content:center;height:100%;color:#999;\'>400x400 px</div>';">
        </div>

        <div class="product-detail-info">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>

            <div class="product-detail-price">
                <?php echo number_format($product['price'], 0, ',', ' '); ?> BYN
            </div>

            <div class="product-detail-description">
                <h3>Описание товара</h3>
                <p><?php echo nl2br(htmlspecialchars($product['description'] ?? 'Описание товара отсутствует.')); ?></p>
            </div>

            <div class="product-detail-params">
                <div class="param-group">
                    <label for="product-color">Цвет:</label>
                    <select id="product-color" class="param-select">
                        <?php
                        $colors = explode(',', $product['color']);
                        foreach ($colors as $color) {
                            $color = trim($color);
                            echo '<option value="' . htmlspecialchars($color) . '">' . htmlspecialchars($color) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="param-group">
                    <label for="product-size">Размер:</label>
                    <select id="product-size" class="param-select">
                        <?php
                        $sizes = explode(',', $product['size']);
                        foreach ($sizes as $size) {
                            $size = trim($size);
                            echo '<option value="' . htmlspecialchars($size) . '">' . htmlspecialchars($size) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="product-detail-actions">
                <button class="btn btn-primary" id="add-to-cart-detail"
                        data-id="<?php echo $product['id']; ?>"
                        data-name="<?php echo htmlspecialchars($product['name']); ?>"
                        data-price="<?php echo $product['price']; ?>">
                    В корзину
                </button>
                <button class="favorite-btn"
                        data-id="<?php echo $product['id']; ?>"
                        data-name="<?php echo htmlspecialchars($product['name']); ?>"
                        data-price="<?php echo $product['price']; ?>"
                        data-image="<?php echo htmlspecialchars($product['image_url']); ?>">
                    ♡
                </button>
            </div>
        </div>
    </div>

    <div class="product-back">
        <a href="/pages/catalog.php" class="btn btn-secondary">← Вернуться в каталог</a>
    </div>
</div>

<script>
document.getElementById('add-to-cart-detail').addEventListener('click', function() {
    const color = document.getElementById('product-color').value;
    const size = document.getElementById('product-size').value;

    const product = {
        id: this.dataset.id,
        name: this.dataset.name,
        price: parseFloat(this.dataset.price),
        color: color,
        size: size,
        quantity: 1
    };

    addToCart(product, this);
});

document.addEventListener('DOMContentLoaded', function() {
    const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    const productId = '<?php echo $product['id']; ?>';
    const favoriteBtn = document.querySelector('.favorite-btn[data-id="' + productId + '"]');

    if (favorites.find(item => item.id === productId)) {
        favoriteBtn.classList.add('active');
        favoriteBtn.textContent = '❤';
    }
});
</script>

<?php
pg_close($conn);
include '../includes/footer.php';
?>
