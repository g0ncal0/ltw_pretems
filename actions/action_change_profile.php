<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();  // TODO: change
    $db = getDatabaseConnection();

    changeProfile($db, $session->getId(), $_POST['name'], $_POST['email'], $_POST['password']); 

    header('Location: ../users.php?id=' . $session->getId());
?>