<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();  // TODO: change


    if(!$session->isLoggedIn()){
        header('Location: /'); 
    }
    else if ($session->getCSRF() !== $_POST['csrf']) {
        header('Location: ../deleteProduct.php?error='.  urlencode("This request looks invalid"));
    }

    else {
        $db = getDatabaseConnection();

        $product = getProduct($db, $_POST['productId']);
        
        if (($session->getId() === $product['user']) || ($session->getAdmin())) {
            deleteProduct($db, $_POST['productId']); 

            header('Location: ../profile.php?id=' . $session->getId());
        }

        else {
            header('Location: ../item.php?id=' . $product['id'] . 'error=invalidPassword');
        }
    }    
?>