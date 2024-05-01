<?php
    require_once(__DIR__ . '/../include.php');
    $session = new Session();
    header('Content-Type: application/json');
    $response['success'] = false;
    // if you are logged in, you are logged out.
    if($session->isLoggedIn()){
        $session->logOut();
    }
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode($response);
        return;
    }

    sleep(1.5);

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!isset($email) || !isset($password)){
        echo json_encode($response);
        return;
    }
    $db = getDatabaseConnection();

    $user = getUserWithPassword($db, $email, $password);


    if ($user){ // User found
        $session->setId($user['id']);
        $session->setName($user['name']);
        $session->setAdmin((bool) $user['admin']);
        $response['success'] = true;
    }

    echo json_encode($response);
?>