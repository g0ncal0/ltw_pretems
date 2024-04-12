<?php 

    function fetchAll($db, $query, $array){
        $stmt = $db->prepare($query);
        if(isset($array)){
            $stmt->execute($array);
        }else{
            $stmt->execute();
        }
        $result = $stmt->fetchAll();
        return $result;
    }

    function fetch($db, $query, $array){
        $stmt = $db->prepare($query);
        if(isset($array)){
            $stmt->execute($array);
        }else{
            $stmt->execute();
        }
        $result = $stmt->fetch();
        return $result;
    }


    function execute($db, $action, $data){
        $stmt = $db->prepare($action);
        if(isset($data)){
            $stmt->execute($data);
        }else{
            $stmt->execute();
        }
    }

    /******* USEFUL FUNCTIONS ********/




    function getAllProducts($db) {
        return fetchAll($db, 'SELECT * FROM products', null);
    }

    function getProduct($db, $id) {
        return fetch($db, 'SELECT * FROM products WHERE id = ?',array($id));
        
    }

    function getProductsOfUser($db, $id) {
        return fetch($db, 'SELECT * FROM products JOIN users ON products.user = users.username WHERE users.id = ?', array($id)
    );
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