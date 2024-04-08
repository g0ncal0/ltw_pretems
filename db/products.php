<?php 
    function getAllProducts($db) {
        $stmt = $db->prepare('SELECT * FROM products');
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }

    function getProduct($db, $id) {
        $stmt = $db->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute(array($id));
        $product = $stmt->fetch();
        return $product;
    }

    function getProductsOfUser($db, $id) {
        $stmt = $db->prepare('SELECT * FROM products JOIN users ON products.user = users.username WHERE users.id = ?');
        $stmt->execute(array($id));
        $products = $stmt->fetch();
        return $products;
    }

    function getProductsOfCategory($db, $category) {
        $stmt = $db->prepare('SELECT * FROM products JOIN categories ON products.category = categories.id WHERE categories.name = ?');
        $stmt->execute(array($id));
        $products = $stmt->fetch();
        return $products;
    }
?>