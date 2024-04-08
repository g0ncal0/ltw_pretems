<?php 
    require_once('templates/common.php');
    require_once('templates/items.php');


    $itemname = "Beautiful Dress";
    $itemdescription = "A very beautiful dress only used once.";

    output_header($itemname, $itemdescription);
    
    output_full_item();
    output_footer();
?>