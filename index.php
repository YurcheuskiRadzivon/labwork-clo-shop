<?php
require_once 'config.php';

$page_title = 'Главная';

$conn = getDbConnection();
$query = "SELECT * FROM products ORDER BY RANDOM() LIMIT 6";
$result = dbQuery($conn, $query);
$products = pg_fetch_all($result);
if (!$products) {
    $products = [];
}

include 'includes/header.php';
?>

<div class="container">
    <div class="slider">
        <div class="slider-track" id="slider-track">
            <div class="slide" style="background: linear-gradient(135deg, #9C2742 0%, #c93153 100%);">
                <h2 style="color: white; font-size: 36px;">Осенняя коллекция 2024</h2>
            </div>
            <div class="slide" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h2 style="color: white; font-size: 36px;">Скидки до 50%</h2>
            </div>
            <div class="slide" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <h2 style="color: white; font-size: 36px;">Новые поступления каждую неделю</h2>
            </div>
            <div class="slide" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <h2 style="color: white; font-size: 36px;">Бесплатная доставка от 100 BYN</h2>
            </div>
            <div class="slide" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <h2 style="color: white; font-size: 36px;">Эксклюзивные модели</h2>
            </div>
        </div>
        <div class="slider-dots" id="slider-dots">
            <span class="dot active" data-slide="0"></span>
            <span class="dot" data-slide="1"></span>
            <span class="dot" data-slide="2"></span>
            <span class="dot" data-slide="3"></span>
            <span class="dot" data-slide="4"></span>
        </div>
    </div>

    <section>
        <h1>Специальные предложения</h1>
        <p>Лучшие товары по выгодным ценам</p>

        <div class="products-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>"
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

        <div class="text-center mt-20">
            <a href="/pages/catalog.php" class="btn btn-primary">Смотреть весь каталог</a>
        </div>
    </section>
</div>

<script>

let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
const sliderTrack = document.getElementById('slider-track');

function showSlide(index) {
    if (index >= slides.length) currentSlide = 0;
    if (index < 0) currentSlide = slides.length - 1;

    sliderTrack.style.transform = `translateX(-${currentSlide * 100}%)`;

    dots.forEach(dot => dot.classList.remove('active'));
    dots[currentSlide].classList.add('active');
}

function nextSlide() {
    currentSlide++;
    showSlide(currentSlide);
}

setInterval(nextSlide, 5000);

dots.forEach(dot => {
    dot.addEventListener('click', () => {
        currentSlide = parseInt(dot.dataset.slide);
        showSlide(currentSlide);
    });
});
</script>

<?php
pg_close($conn);
include 'includes/footer.php';
?>
