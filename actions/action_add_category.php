<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    if (!getCategoryWithName($db, $_POST['name'])){ // Add if category doesn't already exist
        addCategory($db, $_POST['name']);
        header('Location: ../addCategory.php?message=Category added successfully!&id=' . $session->getId());
    } else{
        header('Location: ../addCategory.php?message=This category already exists!&id='. $session->getId());
    }

?>