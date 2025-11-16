
// Настройка карточек товаров для перехода на детальную страницу
document.addEventListener('DOMContentLoaded', function() {
    setupProductCards();
});

function setupProductCards() {
    document.querySelectorAll('.product-card').forEach(card => {
        const buttons = card.querySelectorAll('.add-to-cart, .favorite-btn');
        buttons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        card.addEventListener('click', function(e) {
            if (!e.target.closest('.add-to-cart') && !e.target.closest('.favorite-btn')) {
                const productId = card.querySelector('.add-to-cart').dataset.id;
                window.location.href = `/pages/product.php?id=${productId}`;
            }
        });
    });
}
