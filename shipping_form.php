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
            <div class="shipping-header">
                <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
                <a  href="/"><img class="logo-img" src="/img/logo.png"></a>

            </div>
            <h2>Shipping Forms</h2>
        <?php
        require_once('include.php');
        $db = getDatabaseConnection();
        $shippingInfo = getShippingWithId($db, $_GET['product_id'], $_GET['purchase_id']);?>
            <div class="shipping-info">
                <p class="special"><?='Purchase date: '?></p>
                <p><?=$shippingInfo['date'];?></p>
                <p class="special"><?= 'Destination address: ';?></p>
                <p><?=$shippingInfo['address'];?></p>
                <p class="special"><?= 'Destination Zip Code: ';?></p>
                <p><?=$shippingInfo['zipcode']; ?></p>
                <p class="special"><?= 'Buyer Name: ';?></p> 
                <p><?=$shippingInfo['name']; ?></p>
            </div>
        </div>
        <script>
            window.print();
        </script>
    </html><?php


?>