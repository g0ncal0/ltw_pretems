<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../session.php');
    require_once(__DIR__ . '/../db/connection.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../db/users.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $user = getUserWithEmail($db, $_POST['r-email']);
    if (!$user){ // User does not already exist (success)
        echo "<h2>User registered successfully</h2>";  // TODO: Remove (DEBUG)

        $user['name'] = $_POST['r-name'];
        $user['email'] = $_POST['r-email'];
        $user['username'] = $_POST['r-username'];
        $user['password'] = $_POST['r-password']; // FIXME: Encrypt password with sha1?
        $user['admin'] = false; // TODO: How does an admin register?
        $user['profileImg'] = 'img/profile/profile.png'; 
        
        // TODO: Check if a field is empty
        // FIXME: A user that is already logged in can log in again (and register) 

        addUser($db, $user);
        $user = getUserWithPassword($db, $user['email'], $user['password']); // Necessary in order to get ID

        $session->setId($user['id']);
        $session->setName($user['name']);
        $session->setAdmin((bool) $user['admin']);
        $session->addMessage('success', 'Login successful!');
        header('Location: /../index.php'); // Go back to main page
    } else { // User found
        echo "<h2>A user with this email already exists</h2>";
        $session->addMessage('error', 'This user already exists');
    }
?>