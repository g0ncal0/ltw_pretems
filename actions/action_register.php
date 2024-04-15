<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../session.php');
    require_once(__DIR__ . '/../db/connection.php');
    require_once(__DIR__ . '/../templates/common.php');

    $session = new Session();
    $db = getDatabaseConnection();

    function findUserEmail(PDO $db, string $email){  // TODO: Put in different file
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute(array($email));
        $user = $stmt->fetch(); // Fetch only one row
        return $user;
    }

    function addUserToDatabase($db, $user){ //TODO: Put in different file
        $stmt = $db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($user['name'], $user['id'], $user['email'], $user['username'], $user['password'], $user['admin'], $user['profileImg']));
    }

    $user = findUserEmail($db, $_POST['r-email']);
    if (!$user){ // User does not already exist (success)
        echo "<h2>User registered</h2>";  // TODO: Remove (DEBUG)

        $user['name'] = $_POST['r-name'];
        $user['email'] = $_POST['r-email'];
        $user['username'] = $_POST['r-name']; // TODO: Change form to ask for username
        $user['password'] = $_POST['r-password']; // FIXME: Encrypt password with sha1?
        $user['admin'] = false; // TODO: How does an admin register?
        $user['profileImg'] = 'img/profile.png'; 

        // TODO: Remove (DEBUG)
        echo $user['name']; echo '<br>';
        echo $user['email']; echo '<br>';
        echo $user['username']; echo '<br>';
        echo $user['password']; echo '<br>';
        echo $user['admin']; echo '<br>';
        echo $user['profileImg'];
        
        // TODO: Check if a field is empty
        // FIXME: A user that is already logged in can log in again (and register) 

        addUserToDatabase($db, $user);

        $session->setId($user['id']);
        $session->setName($user['name']);
        $session->addMessage('success', 'Login successful!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else { // User found
        echo "<h2>A user with this email already exists</h2>";
        $session->addMessage('error', 'This user already exists');
    }
?>