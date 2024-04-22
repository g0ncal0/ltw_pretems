<?php
    /* TODO:
    - (Option to remove a category / size,... => Remove for all items containing it!)
    */

    require_once('include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    protectPage();

    if ($_GET['area'] == 'category'){
        output_header($db, 'Add Category', null, $session->getId()); 
        output_category_form();
        output_existing_categories();
    }
    else if ($_GET['area'] == 'size'){
        output_header($db, 'Add Size', null, $session->getId()); 
        output_size_form();
        output_existing_sizes();
    }
    else if ($_GET['area'] == 'condition'){
        output_header($db, 'Add Condition', null, $session->getId()); 
        output_condition_form();
        output_existing_conditions();
    }

    if (isset($_GET['message'])) {
        ?><p><?php echo $_GET['message']?></p><?php // Print if it was added successfully
    } 

    output_footer(); 
?>