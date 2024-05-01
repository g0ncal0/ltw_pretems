<?php

    require_once(__DIR__ . '/../include.php');
    header('Content-Type: application/json');

    $session = new Session();

    $db = getDatabaseConnection();

    $response = array();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $response["error"] = "Not allowed";
        echo json_encode($response);
        return;
    }


    // Get all the variables

    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $size = $_POST['size'];
    $condition = $_POST['condition'];
    $min_price = $_POST['min'];
    $max_price = $_POST['max'];
    $searchq = $_POST['q'];


    // Get offset
    $offset = $_POST['offset'];


    
    $query = 'SELECT * FROM products WHERE available = true';
    $arguments = array();

    // Conditionally update the query::




    if(isset($brand) && !empty($brand)){
        $query = $query . ' AND brand = ?';
        array_push($arguments, $brand); 
    }
    if(isset($category) && !empty($category)){
        $query = $query . ' AND category = ?';
        array_push($arguments, $category);
    }
    if(isset($condition) && !empty($condition)){
        $query = $query . ' AND condition = ?';
        array_push($arguments, $condition);
    }
    if(isset($min_price) && !empty($min_price)){
        $query = $query . ' AND price >= ?';
        array_push($arguments, $min_price);
    }
    if(isset($max_price) && !empty($max_price)){
        $query = $query . ' AND price <= ?';
        array_push($arguments, $max_price);
    }
    if(isset($size) && !empty($size)){
        $query = $query . ' AND size = ?';
        array_push($arguments, $size);
    }

    if(isset($searchq) && !empty($searchq)){
        $query = $query . ' AND (name LIKE ? OR description LIKE ?)';
        array_push($arguments, "%" . $searchq . "%");
        array_push($arguments, "%" . $searchq . "%");
    }

    if(isset($offset) && strlen($offset) >= 2){
        $query = $query . ' LIMIT 20 OFFSET ?';
        $offset = 20 * $offset;
        array_push($arguments, $offset);
    }else{
        $query = $query . ' LIMIT 20';
    }

    $response['products'] = fetchAll($db, $query, $arguments); 
    $response['error'] = "";
    if(count($response['products']) === 0){
        $response['error'] = 'No more products';
    }
    echo json_encode($response);




?>