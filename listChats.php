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
        <div class="list-chats">
            <a href="chat.php?buyerId=<?php echo $chat['id']?>&productId=<?php echo $_GET['productId']?>">
                <div class="chat">
                        <img src="<?php echo $chat['profileImg'] ?>" alt="Profile Image" class="profile-image">

                        <div class="user-info">
                            <p class="user-name">User: <?php echo $chat['username']?></p>
                        </div>
                </div>
            </a>    
        </div>    
    <?php } ?>
</div>    
<?php } ?>


<?php
    output_footer();
?>
