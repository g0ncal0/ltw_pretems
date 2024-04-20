<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();  // TODO: change


    if(!$session->isLoggedIn()){
        header('Location: /'); 
    }

    $db = getDatabaseConnection();

    changeProfile($db, $session->getId(), $_POST['name'], $_POST['email'], $_POST['password'], $_FILES['image']); 

    header('Location: ../profile.php?id=' . $session->getId());
?>