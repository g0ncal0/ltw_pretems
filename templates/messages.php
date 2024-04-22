<?php 
    function output_message($message, $name) { ?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
        <p> <?php echo $message['message'] ?> </p>
        
        <footer>
            <?php echo $name ?>
            <?php echo $message['date'] ?>
        </footer>    
    <?php }
?>    