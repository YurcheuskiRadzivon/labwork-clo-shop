<?php
require_once '../config.php';
$page_title = 'О нас';
include '../includes/header.php';
?>

<div class="container">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="margin-top: 40px; margin-bottom: 20px;">О нас</h2>
        <p style="margin-bottom: 20px; line-height: 1.8;">
            Добро пожаловать в MAKKI - современный интернет-магазин стильной одежды. Мы работаем на рынке
            модной индустрии уже более 5 лет и за это время завоевали доверие тысяч клиентов.
        </p>

        <p style="margin-bottom: 20px; line-height: 1.8;">
            Наша миссия - предоставить каждому возможность выглядеть стильно и современно, не переплачивая
            за бренды. Мы тщательно отбираем каждую модель, проверяя качество материалов и пошива. В нашем
            каталоге представлены как базовые вещи для повседневного гардероба, так и яркие акцентные детали.
        </p>

        <p style="margin-bottom: 20px; line-height: 1.8;">
            MAKKI - это не просто магазин, это сообщество людей, ценящих комфорт, качество и стиль. Мы
            постоянно обновляем коллекции, следим за мировыми трендами и предлагаем самые актуальные модели
            сезона.
        </p>

        <p style="margin-bottom: 30px; line-height: 1.8;">
            Выбирая MAKKI, вы получаете не только качественную одежду, но и отличный сервис, быструю доставку
            и профессиональную консультацию наших специалистов. Мы работаем для вас и ценим каждого клиента!
        </p>

        <h2 style="margin-top: 40px; margin-bottom: 20px;">Наши преимущества:</h2>
        <ul style="line-height: 2; padding-left: 20px;">
            <li>Широкий ассортимент качественной одежды</li>
            <li>Доступные цены без переплат</li>
            <li>Быстрая доставка по всей Беларуси</li>
            <li>Удобная система возврата и обмена</li>
            <li>Профессиональная консультация</li>
            <li>Регулярные акции и скидки</li>
        </ul>

        <h2 style="margin-top: 40px; margin-bottom: 20px;">Контакты</h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <div style="background-color: var(--bg-light); padding: 30px; border-radius: 8px; text-align: center;">
                <div style="font-size: 48px; margin-bottom: 15px;">📞</div>
                <h3 style="margin-bottom: 15px;">Телефоны</h3>
                <p style="line-height: 1.8;">+375 33 325 63 81</p>
                <p style="line-height: 1.8;">+375 29 710 97 92</p>
            </div>

            <div style="background-color: var(--bg-light); padding: 30px; border-radius: 8px; text-align: center;">
                <div style="font-size: 48px; margin-bottom: 15px;">✉️</div>
                <h3 style="margin-bottom: 15px;">Email</h3>
                <p style="line-height: 1.8;">makki-style@mail.ru</p>
            </div>

            <div style="background-color: var(--bg-light); padding: 30px; border-radius: 8px; text-align: center;">
                <div style="font-size: 48px; margin-bottom: 15px;">📍</div>
                <h3 style="margin-bottom: 15px;">Адрес</h3>
                <p style="line-height: 1.8;">г. Гродно</p>
                <p style="line-height: 1.8;">ул. Горького, 91</p>
            </div>
        </div>

        <div style="background-color: var(--bg-light); padding: 30px; border-radius: 8px; margin-bottom: 30px;">
            <h3 style="text-align: center; margin-bottom: 20px;">Режим работы</h3>
            <div style="text-align: center; font-size: 18px; line-height: 2;">
                <p><strong>Понедельник - Воскресенье:</strong> 11:00 - 19:00</p>
                <p style="color: var(--primary-color); font-weight: 700; margin-top: 15px;">Без выходных</p>
            </div>
        </div>

        <div style="background-color: var(--bg-light); padding: 30px; border-radius: 8px; margin-bottom: 30px;">
            <h3 style="text-align: center; margin-bottom: 20px;">Мы в социальных сетях</h3>
            <div style="text-align: center;">
                <a href="https://www.instagram.com/makki_style_by" target="_blank"
                   style="display: inline-block; background-color: var(--primary-color); color: white;
                          padding: 15px 40px; border-radius: 8px; font-size: 18px; font-weight: 700;">
                    Instagram - @makki_style_by
                </a>
            </div>
        </div>

        <div style="background-color: var(--bg-light); padding: 30px; border-radius: 8px;">
            <h3 style="margin-bottom: 15px;">Юридическая информация</h3>
            <p style="line-height: 1.8; margin-bottom: 8px;"><strong>Полное наименование:</strong> ООО "MAKKI"</p>
            <p style="line-height: 1.8; margin-bottom: 8px;"><strong>УНП:</strong> 591039386</p>
            <p style="line-height: 1.8; margin-bottom: 8px;"><strong>Юридический адрес:</strong>  230005, г. Гродно, ул. Горького, 91</p>
            <p style="line-height: 1.8; margin-bottom: 8px;"><strong>Р/с:</strong> ALFA 3012 2B54 6900 1027 0000</p>
            <p style="line-height: 1.8;"><strong>Банк:</strong> ОАО "АСБ Беларусбанк"</p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
