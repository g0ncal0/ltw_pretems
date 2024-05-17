<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();  // TODO: change


    if(!$session->isLoggedIn()){
        header('Location: /'); 
    }

    $db = getDatabaseConnection();

    $user = getUserWithIdAndPassword($db, $session->getId(), $_POST['currentPassword']);
    
    if ($session->getCSRF() !== $_POST['csrf']) {
        header('Location: ../changeProfile.php?error=' . urlencode("This request looks invalid"));
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