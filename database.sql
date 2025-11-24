CREATE TABLE IF NOT EXISTS products (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    color VARCHAR(50),
    size VARCHAR(10),
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
    id SERIAL PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'new',
    payment_method VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS order_items (
    id SERIAL PRIMARY KEY,
    order_id INTEGER REFERENCES orders(id) ON DELETE CASCADE,
    product_id INTEGER REFERENCES products(id) ON DELETE CASCADE,
    quantity INTEGER NOT NULL DEFAULT 1,
    price DECIMAL(10, 2) NOT NULL
);

INSERT INTO products (name, price, description, color, size, image_url) VALUES
('Маленький Пластиковый Ремень', 2561.00, 'Стильный пластиковый ремень для повседневной носки', 'Черный', 'L', 'images/catalog/belt.png'),
('Элегантное Хлопковое Платье', 3890.00, 'Летнее платье из натурального хлопка', 'Белый', 'M', 'images/catalog/cotton_dress.png'),
('Классическая Кожаная Куртка', 8750.00, 'Куртка из натуральной кожи премиум качества', 'Коричневый', 'XL', 'images/catalog/jacket.png'),
('Спортивные Джинсы', 4200.00, 'Удобные джинсы с эластичной тканью', 'Синий', 'L', 'images/catalog/sport_jeans.png'),
('Вязаный Шерстяной Свитер', 3450.00, 'Теплый свитер из натуральной шерсти', 'Серый', 'M', 'images/catalog/sweater.png'),
('Летняя Льняная Рубашка', 2890.00, 'Легкая рубашка для жаркого лета', 'Бежевый', 'L', 'images/catalog/shirt.png'),
('Деловой Брючный Костюм', 9500.00, 'Классический костюм для офиса', 'Черный', 'XL', 'images/catalog/costume.png'),
('Кашемировый Кардиган', 6750.00, 'Роскошный кардиган из кашемира', 'Бордовый', 'M', 'images/catalog/cardigan.png'),
('Джинсовая Юбка', 2340.00, 'Модная юбка из денима', 'Голубой', 'S', 'images/catalog/skirt.png'),
('Трикотажная Футболка', 1560.00, 'Базовая футболка из мягкого трикотажа', 'Белый', 'L', 'images/catalog/t_shirt.png'),
('Шелковая Блуза', 4890.00, 'Элегантная блуза из натурального шелка', 'Розовый', 'M', 'images/catalog/blouse.png'),
('Утепленные Брюки', 3670.00, 'Теплые брюки для холодной погоды', 'Черный', 'L', 'images/catalog/trousers.png'),
('Спортивная Толстовка', 2990.00, 'Удобная толстовка с капюшоном', 'Серый', 'XL', 'images/catalog/sweatshirt.png'),
('Вечернее Платье', 7890.00, 'Роскошное платье для особых случаев', 'Красный', 'M', 'images/catalog/eveninng_dress.png'),
('Кожаные Лосины', 3120.00, 'Стильные лосины из эко-кожи', 'Черный', 'S', 'images/catalog/leggings.png'),
('Шерстяное пальто', 11200.00, 'Классическое пальто из шерсти', 'Серый', 'L', 'images/catalog/coat.png'),
('Хлопковая Пижама', 2450.00, 'Комфортная пижама для сна', 'Синий', 'M', 'images/catalog/pajamas.png'),
('Спортивные Шорты', 1890.00, 'Легкие шорты для тренировок', 'Черный', 'L', 'images/catalog/shorts.png');
