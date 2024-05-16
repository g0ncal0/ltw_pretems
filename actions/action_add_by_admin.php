<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    if ($session->getCSRF() !== $_POST['csrf']) {
        header('Location: ../addProduct.php?error=invalidRequest');
    }
    // FIXME: Checking should be case insensitive
    else if ($_GET['add'] == 'category'){ // Add category
        if (!getCategoryWithName($db, $_POST['name'])){ // Add if category doesn't already exist
            addCategory($db, $_POST['name']);
            header('Location: ../admin_area.php?area=category&message=Category added successfully!&id=' . $session->getId());
        } else{
            header('Location: ../admin_area.php?area=category&message=This category already exists!&id='. $session->getId());
        }
    }
    else if ($_GET['add'] == 'size'){ // Add size
        if (!getSizeWithName($db, $_POST['name'])){ // Add if size doesn't already exist
            addSize($db, $_POST['name']);
            header('Location: ../admin_area.php?area=size&message=Size added successfully!&id=' . $session->getId());
        } else{
            header('Location: ../admin_area.php?area=size&message=This size already exists!&id='. $session->getId());
        }
    }
    else if ($_GET['add'] == 'condition'){ // Add size
        if (!getConditionWithName($db, $_POST['name'])){ // Add if size doesn't already exist
            addCondition($db, $_POST['name']);
            header('Location: ../admin_area.php?area=condition&message=Condition added successfully!&id=' . $session->getId());
        } else{
            header('Location: ../admin_area.php?area=condition&message=Condition already exists!&id='. $session->getId());
        }
    }

?>