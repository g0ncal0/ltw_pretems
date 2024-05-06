<?php

require_once(__DIR__ . '/../db/products.php');
// this file contains code that mmixes db accesses and outputs to simplify code in main files



function output_featured($db) { 
    $featured = getFeatured($db); 
    ?>
    <section class="container">
        <h2><span class="special">Featured</span> Items</h2>
        <?php output_list_items($featured, $db); ?>
    </section>

<?php }

function output_list_categories($db, $parentclass, $childclass){
    $categories = getCategories($db);
    echo "<ul class='$parentclass'>";
    foreach($categories as $category){?>
        <li class="<?=$childclass?>"><a href="/items.php?category=<?php echo $category['id'] ?>"><?php echo $category["name"] ?></a></li>
    <?php }
    echo "</ul>";
}
?>
