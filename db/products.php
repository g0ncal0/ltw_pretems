<?php 

require_once('util.php');

function getAllProducts($db) {
    return fetchAll($db, 'SELECT * FROM products', null);
}

function getProduct($db, $id) {
    return fetch($db, 'SELECT * FROM products WHERE id = ?',array($id));
}

function getProductsLimitOffset($db, $limit, $offset, $category){
    if(isset($category)){
        return fetchAll($db, 'SELECT * FROM products LIMIT ? OFFSET ?', array($limit, $offset));
    }else{
        return fetchAll($db, 'SELECT * FROM products WHERE products.category = ? LIMIT ? OFFSET ?', array($category, $limit, $offset));
    }
}

function getProductsOfUser($db, $id) {
    return fetch($db, 'SELECT * FROM products JOIN users ON products.user = users.username WHERE users.id = ?', array($id));
}

function getProductsOfCategory($db, $category) {
    return fetchAll($db, 'SELECT *  FROM products WHERE  products.category = ?', array($category));
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

function getCategoryWithName($db, $name){
    return fetch($db, 'SELECT name FROM categories WHERE name = ?', array($name));
}

function getBrand($db, $id){
    return fetch($db, 'SELECT name FROM brands WHERE id = ?', array($id))['name'];
}

function getSize($db, $id){
    return fetch($db, 'SELECT name FROM sizes WHERE id = ?', array($id))['name'];
}

function getSizeWithName($db, $name){
    return fetch($db, 'SELECT name FROM sizes WHERE name = ?', array($name));
}

function getCondition($db, $id){
    return fetch($db, 'SELECT name FROM conditions WHERE id = ?', array($id))['name'];
}

function searchProducts($db, $query){
    return fetchAll($db, 'SELECT * FROM products WHERE name LIKE ? OR description LIKE ?', array("%$query%", "%$query%"));
}

function getProductID($db, $name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description) {
    return fetch($db, 'SELECT id FROM products WHERE name = ? AND date = ? AND category = ? AND brand = ? AND model = ? AND size = ? AND condition = ? AND price = ? AND user = ? AND available = ? AND description = ?', array($name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description))['id'];
}

function addProduct($db, $name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description, $images) {
    execute($db, 
    'INSERT INTO products (name, date, category, brand, model, size, condition, price, user, available, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
     array($name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description));
    
    $id = $db->lastInsertId();

    $firstImg = uploadProductImages($db, $images, $id);

    execute($db, 'UPDATE products SET firstImg = ? WHERE id = ?', array($firstImg, $id));
}


function getItemsOnIDs($db, $ids){
    // ids should be an array.
    if(isset($ids)){
    if(count($ids) > 0){
        $in  = str_repeat('?,', count($ids) - 1) . '?'; // GET STRING WITH len($ids) 
        $items = fetchAll($db, "SELECT * FROM products WHERE id IN ( $in )", $ids);
    }
    }
    return $items;
}

function addCategory($db, $name){
    execute($db, 'INSERT INTO categories (name) VALUES (?)', array($name));
}   

function addSize($db, $name){
    execute($db, 'INSERT INTO sizes (name) VALUES (?)', array($name));
}   


?>