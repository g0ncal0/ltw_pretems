<?php 
    require_once('templates/common.php');
    require_once('templates/items.php');
    require_once('db/connection.php');

    $db = getDatabaseConnection();

    output_header($db, "Your shopping Cart", null);
    /*
    //// TODO: Remove ////
    $stmt = $db->prepare('SELECT * FROM products');
    $stmt->execute();
    $products = $stmt->fetchAll();
    

    ?><link rel="stylesheet" href="cart.css"><?php  // TODO: Should this be here?
    output_list_cart_items($products);  // TODO: Remove temporary arg
    ////////////////////////////
    */
    output_list_cart_items(); 
    output_footer();
?>