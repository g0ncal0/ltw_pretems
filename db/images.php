<?php 

function insertProductImage($db, $product_id) {
    execute($db, 'INSERT INTO productimgs (productid) VALUES (?)', array($product_id));
}

function updatePath($db, $img_id, $path) {
    execute($db, 'UPDATE productimgs SET path = ? WHERE id = ?', array($path, $img_id));
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
    $relative_path = "../img/products/$id.jpg";
    $path = "img/products/$id.jpg";

    updatePath($db, $img_id, $path);

    imagejpeg($original, $relative_path);

    return $path;
}

?>