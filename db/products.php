<?php 

declare(strict_types = 1);
require_once('util.php');

function getAllProducts(PDO $db) : ?array {
    return fetchAll($db, 'SELECT * FROM products WHERE available = TRUE', null);
}

function getProduct(PDO $db, $id) : ?array {
    return fetch($db, 'SELECT * FROM products WHERE id = ?',array($id));
}

function getProductsLimitOffset(PDO $db, int $limit, int $offset, int $category) : ?array {
    if(isset($category)){
        return fetchAll($db, 'SELECT * FROM products WHERE available = TRUE LIMIT ? OFFSET ?', array($limit, $offset));
    }else{
        return fetchAll($db, 'SELECT * FROM products WHERE products.category = ? AND available = TRUE LIMIT ? OFFSET ?', array($category, $limit, $offset));
    }
}

function getProductsOfUser(PDO $db, $id) : ?array {
    return fetchAll($db, 'SELECT * FROM products WHERE user = ?', array($id));
}

function getSellingProductsOfUser(PDO $db, int $id) : ?array {
    return fetchAll($db, 'SELECT * FROM products WHERE user = ? AND available = TRUE', array($id));
}

function getSellerOfProduct(PDO $db, int $id) : ?int {
    return fetch($db, 'SELECT user FROM products WHERE id = ?', array($id))['user'];
}

function getSoldProductsOfUser(PDO $db, int $id) : ?array {
    return fetchAll($db, 'SELECT * FROM products WHERE user = ? AND available = FALSE', array($id));
}

function getShippingIds(PDO $db, int $id) : ?array {
    return fetch($db, 'SELECT purchaseItems.productid AS product_id, purchaseItems.purchaseid AS purchase_id
                       FROM purchaseItems WHERE product_id = ?;', array($id));
}

function getShippingWithId(PDO $db, int $product_id, string $purchase_id) : ?array {
    return fetch($db, 'SELECT purchases.date AS date, purchases.address AS address, purchases.zipcode AS zipcode, users.name AS name
                       FROM purchases
                       JOIN purchaseItems ON purchases.id = purchaseItems.purchaseid
                       JOIN products ON purchaseItems.productid = products.id
                       JOIN users ON purchases.buyerid = users.id
                       WHERE purchases.id = ? AND purchaseItems.productid = ?;', array($purchase_id, $product_id));
}

function getProductsOfCategory(PDO $db, int $category) : ?array {
    return fetchAll($db, 'SELECT * FROM products WHERE category = ? AND available = TRUE', array($category));
}

function getCategories(PDO $db) : ?array {
    return fetchAll($db, 'SELECT * FROM categories', null);
}

function getBrands(PDO $db) : ?array {
    return fetchAll($db, 'SELECT * FROM brands', null);
}

function getBrandWithName(PDO $db, string $id) : ?array {
    return fetch($db, 'SELECT * FROM brands WHERE name = ?', array($id));
}

function getSizes(PDO $db) : ?array {
    return fetchAll($db, 'SELECT * FROM sizes', null);
}

function getConditions(PDO $db) : ?array {
    return fetchAll($db, 'SELECT * FROM conditions', null);
}

function getCategory(PDO $db, int $id) : string {
    return fetch($db, 'SELECT name FROM categories WHERE id = ?', array($id))['name'];
}

function getCategoryWithName(PDO $db, string $name) : ?array {
    return fetch($db, 'SELECT * FROM categories WHERE name = ?', array($name));
}

function getBrand(PDO $db, int $id) : string {
    return fetch($db, 'SELECT name FROM brands WHERE id = ?', array($id))['name'];
}

function getSize(PDO $db, int $id) : string {
    return fetch($db, 'SELECT name FROM sizes WHERE id = ?', array($id))['name'];
}

function getSizeWithName(PDO $db, string $name) : ?array {
    return fetch($db, 'SELECT * FROM sizes WHERE name = ?', array($name));
}

function getCondition(PDO $db, int $id) : string {
    return fetch($db, 'SELECT name FROM conditions WHERE id = ?', array($id))['name'];
}

function getConditionWithName(PDO $db, string $id) : ?array {
    return fetch($db, 'SELECT * FROM conditions WHERE name = ?', array($id));
}

function searchProducts(PDO $db, string $query) : ?array {
    return fetchAll($db, 'SELECT * FROM products WHERE name LIKE ? OR description LIKE ?', array("%$query%", "%$query%"));
}

function getProductID(PDO $db, string $name, string $date, int $category, int $brand, int $model, int $size, int $condition, float $price, int $user, int $available, string $description) : ?array {
    return fetch($db, 'SELECT id FROM products WHERE name = ? AND date = ? AND category = ? AND brand = ? AND model = ? AND size = ? AND condition = ? AND price = ? AND user = ? AND available = ? AND description = ?', array($name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description))['id'];
}

function addProduct(PDO $db, string $name, string $date, string $category, string $brand, string $model, string $size, string $condition, string $price, int $user, string $available, string $description, array $firstImg, ?array $images) : void {
    $available = ($available === "on");

    execute($db, 
    'INSERT INTO products (name, date, category, brand, model, size, condition, price, user, available, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
     array($name, $date, $category, $brand, $model, $size, $condition, $price, $user, $available, $description));
    
    $id = $db->lastInsertId();

    $firstImgPath = uploadProductFirstImage($db, $firstImg, $id);

    execute($db, 'UPDATE products SET firstImg = ? WHERE id = ?', array($firstImgPath, $id));

    if (isset($images) & ($images['tmp_name'][0]) != '') uploadProductImages($db, $images, $id);
}

function changeProduct(PDO $db, string $id, string $name, string $category, string $brand, string $model, string $size, string $condition, string $price, string $available, string $description, ?array $firstImg, ?array $deleted_images, ?array $images) : void {
    if (isset($firstImg) && ($firstImg['tmp_name'] !== "")) {
        changeFirstImage($db, $id, $firstImg);
    }

    if (isset($deleted_images)) {
        deleteProductImages($db, $id, $deleted_images);
    }

    if (isset($images) & ($images['tmp_name'][0]) != '') uploadProductImages($db, $images, $id);

    $available = ($available === "on");

    execute($db,
    'UPDATE products SET name = ?, category = ?, brand = ?, model = ?, size = ?, condition = ?, price = ?, available = ?, description = ? WHERE id = ?',
    array($name, $category, $brand, $model, $size, $condition, $price, $available, $description, $id));
}

function deleteProduct(PDO $db, $id) : void {
    $images = getImagesOfProduct($db, $id);
    $product = getProduct($db, $id);

    foreach ($images as $image) {
        deleteImage($db, $image['path']);
    }

    execute($db, 'DELETE FROM cart WHERE product = ?', array($id));
    execute($db, 'DELETE FROM productImgs WHERE product = ?', array($id));
    execute($db, 'DELETE FROM messages WHERE productId = ?', array($id));
    execute($db, 'DELETE FROM products WHERE id = ?', array($id));
}

function getItemsOnIDs(PDO $db, ?array $ids) : ?array {
    // ids should be an array.
    if(isset($ids)){
    if(count($ids) > 0){
        $in  = str_repeat('?,', count($ids) - 1) . '?'; // GET STRING WITH len($ids) 
        $items = fetchAll($db, "SELECT * FROM products WHERE id IN ( $in ) AND available = 1", $ids);
    }
    }
    return $items;
}

function addCategory(PDO $db, string $name) : void {
    execute($db, 'INSERT INTO categories (name) VALUES (?)', array($name));
}   

function addSize(PDO $db, string $name) : void {
    execute($db, 'INSERT INTO sizes (name) VALUES (?)', array($name));
}   

function addCondition(PDO $db, string $name) : void {
    execute($db, 'INSERT INTO conditions (name) VALUES (?)', array($name));
}

function addBrand(PDO $db, string $name) : void {
    execute($db, 'INSERT INTO brands (name) VALUES (?)', array($name));
}

function checkItemAvailable(PDO $db, int $item) : int {
    $product = getProduct($db, $item);
    return $product['available'];
}

function setItemUnavailable(PDO $db, int $item) : float {
    // returns price of item
    $price = fetch($db, 'SELECT price FROM products WHERE id = ?', array($item));
    if(!isset($price['price'])){
        return 0;
    }
    execute($db, 'UPDATE products SET available = FALSE WHERE id = ?', array($item));
    
    execute($db, 'DELETE FROM featured WHERE product = ?', array($item));

    return $price['price'];
}

function getDiscountInfo(PDO $db, ?string $discount) {
    if(!isset($discount)){
        return array();
    }
    return fetch($db, 'SELECT * FROM discounts WHERE code =?', array($discount));
}


function getPurchase(PDO $db, string $id, int $buyerid) : ?array {
    return fetch($db, 'SELECT * FROM purchases WHERE id = ? AND buyerid = ?', array($id, $buyerid));
}
function getPurchases(PDO $db, int $buyerid) : ?array {
    return fetchAll($db, 'SELECT * FROM purchases WHERE buyerid = ?', array($buyerid));
}

function setpaidPurchase(PDO $db, string $id) : void {
    execute($db, 'UPDATE purchases SET status = 1 WHERE id = ?', array($id));
}

function getFavorites(PDO $db, Session $session) : ?array {
    if($session->isLoggedIn()){
        $ci = fetchAll($db, 'SELECT product FROM favorites WHERE user = ?', array($session->getId()));
        if(!isset($ci)){
            return array();
        }
        if(count($ci) == 0){
            return array();
        }
        $elements = array();
        foreach($ci as $citem){
            array_push($elements, $citem['product']);
        }
        $favorite_items = getItemsOnIDs($db, $elements);

        return $favorite_items;
    }else{
        $favorites = $session->getFavorites();
        if(!isset($favorites)){
            return array();
        }
        if(count($favorites) == 0){
            return array();
        }
        $favorite_items = getItemsOnIDs($db, $favorites);
        return $favorite_items;
    }
}

function getFav(PDO $db, int $product, ?int $user) : ?array {
    return fetch($db, 'SELECT * FROM favorites WHERE product = ? AND user = ?', array($product, $user));
}

function getFeaturedItems(PDO $db) : ?array {
    return fetchAll($db, 'SELECT * FROM products WHERE id in (SELECT product FROM featured WHERE enddate  >= CURRENT_TIMESTAMP)', array());
}

?>
