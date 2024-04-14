
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;
DROP tABLE IF EXISTS brands;
DROP TABLE IF EXISTS condition;
DROP TABLE IF EXISTS imgs;
DROP TABLE IF EXISTS productimgs;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS cart;

CREATE TABLE users 
(
    name TEXT NOT NULL,
    id INTEGER NOT NULL PRIMARY KEY,
    email TEXT  NOT NULL,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    admin BOOLEAN
);

CREATE TABLE categories(
    id INTEGER NOT NULL PRIMARY KEY,
    name TEXT NOT NULL
);

CREATE TABLE brands(
    id INTEGER PRIMARY KEY NOT NULL,
    name TEXT NOT NULL
);

CREATE TABLE condition(
    id INTEGER PRIMARY KEY NOT NULL,
    name TEXT NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE imgs(
    id INTEGER NOT NULL PRIMARY KEY,
    filename TEXT NOT NULL
);

CREATE TABLE productimgs (
    productid INTEGER REFERENCES products,
    imgid INTEGER REFERENCES imgs
);

/* TODO: check if size is xs ... xxl (with PHP) */
CREATE TABLE products
(
    name TEXT NOT NULL,
    id INTEGER NOT NULL PRIMARY KEY,
    date DATETIME NOT NULL,
    category INTEGER NOT NULL REFERENCES categories,
    brand INTEGER REFERENCES brands,
    model TEXT NOT NULL,
    size TEXT NOT NULL, 
    condition INTEGER REFERENCES condition,
    price REAL NOT NULL,
    user INTEGER NOT NULL REFERENCES users, 
    available BOOLEAN NOT NULL,
    description TEXT
);


CREATE TABLE cart
(
    product INTEGER NOT NULL REFERENCES products,
    user INTEGER NOT NULL REFERENCES users
);



-- TODO: remove (used for testing shopping cart)
/*
INSERT INTO products (name, id, date, category, brand, model, size, condition, price, user, available, description) VALUES 
("T-shirt", 1, "2024-04-12 10:00:00", 1, 1, "Slim Fit T-shirt", "M", 1, 19.99, 1, 1, "A comfortable and stylish T-shirt for everyday wear."),
("Jeans", 2, "2024-04-12 10:30:00", 2, 2, "Skinny Jeans", "32x30", 2, 39.99, 2, 1, "Classic skinny jeans with a modern twist."),
("Sneakers", 3, "2024-04-12 11:00:00", 3, 3, "Running Shoes", "US 10", 3, 79.99, 3, 1, "Lightweight and breathable running shoes for your active lifestyle.");

INSERT INTO users (name, id, email, username, password, admin) VALUES ('John Doe', 1, 'johndoe@example.com', 'johndoe', 'password123', 0);

INSERT INTO cart (product, user) VALUES (1, 1); -- Link product 1 to user 1
INSERT INTO cart (product, user) VALUES (2, 1); -- Link product 2 to user 1
INSERT INTO cart (product, user) VALUES (3, 1); -- Link product 3 to user 1
*/