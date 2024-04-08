<?php 
    require_once('templates/common.php');
    require_once('templates/items.php');

    output_header("Your shopping Cart", null);
    output_list_cart_items();
    output_footer();
?>