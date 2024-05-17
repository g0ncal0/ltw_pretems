<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session(); 
    $db = getDatabaseConnection();
    

    protectActionloggedIn($session);

    if ($session->getCSRF() !== $_POST['csrf']) {
        throw new Exception('CSRF token is invalid.');
    }

    else if(!areAllElementsListDefined($_POST, array('name', 'category', 'brand', 'model', 'size', 'condition', 'price', 'available', 'description'))){
        header('Location: ../profile.php?id=' . $session->getId());
    }

    else {
        addProduct($db, $_POST['name'], date("Y-m-d"), $_POST['category'], $_POST['brand'], $_POST['model'], $_POST['size'], $_POST['condition'], $_POST['price'], $session->getId(), $_POST['available'], $_POST['description'], $_FILES['firstImg'], $_FILES['images']);

        header('Location: ../profile.php?id=' . $session->getId());
    }    
?>