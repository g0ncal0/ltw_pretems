<?php 

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

?>