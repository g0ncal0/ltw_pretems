<?php 
    require_once('include.php');

    $db = getDatabaseConnection();

    output_header($db,"Our catalogue", null);
?>
<main>

<?php

    $title = "Products";
    $items = array();
    if(isset($_GET['category'])){
        // the user is searching for category
        $catgid = $_GET['category'];
        $category = getCategory($db, $catgid);
        $title = $category;
        $items = getProductsOfCategory($db, $catgid);
    }
    else{
        $items = getAllProducts($db);
    }

    simpleheader($title);

    output_list_items($items);
?>
</main>

<?php
    output_footer();
?>
