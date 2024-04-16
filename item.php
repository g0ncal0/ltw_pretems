<?php 
    require_once('include.php');
    $session = new Session();

    $itemname = "Beautiful Dress";
    $itemdescription = "A very beautiful dress only used once.";

    $db = getDatabaseConnection();


    output_header($db, $itemname, $itemdescription, $session->getId());


    $id = $_GET['id'];
    $item = getProduct($db, $id);
    
    output_full_item($item);
    output_footer();
?>