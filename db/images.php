<?php 

function insertProductImage($db, $product_id) {
    execute($db, 'INSERT INTO productImgs (product) VALUES (?)', array($product_id));
}

function updatePath($db, $img_id, $path) {
    execute($db, 'UPDATE productImgs SET path = ? WHERE id = ?', array($path, $img_id));
}

function uploadProductImages($db, $images, $id) {
    $file_tmp = $images['tmp_name'];

    $original = @imagecreatefromjpeg($file_tmp);
    if (!$original) $original = @imagecreatefrompng($file_tmp);
    if (!$original) $original = @imagecreatefromgif($file_tmp);

    if (!$original) die('Unknown image format!');

    insertProductImage($db, $id);

    // Get image ID
    $img_id = $db->lastInsertId();

    // Generate filenames
    $relative_path = "../img/products/$img_id.jpg";
    $path = "img/products/$img_id.jpg";

    updatePath($db, $img_id, $path);

    imagejpeg($original, $relative_path);

    return $path;
}

function uploadProfileImage($db, $image, $id) {
    $file_tmp = $image['tmp_name'];

    $original = @imagecreatefromjpeg($file_tmp);
    if (!$original) $original = @imagecreatefrompng($file_tmp);
    if (!$original) $original = @imagecreatefromgif($file_tmp);

    if (!$original) die('Unknown image format!');

    // Generate filenames
    $relative_path = "../img/profile/$id.jpg";
    $path = "img/profile/$id.jpg";

    imagejpeg($original, $relative_path);

    return $path;
}

?>