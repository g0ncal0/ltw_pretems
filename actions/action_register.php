<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../session.php');
    require_once(__DIR__ . '/../db/connection.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../db/users.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $inputEmail = strtolower($_POST['r-email']); // Emails are case insensitive
    $userWithMail = getUserWithEmail($db, $inputEmail);
    $userWithUsername = getUserWithUsername($db, $_POST['r-username']);
    $blockedUser = getBlockedUser($db, $inputEmail);

    if($session->isLoggedIn()){
        header('Location: /../index.php'); // Go back to main page
    }

    else if ($session->getCSRF() !== $_POST['csrf']) {
        header('Location: ../register.php?error=' . urlencode("This request looks invalid"));
    }

    else if ((!$userWithMail) && (!$userWithUsername) && (!$blockedUser)){ // User does not already exist (success)
        $user['name'] = $_POST['r-name'];
        $user['email'] = $inputEmail;
        $user['username'] = $_POST['r-username'];
        $user['password'] = $_POST['r-password']; 
        $user['admin'] = false; 
        $user['profileImg'] = 'img/profile/profile.png'; 
        
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
    else if ($userWithUsername) {
        header('Location: /../register.php?error=InvalidUsername');
    }
    else if ($blockedUser) {
        header('Location: /../register.php?error=InvalidBlockedUser');
    }
?>