<?php
    require_once('include.php');
    
    $session = new Session();
    $db = getDatabaseConnection();

    $seller_id = getSellerOfProduct($db, $_GET['product_id']);
    protectPageUser($session, $seller_id); // Must be logged in and with the right account
    
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
        <div class="shipping-form">
            <h2>Shipping Forms</h2>
        <?php
        require_once('include.php');
        $db = getDatabaseConnection();
        $shippingInfo = getShippingWithId($db, $_GET['product_id'], $_GET['purchase_id']);?>
            <p><?='Purchase date: ' . $shippingInfo['date']; ?></p>
            <p><?= 'Destination address: ' . $shippingInfo['address']; ?></p>
            <p><?= 'Destination Zip Code: ' . $shippingInfo['zipcode']; ?></p>
            <p><?= 'Buyer Name: ' . $shippingInfo['name']; ?></p>
        </div>
        <script>
            window.print();
        </script>
    </html><?php


?>