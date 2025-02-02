<?php

declare(strict_types = 1);
require_once(__DIR__ . '/error.php'); 


function protectPage(?Session $session) : void {
    if(!isset($session)){
        exit;
    }
    if (!$session->isLoggedIn()) {
        errorPage("You found a protected page", "Login or register to continue on this page!");
        
        // header("Location: register.php")
        exit;
    }
}

function protectPageUser(?Session $session, int $user_id) : void { // User is logged in and with the right account
    if(!isset($session)){
        exit;
    }
    if (!$session->isLoggedIn() || $session->getId() != $user_id) {
        errorPage("You found a protected page", "Nothing here for you");
        
        // header("Location: register.php")
        exit;
    }
}

function protectPageAdmins(?Session $session) : void {
    if(!isset($session)){
        exit;
    }
    if(!$session->isLoggedIn() || $session->getAdmin() !== TRUE){
        errorPage("This page is restricted for admins", "Nothing here for you");
        exit;
    }
}


function protectAPIloggedIN(?Session $session) : void {
    if(!isset($session)){
        exit;
    }
    // protect to logged in users
    if(!$session->isLoggedIn()){
        errorAPI("Requires account.");
        exit;
    }
}

function protectAPIadmin(?Session $session) : void {
    if(!isset($session)){
        exit;
    }
    // not logged in or not admin
    if(!$session->isLoggedIn() || $session->getAdmin() !== TRUE){
        errorAPI("Not enough permissions");
        exit;
    }
}

function protectActionloggedIn(?Session $session) : void {
    if(!isset($session)){
        exit;
    }
    if(!$session->isLoggedIn()){
        header('Location: /index.php'); // Go back to main page
        exit;
    }
}

// iterates over all strings and checks if they are defined in POST or GET
function areAllElementsListDefined(array $list, array $toverify) : bool{
    foreach($toverify as $el){
        var_dump($list[$el]);
        var_dump($el);
        if(!isset($list[$el])){
            return false;
        }
    }
    return true;
}

?>