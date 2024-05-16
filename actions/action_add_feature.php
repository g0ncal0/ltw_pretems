<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    protectActionloggedIn($session);

    if ($session->getCSRF() !== $_POST['csrf']) {
        header('Location: ../item.php?id=' . $idProduct . '&error=invalidRequest');
    }

    else {
        $idProduct = $_POST['product'];
        
        $seller = getSellerOfProduct($db, (int) $idProduct);
        $endDate = strtotime("+8 Days");
        if($seller == $session->getId()){
            execute($db, 'INSERT INTO featured VALUES (?,?)', array($idProduct, date("Y-m-d h:i:s", $endDate)));
        }

        header('Location: ../item.php?id=' . $idProduct);
    }    

?>