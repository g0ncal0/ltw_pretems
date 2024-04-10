<?php 
    require_once('include.php');

    $itemname = "Beautiful Dress";
    $itemdescription = "A very beautiful dress only used once.";

    $db = getDatabaseConnection();


    output_header($db, $itemname, $itemdescription);


    $id = $_GET['id'];
    $item = getProduct($db, $id);
    
    output_full_item($item);
    output_footer();
?>