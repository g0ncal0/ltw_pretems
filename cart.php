<?php 
    require_once('templates/common.php');
    require_once('templates/shopping_cart.php'); // TODO: Change name?
    require_once('templates/items.php');
    require_once('db/connection.php');

    $db = getDatabaseConnection();

    output_header($db, "Your shopping Cart", null);    

    session_start();

    function get_cart_items_from_user($db) {  // FIXME: Fix query 
        if(isset($_SESSION['id'])){
            $cart_items = fetchAll($db, 'SELECT * FROM products WHERE id IN (SELECT product FROM cart)', null);
        }else{
            $cart = $_SESSION['cart'];
            $cart_items = getItemsOnIDs($db, $cart);
        }
        return $cart_items;
    }

    $cart_items = get_cart_items_from_user($db);


    ?><link rel="stylesheet" href="cart.css"><?php  // FIXME: Should this be here?

    $cart_items = get_cart_items_from_user($db);
    $sum = 0;
    
    foreach($cart_items as $ci){
        $sum += $ci['price'];
    }

    // Output cart interface
    ?>
    <main>
    <h2>Cart</h2>
    <div class="cart_interface">
        <?php 
            if ($cart_items){
             output_list_cart_items($cart_items); 
        } else {
            echo "<p>There are currently no items in your shopping cart</p>";
        }
        output_total($sum); ?>
    </div>
    </main>
    <?php

    output_footer();
?>