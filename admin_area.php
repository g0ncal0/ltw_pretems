<?php
    /* TODO:
    - (Option to remove a category / size,... => Remove for all items containing it!)
    */

    require_once('include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $categories = getCategories($db);
    $sizes = getSizes($db);
    $conditions = getConditions($db);

    protectPage($session);

    if ($_GET['area'] == 'category'){
        output_header($db, 'Add Category', null, $session->getId(), $session);
        ?><section class="container"> 
            <h1>Add Category:</h1><?php
        output_category_form($session);
        output_existing_categories($categories);
    }
    else if ($_GET['area'] == 'size'){
        output_header($db, 'Add Size', null, $session->getId(), $session); 
        ?><section class="container"> 
            <h1>Add Size:</h1><?php
        output_size_form($session);
        output_existing_sizes($sizes);
    }
    else if ($_GET['area'] == 'condition'){
        output_header($db, 'Add Condition', null, $session->getId(), $session);
        ?><section class="container"> 
            <h1>Add Condition:</h1><?php 
        output_condition_form($session);
        output_existing_conditions($conditions);
    }

    if (isset($_GET['message'])) {
        ?><p><?php echo htmlentities($_GET['message'])?></p><?php // Print if it was added successfully
    } 
    ?></section><?php

    output_footer(); 
?>