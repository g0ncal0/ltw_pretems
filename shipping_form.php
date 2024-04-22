<?php
    require_once('include.php');
    
    $session = new Session();
    $db = getDatabaseConnection();

    $seller_id = getSellerOfProduct($db, $_GET['product_id']);
    protectPageUser($session, $seller_id); // Must be logged in and with the right account

    ?>
    <h2>Shipping Forms</h2>
    <script src="/js/shipping_form.js" defer></script>

    <?php
    require_once('include.php');
    $db = getDatabaseConnection();
    $shippingInfo = getShippingWithId($db, $_GET['product_id'], $_GET['purchase_id']);
    ?><p><?php echo 'Purchase date: ' . $shippingInfo['date']; ?></p><?php
    ?><p><?php echo 'Destination address: ' . $shippingInfo['address']; ?></p><?php
    ?><p><?php echo 'Destination Zip Code: ' . $shippingInfo['zipcode']; ?></p><?php
    ?><p><?php echo 'Buyer Name: ' . $shippingInfo['name']; ?></p><?php

?>