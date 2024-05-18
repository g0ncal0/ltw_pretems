<?php
    require_once(__DIR__ . '/../include.php');
    header('Content-Type: application/json');

    $data = array();
    $session = new Session();


    if(isset($_GET['userId'])){
        $db = getDatabaseConnection();
        // then, we are getting users info
        $user = getNamePhotoUser($db, $_GET['userId']);
        echo json_encode($user);
        exit();
    }
   
    if($session->isLoggedIn()){
        $data['user'] = True;
        $data['id'] = $session->getId();
    }else{
        $data['user'] = False;
        $data['id'] = NULL;
    }

    echo json_encode($data);


?>