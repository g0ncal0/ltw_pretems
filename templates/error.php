<?php

declare(strict_types = 1);

function errorPage(?string $error, ?string $description) : void {
    ?>
    <section class="container protectedpage">
        <h1><?php echo $error?></h1>
        <p><?php echo $description ?></p>
        <a href="/">Head home</a>
    </section>
    <?php
    die();
}

function errorAPI(?string $error) : void {
    $message = array();
    $message['error'] = $error;    
    header('Content-Type: application/json');
    echo json_encode($message);
}


?>