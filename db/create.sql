
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS brands;
DROP TABLE IF EXISTS conditions;
DROP TABLE IF EXISTS productimgs;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS imgs;
DROP TABLE IF EXISTS productimgs;
DROP TABLE IF EXISTS cart;

CREATE TABLE users (
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

CREATE TABLE conditions(
    id INTEGER PRIMARY KEY NOT NULL,
    name TEXT NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE products (
    name TEXT NOT NULL,
    id INTEGER NOT NULL PRIMARY KEY,
    date DATETIME NOT NULL,
    category INTEGER NOT NULL REFERENCES  categories,
    brand INTEGER REFERENCES brands,
    model TEXT NOT NULL,
    size TEXT NOT NULL, 
    condition INTEGER REFERENCES conditions,
    price REAL NOT NULL,
    user INTEGER NOT NULL REFERENCES users, 
    available BOOLEAN NOT NULL,
    description TEXT,
    firstImg TEXT
);

CREATE TABLE imgs(
    id INTEGER NOT NULL PRIMARY KEY,
    filename TEXT NOT NULL
);

CREATE TABLE productimgs (
    productid INTEGER REFERENCES products,
    imgid INTEGER REFERENCES imgs
);

CREATE TABLE cart (
    product INTEGER NOT NULL REFERENCES products,
    user INTEGER NOT NULL REFERENCES users
);

INSERT INTO users VALUES ('Zé', 0, 'ze@gmail.com', 'zeze', '1234', FALSE);

INSERT INTO categories VALUES (0, 'pretty');

INSERT INTO products VALUES ('dress', 0, '2023-11-12', 0, NULL, 'modelo2', '0', NULL, 80.9, 0, TRUE, 'beautiful dress with some functionality. I guess..', NULL);

INSERT INTO imgs VALUES (0, 'img/dress.jpeg');
INSERT INTO imgs VALUES (1, 'img/dress-beach.jpg');

UPDATE products SET firstImg = 'img/dress.jpeg' WHERE id = 0;
