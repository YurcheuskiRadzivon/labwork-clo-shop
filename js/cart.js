// Добавление товара 
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const product = {
                id: this.dataset.id,
                name: this.dataset.name,
                price: parseFloat(this.dataset.price),
                color: this.dataset.color,
                size: this.dataset.size,
                quantity: 1
            };

            addToCart(product, this);
        });
    });
});

//add to cart from local storage
function addToCart(product, buttonElement) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const existingProduct = cart.find(item => item.id === product.id);

    if (existingProduct) {
        existingProduct.quantity++;
    } else {
        cart.push(product);
    }

    localStorage.setItem('cart', JSON.stringify(cart));

    updateCartCount();

    if (buttonElement) {
        const originalText = buttonElement.textContent;
        buttonElement.textContent = 'Товар в корзине';
        buttonElement.classList.remove('btn-primary');
        buttonElement.classList.add('btn-success');

        setTimeout(() => {
            buttonElement.textContent = originalText;
            buttonElement.classList.remove('btn-success');
            buttonElement.classList.add('btn-primary');
        }, 2000);
    }

    showNotification('Товар добавлен в корзину!');
}

// css for notification
function showNotification(message) {
    const notification = document.createElement('div');
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background-color: #4CAF50;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        z-index: 10000;
        font-weight: 700;
        animation: slideIn 0.3s ease;
    `;

    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(style);

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideIn 0.3s ease reverse';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}
