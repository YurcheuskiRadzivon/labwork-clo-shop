
<?php
require_once '../config.php';
$page_title = 'Доставка и оплата';
include '../includes/header.php';
?>
<div class="container">
    <h1>Доставка и оплата</h1>

    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="margin-top: 40px; margin-bottom: 20px;">Способы доставки</h2>

        <div style="background-color: var(--bg-light); padding: 25px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Курьерская доставка</h3>
            <p style="line-height: 1.8; margin-bottom: 10px;">
                Доставка по Гродно осуществляется в течение 1-2 рабочих дней с момента оформления заказа.
            </p>
            <p style="line-height: 1.8; margin-bottom: 10px;">
                <strong>Стоимость:</strong> 5 BYN
            </p>
            <p style="line-height: 1.8;">
                <strong>Время доставки:</strong> с 10:00 до 20:00 (возможна доставка в удобное для вас время)
            </p>
        </div>

        <div style="background-color: var(--bg-light); padding: 25px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Доставка в регионы</h3>
            <p style="line-height: 1.8; margin-bottom: 10px;">
                Доставка по всей Беларуси через службы "Белпочта" и "Европочта".
            </p>
            <p style="line-height: 1.8; margin-bottom: 10px;">
                <strong>Стоимость:</strong> от 7 BYN (зависит от региона и веса посылки)
            </p>
            <p style="line-height: 1.8;">
                <strong>Срок доставки:</strong> 3-5 рабочих дней
            </p>
        </div>

        <div style="background-color: var(--bg-light); padding: 25px; border-radius: 8px; margin-bottom: 40px;">
            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Самовывоз</h3>
            <p style="line-height: 1.8; margin-bottom: 10px;">
                Вы можете забрать заказ самостоятельно из нашего магазина.
            </p>
            <p style="line-height: 1.8; margin-bottom: 10px;">
                <strong>Адрес:</strong> г. Гродно, ул. К. Маркса, 7
            </p>
            <p style="line-height: 1.8; margin-bottom: 10px;">
                <strong>Стоимость:</strong> БЕСПЛАТНО
            </p>
            <p style="line-height: 1.8;">
                <strong>Режим работы:</strong> 11:00 - 19:00 ежедневно
            </p>
        </div>

        <h2 style="margin-top: 40px; margin-bottom: 20px;">Способы оплаты</h2>

        <div style="background-color: var(--bg-light); padding: 25px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Банковские карты</h3>
            <p style="line-height: 1.8;">
                Принимаем к оплате карты Visa, MasterCard, Maestro, Белкарт. Оплата происходит на защищенной
                странице банка с использованием технологии 3D Secure.
            </p>
        </div>

        <div style="background-color: var(--bg-light); padding: 25px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Наличные при получении</h3>
            <p style="line-height: 1.8;">
                Вы можете оплатить заказ наличными курьеру при получении или в пункте самовывоза.
            </p>
        </div>

        <div style="background-color: var(--bg-light); padding: 25px; border-radius: 8px; margin-bottom: 40px;">
            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Электронные кошельки</h3>
            <p style="line-height: 1.8;">
                Принимаем оплату через ЕРИП, WebMoney, Яндекс.Деньги и другие электронные платежные системы.
            </p>
        </div>

        <h2 style="margin-top: 40px; margin-bottom: 20px;">Возврат и обмен</h2>

        <div style="background-color: var(--bg-light); padding: 25px; border-radius: 8px;">
            <p style="line-height: 1.8; margin-bottom: 15px;">
                Вы можете вернуть или обменять товар надлежащего качества в течение 14 дней с момента получения.
            </p>
            <p style="line-height: 1.8; margin-bottom: 15px;">
                <strong>Условия возврата:</strong>
            </p>
            <ul style="line-height: 2; padding-left: 20px; margin-bottom: 15px;">
                <li>Товар не был в употреблении</li>
                <li>Сохранены все бирки и этикетки</li>
                <li>Товарный вид и упаковка не нарушены</li>
                <li>Сохранен чек или иной документ, подтверждающий покупку</li>
            </ul>
            <p style="line-height: 1.8;">
                <strong>График работы:</strong> 11:00 - 19:00 ежедневно
            </p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
