<?php 
  declare(strict_types = 1);
    require_once('templates/common.php');
    require_once('templates/shopping_cart.php');
    require_once('templates/items.php');
    require_once('db/connection.php');
    $session = new Session();

    $db = getDatabaseConnection();

    output_header($db, "Your shopping Cart", null, $session->getId());    
    simpleheader("Cart");

    ?>
    <script src="/js/cart.js" defer></script>

    <h1>Cart</h1>
    <div class="cart_interface">
        <div class="cart">
        </div>
        <?php output_total(); ?>
    </div>


    output_checkout();
    output_footer();
?>