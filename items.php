<?php 
    require_once('templates/common.php');
    require_once('db/connection.php');
    require_once('templates/home.php');
    require_once('db/products.php');

    output_header("Our catalogue", null);
?>
<main>

<?php
    $db = getDatabaseConnection();
    $items = getAllProducts($db);
    output_list_items($items);
?>

</main>

