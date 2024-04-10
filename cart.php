<?php 
    require_once('templates/common.php');
    require_once('templates/items.php');
    require_once('db/connection.php');

    $db = getDatabaseConnection();

    output_header($db, "Your shopping Cart", null);
    output_list_cart_items();
    output_footer();
?>