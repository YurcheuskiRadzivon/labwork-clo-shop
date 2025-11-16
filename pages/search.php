<?php
require_once '../config.php';

$page_title = 'Поиск';

$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';
$products = [];

if (!empty($search_query)) {
    $conn = getDbConnection();
    $query = "SELECT * FROM products WHERE LOWER(name) LIKE LOWER($1) OR LOWER(description) LIKE LOWER($1) LIMIT 20";
    $search_term = '%' . $search_query . '%';
    $result = dbQuery($conn, $query, [$search_term]);
    $products = pg_fetch_all($result);
    if (!$products) {
        $products = [];
    }
    pg_close($conn);
}

include '../includes/header.php';
?>

<div class="container">
    <h1>Поиск</h1>

    <div class="search-container">
        <form method="GET" action="/pages/search.php">
            <input type="text"
                   name="q"
                   class="search-input"
                   placeholder="Введите название товара..."
                   value="<?php echo htmlspecialchars($search_query); ?>"
                   autofocus>
        </form>
    </div>

    <?php if (!empty($search_query)): ?>
        <div class="search-results">
            <?php if (count($products) > 0): ?>
                <h2>Найдено результатов: <?php echo count($products); ?></h2>

                <div class="products-grid">
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <div class="product-image">200x200 px</div>
                            <div class="product-info">
                                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                                <p class="product-price"><?php echo number_format($product['price'], 0, ',', ' '); ?> BYN</p>
                                <div class="product-actions">
                                    <button class="btn btn-primary add-to-cart"
                                            data-id="<?php echo $product['id']; ?>"
                                            data-name="<?php echo htmlspecialchars($product['name']); ?>"
                                            data-price="<?php echo $product['price']; ?>"
                                            data-color="<?php echo htmlspecialchars($product['color']); ?>"
                                            data-size="<?php echo htmlspecialchars($product['size']); ?>">
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
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center" style="padding: 60px 20px;">
                    <h2 style="color: #999;">Ничего не найдено</h2>
                    <p>Попробуйте изменить запрос</p>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="text-center" style="padding: 60px 20px;">
            <p style="color: #666;">Введите запрос для поиска товаров</p>
        </div>
    <?php endif; ?>
</div>

<?php
include '../includes/footer.php';
?>
