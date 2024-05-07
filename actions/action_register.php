<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../session.php');
    require_once(__DIR__ . '/../db/connection.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../db/users.php');

    $session = new Session();
    if($session->isLoggedIn()){
        header('Location: /../index.php'); // Go back to main page
    }
    $db = getDatabaseConnection();

    $userWithMail = getUserWithEmail($db, $_POST['r-email']);
    $userWithUsername = getUserWithUsername($db, $_POST['r-username']);
    if ((!$userWithMail) && (!$userWithUsername)){ // User does not already exist (success)
       
        $user['name'] = $_POST['r-name'];
        $user['email'] = $_POST['r-email'];
        $user['username'] = $_POST['r-username'];
        $user['password'] = $_POST['r-password']; // FIXME: Encrypt password with sha1?
        $user['admin'] = false; // TODO: How does an admin register?
        $user['profileImg'] = 'img/profile/profile.png'; 
        
        // TODO: Check if a field is empty
        if(empty($user['name']) || empty($user['email']) || empty($user['username']) || empty($user['password']) || strlen($user['password']) < 6){
            header('Location: /../register.php?error=Invalid%20Data');
            exit();
        }

        addUser($db, $user);
        $user = getUserWithPassword($db, $user['email'], $user['password']); // Necessary in order to get ID

        $session->setId($user['id']);
        $session->setName($user['name']);
        $session->setAdmin((bool) $user['admin']);
        header('Location: /../index.php'); // Go back to main page
    } else if ($userWithMail){ // User found
        if ($userWithUsername) {
            header('Location: /../register.php?error=InvalidEmailAndUsername');
        }
        else {
            header('Location: /../register.php?error=InvalidEmail');
        }
    }
    else {
        header('Location: /../register.php?error=InvalidUsername');
    }
?>