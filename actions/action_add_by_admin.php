<?php
    declare(strict_types = 1);

    require_once('../include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    if ($session->getCSRF() !== $_POST['csrf']) {
        throw new Exception('CSRF token is invalid.');
    }
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
        if (!getConditionWithName($db, $_POST['name'])){ // Add if condition doesn't already exist
            addCondition($db, $_POST['name']);
            header('Location: ../admin_area.php?area=condition&message=Condition added successfully!&id=' . $session->getId());
        } else{
            header('Location: ../admin_area.php?area=condition&message=Condition already exists!&id='. $session->getId());
        }
    }
    else if ($_GET['add'] == 'brand'){ // Add brand
        if (!getBrandWithName($db, $_POST['name'])){ // Add if brand doesn't already exist
            addBrand($db, $_POST['name']);
            header('Location: ../admin_area.php?area=brand&message=Brand added successfully!&id=' . $session->getId());
        } else{
            header('Location: ../admin_area.php?area=brand&message=Brand already exists!&id='. $session->getId());
        }
    }

?>