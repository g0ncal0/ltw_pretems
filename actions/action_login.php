<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../session.php');
    require_once(__DIR__ . '/../db/connection.php');
    require_once(__DIR__ . '/../templates/common.php');

    $session = new Session();  // TODO: change
    $db = getDatabaseConnection();

    function findUser(PDO $db, string $email, string $password){
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
        $stmt->execute(array($email, $password));
        $user = $stmt->fetch(); // Fetch only one row
        return $user;
    }

    $user = findUser($db, $_POST['email'], $_POST['password']);

    if ($user){ // User found
        $session->setId($user['id']);
        $session->setName($user['name']);
        $session->addMessage('success', 'Login successful!'); // TODO: use when logged in main page
    }
    else{ // User not found
        $session->addMessage('error', 'Email or password incorrect!'); // TODO: use when logged in main page failed
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']); // TODO: Remove? (Goes back to main page)
?>