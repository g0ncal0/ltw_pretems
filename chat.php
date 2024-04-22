<?php 
    require_once('include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $buyerId = $_GET['buyerId'];
    $productId = $_GET['productId'];

    $product = getProduct($db, $productId);

    output_header($db,  "Chat-" . $productId . "-" . $buyerId, null, $session->getId());
    protectPage();

    if (($session->getId() != $buyer) && ($session->getId() != $product['user'])) { ?>
        <section class="container protectedpage">
            <h1>You found a protected page</h1>
            <p>Login or register to continue on this page!</p>
        </section>
    <?php }  
    
    else {
        
    }

    output_footer();
?>