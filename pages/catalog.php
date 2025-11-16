<?php
require_once '../config.php';

$page_title = 'Каталог';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 9;
$offset = ($page - 1) * $limit;

$conn = getDbConnection();

$colors_query = "SELECT DISTINCT TRIM(UNNEST(STRING_TO_ARRAY(color, ','))) as color FROM products ORDER BY color";
$colors_result = dbQuery($conn, $colors_query);
$colors = pg_fetch_all($colors_result);

$sizes_query = "SELECT DISTINCT TRIM(UNNEST(STRING_TO_ARRAY(size, ','))) as size FROM products ORDER BY size";
$sizes_result = dbQuery($conn, $sizes_query);
$sizes = pg_fetch_all($sizes_result);

$price_query = "SELECT MIN(price) as min_price, MAX(price) as max_price FROM products";
$price_result = dbQuery($conn, $price_query);
$price_range = pg_fetch_assoc($price_result);

$where_conditions = [];
$params = [];
$param_count = 1;

if (isset($_GET['color']) && !empty($_GET['color'])) {
    $where_conditions[] = "color LIKE $" . $param_count;
    $params[] = '%' . $_GET['color'] . '%';
    $param_count++;
}

if (isset($_GET['size']) && !empty($_GET['size'])) {
    $where_conditions[] = "size LIKE $" . $param_count;
    $params[] = '%' . $_GET['size'] . '%';
    $param_count++;
}

if (isset($_GET['min_price']) && !empty($_GET['min_price'])) {
    $where_conditions[] = "price >= $" . $param_count;
    $params[] = (float)$_GET['min_price'];
    $param_count++;
}

if (isset($_GET['max_price']) && !empty($_GET['max_price'])) {
    $where_conditions[] = "price <= $" . $param_count;
    $params[] = (float)$_GET['max_price'];
    $param_count++;
}

if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'price_asc':
            $order_by = 'ORDER BY price ASC';
            break;
        case 'price_desc':
            $order_by = 'ORDER BY price DESC';
            break;
        case 'name_asc':
            $order_by = 'ORDER BY name ASC';
            break;
        default:
            $order_by = 'ORDER BY id';
    }
} else {
    $order_by = 'ORDER BY id';
}

$where_clause = count($where_conditions) > 0 ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

$count_query = "SELECT COUNT(*) as total FROM products $where_clause";
$count_result = dbQuery($conn, $count_query, $params);
$total_products = pg_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_products / $limit);

$params[] = $limit;
$params[] = $offset;
$query = "SELECT * FROM products $where_clause $order_by LIMIT $" . $param_count . " OFFSET $" . ($param_count + 1);
$result = dbQuery($conn, $query, $params);
$products = pg_fetch_all($result);
if (!$products) {
    $products = [];
}

include '../includes/header.php';
?>

<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h1>Каталог</h1>
            <p style="color: #666;">Найдено товаров: <?php echo $total_products; ?></p>
        </div>
        <div>
            <button class="btn btn-secondary" id="toggle-filters" style="display: inline-flex; align-items: center; gap: 8px;">
                Фильтры
            </button>
        </div>
    </div>

    <div class="filters-panel" id="filters-panel">
        <form method="GET" action="" id="filters-form">
            <div class="filters-grid">
                <div class="filter-group">
                    <label for="filter-color">Цвет:</label>
                    <select name="color" id="filter-color">
                        <option value="">Все цвета</option>
                        <?php if ($colors): ?>
                            <?php foreach ($colors as $color): ?>
                                <option value="<?php echo htmlspecialchars($color['color']); ?>"
                                    <?php echo (isset($_GET['color']) && $_GET['color'] == $color['color']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($color['color']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="filter-size">Размер:</label>
                    <select name="size" id="filter-size">
                        <option value="">Все размеры</option>
                        <?php if ($sizes): ?>
                            <?php foreach ($sizes as $size): ?>
                                <option value="<?php echo htmlspecialchars($size['size']); ?>"
                                    <?php echo (isset($_GET['size']) && $_GET['size'] == $size['size']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($size['size']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="filter-min-price">Мин. цена:</label>
                    <select name="min_price" id="filter-min-price">
                        <option value="">От</option>
                        <option value="50" <?php echo (isset($_GET['min_price']) && $_GET['min_price'] == '50') ? 'selected' : ''; ?>>50 BYN</option>
                        <option value="100" <?php echo (isset($_GET['min_price']) && $_GET['min_price'] == '100') ? 'selected' : ''; ?>>100 BYN</option>
                        <option value="150" <?php echo (isset($_GET['min_price']) && $_GET['min_price'] == '150') ? 'selected' : ''; ?>>150 BYN</option>
                        <option value="200" <?php echo (isset($_GET['min_price']) && $_GET['min_price'] == '200') ? 'selected' : ''; ?>>200 BYN</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="filter-max-price">Макс. цена:</label>
                    <select name="max_price" id="filter-max-price">
                        <option value="">До</option>
                        <option value="100" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '100') ? 'selected' : ''; ?>>100 BYN</option>
                        <option value="150" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '150') ? 'selected' : ''; ?>>150 BYN</option>
                        <option value="200" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '200') ? 'selected' : ''; ?>>200 BYN</option>
                        <option value="300" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '300') ? 'selected' : ''; ?>>300 BYN</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="filter-sort">Сортировка:</label>
                    <select name="sort" id="filter-sort">
                        <option value="">По умолчанию</option>
                        <option value="price_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : ''; ?>>Цена: по возрастанию</option>
                        <option value="price_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : ''; ?>>Цена: по убыванию</option>
                        <option value="name_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name_asc') ? 'selected' : ''; ?>>По алфавиту</option>
                    </select>
                </div>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">Применить</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='catalog.php'">Сбросить</button>
            </div>
        </form>
    </div>

    <div class="products-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="../<?php echo htmlspecialchars($product['image_url']); ?>"
                         alt="<?php echo htmlspecialchars($product['name']); ?>"
                         onerror="this.style.display='none'; this.parentElement.innerHTML='200x200 px';">
                </div>
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

    <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php
            $filter_params = [];
            if (isset($_GET['color'])) $filter_params[] = 'color=' . urlencode($_GET['color']);
            if (isset($_GET['size'])) $filter_params[] = 'size=' . urlencode($_GET['size']);
            if (isset($_GET['min_price'])) $filter_params[] = 'min_price=' . urlencode($_GET['min_price']);
            if (isset($_GET['max_price'])) $filter_params[] = 'max_price=' . urlencode($_GET['max_price']);
            if (isset($_GET['sort'])) $filter_params[] = 'sort=' . urlencode($_GET['sort']);
            $filter_query = count($filter_params) > 0 ? '&' . implode('&', $filter_params) : '';
            ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="active"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?php echo $i . $filter_query; ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<script>
document.getElementById('toggle-filters').addEventListener('click', function() {
    const panel = document.getElementById('filters-panel');
    panel.classList.toggle('active');

    if (panel.classList.contains('active')) {
        this.innerHTML = 'Скрыть фильтры';
    } else {
        this.innerHTML = 'Фильтры';
    }
});

<?php if (isset($_GET['color']) || isset($_GET['size']) || isset($_GET['min_price']) || isset($_GET['max_price']) || isset($_GET['sort'])): ?>
document.addEventListener('DOMContentLoaded', function() {
    const panel = document.getElementById('filters-panel');
    const button = document.getElementById('toggle-filters');
    panel.classList.add('active');
    button.innerHTML = 'Скрыть фильтры';
});
<?php endif; ?>
</script>

<?php
pg_close($conn);
include '../includes/footer.php';
?>
