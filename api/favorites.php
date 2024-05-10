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
        echo json_encode(getFavorites($db, $session));
        return;
    }
    
    if($user !== NULL){
        
        if($type == 'PUT'){
            // we want to insert the element on the database
            
            execute($db, 'INSERT INTO favorites VALUES(?,?)', [$product, $user]);
        }
        if($type == 'DELETE'){
            execute($db, 'DELETE FROM favorites WHERE user = ? AND product = ?', [$user, $product]);
        }
    }else{

        if($session->getFavorites() === NULL){
            $session->setFavorites(array());
        }
        
 
        if($type == 'PUT'){
            // we just associate it with session
            $oldfavorites = $session->getFavorites();
            if (!in_array($product, $oldfavorites)) {
                array_push($oldfavorites, $product);
            }
            $session->setFavorites($oldfavorites);
        }
        if($type == 'DELETE'){
            $session->setFavorites(array_diff($session->getFavorites(), [$product]));
        }
    }

?>