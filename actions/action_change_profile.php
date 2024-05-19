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
        $password = $_POST['newPassword'];
        if ($password === '') $password = $_POST['currentPassword'];

        changeProfile($db, $session->getId(), $_POST['name'], $_POST['email'], $password, $_FILES['image']); 

        header('Location: ../profile.php?id=' . $session->getId());
    }    
    else {
        header('Location: ../changeProfile.php?error=invalidPassword');
    }
?>