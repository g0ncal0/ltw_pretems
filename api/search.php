<?php
    require_once(__DIR__ . '/../include.php');
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        errorAPI("Invalid");
        return;
    }

    $query = $_POST['q'];
    if(!isset($query)){
        errorAPI("Nothing to search.");
    }
    $db = getDatabaseConnection();


    $products['products'] = searchProducts($db, $query);

    echo json_encode($products);


?>