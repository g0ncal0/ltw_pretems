<?php
    require_once(__DIR__ . '/../include.php');
    $query = $_POST['q'];
    if(!isset($query)){
        return;
    }

    $db = getDatabaseConnection();


    $products = searchProducts($db, $query);

    var_dump($products);


?>