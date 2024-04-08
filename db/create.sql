


CREATE TABLE users 
{
    name TEXT NOT NULL,
    ID INTEGER NOT NULL,
    email TEXT  NOT NULL,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    admin BOOLEAN NOT NULL
}

CREATE TABLE categories{
    ID INTEGER NOT NULL,
    name TEXT NOT NULL,
}

CREATE TABLE products
{
    date DATE NOT NULL,
    category 
    brand
    model
    size
    condition
    price
    user
    images
    available
}

