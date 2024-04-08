<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../session.php');
    $session = new Session();  // FIXME:

    require_once(__DIR__ . '/../db/connection.php');
    //$db = getDatabaseConnection(); //FIXME: 
    $db = new PDO('sqlite:../db/db.sqlite');  //temporary

    require_once(__DIR__ . '/../templates/common.php');

    function findUsers(PDO $db, string $email, string $password){
        // FIXME:
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
        $stmt->execute(array($email, $password));
        $users = $stmt->fetchAll();
        return $users;
    }
    
    $users = findUsers($db, $_POST['email'], $_POST['password']);

    if ($user){ // User found
        $session->setId($user->id);
        $session->setName($user->name());
        $session->addMessage('success', 'Login successful!');
        echo "User found";
    }
    else{ // User not found
        $session->addMessage('error', 'Wrong password!');
        echo "User not found";
    }

    //header('Location: ' . $_SERVER['HTTP_REFERER']); // TODO: ???
?>