<?php
    require_once(__DIR__ . '/../include.php');
    $query = $_GET['q'];
    if(!isset($query)){
        return;
    }

    $db = getDatabaseConnection();


    $products = searchProducts($db, $query);

    var_dump($products);


?>