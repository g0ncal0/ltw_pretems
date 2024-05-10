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
    

    simpleheader("Your Purchase");

    ?>
   
    <div class="container">
    <p><?=$purchaseId?></p>
    <p><span class="special">Address:</span> <?=$purchase['address']?></p>
    <p><span class="special">ZipCode:</span> <?=$purchase['zipcode']?></p>
    <p><span class="special">Total amount:</span> <?=$purchase['cost']?>€</p>

    <?php

        if($purchase['status'] == 0){
            ?>
            <p>Your purchase awaits payment</p>
            <h2>Pay</h2>
            <form class="styled-input" method="post" action="/actions/action_pay.php">
                <label for="card">Credit Card</label>
                <input type="text" name="card" id="card">

                <input type="hidden" name='id' value='<?=$purchaseId?>'>
                <button class="button" type="submit">PAY</a>
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