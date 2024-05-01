<?php
    // ALLOWED: 'insert', 'remove', 'empty'

    // TO-DO: CHECK IF PRODUCT IS STILL AVAILABLE BEFORE RETURNING


    require_once(__DIR__ . '/../include.php');
    header('Content-Type: application/json');

    $session = new Session();
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        return;
    }
    $type = $_GET["type"];
    $product = $_GET["product"];

    


    $user = $session->getId();
    $db = getDatabaseConnection();


    if(!isset($type)){
        echo json_encode(getCart($db, $session));
    }
    
    
    if($user !== NULL){
        
        if($type === 'insert'){
            // we want to insert the element on the database
            
            execute($db, 'INSERT INTO cart VALUES(?,?)', [$product, $user]);
        }
        if($type === 'remove'){
            execute($db, 'DELETE FROM cart WHERE user = ? AND product = ?', [$user, $product]);
        }
        if($type === 'empty'){
            execute($db, 'DELETE FROM cart WHERE user = ?', [$user]);
        }
    }else{

        if($session->getCart() === NULL){
            $session->setCard(array());
        }
        if($type === 'empty'){
            $session->setCard(array());
        }
 
        if($type === 'insert'){
            // we just associate it with session
            $oldcart = $session->getCart();
            if (!in_array($product, $oldcart)) {
                array_push($oldcart, $product);
            }
            $session->setCart($oldcart);
        }
        if($type === 'remove'){
            $session->setCart(array_diff($session->getCart(), [$product]));
        }
    }

?>