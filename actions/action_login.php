<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../session.php'); // 
    $session = new Session();  // FIXME:

    //require_once(__DIR__ . '/../database/connection.db.php');  // TODO: Create file
    //$db = getDatabaseConnection();

    //require_once('/../templates/common.php');

    function findUsers(PDO $db, string $email, string $password){
        // FIXME:
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
        $stmt->execute(array($email, $password));
        $users = $stmt->fetchAll();
        return $users;
    }

    $users = findUsers($db, $_POST['email'], $_POST['password']);  //TODO: Use when db created

    if ($user){ // User found
        $session->setId($user->id);
        $session->setName($user->name());
        $session->addMessage('success', 'Login successful!');
    }
    else{ // User not found
        $session->addMessage('error', 'Wrong password!');
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']); // TODO: ???
?>