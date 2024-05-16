<?php 
    require_once('include.php');
    $session = new Session();

    $itemname = "Beautiful Dress";
    $itemdescription = "A very beautiful dress only used once.";

    $db = getDatabaseConnection();

    $id = $_GET['id'];
    $product = getProduct($db, $id);

    $user = getUser($db, $product['user']);
    $category = getCategory($db, $product['category']);
    $brand = getBrand($db, $product['brand']);
    $size = getSize($db, $product['size']);
    $condition = getCondition($db, $product['condition']);
    $fav = getFav($db, $product['id'], $session->getId());
 
    output_header($db, $item['name'], $item['description'], $session->getId(), $session);
    
    if(empty($product)){
        errorPage("No item", "The product may have been deleted");
    }

    $images = getImagesOfProduct($db, $id);
    
    output_full_item($product, $session->getId(), $images, $user, $category, $brand, $size, $condition, $fav, $session);
    output_footer();
?>