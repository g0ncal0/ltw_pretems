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

    if($user !== NULL){
        if(!isset($type)){
            $ci = fetchAll($db, 'SELECT product FROM cart WHERE user = ?', array($session->getId()));
            if(!isset($ci)){
                echo json_encode(array());
                return;
            }
            if(count($ci) == 0){
                echo json_encode(array());
                return;
            }
            $elements = array();
            foreach($ci as $citem){
                array_push($elements, $citem['product']);
            }
            $cart_items = getItemsOnIDs($db, $elements);

            echo json_encode($cart_items);
            return;
        }
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
        if(!isset($type)){
            $cart = $session->getCart();
            if(!isset($cart)){
                echo json_encode(array());
                return;
            }
            if(count($cart) == 0){
                echo json_encode(array());
                return;
            }
            $cart_items = getItemsOnIDs($db, $cart);
            echo json_encode($cart_items);
        }
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