<?php
    // ALLOWED: 'insert', 'remove', 'empty'
    require_once(__DIR__ . '/../include.php');
    header('Content-Type: application/json');

    $session = new Session();
    $data = array();
    
    
    if($session->isLoggedIn()){
        $data['user'] = True;
        $data['id'] = $session->getId();
        return;
    }else{
        $data['user'] = False;
        $data['id'] = NULL;
    }

    echo json_encode($data);


?>