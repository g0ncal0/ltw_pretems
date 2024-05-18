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

    <div class="cart_interface container">
        <div class="cart">
        </div>
        <?php output_total(); ?>
    </div>

<?php
    output_checkout($session);
    output_footer();
?>