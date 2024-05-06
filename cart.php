<?php 
  declare(strict_types = 1);
    require_once('templates/common.php');
    require_once('templates/shopping_cart.php'); // TODO: Change name?
    require_once('templates/items.php');
    require_once('db/connection.php');
    $session = new Session();

    $db = getDatabaseConnection();

    output_header($db, "Your shopping Cart", null, $session->getId());    


    ?><link rel="stylesheet" href="cart.css">
    <script src="/js/cart.js" defer></script>

    <h1>Cart</h1>
    <div class="cart_interface">
        <div class="cart">
        </div>
        <?php output_total(); ?>
    </div>


    <div class="container" id="checkout" style="display: none">
        <p class="special">Checkout</p>
        <h2>In one step, everything will be yours..</h2>
        <form method="post" action="/actions/action_checkout.php">
            <input name="delivery" id="delivery" type="text" placeholder="Delivery Spot">
            <input name="zipcode" id="zipcode" type="text" pattern="[0-9]{4}-[0-9]{3}" placeholder="ZipCode">
            <button type="submit">Pay</button>
        </form>
    </div>


    <?php

    output_footer();
?>