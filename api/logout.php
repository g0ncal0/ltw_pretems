<?php
    require_once(__DIR__ . '/../include.php');
    $session = new Session();


    if($session->isLoggedIn()){
        $session->logOut();
    }

?>