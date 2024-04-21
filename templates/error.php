<?php

function errorPage($error, $description){
    ?>
    <section class="container protectedpage">
        <h1><?php echo $error?></h1>
        <p><?php echo $description ?></p>
        <a href="/">Head home</a>
    </section>
    <?php
}

function errorAPI($error){
    $message = array();
    $message['error'] = $error;    
    header('Content-Type: application/json');
    echo json_encode($message);
}


?>