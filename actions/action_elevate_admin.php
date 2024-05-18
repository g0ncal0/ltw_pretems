<?php
    require_once('../include.php');

    

    $session = new Session();  // TODO: change
    $db = getDatabaseConnection();
    $user = getUser($db, $_GET['id']);

    
    if ($user){ // Make sure user exists
        setAdmin($db, $user['id']);
    }
    

    header('Location: ../manage_users.php?id=' . $session->getId());


?>