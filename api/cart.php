<?php
    // ALLOWED: 'insert', 'remove', 'empty'

    require_once(__DIR__ . '/../include.php');
    header('Content-Type: application/json');

    $session = new Session();
    
    parse_str(file_get_contents('php://input'), $_PUT);


    $type = $_SERVER['REQUEST_METHOD'];
    $productId = $_PUT["product"];



    $user = $session->getId();
    $db = getDatabaseConnection();
    $product = getProduct($db, $productId);


    if($type == 'POST'){
        echo json_encode(getCart($db, $session));
        return;
    }
    
    
    if($user !== NULL){
        
        if($type == 'PUT'){
            // we want to insert the element on the database
            
            if ($product['user'] != $user) execute($db, 'INSERT INTO cart VALUES(?,?)', [$productId, $user]);
        }
        if($type == 'DELETE'){
            execute($db, 'DELETE FROM cart WHERE user = ? AND product = ?', [$user, $productId]);
        }
    }else{

        if($session->getCart() === NULL){
            $session->setCard(array());
        }
        
 
        if($type == 'PUT'){
            // we just associate it with session
            $oldcart = $session->getCart();
            if (!in_array($productId, $oldcart)) {
                array_push($oldcart, $productId);
            }
            $session->setCart($oldcart);
        }
        if($type == 'DELETE'){
            $session->setCart(array_diff($session->getCart(), [$productId]));
        }
    }

?>