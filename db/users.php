<?php 

function getUser($db, $user) {
    return fetch($db, 'SELECT * FROM users WHERE id = ?', array($user));
}

?>