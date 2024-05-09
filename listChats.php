<?php 
    require_once('include.php');
    $session = new Session();

    $db = getDatabaseConnection();
    
   
    output_header($db, "List chats", null, $session->getId());

    simpleheader("List of chats for this product");

    $chats = getChats($db, $_GET['productId']);
    $product = getProduct($db, $_GET['productId']);

    if ($session->getId() != $product['user']) { ?>
        <?php errorPage("Access Forbidden","You can not access this url.");?>
    <?php }

    else { ?>

<div class="container">
    <?php foreach($chats as $chat) { ?>
        <div id="chat">
            <a href="chat.php?buyerId=<?php echo $chat['id']?>&productId=<?php echo $_GET['productId']?>">
            <img src="<?php echo $chat['profileImg'] ?>"  width="100" height="100">

            <h2><?php echo $chat['username']?></h2>
            </a>        
        </div>
    <?php } ?>
</div>    
<?php } ?>


<?php
    output_footer();
?>
