// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    updateFavoriteButtons();

    document.querySelectorAll('.favorite-btn').forEach(button => {
        button.addEventListener('click', function() {
            const product = {
                id: this.dataset.id,
                name: this.dataset.name,
                price: parseFloat(this.dataset.price),
                image: this.dataset.image
            };

            toggleFavorite(product, this);
        });
    });
});

// сердечко загорается либо тухнет в каталоге или главном при нажатии
function toggleFavorite(product, buttonElement) {
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    const index = favorites.findIndex(item => item.id === product.id);

    if (index > -1) {
        favorites.splice(index, 1);
        buttonElement.classList.remove('active');
        buttonElement.textContent = '♡';
        showFavoriteNotification('Товар удален из избранного');
    } else {
        favorites.push(product);
        buttonElement.classList.add('active');
        buttonElement.textContent = '♥';
        showFavoriteNotification('Товар добавлен в избранное!');
    }

    localStorage.setItem('favorites', JSON.stringify(favorites));
}

//установка состояния сердечек при загрузке страницы 
function updateFavoriteButtons() {
    const favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    document.querySelectorAll('.favorite-btn').forEach(button => {
        const productId = button.dataset.id;
        const isFavorite = favorites.some(item => item.id === productId);

        if (isFavorite) {
            button.classList.add('active');
            button.textContent = '♥';
        } else {
            button.classList.remove('active');
            button.textContent = '♡';
        }
    });
}

function showFavoriteNotification(message) {
    const notification = document.createElement('div');
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background-color: #9C2742;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        z-index: 10000;
        font-weight: 700;
        animation: slideIn 0.3s ease;
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideIn 0.3s ease reverse';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}
