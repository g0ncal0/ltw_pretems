<?php
    // ALLOWED: 'insert', 'remove', 'empty'

    require_once(__DIR__ . '/../include.php');
    header('Content-Type: application/json');

    $session = new Session();
    
    parse_str(file_get_contents('php://input'), $_PUT);


    $type = $_SERVER['REQUEST_METHOD'];
    $product = $_PUT["product"];



    $user = $session->getId();
    $db = getDatabaseConnection();


    if($type == 'POST'){
        echo json_encode(getCart($db, $session));
        return;
    }
    
    
    if($user !== NULL){
        
        if($type == 'PUT'){
            // we want to insert the element on the database
            
            execute($db, 'INSERT INTO cart VALUES(?,?)', [$product, $user]);
        }
        if($type == 'DELETE'){
            execute($db, 'DELETE FROM cart WHERE user = ? AND product = ?', [$user, $product]);
        }
    }else{

        if($session->getCart() === NULL){
            $session->setCard(array());
        }
        
 
        if($type == 'PUT'){
            // we just associate it with session
            $oldcart = $session->getCart();
            if (!in_array($product, $oldcart)) {
                array_push($oldcart, $product);
            }
            $session->setCart($oldcart);
        }
        if($type == 'DELETE'){
            $session->setCart(array_diff($session->getCart(), [$product]));
        }
    }

?>