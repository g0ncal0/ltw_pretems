<?php 
    require_once('include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $buyerId = $_GET['buyerId'];
    $productId = $_GET['productId'];

    $product = getProduct($db, $productId);

    output_header($db,  "Chat-" . $productId . "-" . $buyerId, null, $session->getId());
    protectPage();

    if (($session->getId() != $buyerId) && ($session->getId() != $product['user'])) { ?>
        <section class="container protectedpage">
            <h1>You found a protected page</h1>
            <p>Login or register to continue on this page!</p>
        </section>
    <?php }  
    
    else {
        $messages = getMessages($db, $productId, $buyerId);
        $buyer = getUser($db, $buyerId);
        $product = getProduct($db, $productId);
        $seller = getUser($db, $product['user']);

        ?>
        <section class="container">
            <h1>Chat</h1>
            <section class="messages">            
            <?php foreach($messages as $message) {
                if ($message['fromBuyer']) { ?>
                    <div class="messageFromBuyer">
                        <?php output_message($message, $buyer['name']); ?>
                    </div>    
                <?php }
                else { ?>
                    <div class="messageFromSeller">
                        <?php output_message($message, $seller['name']); ?>
                    </div>

                <?php }
            } ?>
            </section>
        </section>    
    <?php }

    output_footer();
?>