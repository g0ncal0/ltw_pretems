<?php

require_once(__DIR__ . '/error.php'); 


function protectPage($session) {
    if(!isset($session)){
        exit;
    }
    if (!$session->isLoggedIn()) {
        errorPage("You found a protected page", "Login or register to continue on this page!");
        
        // header("Location: register.php")
        exit;
    }
}

function protectPageUser($session, $user_id) { // User is logged in and with the right account
    if(!isset($session)){
        exit;
    }
    if (!$session->isLoggedIn() || $session->getId() != $user_id) {
        errorPage("You found a protected page", "Nothing here for you");
        
        // header("Location: register.php")
        exit;
    }
}

function protectPageAdmins($session){
    if(!isset($session)){
        exit;
    }
    if(!$session->isLoggedIn() || $session->getAdmin() !== TRUE){
        errorPage("This page is restricted for admins", "Nothing here for you");
        exit;
    }
}


function protectAPIloggedIN($session){
    if(!isset($session)){
        exit;
    }
    // protect to logged in users
    if(!$session->isLoggedIn()){
        errorAPI("Requires account.");
        exit;
    }
}

function protectAPIadmin($session){
    if(!isset($session)){
        exit;
    }
    // not logged in or not admin
    if(!$session->isLoggedIn() || $session->getAdmin() !== TRUE){
        errorAPI("Not enough permissions");
        exit;
    }
}

function protectActionloggedIn($session){
    if(!isset($session)){
        exit;
    }
    if(!$session->isLoggedIn()){
        // TODO - improve action here
        exit;
    }
}

?>