<?php 

require_once('util.php');

function getAllProducts($db) {
    return fetchAll($db, 'SELECT * FROM products WHERE available = TRUE', null);
}

function getProduct($db, $id) {
    return fetch($db, 'SELECT * FROM products WHERE id = ?',array($id));
}

function getProductsLimitOffset($db, $limit, $offset, $category){
    if(isset($category)){
        return fetchAll($db, 'SELECT * FROM products WHERE available = TRUE LIMIT ? OFFSET ?', array($limit, $offset));
    }else{
        return fetchAll($db, 'SELECT * FROM products WHERE products.category = ? AND available = TRUE LIMIT ? OFFSET ?', array($category, $limit, $offset));
    }
}

function getProductsOfUser($db, $id) {
    return fetchAll($db, 'SELECT * FROM products WHERE user = ?', array($id));
}

function getSellingProductsOfUser($db, $id) {
    return fetchAll($db, 'SELECT * FROM products WHERE user = ? AND available = TRUE', array($id));
}

function getSellerOfProduct($db, $id) {
    return fetch($db, 'SELECT user FROM products WHERE id = ?', array($id))['user'];
}

function getSoldProductsOfUser($db, $id) {
    return fetchAll($db, 'SELECT * FROM products WHERE user = ? AND available = FALSE', array($id));
}

function getShippingIds($db, $id) {
    return fetch($db, 'SELECT purchaseItems.productid AS product_id, purchaseItems.purchaseid AS purchase_id
                       FROM purchaseItems WHERE product_id = ?;', array($id));
}

function getShippingWithId($db, $product_id, $purchase_id) {
    return fetch($db, 'SELECT purchases.date AS date, purchases.address AS address, purchases.zipcode AS zipcode, users.name AS name
                       FROM purchases
                       JOIN purchaseItems ON purchases.id = purchaseItems.purchaseid
                       JOIN products ON purchaseItems.productid = products.id
                       JOIN users ON purchases.buyerid = users.id
                       WHERE purchases.id = ? AND purchaseItems.productid = ?;', array($purchase_id, $product_id));
}

function getProductsOfCategory($db, $category) {
    return fetchAll($db, 'SELECT * FROM products WHERE category = ? AND available = TRUE', array($category));
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
    return fetch($db, 'SELECT * FROM categories WHERE name = ?', array($name));
}

function getBrand($db, $id){
    return fetch($db, 'SELECT name FROM brands WHERE id = ?', array($id))['name'];
}

function getSize($db, $id){
    return fetch($db, 'SELECT name FROM sizes WHERE id = ?', array($id))['name'];
}

function getSizeWithName($db, $name){
    return fetch($db, 'SELECT * FROM sizes WHERE name = ?', array($name));
}

function getCondition($db, $id){
    return fetch($db, 'SELECT name FROM conditions WHERE id = ?', array($id))['name'];
}

function getConditionWithName($db, $id){
    return fetch($db, 'SELECT * FROM conditions WHERE name = ?', array($id));
}

function searchProducts($db, $query){
    return fetchAll($db, 'SELECT * FROM products WHERE name LIKE ? OR description LIKE ?', array("%$query%", "%$query%"));
}

function getProductID($db, $name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description) {
    return fetch($db, 'SELECT id FROM products WHERE name = ? AND date = ? AND category = ? AND brand = ? AND model = ? AND size = ? AND condition = ? AND price = ? AND user = ? AND available = ? AND description = ?', array($name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description))['id'];
}

function addProduct($db, $name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description, $firstImg, $images) {
    $available = ($available === "on");

    execute($db, 
    'INSERT INTO products (name, date, category, brand, model, size, condition, price, user, available, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
     array($name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description));
    
    $id = $db->lastInsertId();

    $firstImgPath = uploadProductFirstImage($db, $firstImg, $id);

    execute($db, 'UPDATE products SET firstImg = ? WHERE id = ?', array($firstImgPath, $id));

    if (isset($images) & ($images['tmp_name'][0]) != '') uploadProductImages($db, $images, $id);
}

function changeProduct($db, $id, $name, $category, $brand, $model, $size, $condition, $price, $available, $description) {
    $available = ($available === "on");

    execute($db,
    'UPDATE products SET name = ?, category = ?, brand = ?, model = ?, size = ?, condition = ?, price = ?, available = ?, description = ? WHERE id = ?',
    array($name, $category, $brand, $model, $size, $condition, $price, $available, $description, $id));
}

function deleteProduct($db, $id) {
    execute($db, 'DELETE FROM cart WHERE product = ?', array($id));
    execute($db, 'DELETE FROM productImgs WHERE product = ?', array($id));
    execute($db, 'DELETE FROM messages WHERE productId = ?', array($id));
    execute($db, 'DELETE FROM products WHERE id = ?', array($id));
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

function addCondition($db, $name){
    execute($db, 'INSERT INTO conditions (name) VALUES (?)', array($name));
}

function checkItemAvailable($db, $item){
    $product = getProduct($db, $item);
    return $product['available'];
}

function setItemUnavailable($db, $item){
    // returns price of item
    $price = fetch($db, 'SELECT price FROM products WHERE id = ?', array($item));
    if(!isset($price['price'])){
        return 0;
    }
    execute($db, 'UPDATE products SET available = FALSE WHERE id = ?', array($item));

    return $price['price'];
}

function getDiscountInfo($db, $discount){
    if(!isset($discount)){
        return array();
    }
    return fetch($db, 'SELECT * FROM discounts WHERE code =?', array($discount));
}

?>
