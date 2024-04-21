<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    if (!getSizeWithName($db, $_POST['name'])){ // Add if size doesn't already exist
        addSize($db, $_POST['name']);
        header('Location: ../add_size.php?message=Size added successfully!&id=' . $session->getId());
    } else{
        header('Location: ../add_size.php?message=This size already exists!&id='. $session->getId());
    }

?>