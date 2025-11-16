<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - MAKKI' : 'MAKKI - Интернет-магазин одежды'; ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <a href="/index.php" class="logo">MAKKI</a>

            <button class="burger-menu" id="burger-menu" aria-label="Меню">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="nav" id="nav-menu">
                <ul class="nav-menu">
                    <li><a href="/index.php">Главная</a></li>
                    <li><a href="/pages/catalog.php">Каталог</a></li>
                    <li><a href="/pages/about.php">О нас</a></li>
                    <li><a href="/pages/delivery.php">Доставка и оплата</a></li>
                </ul>
            </nav>

            <div class="header-icons">
                <a href="/pages/search.php" class="icon" title="Поиск"><img src="/images/search.svg" alt="Поиск"></a>
                <a href="/pages/cart.php" class="icon" title="Корзина">
                    <img src="/images/cart.svg" alt="Корзина">
                    <span class="cart-count" id="cart-count">0</span>
                </a>
                <a href="/pages/favorites.php" class="icon" title="Избранное"><img src="/images/favorites.svg" alt="Избранное"></a>
            </div>
        </div>
    </header>

    <main>
