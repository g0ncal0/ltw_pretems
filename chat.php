<?php 
    require_once('include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $buyerId = $_GET['buyerId'];
    $productId = $_GET['productId'];

    $product = getProduct($db, $productId);

    output_header($db,  "Chat-" . $productId . "-" . $buyerId, null, $session->getId()); ?>

    <script src="/js/chat.js" defer></script>

    <?php protectPage($session);

    if (($session->getId() != $buyerId) && ($session->getId() != $product['user'])) { ?>
        <?php errorPage("Access Forbidden","You can not access this url.");?>
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
                    <div class="fromBuyer">
                        <?php output_message($message, $buyer, true); ?>
                    </div>    
                <?php }
                else { ?>
                    <div class="fromSeller">
                        <?php output_message($message, $seller, false); ?>
                    </div>

                <?php }
            } ?>
            </section>

            <form id="newCommentForm">
                <input type="hidden" id="productId" name="productId" value=<?php echo $productId?>>
                <input type="hidden" id="buyerId" name="buyerId" value=<?php echo $buyerId?>>

                <textarea id="newMessage" name="newMessage" placeholder="Write a message" rows="2" cols="50"></textarea>
                <button class="button">Submit</button>
            </form>

        </section>    
    <?php }

    output_footer();
?>