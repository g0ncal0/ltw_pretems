<?php
    declare(strict_types = 1);
    require_once('../include.php');


    $id = $_POST['id'];
    $session = new Session();
    $db = getDatabaseConnection();
    if(!$session->isLoggedIn()){
        die();
    }

    else if(!isset($id)){
        errorPage("Error", "Wrong format");
    }

    else if ($session->getCSRF() !== $_POST['csrf']) {
        throw new Exception('CSRF token is invalid.');
    }

    else {$purchase = getPurchase($db, $id, $session->getId());

        if(empty($purchase)){
            errorPage("Invalid Purchase", "Invalid");
        }



        setpaidPurchase($db, $id);

        header('Location: /../purchase.php?id=' . $id);
    }

?>