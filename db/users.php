<?php 

function getAllUsers($db) {
    return fetchAll($db, 'SELECT * FROM users', null);
}

function getUser($db, $user) {
    return fetch($db, 'SELECT * FROM users WHERE id = ?', array($user));
}

function changeProfile($db, $id, $name, $email, $password, $image) {
    if ($image['size'] == 0) {
        execute($db, 'UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?', array($name, $email, $password, $id));
    }    

    else {
        $image_path = uploadProfileImage($db, $image, $id);
        execute($db, 'UPDATE users SET name = ?, email = ?, password = ?, profileImg = ? WHERE id = ?', array($name, $email, $password, $image_path, $id));
    }
}

function getUserWithPassword($db, $email, $password){
    $stmt = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
    $stmt->execute(array($email, $password));
    $user = $stmt->fetch(); // Fetch only one row
    return $user;
}

function getUserWithEmail($db, $email){
    $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute(array($email));
    $user = $stmt->fetch(); // Fetch only one row
    return $user;
}

function addUser($db, $user){
    $stmt = $db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($user['name'], $user['id'], $user['email'], $user['username'], $user['password'], $user['admin'], $user['profileImg']));
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

?>