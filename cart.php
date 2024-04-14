<?php 
    require_once('templates/common.php');
    require_once('templates/shopping_cart.php'); // TODO: Change name?
    require_once('templates/items.php');
    require_once('db/connection.php');

    $db = getDatabaseConnection();

    output_header($db, "Your shopping Cart", null);    

    function get_cart_items_from_user($db) {  // FIXME: Fix query 
        $stmt = $db->prepare('SELECT * FROM products WHERE id IN (SELECT product FROM cart)');
        $stmt->execute();
        $cart_items = $stmt->fetchAll();
        return $cart_items;
    }

    $cart_items = get_cart_items_from_user($db);
    ?><link rel="stylesheet" href="cart.css"><?php  // FIXME: Should this be here?

    // Output cart interface
    ?>
    <h2>Cart</h2>
    <div class="cart_interface">
        <?php output_list_cart_items($cart_items); ?>
        <?php output_total(); ?>
    </div>
    <?php

    output_footer();
?>