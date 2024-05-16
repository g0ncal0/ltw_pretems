<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();  // TODO: change


    if(!$session->isLoggedIn()){
        header('Location: /'); 
    }
    else if ($session->getCSRF() !== $_POST['csrf']) {
        header('Location: ../addProduct.php?error=invalidRequest');
    }

    else  {
        $db = getDatabaseConnection();
        
        if ($session->getAdmin()) {
            blockUser($db, $_POST['userId']);

            header('Location: ../profile.php?id=' . $session->getId());
        }

        else {
            header('Location: ../profile.php?id=' . $_POST['userId'] . 'error=invalidAdmin');
        }
    }    
?>