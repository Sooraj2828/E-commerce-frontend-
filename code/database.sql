CREATE DATABASE ecommerce_db;
USE ecommerce_db;

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    cart_id INT
);

CREATE TABLE cart (
    cart_id INT,
    user_id INT,
    product_id INT,
    quantity INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE orders (
    user_id INT,
    total_amount DECIMAL(10, 2),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO products (product_name, price) VALUES
    ('Product 1', 1899),
    ('Product 2', 1200),
    ('Product 3', 2499),
    ('Product 4', 2099),
    ('Product 5', 1299),
    ('Product 6', 1399),
    ('Product 7', 1200),
    ('Product 8', 1299),
    ('Product 9', 1599),
    ('Product 10', 1199);


