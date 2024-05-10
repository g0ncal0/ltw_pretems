<?php 

function getAllUsers($db) {
    return fetchAll($db, 'SELECT * FROM users', null);
}

function getUser($db, $user) {
    return fetch($db, 'SELECT * FROM users WHERE id = ?', array($user));
}

function changeProfile($db, $id, $name, $email, $password, $image) {
    $options = ['cost' => 12];
    $password = password_hash($password, PASSWORD_DEFAULT, $options);

    if ($image['size'] == 0) {
        execute($db, 'UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?', array($name, $email, $password, $id));
    }    

    else {
        $image_path = uploadProfileImage($db, $image, $id);
        execute($db, 'UPDATE users SET name = ?, email = ?, password = ?, profileImg = ? WHERE id = ?', array($name, $email, $password, $image_path, $id));
    }
}

function getUserWithPassword($db, $email, $password){
    $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute(array($email));
    $user = $stmt->fetch(); // Fetch only one row

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }

    return false;
}

function getUserWithIdAndPassword($db, $id, $password){
    $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute(array($id));
    $user = $stmt->fetch(); // Fetch only one row

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }

    return false;
}

function getUserWithEmail($db, $email){
    $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute(array($email));
    $user = $stmt->fetch(); // Fetch only one row

    return $user;
}

function getUserWithUsername($db, $username){
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch(); // Fetch only one row

    return $user;
}

function addUser($db, $user){
    $options = ['cost' => 12];
    $password = password_hash($user['password'], PASSWORD_DEFAULT, $options);
    $stmt = $db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($user['name'], $user['id'], $user['email'], $user['username'], $password, $user['admin'], $user['profileImg']));
}

function setAdmin($db, $id){
    $stmt = $db->prepare('UPDATE users SET admin = TRUE WHERE id = ?');
    $stmt->execute(array($id));
}

function isAdmin($db, $id){
    $stmt = $db->prepare('SELECT admin FROM users WHERE id = ?');
    $stmt->execute(array($id));
    $isAdmin = $stmt->fetchColumn();
    return (bool) $isAdmin;
}

function blockUser($db, $id) {
    $user = getUser($db, $id);
    $products = getProductsOfUser($db, $id);

    foreach ($products as $product) {
        deleteProduct($db, $product['id']);
    }

    execute($db, 'INSERT INTO blockedUsers VALUES (?)', array($user['email']));

    execute($db, 'DELETE FROM profileImgs WHERE userId = ?', array($id));
    execute($db, 'DELETE FROM cart WHERE user = ?', array($id));
    execute($db, 'DELETE FROM favorites WHERE user = ?', array($id));
    execute($db, 'DELETE FROM messages WHERE buyerId = ?', array($id));
    execute($db, 'DELETE FROM users WHERE id = ?', array($id));
}

function getBlockedUser($db, $email) {
    return fetch($db, 'SELECT * FROM blockedUsers WHERE user = ?', array($email));
}

?>