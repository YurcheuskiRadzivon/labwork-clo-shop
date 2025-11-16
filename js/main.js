// Обновление счетчика корзины
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const count = cart.reduce((total, item) => total + item.quantity, 0);
    const cartCountElement = document.getElementById('cart-count');

    if (cartCountElement) {
        cartCountElement.textContent = count;

        if (count === 0) {
            cartCountElement.style.display = 'none';
        } else {
            cartCountElement.style.display = 'inline-block';
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();

    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(button => {
        const productId = button.dataset.id;
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const inCart = cart.find(item => item.id === productId);

        if (inCart) {
            button.textContent = 'Товар в корзине';
            button.classList.remove('btn-primary');
            button.classList.add('btn-success');
        }
    });

    const burgerMenu = document.getElementById('burger-menu');
    const navMenu = document.getElementById('nav-menu');

    if (burgerMenu) {
        burgerMenu.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
            document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
        });

        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                burgerMenu.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.style.overflow = '';
            });
        });

        document.addEventListener('click', function(e) {
            if (!navMenu.contains(e.target) && !burgerMenu.contains(e.target) && navMenu.classList.contains('active')) {
                burgerMenu.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
});
