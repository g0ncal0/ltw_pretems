<?php 
    require_once('include.php');

    $db = getDatabaseConnection();

    output_header($db,"Our catalogue", null);
?>
<main>

<?php

    $title = "Products";
    if(isset($_GET['category'])){
        // the user is searching for category
        
    }


    $items = getAllProducts($db);
    output_list_items($items);
?>
</main>

<?php
    output_footer();
?>
