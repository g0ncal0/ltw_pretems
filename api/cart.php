<?php
    // ALLOWED: 'insert', 'remove', 'empty'
    require_once(__DIR__ . '/../include.php');
    $type = $_POST['act'];
    $product = $_POST['product'];
    if(!isset($type)){
        return;
    }

    $user = $_SESSION['user'];

    if(isset($user)){
        $db = getDatabaseConnection();
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
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
        if($type === 'empty'){
            $_SESSION['cart'] = array();
        }
 
        if($type === 'insert'){
            // we just associate it with session
            array_push($_SESSION['cart'], $product);
        }
        if($type === 'remove'){
            $_SESSION['cart'] = array_diff($_SESSION['cart'], [$product]);
        }
    }

?>