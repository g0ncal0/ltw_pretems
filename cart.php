<?php 
    require_once('templates/common.php');
    require_once('templates/shopping_cart.php'); // TODO: Change name?
    require_once('templates/items.php');
    require_once('db/connection.php');
    $session = new Session();

    $db = getDatabaseConnection();

    output_header($db, "Your shopping Cart", null, $session->getId());    


    function get_cart_items_from_user($db, $ses) {  // FIXME: Fix query 

        if($ses->getId() !== null){
            $cart_items = fetchAll($db, 'SELECT * FROM products WHERE id IN (SELECT product FROM cart WHERE user = ?)', array($ses->getId()));
        }else{
            $cart = $ses->getCart();
            $cart_items = getItemsOnIDs($db, $cart);
        }
        return $cart_items;
    }


    ?><link rel="stylesheet" href="cart.css">
    <script src="/js/cart.js" defer></script>
    <?php  

    $cart_items = get_cart_items_from_user($db, $session);
    $sum = 0;
    
    foreach($cart_items as $ci){
        $sum += $ci['price'];
    }

    // Output cart interface
    ?>

    <h2>Cart</h2>
    <div class="cart_interface">
        <div class="cart">
        </div>
        <?php output_total(); ?>
    </div>

    <?php

    output_footer();
?>