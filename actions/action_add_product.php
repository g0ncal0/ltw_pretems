<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();  // TODO: change
    $db = getDatabaseConnection();

    addProduct($db, $_POST['name'], date("Y-m-d"), $_POST['category'], $_POST['brand'], $_POST['model'], $_POST['size'], $_POST['condition'], $_POST['price'], $session->getId(), $_POST['available'], $_POST['description'], $_POST['firstImg']);

    header('Location: ../profile.php?id=' . $session->getId());
?>