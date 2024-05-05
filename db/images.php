<?php 

function insertProductImage($db, $product_id) {
    execute($db, 'INSERT INTO productImgs (product) VALUES (?)', array($product_id));
}

function updatePath($db, $img_id, $path) {
    execute($db, 'UPDATE productImgs SET path = ? WHERE id = ?', array($path, $img_id));
}

function uploadProductFirstImage($db, $image, $id) {
    $file_tmp = $image['tmp_name'];

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

function uploadProductImages($db, $images, $id) {
    for ($i = 0; $i < count($images['name']); $i++) {
        $file_tmp = $images['tmp_name'][$i];

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
    }
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

function getImagesOfProduct($db, $id) {
    return fetchAll($db, 'SELECT * FROM productImgs WHERE product = ?', array($id));
}

function getImage($db, $id) {
    return fetch($db, 'SELECT * FROM productImgs WHERE id = ?', array($id));
}

function deleteImage($db, $path) {
    execute($db, 'DELETE FROM productImgs WHERE path = ?', array($path));
    unlink('../' . $path);
}

function changeFirstImage($db, $id, $firstImg) {
    $product = getProduct($db, $id);
    $path = $product['firstImg'];

    deleteImage($db, $path);

    $newPath = uploadProductFirstImage($db, $firstImg, $id);

    execute($db, 'UPDATE products SET firstImg = ? WHERE id = ?', array($newPath, $id));
}

function deleteProductImages($db, $id, $deleted_images) {
    foreach ($deleted_images as $imageId) {
        $path = getImage($db, $imageId)['path'];
        deleteImage($db, $path);
    }
}

?>