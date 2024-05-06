<?php 
    require_once('include.php');
    $session = new Session();

    $itemname = "Beautiful Dress";
    $itemdescription = "A very beautiful dress only used once.";

    $db = getDatabaseConnection();




    $id = $_GET['id'];
    $item = getProduct($db, $id);
 
    output_header($db, $item['name'], $item['description'], $session->getId());
    
    if(empty($item)){
        errorPage("No item", "The product may have been deleted");
    }

    $images = getImagesOfProduct($db, $id);
    
    output_full_item($item, $session->getId(), $images, $db);
    output_footer();
?>