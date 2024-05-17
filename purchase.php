<?php 
  declare(strict_types = 1);
    require_once('include.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $purchaseId = $_GET['id'];

    output_header($db, "Your purchase", null, $session->getId(), $session);    

    $purchase = getPurchase($db, $purchaseId, $session->getId());
    if(empty($purchase) || !isset($purchase) || !$session->isLoggedIn()){
        errorPage("Not valid", "Return home");
    }
    

    simpleheader("Your Purchase");

    ?>
   
    <div class="container">
    <p>ID: <?=$purchaseId?></p>
    <p><span class="special">Address:</span> <?=$purchase['address']?></p>
    <p><span class="special">ZipCode:</span> <?=$purchase['zipcode']?></p>
    <p><span class="special">Total amount:</span> <?=$purchase['cost']?>€</p>

    <?php

        if($purchase['status'] == 0){
            ?>
            <p>Your purchase awaits payment</p>
            <h2>Pay</h2>
            <form class="styled-input" method="post" action="/actions/action_pay.php">
                <input type="hidden" id="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

                <label for="card">Credit Card</label>
                <input type="text" name="card" id="card">

                <input type="hidden" name='id' value='<?=$purchaseId?>'>
                <button class="button" type="submit">PAY</button>
            </form>
            <?php
        }else{
            echo "<p>Your purchase has been paid and is being sent.</p>";
        }

    ?>

        <h2>The items you bought</h2>

        <div class="products">

        <?php
            $itemsPurch = getItemsPurchased($db, $purchaseId);

            foreach($itemsPurch as $itm){
                $product = getProduct($db, $itm['productid']);
                output_item($product, $db);
            }

        

    ?>
        </div>


    
    </div>
    <?php
    output_footer();
?>