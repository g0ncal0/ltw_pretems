<?php 
    declare(strict_types = 1);

    function output_message(array $message, array $user, bool $isBuyer) : void { ?>
        <img src="<?= $user['profileImg'] ?>" alt="Profile Image" class="profile-image"> <?php
        if ($isBuyer){ ?>
            <div class="messageFromBuyer"><?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        } else{ ?>
            <div class="messageFromSeller"><?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        } ?>
            <p> <?php echo $message['message'] ?> </p>
            <p class="message-from">
                <?php echo $user['name'] ?>
                <?php echo $message['date'] ?>
            </p>
        </div>    
    <?php }
?>    