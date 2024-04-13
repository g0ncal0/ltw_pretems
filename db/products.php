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

function searchProducts($db, $query){
    return fetchAll($db, 'SELECT * FROM products WHERE name LIKE ? OR description LIKE ?', array("%$query%", "%$query%"));
}

?>