<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    protectActionloggedIn($session);

    if(!areAllElementsListDefined($_POST, array('product'))){
        header('Location: ../items.php');
    }

    $idProduct = $_POST['product'];
    
    $seller = getSellerOfProduct($db, (int) $idProduct);
    $endDate = strtotime("+8 Days");
    if($seller == $session->getId()){
        execute($db, 'INSERT INTO featured VALUES (?,?)', array($idProduct, date("Y-m-d h:i:s", $d)));
    }

    header('Location: ../item.php?id=' . $idProduct);

?>