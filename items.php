<?php 
    require_once('include.php');
    $session = new Session();

    $db = getDatabaseConnection();

    output_header($db,"Our catalogue", null, $session->getId());
?>

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


<?php
    output_footer();
?>
