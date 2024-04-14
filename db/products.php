<?php 

require_once('util.php');

function getAllProducts($db) {
    return fetchAll($db, 'SELECT * FROM products', null);
}

function getProduct($db, $id) {
    return fetch($db, 'SELECT * FROM products WHERE id = ?',array($id));
}

function getProductsOfUser($db, $id) {
    return fetch($db, 'SELECT * FROM products JOIN users ON products.user = users.username WHERE users.id = ?', array($id));
}

function getProductsOfCategory($db, $category) {
    return fetchAll($db, 'SELECT * FROM products JOIN categories ON products.category = categories.id WHERE categories.name = ?', array($category));
}

function getCategories($db){
    return fetchAll($db, 'SELECT * FROM categories', null);
}

function getBrands($db){
    return fetchAll($db, 'SELECT * FROM brands', null);
}

function getSizes($db){
    return fetchAll($db, 'SELECT * FROM sizes', null);
}

function getConditions($db){
    return fetchAll($db, 'SELECT * FROM conditions', null);
}

function getCategory($db, $id){
    return fetch($db, 'SELECT name FROM categories WHERE id = ?', array($id))['name'];
}

function getBrand($db, $id){
    return fetch($db, 'SELECT name FROM brands WHERE id = ?', array($id))['name'];
}

function getSize($db, $id){
    return fetch($db, 'SELECT name FROM sizes WHERE id = ?', array($id))['name'];
}

function getCondition($db, $id){
    return fetch($db, 'SELECT name FROM conditions WHERE id = ?', array($id))['name'];
}

function searchProducts($db, $query){
    return fetchAll($db, 'SELECT * FROM products WHERE name LIKE ? OR description LIKE ?', array("%$query%", "%$query%"));
}

function addProduct($db, $name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description, $firstImg) {
    execute($db, 
    'INSERT INTO products (name, date, category, brand, model, size, condition, price, user, available, description, firstImg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
     array($name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description, $firstImg));
}

?>