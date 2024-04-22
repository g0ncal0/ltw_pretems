
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS brands;
DROP TABLE IF EXISTS conditions;
DROP TABLE IF EXISTS productImgs;
DROP TABLE IF EXISTS profileImgs;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS imgs;
DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS sizes;
DROP TABLE IF EXISTS purchases;
DROP TABLE IF EXISTS discounts;
DROP TABLE IF EXISTS purchaseItems;


CREATE TABLE users (
    name TEXT NOT NULL,
    id INTEGER NOT NULL PRIMARY KEY,
    email TEXT  NOT NULL,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    admin BOOLEAN,
    profileImg TEXT
);

CREATE TABLE categories(
    id INTEGER NOT NULL PRIMARY KEY,
    name TEXT NOT NULL
);

CREATE TABLE brands(
    id INTEGER PRIMARY KEY NOT NULL,
    name TEXT NOT NULL
);

CREATE TABLE conditions(
    id INTEGER PRIMARY KEY NOT NULL,
    name TEXT NOT NULL
);

CREATE TABLE sizes(
    id INTEGER PRIMARY KEY NOT NULL,
    name TEXT NOT NULL
);

CREATE TABLE products (
    name TEXT NOT NULL,
    id INTEGER PRIMARY KEY,
    date DATETIME NOT NULL,
    category INTEGER NOT NULL REFERENCES categories,
    brand INTEGER REFERENCES brands,
    model TEXT NOT NULL,
    size INTEGER NOT NULL REFERENCES sizes,
    condition INTEGER REFERENCES conditions,
    price REAL NOT NULL,
    user INTEGER NOT NULL REFERENCES users, 
    available BOOLEAN DEFAULT 0,
    description TEXT,
    firstImg TEXT
);

CREATE TABLE profileImgs (
    id INTEGER PRIMARY KEY,
    userId INTEGER REFERENCES products,
    path TEXT
);

CREATE TABLE cart (
    product INTEGER NOT NULL REFERENCES products,
    user INTEGER NOT NULL REFERENCES users
);

CREATE TABLE productImgs (
    id INTEGER PRIMARY KEY,
    product INTEGER NOT NULL REFERENCES products,
    path TEXT
);

CREATE TABLE purchaseItems(
    purchaseid TEXT NOT NULL REFERENCES purchases,
    productid INTEGER NOT NULL
);

CREATE TABLE purchases(
    id TEXT NOT NULL,
    date DATETIME NOT NULL, /* this will be the date it passed to pending (on checkout)*/
    status INTEGER NOT NULL, /* 0: pending ; 1: sucess (paid) */
    address TEXT NOT NULL,
    zipcode TEXT NOT NULL,
    buyerid INTEGER NOT NULL REFERENCES users
);


CREATE TABLE discounts(
    code TEXT NOT NULL,
    minamount INTEGER NOT NULL,
    percentage INTEGER NOT NULL,
    maxdiscount INTEGER NOT NULL
);

INSERT INTO users VALUES ('Zé', 0, 'ze@gmail.com', 'zeze', '1234', 1, 'img/profile/profile.png');
INSERT INTO users VALUES ('Maria', 1, 'maria@gmail.com', 'maria', '1234', 0, 'img/profile/profile.png');


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


INSERT INTO categories VALUES (0, 'Pretty');
INSERT INTO categories VALUES (1, 'Party');
INSERT INTO categories VALUES (2, 'Sports');

INSERT INTO sizes VALUES (0, 'XS');
INSERT INTO sizes VALUES (1, 'S');
INSERT INTO sizes VALUES (2, 'M');
INSERT INTO sizes VALUES (3, 'L');
INSERT INTO sizes VALUES (4, 'XL');

INSERT INTO brands VALUES (0, 'Nike');
INSERT INTO brands VALUES (1, 'Adidas');
INSERT INTO brands VALUES (2, 'Pull n Bear');

INSERT INTO conditions VALUES (0, 'New');
INSERT INTO conditions VALUES (1, 'Nearely used');
INSERT INTO conditions VALUES (2, 'Used');

INSERT INTO products VALUES ('dress', 0, '2023-11-12', 0, 0, 'modelo2', 0, 0, 80.9, 0, 1, 'beautiful dress with some functionality. I guess..', 'img/products/dress.jpeg');

INSERT INTO productImgs VALUES (0, 0, 'img/products/dress.jpeg');
INSERT INTO productImgs VALUES (1, 0, 'img/products/dress-beach.jpg');

UPDATE products SET firstImg = 'img/products/dress.jpeg' WHERE id = 0;
