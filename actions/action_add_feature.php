<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    protectActionloggedIn($session);

    $idProduct = $_POST['product'];

    if ($session->getCSRF() !== $_POST['csrf']) {
        throw new Exception('CSRF token is invalid.');
    }

    else {
        
        $seller = getSellerOfProduct($db, (int) $idProduct);
        $endDate = strtotime("+8 Days");
        if($seller == $session->getId()){
            execute($db, 'INSERT INTO featured VALUES (?,?)', array($idProduct, date("Y-m-d h:i:s", $endDate)));
        }

        header('Location: ../item.php?id=' . $idProduct);
    }    

?>