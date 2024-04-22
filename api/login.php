<?php
    require_once(__DIR__ . '/../include.php');
    $session = new Session();

    // if you are logged in, you are logged out.
    if($session->isLoggedIn()){
        $session->logOut();
    }


    $email = $_POST['email'];
    $password = $_POST['password'];
    

?>