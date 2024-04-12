
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;
DROP tABLE IF EXISTS brands;
DROP TABLE IF EXISTS condition;
DROP TABLE IF EXISTS productimgs;
DROP TABLE IF EXISTS products;

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
{
    product INTEGER NOT NULL REFERENCES(products),
    user INTEGER NOT NULL REFERENCES(users)
}