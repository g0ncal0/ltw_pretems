<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session(); 


    if(!$session->isLoggedIn()){
        header('Location: /'); 
    }

    $db = getDatabaseConnection();

    $user = getUserWithIdAndPassword($db, $session->getId(), $_POST['currentPassword']);

    if ($session->getCSRF() !== $_POST['csrf']) {
        throw new Exception('CSRF token is invalid.');
    }
    
    else if ($user) {
        changeProduct($db, $_POST['productId'], $_POST['name'], $_POST['category'], $_POST['brand'], $_POST['model'], $_POST['size'], $_POST['condition'], $_POST['price'], $_POST['available'], $_POST['description'], $_FILES['firstImg'], $_POST['deleted_images'], $_FILES['images']); 

        header('Location: ../item.php?id=' . $_POST['productId']);
    }

    else {
        header('Location: ../changeProduct.php?error=invalidPassword');
    }
?>