<?php 

function getUser($db, $user) {
    return fetch($db, 'SELECT * FROM users WHERE id = ?', array($user));
}

function changeProfile($db, $id, $name, $email, $password) {
    execute($db, 'UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?', array($name, $email, $password, $id));
}

?>