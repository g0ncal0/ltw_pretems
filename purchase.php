<?php 
  declare(strict_types = 1);
    require_once('include.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $purchaseId = $_GET['id'];

    output_header($db, "Your purchase", null, $session->getId());    

    $purchase = getPurchase($db, $purchaseId, $session->getId());
    if(empty($purchase) || !isset($purchase) || !$session->isLoggedIn()){
        errorPage("Not valid", "Return home");
    }
    

    ?>
   
    <div class="container">
    <h1>Purchase</h1>
    <p><?=$purchaseId?></p>
    <p><span class="special">Address:</span> <?=$purchase['address']?></p>
    <p><span class="special">ZipCode:</span> <?=$purchase['zipcode']?></p>
    <?php

        if($purchase['status'] == 0){
            ?>
            <p>Your purchase awaits payment</p>
            <h2>Pay</h2>
            <p>Total amount: <?=$purchase['cost']?></p>
            <form method="post" action="/actions/action_pay.php">
                <label for="card">Credit Card</label>
                <input type="text" name="card" id="card">

                <input type="hidden" name='id' value='<?=$purchaseId?>'>
                <button type="submit">PAY</a>
            </form>
            <?php
        }else{
            echo "<p>Your purchase has been paid and is being sent.</p>";
        }

    ?>



    
    </div>
    <?php
    output_footer();
?>