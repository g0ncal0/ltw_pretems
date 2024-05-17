<?php

declare(strict_types = 1);
require_once(__DIR__ . '/../db/products.php');
// this file contains code that mmixes db accesses and outputs to simplify code in main files



function output_list_categories(PDO $db, ?string $parentclass, ?string $childclass) : void {
    $categories = getCategories($db);
    echo "<ul class='$parentclass'>";
    foreach($categories as $category){?>
        <li class="<?=$childclass?>"><a href="/items.php?category=<?php echo $category['id'] ?>"><?php echo $category["name"] ?></a></li>
    <?php }
    echo "</ul>";
}
?>
