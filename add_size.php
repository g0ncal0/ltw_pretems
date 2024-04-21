<?php
    require_once('include.php');

    $session = new Session();
    $db = getDatabaseConnection();
    $sizes = getSizes($db);

    output_header($db, 'Add Size', null, $session->getId()); 
    protectPage($session);
    output_size_form();
    output_existing_sizes($sizes);
    
    if (isset($_GET['message'])) {
        ?><p><?php echo $_GET['message']?></p><?php // Print if size was added successfully
    } 

    output_footer(); 
?>